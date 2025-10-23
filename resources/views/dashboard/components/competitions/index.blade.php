@extends('dashboard.layouts.dashboard')
@section('title', 'Competitions Management')

@section('breadcrumb')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Competitions Management</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Competitions</li>
    </ul>
</div>
@endsection

@section('content')
<div class="row gy-4">
    <!-- Statistics Cards -->
    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:trophy-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ $stats['total'] }}</h3>
                    <p class="dashboard-card-text">Total Competitions</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:folder-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ $stats['total_projects'] }}</h3>
                    <p class="dashboard-card-text">Projects Involved</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:users-group-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ $stats['total_associations'] }}</h3>
                    <p class="dashboard-card-text">Total Associations</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:handshake-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ count($stats['by_partner']) }}</h3>
                    <p class="dashboard-card-text">Active Partners</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Competitions Table -->
    <div class="col-12">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <h4 class="fw-semibold mb-0">All Competitions</h4>
                </div>
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <a href="{{ route('back.competitions.create') }}" class="btn btn-primary">
                        <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                        Add New Competition
                    </a>
                </div>
            </div>
            
            <div class="card-body p-24">
                <!-- Filters -->
                <form method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search competitions...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="partner_id">
                                <option value="">All Partners</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ request('partner_id') == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="projet_id">
                                <option value="">All Projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ request('projet_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('back.competitions.index') }}" class="btn btn-light">Clear</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive scroll-sm">
                    <table class="table table-hover align-middle bordered-table sm-table mb-0"  >
                        <thead>
                            <tr>
                                <th scope="col">Reward</th>
                                <th scope="col">Project</th>
                                <th scope="col">Partner</th>
                                <th scope="col">Associations</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created</th>
                                <th scope="col" class="text-center" style="min-width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody  >
                            @forelse($competitions as $competition)
                                <tr>
                                    <td>
                                        <h6 class="mb-0">{{ $competition->reward }}</h6>
                                    </td>
                                    <td>{{ $competition->project->name ?? 'N/A' }}</td>
                                    <td>{{ $competition->partner->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($competition->associations->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($competition->associations->take(2) as $association)
                                                    <span class="badge badge-secondary" style="background-color:#000;color:#fff;border-color:#000;">{{ $association->name }}</span>
                                                @endforeach
                                                @if($competition->associations->count() > 2)
                                                    <span class="badge badge-light" style="background-color:#000;color:#fff;border-color:#000;">+{{ $competition->associations->count() - 2 }} more</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">No associations</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ Str::limit($competition->description, 50) }}</small>
                                    </td>
                                    <td>{{ $competition->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center gap-2 justify-content-center">
                                            <a href="{{ route('back.competitions.show', $competition) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                <iconify-icon icon="solar:eye-outline"></iconify-icon>
                                            </a>
                                            <a href="{{ route('back.competitions.edit', $competition) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <iconify-icon icon="solar:pen-outline"></iconify-icon>
                                            </a>
                                            <form action="{{ route('back.competitions.destroy', $competition) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this competition? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" style="min-width: 32px;">
                                                    <iconify-icon icon="solar:trash-bin-outline"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <iconify-icon icon="solar:trophy-outline" style="font-size: 48px;"></iconify-icon>
                                            <p class="mt-2">No competitions found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($competitions->hasPages())
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                        <span>Showing {{ $competitions->firstItem() }} to {{ $competitions->lastItem() }} of {{ $competitions->total() }} entries</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            {{ $competitions->links('pagination::bootstrap-4') }}
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
