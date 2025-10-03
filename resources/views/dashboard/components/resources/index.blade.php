@extends('dashboard.layouts.dashboard')

@section('title', 'Resources - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Resources</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Resources</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
            <h6 class="text-lg fw-semibold mb-0">Resources List</h6>
            <button type="button" onclick="openCreateModal()" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Add New Resource
            </button>
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
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Created At</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($resources as $resource)
                        <tr>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">#{{ $resource->id }}</span>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">{{ $resource->name }}</span>
                            </td>
                            <td>
                                <span class="bg-info-focus text-info-main px-16 py-4 radius-4 fw-medium text-sm">{{ $resource->type }}</span>
                            </td>
                            <td>
                                <span class="bg-neutral-200 text-neutral-900 px-16 py-4 radius-4 fw-medium text-sm">{{ $resource->quantity }}</span>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">{{ $resource->created_at->format('Y-m-d') }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <button type="button"
                                            onclick="viewResource({{ $resource->id }})"
                                            class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                            title="View">
                                        <iconify-icon icon="solar:eye-linear" class="icon text-xl"></iconify-icon>
                                    </button>
                                    <button type="button"
                                            onclick="editResource({{ $resource->id }})"
                                            class="bg-warning-focus bg-hover-warning-200 text-warning-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                            title="Edit">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </button>
                                    <form action="{{ route('resources.destroy', $resource) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this resource?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                                title="Delete">
                                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <iconify-icon icon="solar:inbox-line-broken" class="icon text-xxl text-secondary-light mb-2"></iconify-icon>
                                    <p class="mb-0 text-secondary-light">No resources found. Click "Add New Resource" to create one.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($resources->hasPages())
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Showing {{ $resources->firstItem() }} to {{ $resources->lastItem() }} of {{ $resources->total() }} entries</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{ $resources->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {{-- Create Resource Modal --}}
    <div class="modal fade" id="createResourceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary-focus border-bottom">
                    <h5 class="modal-title text-primary-600">
                        <iconify-icon icon="ic:baseline-plus" class="icon"></iconify-icon>
                        Create New Resource
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="createResourceForm" action="{{ route('resources.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Resource Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="name" class="form-control radius-8" placeholder="e.g., Solar Panels" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Resource Type <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="type" class="form-control radius-8" placeholder="e.g., Equipment" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Quantity <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" name="quantity" class="form-control radius-8" value="0" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Resource</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Resource Modal --}}
    <div class="modal fade" id="viewResourceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info-focus border-bottom">
                    <h5 class="modal-title text-info-600">
                        <iconify-icon icon="solar:eye-linear" class="icon"></iconify-icon>
                        Resource Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewResourceContent">
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

    {{-- Edit Resource Modal --}}
    <div class="modal fade" id="editResourceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning-focus border-bottom">
                    <h5 class="modal-title text-warning-600">
                        <iconify-icon icon="lucide:edit" class="icon"></iconify-icon>
                        Edit Resource
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div id="editResourceContent">
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
        // Create Resource Modal
        function openCreateModal() {
            const modal = new bootstrap.Modal(document.getElementById('createResourceModal'));
            document.getElementById('createResourceForm').reset();
            modal.show();
        }

        // View Resource Modal
        function viewResource(id) {
            const modal = new bootstrap.Modal(document.getElementById('viewResourceModal'));
            modal.show();

            document.getElementById('viewResourceContent').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';

            fetch(`/admin/resources/${id}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('viewResourceContent').innerHTML = `
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <iconify-icon icon="solar:hashtag-linear" class="icon text-xl"></iconify-icon>
                            <span class="text-secondary-light">ID:</span>
                            <span class="badge bg-secondary">${data.id}</span>
                        </div>
                    </div>
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:box-linear" class="icon text-xxl text-primary-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Name</span>
                                <h6 class="fw-semibold mb-0">${data.name}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:tag-linear" class="icon text-xxl text-info-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Type</span>
                                <span class="bg-info-focus text-info-main px-16 py-6 radius-4 fw-medium">${data.type}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:chart-linear" class="icon text-xxl text-success-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Quantity</span>
                                <span class="bg-success-focus text-success-main px-20 py-8 radius-4 fw-semibold text-lg">${data.quantity}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-bottom pb-3">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:calendar-add-linear" class="icon text-xxl"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Created At</span>
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
                    document.getElementById('viewResourceContent').innerHTML = `
                <div class="alert alert-danger">Error loading resource details.</div>
            `;
                });
        }

        // Edit Resource Modal
        function editResource(id) {
            const modal = new bootstrap.Modal(document.getElementById('editResourceModal'));
            modal.show();

            document.getElementById('editResourceContent').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';

            fetch(`/admin/resources/${id}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editResourceContent').innerHTML = `
                <form action="/admin/resources/${data.id}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="alert alert-info bg-info-100 text-info-600 border-info-600 border-start border-width-4-px mb-3">
                            <iconify-icon icon="solar:info-circle-linear" class="icon"></iconify-icon>
                            Editing Resource ID: <strong>${data.id}</strong>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Resource Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="name" class="form-control radius-8" value="${data.name}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Resource Type <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="type" class="form-control radius-8" value="${data.type}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Quantity <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" name="quantity" class="form-control radius-8" value="${data.quantity}" min="0" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-secondary-light">
                                    <iconify-icon icon="solar:calendar-add-linear"></iconify-icon>
                                    Created: ${data.created_at_human}
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
                        <button type="submit" class="btn btn-warning">Update Resource</button>
                    </div>
                </form>
            `;
                })
                .catch(() => {
                    document.getElementById('editResourceContent').innerHTML = `
                <div class="alert alert-danger m-3">Error loading resource details.</div>
            `;
                });
        }
    </script>
@endpush
