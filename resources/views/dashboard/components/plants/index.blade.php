@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Gestion des Plantes</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Plantes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Liste des Plantes</h5>
                                <a href="{{ route('admin.plants.create') }}" class="btn btn-primary">
                                    <i class="ri-add-line me-1"></i> Ajouter une Plante
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Filtres -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <form method="GET" action="{{ route('admin.plants.index') }}">
                                        <div class="input-group">
                                            <select name="green_space_id" class="form-select">
                                                <option value="">Tous les espaces verts</option>
                                                @foreach($greenSpaces as $greenSpace)
                                                    <option value="{{ $greenSpace->id }}" 
                                                        {{ request('green_space_id') == $greenSpace->id ? 'selected' : '' }}>
                                                        {{ $greenSpace->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="ri-search-line"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Espace Vert</th>
                                            <th>Date Plantation</th>
                                            <th>Date Croissance Prévue</th>
                                            <th>Personne Plantation</th>
                                            <th>Milieu Croissance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($plants as $plant)
                                            <tr>
                                                <td>{{ $plant->id }}</td>
                                                <td>{{ $plant->nom }}</td>
                                                <td>{{ $plant->greenSpace->name ?? 'N/A' }}</td>
                                                <td>{{ $plant->date_plantation->format('d/m/Y') }}</td>
                                                <td>{{ $plant->date_croissance_prevue->format('d/m/Y') }}</td>
                                                <td>{{ $plant->personne_plantation }}</td>
                                                <td>{{ $plant->milieu_croissance }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.plants.show', $plant) }}" class="btn btn-sm btn-info">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                        <a href="{{ route('admin.plants.edit', $plant) }}" class="btn btn-sm btn-warning">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="{{ route('admin.plants.destroy', $plant) }}" method="POST" 
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette plante ?')" 
                                                              style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Aucune plante trouvée</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $plants->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
