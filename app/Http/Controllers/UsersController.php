<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Association;
use App\Models\Partner;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(User::allowedRoles())],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('showSignup', true);
        }

        // Split full name into first and last names
        $fullName = trim($request->name);
        $nameParts = preg_split('/\s+/', $fullName, -1, PREG_SPLIT_NO_EMPTY);
        $firstName = $nameParts[0] ?? '';
        $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';

        DB::beginTransaction();

        try {
            // Create base user
            $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address,
                'bio' => $request->bio,
            ]);

            // Create role-specific profile
            $this->createRoleProfile($user, $request);

            DB::commit();

            Auth::login($user);

            return redirect()->route('user.profile')
                ->with('success', 'Welcome! Your account has been created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Registration failed. Please try again.'])
                ->withInput()
                ->with('showSignup', true);
        }
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('showLogin', true);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect admin users to dashboard
            if (Auth::user()->isAdmin()) {
                return redirect()->route('back.home')
                    ->with('success', 'Welcome back, '.Auth::user()->name.'!');
            }

            return redirect()->route('user.profile')
                ->with('success', 'Welcome back, '.Auth::user()->name.'!');
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput()
            ->with('showLogin', true);
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show user profile (Front Office)
     */
    public function userProfile()
    {
        $user = Auth::user();

        // Eager load the role-specific profile
        $user->load($this->getRoleRelationship($user->role));

        return view('frontOffice.pages.profile', [
            'user' => $user,
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $section = $request->input('section', 'basic');

        // Build validation rules based on the submitted section
        $rules = [];
        if ($section === 'basic') {
            $rules = [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'bio' => 'nullable|string|max:1000',
                // Allow password change from this section too if provided
                'current_password' => 'nullable|required_with:password',
                'password' => 'nullable|min:8|confirmed',
            ];
        } elseif ($section === 'role') {
            // Only validate role-specific fields
            $rules = $this->getRoleValidationRules($user->role);
        } elseif ($section === 'password') {
            // Password-only update
            $rules = [
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
            ];
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            if ($section === 'basic') {
                // Update only basic user info
                $user->full_name = $request->full_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->bio = $request->bio;

                // Handle optional password change from basic section
                if ($request->filled('current_password')) {
                    if (! Hash::check($request->current_password, $user->password)) {
                        return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
                    }
                    $user->password = Hash::make($request->password);
                }

                $user->save();

            } elseif ($section === 'role') {
                // Update only role-specific profile
                $this->updateRoleProfile($user, $request);

            } elseif ($section === 'password') {
                // Password-only update
                if (! Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
                }
                $user->password = Hash::make($request->password);
                $user->save();
            }

            DB::commit();

            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Update failed. Please try again.'])->withInput();
        }
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
            \Storage::disk('public')->delete($user->avatar);
        }

        // Store new avatar
        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        $user->avatar = $avatarPath;
        $user->save();

        return back()->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Display the specified user (for modal view)
     */
    public function show($id)
    {
        $user = User::with([
            'association',
            'supplier',
            'partner',
            'volunteer',
            'admin',
        ])->findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'full_name' => $user->full_name,
            'name' => $user->name,
            'display_name' => $user->display_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'bio' => $user->bio,
            'role' => $user->role,
            'avatar_url' => $user->avatar_url,
            'role_specific_data' => $user->getRoleSpecificData(),
            'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            'created_at_human' => $user->created_at->diffForHumans(),
            'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),
            'updated_at_human' => $user->updated_at->diffForHumans(),
        ]);
    }

    /**
     * Update the specified user (for admin)
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'role' => ['nullable', Rule::in(User::allowedRoles())],
        ];

        $targetRole = $request->role ?? $user->role;
        $rules = array_merge($rules, $this->getRoleValidationRules($targetRole));

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->bio = $request->bio;

            // Handle role change
            if ($request->filled('role') && $request->role !== $user->role) {
                // Delete old role profile
                $this->deleteRoleProfile($user);

                // Update role
                $user->role = $request->role;
                $user->save();

                // Create new role profile
                $this->createRoleProfile($user, $request);
            } else {
                $user->save();
                // Update existing role profile
                $this->updateRoleProfile($user, $request);
            }

            DB::commit();

            return redirect()->route('back.users.index')
                ->with('success', 'User updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Update failed. Please try again.'])->withInput();
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if (Auth::id() === $user->id) {
            return redirect()->route('back.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Delete avatar if exists
        if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
            \Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        // Role profile will be deleted automatically by cascade

        return redirect()->route('back.users.index')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Display a listing of users (for admin)
     */
    public function index(Request $request)
    {
        $query = User::with([
            'association',
            'supplier',
            'partner',
            'volunteer',
            'admin',
        ]);

        // Filter by role if specified
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('association', function ($q) use ($search) {
                        $q->where('organization_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('supplier', function ($q) use ($search) {
                        $q->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('partner', function ($q) use ($search) {
                        $q->where('organization_name', 'like', "%{$search}%");
                    });
            });
        }

        $users = $query->latest()->paginate(10);

        return view('dashboard.components.users.user', compact('users'));
    }

    // ==================== PRIVATE HELPER METHODS ====================

    /**
     * Get role-specific validation rules
     */
    private function getRoleValidationRules(string $role): array
    {
        return match ($role) {
            User::ROLE_ASSOCIATION => Association::validationRules(),
            User::ROLE_SUPPLIER => Supplier::validationRules(),
            User::ROLE_PARTNER => Partner::validationRules(),
            User::ROLE_VOLUNTEER => Volunteer::validationRules(),
            User::ROLE_ADMIN => Admin::validationRules(),
            default => [],
        };
    }

    /**
     * Get the relationship name for a role
     */
    private function getRoleRelationship(string $role): string
    {
        return match ($role) {
            User::ROLE_ASSOCIATION => 'association',
            User::ROLE_SUPPLIER => 'supplier',
            User::ROLE_PARTNER => 'partner',
            User::ROLE_VOLUNTEER => 'volunteer',
            User::ROLE_ADMIN => 'admin',
            default => '',
        };
    }

    /**
     * Create role-specific profile
     */
    private function createRoleProfile(User $user, Request $request): void
    {
        $roleData = $this->extractRoleData($request, $user->role);
        $roleData['user_id'] = $user->id;

        match ($user->role) {
            User::ROLE_ASSOCIATION => Association::create($roleData),
            User::ROLE_SUPPLIER => Supplier::create($roleData),
            User::ROLE_PARTNER => Partner::create(array_merge($roleData, [
                'partnership_start_date' => $request->partnership_start_date ?? now(),
            ])),
            User::ROLE_VOLUNTEER => Volunteer::create(array_merge($roleData, [
                'joined_date' => $request->joined_date ?? now(),
            ])),
            User::ROLE_ADMIN => Admin::create($roleData),
            default => null,
        };
    }

    /**
     * Update role-specific profile
     */
    private function updateRoleProfile(User $user, Request $request): void
    {
        $profile = $user->roleProfile();

        if (! $profile) {
            // Create profile if it doesn't exist
            $this->createRoleProfile($user, $request);

            return;
        }

        $roleData = $this->extractRoleData($request, $user->role);
        $profile->update($roleData);
    }

    /**
     * Delete role-specific profile
     */
    private function deleteRoleProfile(User $user): void
    {
        $profile = $user->roleProfile();

        if ($profile) {
            $profile->delete();
        }
    }

    /**
     * Extract role-specific data from request
     */
    private function extractRoleData(Request $request, string $role): array
    {
        $data = match ($role) {
            User::ROLE_ASSOCIATION => [
                'organization_name' => $request->organization_name,
                'registration_number' => $request->registration_number,
                'mission_statement' => $request->mission_statement,
                'founded_year' => $request->founded_year,
                'website' => $request->website,
                'number_of_members' => $request->number_of_members,
                'organization_type' => $request->organization_type,
            ],
            User::ROLE_SUPPLIER => [
                'company_name' => $request->company_name,
                'business_type' => $request->business_type,
                'product_catalog' => $request->product_catalog,
                'delivery_options' => $request->delivery_options,
                'payment_terms' => $request->payment_terms,
                'rating' => $request->rating,
            ],
            User::ROLE_PARTNER => [
                'organization_name' => $request->organization_name,
                'partnership_type' => $request->partnership_type,
                'industry_sector' => $request->industry_sector,
                'partnership_start_date' => $request->partnership_start_date,
                'contribution_type' => $request->contribution_type,
                'contact_person' => $request->contact_person,
            ],
            User::ROLE_VOLUNTEER => [
                'date_of_birth' => $request->date_of_birth,
                'skills' => $request->skills,
                'availability' => $request->availability,
                'hours_contributed' => $request->hours_contributed ?? 0,
                'joined_date' => $request->joined_date,
                'volunteer_id_number' => $request->volunteer_id_number,
            ],
            User::ROLE_ADMIN => [
                'admin_level' => $request->admin_level ?? 'standard',
                'permissions' => $request->permissions,
            ],
            default => [],
        };

        // Remove null values
        return array_filter($data, fn ($value) => $value !== null);
    }
}
