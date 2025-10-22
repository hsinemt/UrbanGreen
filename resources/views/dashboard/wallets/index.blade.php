@extends('dashboard.layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h3 class="card-title mb-0">Gestion des Wallets</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.wallets.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nouveau Wallet
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

                    {{-- Statistiques rapides --}}
                    @isset($stats)
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <div class="p-3 rounded border bg-light h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted">Nombre de wallets</div>
                                        <div class="h5 mb-0">{{ $stats['count'] }}</div>
                                    </div>
                                    <i class="ri-wallet-3-line fs-3 text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 rounded border bg-light h-100">
                                <div class="text-muted">Total collecté</div>
                                <div class="h5 mb-0">{{ number_format($stats['total_collected'] ?? 0, 2) }} €</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 rounded border bg-light h-100">
                                <div class="text-muted">Objectif total</div>
                                <div class="h5 mb-0">{{ number_format($stats['total_target'] ?? 0, 2) }} €</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 rounded border bg-light h-100">
                                <div class="text-muted">Progression moyenne</div>
                                <div class="h5 mb-0">{{ number_format($stats['avg_progress'] ?? 0, 1) }}%</div>
                            </div>
                        </div>
                    </div>
                    @endisset

                    {{-- Filtres --}}
                    <form method="GET" action="{{ route('admin.wallets.index') }}" class="row g-2 align-items-end mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Recherche</label>
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Rechercher par nom...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Événement</label>
                            <select name="event_id" class="form-select">
                                <option value="">Tous</option>
                                @isset($events)
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button class="btn btn-outline-primary" type="submit"><i class="ri-search-line"></i> Filtrer</button>
                            <a href="{{ route('admin.wallets.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Événement</th>
                                    <th>Montant Collecté</th>
                                    <th>Objectif</th>
                                    <th>Progression</th>
                                    <th>Nombre de Donations</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wallets as $wallet)
                                <tr>
                                    <td>{{ $wallet->id }}</td>
                                    <td>{{ $wallet->name }}</td>
                                    <td>{{ $wallet->event->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($wallet->total_amount, 2) }} €</td>
                                    <td>{{ number_format($wallet->target_amount, 2) }} €</td>
                                    <td>
                                        <div class="progress" style="width: 140px; height: 10px;">
                                            <div class="progress-bar {{ $wallet->progress_percentage >= 100 ? 'bg-success' : 'bg-primary' }}" role="progressbar" style="width: {{ min($wallet->progress_percentage, 100) }}%"></div>
                                        </div>
                                        <small class="text-muted">{{ $wallet->progress_percentage }}%</small>
                                    </td>
                                    <td>{{ $wallet->donation_count }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.wallets.show', $wallet) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.wallets.edit', $wallet) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.wallets.destroy', $wallet) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce wallet ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Aucun wallet trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        {{ $wallets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
