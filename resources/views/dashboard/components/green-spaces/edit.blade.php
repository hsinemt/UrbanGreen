@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Modifier l'Espace Vert</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.green-spaces.index') }}">Espaces Verts</a></li>
                                <li class="breadcrumb-item active">Modifier</li>
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
                            <h5 class="card-title mb-0">Modifier l'Espace Vert: {{ $greenSpace->name }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.green-spaces.update', $greenSpace) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom de l'espace vert <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name', $greenSpace->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Localisation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                                   id="location" name="location" value="{{ old('location', $greenSpace->location) }}" required>
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="surface" class="form-label">Surface (m²) <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control @error('surface') is-invalid @enderror" 
                                                   id="surface" name="surface" value="{{ old('surface', $greenSpace->surface) }}" required>
                                            @error('surface')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type d'espace</label>
                                            <select class="form-select @error('type') is-invalid @enderror" 
                                                    id="type" name="type">
                                                <option value="">Sélectionner le type</option>
                                                <option value="Jardin" {{ old('type', $greenSpace->type) == 'Jardin' ? 'selected' : '' }}>Jardin</option>
                                                <option value="Parc" {{ old('type', $greenSpace->type) == 'Parc' ? 'selected' : '' }}>Parc</option>
                                                <option value="Square" {{ old('type', $greenSpace->type) == 'Square' ? 'selected' : '' }}>Square</option>
                                                <option value="Terrasse" {{ old('type', $greenSpace->type) == 'Terrasse' ? 'selected' : '' }}>Terrasse</option>
                                                <option value="Balcon" {{ old('type', $greenSpace->type) == 'Balcon' ? 'selected' : '' }}>Balcon</option>
                                                <option value="Serre" {{ old('type', $greenSpace->type) == 'Serre' ? 'selected' : '' }}>Serre</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="availability" class="form-label">Disponibilité</label>
                                            <select class="form-select @error('availability') is-invalid @enderror" 
                                                    id="availability" name="availability">
                                                <option value="1" {{ old('availability', $greenSpace->availability) == '1' ? 'selected' : '' }}>Disponible</option>
                                                <option value="0" {{ old('availability', $greenSpace->availability) == '0' ? 'selected' : '' }}>Occupé</option>
                                            </select>
                                            @error('availability')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" name="description" rows="4">{{ old('description', $greenSpace->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.green-spaces.index') }}" class="btn btn-secondary">
                                                <i class="ri-arrow-left-line me-1"></i> Annuler
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ri-save-line me-1"></i> Mettre à jour
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
