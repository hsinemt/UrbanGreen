@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Détails de l'Espace Vert</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.green-spaces.index') }}">Espaces Verts</a></li>
                                <li class="breadcrumb-item active">Détails</li>
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
                                <h5 class="card-title mb-0">{{ $greenSpace->name }}</h5>
                                <div>
                                    <a href="{{ route('admin.green-spaces.edit', $greenSpace) }}" class="btn btn-warning">
                                        <i class="ri-edit-line me-1"></i> Modifier
                                    </a>
                                    <a href="{{ route('admin.green-spaces.index') }}" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line me-1"></i> Retour
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Informations Générales</h6>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-semibold">ID:</td>
                                                        <td>{{ $greenSpace->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Nom:</td>
                                                        <td>{{ $greenSpace->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Localisation:</td>
                                                        <td>{{ $greenSpace->location }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Surface:</td>
                                                        <td>{{ $greenSpace->surface }} m²</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Statut et Type</h6>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-semibold">Type:</td>
                                                        <td>
                                                            @if($greenSpace->type)
                                                                <span class="badge bg-primary">{{ $greenSpace->type }}</span>
                                                            @else
                                                                <span class="text-muted">Non spécifié</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Disponibilité:</td>
                                                        <td>
                                                            @if($greenSpace->availability)
                                                                <span class="badge bg-success">Disponible</span>
                                                            @else
                                                                <span class="badge bg-danger">Occupé</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Nombre de Plantes:</td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $greenSpace->plants->count() }} plantes</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Créé le:</td>
                                                        <td>{{ $greenSpace->created_at->format('d/m/Y H:i') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($greenSpace->description)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <h6 class="text-muted mb-2">Description</h6>
                                            <div class="card border">
                                                <div class="card-body">
                                                    {{ $greenSpace->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="text-muted mb-0">Plantes dans cet Espace Vert</h6>
                                            <a href="{{ route('admin.plants.create', ['green_space_id' => $greenSpace->id]) }}" class="btn btn-sm btn-primary">
                                                <i class="ri-add-line me-1"></i> Ajouter une Plante
                                            </a>
                                        </div>
                                        
                                        @if($greenSpace->plants->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nom</th>
                                                            <th>Date Plantation</th>
                                                            <th>Date Croissance Prévue</th>
                                                            <th>Personne Plantation</th>
                                                            <th>Milieu Croissance</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($greenSpace->plants as $plant)
                                                            <tr>
                                                                <td>{{ $plant->id }}</td>
                                                                <td>{{ $plant->nom }}</td>
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
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="alert alert-info">
                                                <i class="ri-information-line me-2"></i>
                                                Aucune plante n'est encore associée à cet espace vert.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
