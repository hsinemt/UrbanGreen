@extends('frontOffice.layouts.app')
@section('title', 'Détails de la Donation')

@section('content')
<!-- Start Hero Section -->
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Détails de la Donation</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('donations.index') }}">Donations</a></li>
      <li class="breadcrumb-item active">Donation #{{ $donation->id }}</li>
    </ol>
  </div>
</section>
<!-- End Hero Section -->

<!-- Start Show Donation Section -->
<section class="cs_shape_wrap">
  <div class="cs_height_140 cs_height_lg_70"></div>
  <div class="cs_shape cs_shape_position_1"><img src="{{ asset('frontOffice/img/nature/about_shape_1.svg') }}" alt=""></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="cs_pl_75">
          <div class="cs_section_heading cs_style_1 cs_mb_60">
            <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">Merci pour votre générosité</h3>
            <h2 class="cs_fs_51 cs_mb_15">Détails de la Contribution</h2>
            <p class="cs_mb_0">Votre donation contribue significativement à nos projets environnementaux. Voici les détails de votre contribution.</p>
          </div>

          <div class="cs_white_bg cs_shadow_1 cs_padding_large">
            <div class="row cs_gap_y_40">
              <div class="col-md-6">
                <div class="cs_info_box">
                  <h4 class="cs_fs_21 cs_semibold cs_mb_15 cs_accent_color">Informations Générales</h4>
                  <div class="cs_info_list">
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">ID Donation :</span>
                      <span class="cs_info_value fw-bold">#{{ $donation->id }}</span>
                    </div>
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">Montant :</span>
                      <span class="cs_info_value fw-bold cs_accent_color">
                        <span class="cs_amount_show_tnd">{{ App\Helpers\CurrencyHelper::formatTND(App\Helpers\CurrencyHelper::convertToTND($donation->amount, $donation->currency)) }}</span>
                        <span class="cs_amount_original">({{ number_format($donation->amount, 2) }} {{ $donation->currency }})</span>
                      </span>
                    </div>
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">Date :</span>
                      <span class="cs_info_value">{{ $donation->date->format('d/m/Y') }}</span>
                    </div>
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">Méthode :</span>
                      <span class="cs_info_value">{{ $donation->payment_method }}</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="cs_info_box">
                  <h4 class="cs_fs_21 cs_semibold cs_mb_15 cs_accent_color">Suivi</h4>
                  <div class="cs_info_list">
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">Créée le :</span>
                      <span class="cs_info_value">{{ $donation->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">Modifiée le :</span>
                      <span class="cs_info_value">{{ $donation->updated_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="cs_info_item cs_mb_15">
                      <span class="cs_info_label">Statut :</span>
                      <span class="cs_status cs_success">✓ Confirmée</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="cs_height_40"></div>
            
            <div class="cs_impact_box cs_accent_bg text-center">
              <div class="cs_impact_icon cs_mb_20">
                <i class="fas fa-heart cs_white_color" style="font-size: 2.5rem;"></i>
              </div>
              <h3 class="cs_fs_28 cs_semibold cs_white_color cs_mb_15">Impact Environnemental</h3>
              <p class="cs_white_color cs_mb_0">Votre contribution de {{ App\Helpers\CurrencyHelper::formatTND(App\Helpers\CurrencyHelper::convertToTND($donation->amount, $donation->currency)) }} nous permet de continuer nos efforts pour protéger l'environnement et sensibiliser aux problèmes écologiques.</p>
            </div>

            <div class="cs_height_40"></div>
            
            <div class="row align-items-center">
              <div class="col-md-4">
                <a href="{{ route('donations.index') }}" class="cs_btn cs_style_2">
                  <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
              </div>
              <div class="col-md-4 text-center">
                <a href="{{ route('donations.edit', $donation) }}" class="cs_btn cs_style_3">
                  <i class="fas fa-download"></i> Modifier
                </a>
              </div>
              <div class="col-md-4 text-md-end">
                <form action="{{ route('donations.destroy', $donation) }}" method="POST" 
                      style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette donation?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="cs_btn cs_style_4">
                    <i class="fas fa-trash"></i> Supprimer
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4">
        <div class="cs_white_bg cs_shadow_1 cs_padding_large">
          <h3 class="cs_fs_28 cs_semibold cs_mb_30">Projets Soutenus</h3>
          
          <div class="cs_project_box cs_mb_20">
            <div class="cs_project_icon cs_mb_15">
              <img src="{{ asset('frontOffice/img/others/feature_icon_1.svg') }}" alt="">
            </div>
            <h4 class="cs_fs_18 cs_semibold cs_mb_10">Éducation</h4>
            <p class="cs_mb_0">Campagnes de sensibilisation pour l'environnement.</p>
          </div>
          
          <div class="cs_project_box cs_mb_20">
            <div class="cs_project_icon cs_mb_15">
              <img src="{{ asset('frontOffice/img/others/feature_icon_2.svg') }}" alt="">
            </div>
            <h4 class="cs_fs_18 cs_semibold cs_mb_10">Conservation</h4>
            <p class="cs_mb_0">Protection des habitats naturels.</p>
          </div>
          
          <div class="cs_project_box cs_mb_30">
            <div class="cs_project_icon cs_mb_15">
              <img src="{{ asset('frontOffice/img/others/feature_icon_3.svg') }}" alt="">
            </div>
            <h4 class="cs_fs_18 cs_semibold cs_mb_10">Communauté</h4>
            <p class="cs_mb_0">Programmes communautaires verts.</p>
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
<!-- End Show Donation Section -->
@endsection