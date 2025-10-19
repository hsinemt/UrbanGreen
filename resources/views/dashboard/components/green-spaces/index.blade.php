@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Gestion des Espaces Verts</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Espaces Verts</li>
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
                                <h5 class="card-title mb-0">Liste des Espaces Verts</h5>
                                <a href="{{ route('admin.green-spaces.create') }}" class="btn btn-primary">
                                    <i class="ri-add-line me-1"></i> Ajouter un Espace Vert
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

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Localisation</th>
                                            <th>Surface</th>
                                            <th>Type</th>
                                            <th>Disponibilité</th>
                                            <th>Nombre de Plantes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($greenSpaces as $greenSpace)
                                            <tr>
                                                <td>{{ $greenSpace->id }}</td>
                                                <td>{{ $greenSpace->name }}</td>
                                                <td>{{ $greenSpace->location }}</td>
                                                <td>{{ $greenSpace->surface }} m²</td>
                                                <td>{{ $greenSpace->type ?? 'N/A' }}</td>
                                                <td>
                                                    @if($greenSpace->availability)
                                                        <span class="badge bg-success">Disponible</span>
                                                    @else
                                                        <span class="badge bg-danger">Occupé</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $greenSpace->plants_count }} plantes</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.green-spaces.show', $greenSpace) }}" class="btn btn-sm btn-info">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                        <a href="{{ route('admin.green-spaces.edit', $greenSpace) }}" class="btn btn-sm btn-warning">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="{{ route('admin.green-spaces.destroy', $greenSpace) }}" method="POST" 
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet espace vert ?')" 
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
                                                <td colspan="8" class="text-center">Aucun espace vert trouvé</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $greenSpaces->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
