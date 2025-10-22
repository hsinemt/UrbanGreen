@extends('frontOffice.layouts.app')
@section('title', 'Ajouter une Donation')

@section('content')
<!-- Start Hero Section -->
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Ajouter une Donation</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('donations.index') }}">Donations</a></li>
      <li class="breadcrumb-item active">Nouvelle Donation</li>
    </ol>
  </div>
</section>
<!-- End Hero Section -->

<!-- Start Create Donation Section -->
<section class="cs_shape_wrap">
  <div class="cs_height_140 cs_height_lg_70"></div>
  <div class="cs_shape cs_shape_position_1"><img src="{{ asset('frontOffice/img/nature/about_shape_1.svg') }}" alt=""></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="cs_section_heading cs_style_1 text-center cs_mb_60">
          <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Créer une Donation</h3>
          <h2 class="cs_fs_51 cs_mb_15">Faire une Contribution</h2>
          <p class="cs_mb_0">Remplissez les informations ci-dessous pour ajouter une nouvelle donation à nos projets environnementaux.</p>
        </div>
        
        <div class="cs_white_bg cs_shadow_1 cs_padding_large">
          <form action="{{ route('donations.store') }}" method="POST">
            @csrf
            
            <div class="row cs_gap_y_30">
              <div class="col-md-6">
                <label for="amount" class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Montant *</label>
                <div class="cs_form_group cs_mb_20">
                  <input type="number" step="0.01" min="0.01" class="cs_form_input @error('amount') is-invalid @enderror" 
                         id="amount" name="amount" value="{{ old('amount') }}" placeholder="0.00" required>
                  @error('amount')
                    <div class="cs_invalid_feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label for="currency" class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Devise *</label>
                <div class="cs_form_group cs_mb_20">
                  <select class="cs_form_select @error('currency') is-invalid @enderror" id="currency" name="currency" required onchange="updateCurrencyConversion()">
                    <option value="">Choisir une devise</option>
                    <option value="TND" {{ old('currency') == 'TND' ? 'selected' : '' }}>د.ت TND - Dinar Tunisien</option>
                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>€ EUR - Euro</option>
                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>$ USD - Dollar US</option>
                    <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>£ GBP - Livre Sterling</option>
                    <option value="CHF" {{ old('currency') == 'CHF' ? 'selected' : '' }}>CHF - Franc Suisse</option>
                    <option value="CAD" {{ old('currency') == 'CAD' ? 'selected' : '' }}>C$ CAD - Dollar Canadien</option>
                    <option value="AUD" {{ old('currency') == 'AUD' ? 'selected' : '' }}>A$ AUD - Dollar Australien</option>
                    <option value="JPY" {{ old('currency') == 'JPY' ? 'selected' : '' }}>¥ JPY - Yen Japonais</option>
                    <option value="CNY" {{ old('currency') == 'CNY' ? 'selected' : '' }}>¥ CNY - Yuan Chinois</option>
                    <option value="AED" {{ old('currency') == 'AED' ? 'selected' : '' }}>د.إ AED - Dirham Émirati</option>
                    <option value="SAR" {{ old('currency') == 'SAR' ? 'selected' : '' }}>ر.س SAR - Riyal Saoudien</option>
                    <option value="EGP" {{ old('currency') == 'EGP' ? 'selected' : '' }}>£ EGP - Livre Égyptienne</option>
                    <option value="MAD" {{ old('currency') == 'MAD' ? 'selected' : '' }}>د.م. MAD - Dirham Marocain</option>
                    <option value="DZD" {{ old('currency') == 'DZD' ? 'selected' : '' }}>د.ج DZD - Dinar Algérien</option>
                  </select>
                  @error('currency')
                    <div class="cs_invalid_feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Convertisseur en temps réel -->
            <div class="row cs_gap_y_30">
              <div class="col-12">
                <div class="cs_currency_converter cs_light_bg cs_padding_medium cs_mb_20">
                  <h5 class="cs_fs_18 cs_semibold cs_mb_15 cs_accent_color">
                    <i class="fas fa-exchange-alt"></i> Conversion en Temps Réel
                  </h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div id="conversionResult" class="cs_conversion_display">
                        <span class="cs_conversion_text">Entrez un montant pour voir la conversion</span>
                      </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                      <a href="{{ route('currency.index') }}" class="cs_btn cs_style_2 cs_btn_sm">
                        <i class="fas fa-calculator"></i> Convertisseur Complet
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row cs_gap_y_30">
              <div class="col-md-6">
                <label for="wallet_id" class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Wallet de Destination *</label>
                <div class="cs_form_group cs_mb_20">
                  <select class="cs_form_select @error('wallet_id') is-invalid @enderror" id="wallet_id" name="wallet_id" required>
                    <option value="">Choisir un wallet</option>
                    @foreach($wallets as $wallet)
                      <option value="{{ $wallet->id }}" {{ old('wallet_id') == $wallet->id ? 'selected' : '' }}>
                        {{ $wallet->name }} - {{ $wallet->event->name ?? 'N/A' }}
                        ({{ number_format($wallet->total_amount, 2) }}€ / {{ number_format($wallet->target_amount, 2) }}€)
                      </option>
                    @endforeach
                  </select>
                  @error('wallet_id')
                    <div class="cs_invalid_feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label for="date" class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Date *</label>
                <div class="cs_form_group cs_mb_20">
                  <input type="date" class="cs_form_input @error('date') is-invalid @enderror" 
                         id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                  @error('date')
                    <div class="cs_invalid_feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row cs_gap_y_30">
              <div class="col-md-6">
                <label for="payment_method" class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Méthode de Paiement *</label>
                <div class="cs_form_group cs_mb_20">
                  <select class="cs_form_select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                    <option value="">Choisir une méthode</option>
                    <option value="Card" {{ old('payment_method') == 'Card' ? 'selected' : '' }}>💳 Carte Bancaire</option>
                    <option value="PayPal" {{ old('payment_method') == 'PayPal' ? 'selected' : '' }}>🟦 PayPal</option>
                    <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>🏦 Virement Bancaire</option>
                    <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>💵 Espèces</option>
                    <option value="Check" {{ old('payment_method') == 'Check' ? 'selected' : '' }}>✅ Chèque</option>
                    <option value="Cryptocurrency" {{ old('payment_method') == 'Cryptocurrency' ? 'selected' : '' }}>₿ Cryptomonnaie</option>
                  </select>
                  @error('payment_method')
                    <div class="cs_invalid_feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="cs_height_30"></div>
            
            <div class="row align-items-center">
              <div class="col-md-6">
                <a href="{{ route('donations.index') }}" class="cs_btn cs_style_2">
                  <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
              </div>
              <div class="col-md-6 text-md-end">
                <div class="d-flex gap-2 justify-content-end">
                  <button type="submit" class="cs_btn cs_style_2">
                    <i class="fas fa-save"></i> Enregistrer (sans paiement)
                  </button>
                  <button type="submit" class="cs_btn cs_style_1" formaction="{{ route('donations.stripe.checkout') }}" formmethod="POST">
                    <i class="fab fa-stripe"></i> Payer avec Stripe
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
<!-- End Create Donation Section -->

<script>
function updateCurrencyConversion() {
    const amount = document.getElementById('amount').value;
    const currency = document.getElementById('currency').value;
    const resultDiv = document.getElementById('conversionResult');
    
    if (!amount || amount <= 0 || !currency) {
        resultDiv.innerHTML = '<span class="cs_conversion_text">Entrez un montant pour voir la conversion</span>';
        return;
    }
    
    resultDiv.innerHTML = '<span class="cs_conversion_text"><i class="fas fa-spinner fa-spin"></i> Conversion...</span>';
    
    fetch('{{ route("currency.convert") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            amount: parseFloat(amount),
            from: currency,
            to: 'TND'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            resultDiv.innerHTML = `
                <div class="cs_conversion_success">
                    <strong>${amount} ${currency}</strong> = <strong>${data.formatted}</strong>
                    <br><small class="text-muted">Taux: 1 ${currency} = ${data.rate.toFixed(4)} TND</small>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `<span class="cs_conversion_error">Erreur de conversion</span>`;
        }
    })
    .catch(error => {
        resultDiv.innerHTML = `<span class="cs_conversion_error">Erreur de connexion</span>`;
    });
}

// Conversion automatique lors du changement des valeurs
document.getElementById('amount').addEventListener('input', updateCurrencyConversion);
document.getElementById('currency').addEventListener('change', updateCurrencyConversion);
</script>
@endsection