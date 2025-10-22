@extends('frontOffice.layouts.app')
@section('title', 'Paiement Réussi')

@section('content')
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Merci pour votre donation</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('donations.index') }}">Donations</a></li>
      <li class="breadcrumb-item active">Succès</li>
    </ol>
  </div>
</section>

<section class="cs_shape_wrap">
  <div class="cs_height_140 cs_height_lg_70"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="cs_white_bg cs_shadow_1 cs_padding_large text-center">
          <div class="mb-4">
            <i class="fas fa-check-circle text-success" style="font-size:64px;"></i>
          </div>
          <h2 class="cs_fs_36 cs_mb_15">Paiement confirmé</h2>
          <p class="cs_mb_30">Votre donation a été enregistrée avec succès. Merci pour votre soutien.</p>

          <div class="cs_white_bg cs_shadow_1 cs_padding_medium text-start">
            <p><strong>Montant:</strong> {{ number_format($donation->amount, 2) }} {{ $donation->currency }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($donation->date)->format('d/m/Y') }}</p>
            <p><strong>Méthode:</strong> {{ $donation->payment_method }}</p>
            @if($donation->wallet)
            <p><strong>Wallet:</strong> {{ $donation->wallet->name }} ({{ $donation->wallet->event->name ?? 'N/A' }})</p>
            @endif
            <p><strong>ID Paiement:</strong> {{ $session->payment_intent ?? 'N/A' }}</p>
          </div>

          <div class="mt-4">
            <a href="{{ route('donations.index') }}" class="cs_btn cs_style_1">Voir mes donations</a>
            <a href="{{ route('home') }}" class="cs_btn cs_style_2">Retour à l'accueil</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
@endsection

