@extends('dashboard.layouts.dashboard')
@section('title', 'Projects Management')

@section('breadcrumb')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Projects Management</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Projects</li>
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
                    <iconify-icon icon="solar:folder-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ $stats['total'] }}</h3>
                    <p class="dashboard-card-text">Total Projects</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ $stats['completed_count'] }}</h3>
                    <p class="dashboard-card-text">Completed</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:clock-circle-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">{{ $stats['in_progress_count'] }}</h3>
                    <p class="dashboard-card-text">In Progress</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card">
            <div class="dashboard-card-body">
                <div class="dashboard-card-icon">
                    <iconify-icon icon="solar:dollar-outline"></iconify-icon>
                </div>
                <div class="dashboard-card-content">
                    <h3 class="dashboard-card-title">${{ number_format($stats['total_budget']) }}</h3>
                    <p class="dashboard-card-text">Total Budget</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="col-12">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <h4 class="fw-semibold mb-0">All Projects</h4>
                </div>
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <a href="{{ route('back.projects.create') }}" class="btn btn-primary">
                        <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                        Add New Project
                    </a>
                </div>
            </div>
            
            <div class="card-body p-24">
                <!-- Filters -->
                <form method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search projects...">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="status">
                                <option value="">All Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="user_id">
                                <option value="">All Users</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" placeholder="Start Date">
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" placeholder="End Date">
                        </div>
                        <div class="col-md-1 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('back.projects.index') }}" class="btn btn-light">Clear</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive scroll-sm">
                    <table class="table table-hover align-middle bordered-table sm-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Status</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col" class="text-center" style="min-width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $project->name }}</h6>
                                            <small class="text-muted">{{ Str::limit($project->description, 50) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $project->user ? $project->user->avatar_url : 'https://ui-avatars.com/api/?name=No+Owner&background=9CA3AF&color=fff' }}" alt="avatar" class="rounded-circle" style="width:32px;height:32px;object-fit:cover;">
                                            <div>
                                                <div class="fw-medium">{{ $project->user ? $project->user->name : 'No Owner' }}</div>
                                                <small class="text-muted">{{ $project->user ? $project->user->email : '—' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            if ($project->status === 'completed') {
                                                $bg = '#e6f4ea'; // light green background
                                                $color = '#137333'; // green text
                                            } elseif ($project->status === 'in_progress') {
                                                $bg = '#fff4e6'; // light orange background
                                                $color = '#b45309'; // orange text
                                            } else {
                                                $bg = '#f3f4f6'; // light gray background
                                                $color = '#374151'; // dark gray text
                                            }
                                        @endphp
                                        <span class="badge" style="background-color: {{ $bg }}; color: {{ $color }}; border: 1px solid {{ $bg }};">
                                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $progressClass = $project->progress_percentage >= 80 ? 'bg-success' : ($project->progress_percentage >= 40 ? 'bg-warning' : 'bg-danger');
                                        @endphp
                                        <div class="progress" style="width: 120px; height: 8px;">
                                            <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $project->progress_percentage }}%"></div>
                                        </div>
                                        <small class="text-muted">{{ $project->progress_percentage }}%</small>
                                    </td>
                                    <td>${{ number_format($project->budget) }}</td>
                                    <td>{{ $project->start_date->format('M d, Y') }}</td>
                                    <td>{{ $project->end_date ? $project->end_date->format('M d, Y') : 'Ongoing' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center gap-2 justify-content-center">
                                            <a href="{{ route('back.projects.show', $project) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                <iconify-icon icon="solar:eye-outline"></iconify-icon>
                                            </a>
                                            @if(auth()->user()->isAdmin() || (auth()->user()->isAssociation() || auth()->user()->isPartner()) && $project->user_id == auth()->id())
                                                <a href="{{ route('back.projects.edit', $project) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <iconify-icon icon="solar:pen-outline"></iconify-icon>
                                                </a>
                                                <form action="{{ route('back.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" style="min-width: 32px;">
                                                        <iconify-icon icon="solar:trash-bin-outline"></iconify-icon>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <iconify-icon icon="solar:folder-open-outline" style="font-size: 48px;"></iconify-icon>
                                            <p class="mt-2">No projects found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($projects->hasPages())
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                        <span>Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            {{ $projects->links('pagination::bootstrap-4') }}
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
