@extends('frontOffice.layouts.app')
@section('title', 'Competitions')

@section('content')
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Competitions</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Competitions</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center cs_mb_30">
      <h2 class="cs_fs_38 cs_semibold mb-0">Competition List</h2>
      @auth
        @if(Auth::user()->isPartner())
          <a href="{{ route('competitions.create') }}" class="cs_btn cs_style_1">Create Competition</a>
        @endif
      @endauth
    </div>

    <form method="GET" class="cs_mb_30" id="competitionsFilterForm">
      <div class="d-flex align-items-end gap-2">
        <input type="text" class="cs_form_input" name="q" value="{{ request('q') }}" placeholder="Search by reward or description" style="min-width:260px">
        <button type="submit" class="cs_btn cs_style_2">Filter</button>
      </div>
    </form>

    <div class="row cs_gap_y_50">
      @forelse($competitions as $competition)
        <div class="col-lg-6">
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
              <p class="cs_mb_14">{{ \Illuminate\Support\Str::limit($competition->description, 180) }}</p>
              <div class="d-flex gap-2">
                <a href="{{ route('competitions.show', $competition) }}" class="cs_btn cs_style_1">View</a>
                @auth
                  @if(Auth::user()->isPartner() && $competition->partner_id === Auth::id())
                    <a href="{{ route('competitions.edit', $competition) }}" class="cs_btn cs_style_1">Edit</a>
                    <form action="{{ route('competitions.destroy', $competition) }}" method="POST" onsubmit="return confirm('Delete competition?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="cs_btn cs_style_2">Delete</button>
                    </form>
                  @endif
                @endauth
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12"><div class="cs_notice cs_style_1">No competitions found.</div></div>
      @endforelse
    </div>

    <div class="cs_mt_30">
      {{ $competitions->withQueryString()->links() }}
    </div>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection


