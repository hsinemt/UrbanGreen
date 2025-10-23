<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:association,partner,volunteer',
        ]);

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

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->input('role', \App\Models\User::ROLE_VOLUNTEER),
        ]);

        Auth::login($user);

        return redirect()->route('user.profile')->with('success', 'Welcome! Your account has been created successfully.');
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
                    ->with('success', 'Welcome back, ' . Auth::user()->name . '!');
            }

            return redirect()->route('user.profile')
                ->with('success', 'Welcome back, ' . Auth::user()->name . '!');
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
        return view('frontOffice.pages.profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
            'role' => 'nullable|in:association,partner,volunteer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update basic info
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
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
        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'bio' => $user->bio,
            'avatar_url' => $user->avatar_url,
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

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('back.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optional: Prevent deleting yourself
        if (Auth::id() === $user->id) {
            return redirect()->route('back.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Delete avatar if exists
        if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
            \Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('back.users.index')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Display a listing of users (for admin)
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.components.users.user', compact('users'));
    }
}
