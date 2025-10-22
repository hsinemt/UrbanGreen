@extends('dashboard.layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Détails du Wallet: {{ $wallet->name }}</h3>
                    <div>
                        <a href="{{ route('admin.wallets.edit', $wallet) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('admin.wallets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations générales</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $wallet->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nom:</strong></td>
                                    <td>{{ $wallet->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Événement:</strong></td>
                                    <td>{{ $wallet->event->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Montant Objectif:</strong></td>
                                    <td>{{ number_format($wallet->target_amount, 2) }} €</td>
                                </tr>
                                <tr>
                                    <td><strong>Montant Collecté:</strong></td>
                                    <td>{{ number_format($wallet->total_amount, 2) }} €</td>
                                </tr>
                                <tr>
                                    <td><strong>Progression:</strong></td>
                                    <td>
                                        <div class="progress" style="width: 200px;">
                                            <div class="progress-bar {{ $wallet->progress_percentage >= 100 ? 'bg-success' : 'bg-primary' }}" 
                                                 role="progressbar" 
                                                 style="width: {{ min($wallet->progress_percentage, 100) }}%">
                                                {{ $wallet->progress_percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Nombre de Donations:</strong></td>
                                    <td>{{ $wallet->donation_count }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Statut:</strong></td>
                                    <td>
                                        @if($wallet->isTargetReached())
                                            <span class="badge bg-success">Objectif atteint</span>
                                        @else
                                            <span class="badge bg-warning">En cours</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Créé le:</strong></td>
                                    <td>{{ $wallet->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mis à jour le:</strong></td>
                                    <td>{{ $wallet->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Historique des Donations</h5>
                            @if($wallet->donations->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Montant</th>
                                                <th>Méthode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wallet->donations as $donation)
                                            <tr>
                                                <td>{{ $donation->date->format('d/m/Y') }}</td>
                                                <td>{{ number_format($donation->amount, 2) }} €</td>
                                                <td>{{ $donation->payment_method }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Aucune donation pour ce wallet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
