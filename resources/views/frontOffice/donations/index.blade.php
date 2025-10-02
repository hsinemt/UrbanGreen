@extends('frontOffice.layouts.app')
@section('title', 'Donations')

@section('content')
<!-- Start Hero Section -->
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Gestion des Donations</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Donations</li>
    </ol>
  </div>
</section>
<!-- End Hero Section -->

<!-- Start Donations Section -->
<section class="cs_shape_wrap">
  <div class="cs_height_140 cs_height_lg_70"></div>
  <div class="cs_shape cs_shape_position_1"><img src="{{ asset('frontOffice/img/nature/about_shape_1.svg') }}" alt=""></div>
  <div class="container">
    
    @if(session('success'))
      <div class="row">
        <div class="col-lg-12">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px;">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        </div>
      </div>
    @endif

    <div class="row">
      <div class="col-lg-8">
        <div class="cs_pl_75">
          <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">Nos Donations</h3>
          <h2 class="cs_fs_51 cs_mb_29">Gérer vos Contributions</h2>
          <p class="cs_mb_37">Suivez et gérez toutes vos donations pour nos projets environnementaux. Chaque contribution compte pour créer un impact positif sur notre planète.</p>
          
          <!-- Section des filtres -->
          <div class="cs_filters_wrap cs_white_bg cs_shadow_1 cs_padding_medium cs_mb_40">
            <h4 class="cs_fs_21 cs_semibold cs_mb_20 cs_accent_color">Filtrer les Donations</h4>
            <form method="GET" action="{{ route('donations.index') }}" class="cs_filters_form">
              <div class="row cs_gap_y_20">
                <div class="col-md-5">
                  <label for="currency" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Devise</label>
                  <select class="cs_form_select" id="currency" name="currency">
                    <option value="">Toutes les devises</option>
                    @foreach($currencies as $currency)
                      <option value="{{ $currency }}" {{ request('currency') == $currency ? 'selected' : '' }}>
                        {{ $currency }} - {{ $currency == 'TND' ? 'Dinar Tunisien' : ($currency == 'EUR' ? 'Euro' : ($currency == 'USD' ? 'Dollar US' : ($currency == 'GBP' ? 'Livre Sterling' : ($currency == 'CHF' ? 'Franc Suisse' : $currency)))) }}
                      </option>
                    @endforeach
                  </select>
                </div>
                
                <div class="col-md-5">
                  <label for="payment_method" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Méthode de Paiement</label>
                  <select class="cs_form_select" id="payment_method" name="payment_method">
                    <option value="">Toutes les méthodes</option>
                    @foreach($paymentMethods as $paymentMethod)
                      <option value="{{ $paymentMethod }}" {{ request('payment_method') == $paymentMethod ? 'selected' : '' }}>
                        {{ $paymentMethod == 'Card' ? '💳 Carte Bancaire' : 
                           ($paymentMethod == 'PayPal' ? '🟦 PayPal' : 
                           ($paymentMethod == 'Bank Transfer' ? '🏦 Virement Bancaire' :
                           ($paymentMethod == 'Cash' ? '💵 Espèces' :
                           ($paymentMethod == 'Check' ? '✅ Chèque' :
                           ($paymentMethod == 'Cryptocurrency' ? '₿ Cryptomonnaie' : $paymentMethod))))) }}
                      </option>
                    @endforeach
                  </select>
                </div>
            
                <div class="col-md-2">
                  <button type="submit" class="cs_btn cs_style_1 cs_btn_full cs_btn_sm">
                    <i class="fas fa-filter"></i> Filtrer
                  </button>
                </div>
              </div>
              
              @if(request()->has(['currency', 'payment_method']) && !empty(array_filter(request()->only(['currency', 'payment_method']))))
                <div class="cs_active_filters cs_mt_20">
                  <span class="cs_filter_label">Filtres actifs :</span>
                  @if(request('currency'))
                    <span class="cs_filter_tag cs_currency_tag">{{ request('currency') }}</span>
                  @endif
                  @if(request('payment_method'))
                    <span class="cs_filter_tag cs_payment_tag">{{ request('payment_method') }}</span>
                  @endif
                  <a href="{{ route('donations.index') }}" class="cs_clear_filters">
                    <i class="fas fa-times"></i> Effacer tout
                  </a>
                </div>
              @endif
            </form>
          </div>

          <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('donations.create') }}" class="cs_btn cs_style_1">
              <i class="fas fa-plus"></i> Ajouter une Donation
              <i>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </i>
            </a>
          </div>

          @if($donations->count() > 0)
            <div class="cs_table_wrap">
              <div class="cs_table_header">
                <h3 class="cs_table_title">Liste des Donations ({{ $donations->count() }} {{ $donations->count() == 1 ? 'donation' : 'donations' }})</h3>
              </div>
              <table class="cs_table cs_style_1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Méthode</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($donations as $donation)
                    <tr>
                      <td>
                        <span class="cs_donation_id">#{{ $donation->id }}</span>
                      </td>
                      <td>
                        <span class="cs_amount cs_amount_tnd">
                          {{ App\Helpers\CurrencyHelper::formatTND(App\Helpers\CurrencyHelper::convertToTND($donation->amount, $donation->currency)) }}
                          <span class="cs_currency_converted_from">{{ $donation->currency }}</span>
                        </span>
                      </td>
                      <td>
                        <span class="cs_date">{{ $donation->date->format('d/m/Y') }}</span>
                      </td>
                      <td>
                        <span class="cs_payment_badge cs_{{ strtolower(str_replace(' ', '_', $donation->payment_method)) }}">
                          @if($donation->payment_method == 'Card') 💳@elseif($donation->payment_method == 'PayPal') 🟦@elseif($donation->payment_method == 'Bank Transfer') 🏦@elseif($donation->payment_method == 'Cash') 💵@elseif($donation->payment_method == 'Check') ✅@elseif($donation->payment_method == 'Cryptocurrency') ₿@endif
                          {{ $donation->payment_method }}
                        </span>
                      </td>
                      <td>
                        <div class="cs_action_buttons_group">
                          <a href="{{ route('donations.show', $donation) }}" class="cs_action_btn cs_view_btn" title="Voir les détails">
                            <i class="fas fa-eye"></i>
                          </a>
                          <a href="{{ route('donations.edit', $donation) }}" class="cs_action_btn cs_edit_btn" title="Modifier">
                            <i class="fas fa-edit"></i>
                          </a>
                          <form action="{{ route('donations.destroy', $donation) }}" method="POST" style="display: inline;" 
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette donation?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cs_action_btn cs_delete_btn" title="Supprimer">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="cs_empty_state text-center">
              <div class="cs_empty_state_icon cs_mb_30">
                <img src="{{ asset('frontOffice/img/others/feature_icon_1.svg') }}" alt="" style="opacity: 0.3;">
              </div>
              @if(request()->has(['currency', 'payment_method']) && !empty(array_filter(request()->only(['currency', 'payment_method']))))
                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Aucun résultat trouvé</h3>
                <p class="cs_mb_30">Aucune donation ne correspond à vos critères de recherche.</p>
                <a href="{{ route('donations.index') }}" class="cs_btn cs_style_2">
                  <i class="fas fa-refresh"></i> Effacer les filtres
                </a>
              @else
                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Aucune donation trouvée</h3>
                <p class="cs_mb_30">Commencez par ajouter votre première donation pour aider nos projets environnementaux.</p>
                <a href="{{ route('donations.create') }}" class="cs_btn cs_style_1">
                  Créer ma première donation
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </i>
                </a>
              @endif
            </div>
          @endif

        </div>
      </div>
      <div class="col-lg-4">
        <div class="cs_donation_stats cs_white_bg cs_shadow_1">
          <h3 class="cs_fs_28 cs_semibold cs_mb_30">Statistiques</h3>
          
          <div class="cs_stat_item cs_mb_25">
            <div class="cs_stat_number cs_accent_color cs_fs_38 cs_semibold">{{ $donations->count() }}</div>
            <div class="cs_stat_label">Total Donations</div>
          </div>
          
          <div class="cs_stat_item cs_mb_25">
            <div class="cs_stat_number cs_accent_color cs_fs_38 cs_semibold">{{ App\Helpers\CurrencyHelper::formatTND($totalAmountTND) }}</div>
            <div class="cs_stat_label">Montant Total</div>
          </div>
          
          <div class="cs_stat_item cs_mb_25">
            <div class="cs_stat_number cs_accent_color cs_fs_38 cs_semibold">{{ $donations->where('date', '>=', now()->subMonths(1))->count() }}</div>
            <div class="cs_stat_label">Ce mois</div>
          </div>
          
          <hr class="cs_mb_30">
          
          <!-- Statistiques par devise -->
          <div class="cs_currency_stats cs_mb_30">
            <h4 class="cs_fs_18 cs_semibold cs_mb_15 cs_accent_color">Par Devise (Montants en TND)</h4>
            @foreach($statisticsByCurrency as $statistic)
              <div class="cs_currency_item cs_mb_10">
                <div class="cs_currency_info">
                  <span class="cs_currency_label">{{ $statistic['currency'] }}</span>
                  <span class="cs_currency_conversion">{{ App\Helpers\CurrencyHelper::formatTND($statistic['amount_tnd']) }}</span>
                </div>
                <div class="cs_currency_meta">
                  <span class="cs_currency_count">{{ $statistic['count'] }} donations</span>
                  <span class="cs_currency_original">{{ number_format($statistic['amount_original'], 2) }} {{ $statistic['currency'] }}</span>
                </div>
              </div>
            @endforeach
          </div>
          
          <!-- Statistiques par méthode de paiement -->
          <div class="cs_payment_stats cs_mb_30">
            <h4 class="cs_fs_18 cs_semibold cs_mb_15 cs_accent_color">Par Méthode</h4>
            @foreach($donations->groupBy('payment_method') as $method => $methodDonations)
              <div class="cs_payment_item cs_mb_10">
                <span class="cs_payment_label">{{ $method }}</span>
                <span class="cs_payment_count">{{ count($methodDonations) }}</span>
              </div>
            @endforeach
          </div>
          
          <div class="text-center">
            <a href="{{ route('donations.create') }}" class="cs_btn cs_style_1 w-100">
              <i class="fas fa-heart"></i> Nouvelle Donation
            </a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
<!-- End Donations Section -->
@endsection