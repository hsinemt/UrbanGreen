@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ajouter une Plante</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.plants.index') }}">Plantes</a></li>
                                <li class="breadcrumb-item active">Ajouter</li>
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
                            <h5 class="card-title mb-0">Nouvelle Plante</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.plants.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom de la plante <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                                   id="nom" name="nom" value="{{ old('nom') }}" required>
                                            @error('nom')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="green_space_id" class="form-label">Espace Vert <span class="text-danger">*</span></label>
                                            <select class="form-select @error('green_space_id') is-invalid @enderror" 
                                                    id="green_space_id" name="green_space_id" required>
                                                <option value="">Sélectionner un espace vert</option>
                                                @foreach($greenSpaces as $greenSpace)
                                                    <option value="{{ $greenSpace->id }}" 
                                                        {{ (old('green_space_id', $selectedGreenSpaceId ?? '') == $greenSpace->id) ? 'selected' : '' }}>
                                                        {{ $greenSpace->name }} - {{ $greenSpace->location }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('green_space_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date_plantation" class="form-label">Date de Plantation <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('date_plantation') is-invalid @enderror" 
                                                   id="date_plantation" name="date_plantation" value="{{ old('date_plantation') }}" required>
                                            @error('date_plantation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date_croissance_prevue" class="form-label">Date Croissance Prévue <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('date_croissance_prevue') is-invalid @enderror" 
                                                   id="date_croissance_prevue" name="date_croissance_prevue" value="{{ old('date_croissance_prevue') }}" required>
                                            @error('date_croissance_prevue')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="personne_plantation" class="form-label">Personne qui a planté <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('personne_plantation') is-invalid @enderror" 
                                                   id="personne_plantation" name="personne_plantation" value="{{ old('personne_plantation') }}" required>
                                            @error('personne_plantation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="milieu_croissance" class="form-label">Milieu de Croissance <span class="text-danger">*</span></label>
                                            <select class="form-select @error('milieu_croissance') is-invalid @enderror" 
                                                    id="milieu_croissance" name="milieu_croissance" required>
                                                <option value="">Sélectionner le milieu</option>
                                                <option value="Intérieur" {{ old('milieu_croissance') == 'Intérieur' ? 'selected' : '' }}>Intérieur</option>
                                                <option value="Extérieur" {{ old('milieu_croissance') == 'Extérieur' ? 'selected' : '' }}>Extérieur</option>
                                                <option value="Serre" {{ old('milieu_croissance') == 'Serre' ? 'selected' : '' }}>Serre</option>
                                                <option value="Jardin" {{ old('milieu_croissance') == 'Jardin' ? 'selected' : '' }}>Jardin</option>
                                                <option value="Balcon" {{ old('milieu_croissance') == 'Balcon' ? 'selected' : '' }}>Balcon</option>
                                            </select>
                                            @error('milieu_croissance')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.plants.index') }}" class="btn btn-secondary">
                                                <i class="ri-arrow-left-line me-1"></i> Annuler
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ri-save-line me-1"></i> Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
