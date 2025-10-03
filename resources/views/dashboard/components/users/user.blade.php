@extends('dashboard.layouts.dashboard')

@section('title', 'Users List - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Users List</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Users List</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <div class="navbar-search">
                    <input type="text" class="bg-base h-40-px w-auto" id="searchInput" placeholder="Search by name or email">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </div>
            </div>
        </div>

        <div class="card-body p-24">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="akar-icons:circle-check" class="icon text-xl"></iconify-icon>
                        {{ session('success') }}
                    </div>
                    <button class="remove-button text-success-600 text-xxl line-height-1" type="button" data-bs-dismiss="alert" aria-label="Close">
                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                    </button>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="akar-icons:circle-x" class="icon text-xl"></iconify-icon>
                        {{ session('error') }}
                    </div>
                    <button class="remove-button text-danger-600 text-xxl line-height-1" type="button" data-bs-dismiss="alert" aria-label="Close">
                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                    </button>
                </div>
            @endif

            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" id="selectAll">
                                </div>
                                S.L
                            </div>
                        </th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    {{ $users->firstItem() + $index }}
                                </div>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->avatar_url }}"
                                         alt="{{ $user->name }}"
                                         class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                    <div class="flex-grow-1">
                                        <span class="text-md mb-0 fw-normal text-secondary-light">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-md mb-0 fw-normal text-secondary-light">{{ $user->email }}</span></td>
                            <td>
                                @if($user->phone)
                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{ $user->phone }}</span>
                                @else
                                    <span class="text-secondary-light">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <button type="button"
                                            onclick="viewUser({{ $user->id }})"
                                            class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                            title="View">
                                        <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                    </button>
                                    <button type="button"
                                            onclick="editUser({{ $user->id }})"
                                            class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                            title="Edit">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </button>
                                    <form action="{{ route('back.users.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                                title="Delete">
                                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="text-secondary-light mb-0">No users found</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {{-- View User Modal --}}
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info-focus border-bottom">
                    <h5 class="modal-title text-info-600">
                        <iconify-icon icon="solar:eye-linear" class="icon"></iconify-icon>
                        User Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewUserContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit User Modal --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning-focus border-bottom">
                    <h5 class="modal-title text-warning-600">
                        <iconify-icon icon="lucide:edit" class="icon"></iconify-icon>
                        Edit User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div id="editUserContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Client-side search without server request
        $('#searchInput').on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            let visibleCount = 0;

            $('table tbody tr').each(function() {
                const row = $(this);

                // Skip empty state row
                if (row.find('td[colspan]').length > 0) {
                    return;
                }

                const name = row.find('td:nth-child(3)').text().toLowerCase();
                const email = row.find('td:nth-child(4)').text().toLowerCase();

                if (name.includes(searchValue) || email.includes(searchValue)) {
                    row.show();
                    visibleCount++;
                } else {
                    row.hide();
                }
            });

            // Show "no results" message if nothing found
            if (visibleCount === 0 && searchValue !== '') {
                if ($('#noSearchResults').length === 0) {
                    $('table tbody').append(`
                        <tr id="noSearchResults">
                            <td colspan="6" class="text-center py-4">
                                <p class="text-secondary-light mb-0">No users found matching "${searchValue}"</p>
                            </td>
                        </tr>
                    `);
                }
            } else {
                $('#noSearchResults').remove();
            }
        });

        // Select all checkbox
        $('#selectAll').on('change', function() {
            $('input[name="checkbox"]:visible').prop('checked', this.checked);
        });

        // View User Modal
        function viewUser(id) {
            const modal = new bootstrap.Modal(document.getElementById('viewUserModal'));
            modal.show();

            document.getElementById('viewUserContent').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';

            fetch(`/admin/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('viewUserContent').innerHTML = `
                <div class="row g-3">
                    <div class="col-12 text-center border-bottom pb-3">
                        <img src="${data.avatar_url}" alt="${data.name}" class="w-100-px h-100-px rounded-circle mb-3">
                        <h5 class="fw-semibold mb-1">${data.name}</h5>
                        <span class="badge bg-secondary">ID: ${data.id}</span>
                    </div>
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:letter-linear" class="icon text-xxl text-primary-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Email</span>
                                <h6 class="fw-medium mb-0">${data.email}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:phone-linear" class="icon text-xxl text-success-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Phone</span>
                                <p class="mb-0 fw-medium">${data.phone || 'N/A'}</p>
                            </div>
                        </div>
                    </div>
                    ${data.bio ? `
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:document-text-linear" class="icon text-xxl"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Bio</span>
                                <p class="mb-0">${data.bio}</p>
                            </div>
                        </div>
                    </div>
                    ` : ''}
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:calendar-add-linear" class="icon text-xxl"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Joined</span>
                                <p class="mb-0 fw-medium">${data.created_at}</p>
                                <small class="text-secondary-light">${data.created_at_human}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:calendar-mark-linear" class="icon text-xxl"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Last Updated</span>
                                <p class="mb-0 fw-medium">${data.updated_at}</p>
                                <small class="text-secondary-light">${data.updated_at_human}</small>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                })
                .catch(() => {
                    document.getElementById('viewUserContent').innerHTML = `
                <div class="alert alert-danger">Error loading user details.</div>
            `;
                });
        }

        // Edit User Modal
        function editUser(id) {
            const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();

            document.getElementById('editUserContent').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';

            fetch(`/admin/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editUserContent').innerHTML = `
                <form action="/admin/users/${data.id}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="alert alert-info bg-info-100 text-info-600 border-info-600 border-start border-width-4-px mb-3">
                            <iconify-icon icon="solar:info-circle-linear" class="icon"></iconify-icon>
                            Editing User ID: <strong>${data.id}</strong>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    First Name <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" name="first_name" class="form-control radius-8" value="${data.first_name}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Last Name <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" name="last_name" class="form-control radius-8" value="${data.last_name}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Email <span class="text-danger-600">*</span>
                                </label>
                                <input type="email" name="email" class="form-control radius-8" value="${data.email}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Phone
                                </label>
                                <input type="text" name="phone" class="form-control radius-8" value="${data.phone || ''}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Bio
                                </label>
                                <textarea name="bio" class="form-control radius-8" rows="3">${data.bio || ''}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <small class="text-secondary-light">
                                    <iconify-icon icon="solar:calendar-add-linear"></iconify-icon>
                                    Joined: ${data.created_at_human}
                                </small>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-secondary-light">
                                    <iconify-icon icon="solar:calendar-mark-linear"></iconify-icon>
                                    Updated: ${data.updated_at_human}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Update User</button>
                    </div>
                </form>
            `;
                })
                .catch(() => {
                    document.getElementById('editUserContent').innerHTML = `
                <div class="alert alert-danger m-3">Error loading user details.</div>
            `;
                });
        }
    </script>
@endpush
