@extends('dashboard.layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier le Wallet</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.wallets.update', $wallet) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom du Wallet *</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $wallet->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_id" class="form-label">Événement *</label>
                                    <select class="form-control @error('event_id') is-invalid @enderror" 
                                            id="event_id" 
                                            name="event_id" 
                                            required>
                                        <option value="">Sélectionner un événement</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}" 
                                                    {{ old('event_id', $wallet->event_id) == $event->id ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('event_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="target_amount" class="form-label">Montant Objectif *</label>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0"
                                           class="form-control @error('target_amount') is-invalid @enderror" 
                                           id="target_amount" 
                                           name="target_amount" 
                                           value="{{ old('target_amount', $wallet->target_amount) }}" 
                                           required>
                                    @error('target_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Mettre à jour
                                </button>
                                <a href="{{ route('admin.wallets.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Retour
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
