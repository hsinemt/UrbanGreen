@extends('frontOffice.layouts.app')
@section('title', 'Paiement Annulé')

@section('content')
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Paiement annulé</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('donations.index') }}">Donations</a></li>
      <li class="breadcrumb-item active">Annulé</li>
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
            <i class="fas fa-times-circle text-danger" style="font-size:64px;"></i>
          </div>
          <h2 class="cs_fs_36 cs_mb_15">Transaction annulée</h2>
          <p class="cs_mb_30">Le paiement a été annulé. Vous pouvez réessayer ou revenir à la liste des donations.</p>

          <div class="mt-4">
            <a href="{{ route('donations.create') }}" class="cs_btn cs_style_1">Réessayer</a>
            <a href="{{ route('donations.index') }}" class="cs_btn cs_style_2">Voir mes donations</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
@endsection

