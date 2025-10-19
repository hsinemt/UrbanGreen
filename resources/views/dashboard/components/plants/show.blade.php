@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Détails de la Plante</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.plants.index') }}">Plantes</a></li>
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
                                <h5 class="card-title mb-0">{{ $plant->nom }}</h5>
                                <div>
                                    <a href="{{ route('admin.plants.edit', $plant) }}" class="btn btn-warning">
                                        <i class="ri-edit-line me-1"></i> Modifier
                                    </a>
                                    <a href="{{ route('admin.plants.index') }}" class="btn btn-secondary">
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
                                                        <td>{{ $plant->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Nom:</td>
                                                        <td>{{ $plant->nom }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Espace Vert:</td>
                                                        <td>
                                                            @if($plant->greenSpace)
                                                                <span class="badge bg-primary">{{ $plant->greenSpace->name }}</span>
                                                                <small class="text-muted d-block">{{ $plant->greenSpace->location }}</small>
                                                            @else
                                                                <span class="text-muted">Non assigné</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Personne Plantation:</td>
                                                        <td>{{ $plant->personne_plantation }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Dates et Milieu</h6>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-semibold">Date Plantation:</td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $plant->date_plantation->format('d/m/Y') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Date Croissance Prévue:</td>
                                                        <td>
                                                            <span class="badge bg-success">{{ $plant->date_croissance_prevue->format('d/m/Y') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Milieu Croissance:</td>
                                                        <td>
                                                            <span class="badge bg-warning">{{ $plant->milieu_croissance }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold">Statut:</td>
                                                        <td>
                                                            @php
                                                                $now = now();
                                                                $dateCroissance = $plant->date_croissance_prevue;
                                                                $joursRestants = $now->diffInDays($dateCroissance, false);
                                                            @endphp
                                                            @if($joursRestants > 0)
                                                                <span class="badge bg-info">{{ $joursRestants }} jours restants</span>
                                                            @elseif($joursRestants == 0)
                                                                <span class="badge bg-warning">Croissance prévue aujourd'hui</span>
                                                            @else
                                                                <span class="badge bg-success">Croissance atteinte</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Informations sur l'Espace Vert</h6>
                                        @if($plant->greenSpace)
                                            <div class="card border">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <strong>Nom:</strong><br>
                                                            {{ $plant->greenSpace->name }}
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Localisation:</strong><br>
                                                            {{ $plant->greenSpace->location }}
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Surface:</strong><br>
                                                            {{ $plant->greenSpace->surface }} m²
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Disponibilité:</strong><br>
                                                            @if($plant->greenSpace->availability)
                                                                <span class="badge bg-success">Disponible</span>
                                                            @else
                                                                <span class="badge bg-danger">Occupé</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if($plant->greenSpace->description)
                                                        <div class="mt-3">
                                                            <strong>Description:</strong><br>
                                                            {{ $plant->greenSpace->description }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                <i class="ri-alert-line me-2"></i>
                                                Cette plante n'est associée à aucun espace vert.
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
