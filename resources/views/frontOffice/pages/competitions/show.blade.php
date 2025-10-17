@extends('frontOffice.layouts.app')
@section('title', 'Competition Details')

@section('content')
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Competition Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('competitions.index') }}">Competitions</a></li>
        <li class="breadcrumb-item active">Details</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
      <div class="cs_card_info">
        <h2 class="cs_fs_32 cs_semibold cs_mb_10">Reward: {{ $competition->reward }}</h2>
        <p class="cs_mb_10">Project: <strong>{{ optional($competition->project)->name }}</strong></p>
        <p class="cs_mb_10">Partner: <strong>{{ optional($competition->partner)->name }}</strong></p>
        <p class="cs_mb_10">Associations:
          @foreach($competition->associations as $assoc)
            <span class="cs_badge cs_badge_secondary" style="background:#e9ecef;color:#212529;">{{ $assoc->name }}</span>
          @endforeach
        </p>
        <p class="cs_mb_14">{{ $competition->description }}</p>
      </div>
    </div>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection


