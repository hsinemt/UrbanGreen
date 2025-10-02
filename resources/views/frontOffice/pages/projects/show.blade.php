@extends('frontOffice.layouts.app')
@section('title', 'Projects')

@section('content')
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Projects</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Projects</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    @if (session('success'))
      <div class="cs_notice cs_style_1 cs_green_bg cs_white_color cs_mb_30">{{ session('success') }}</div>
    @endif

    <!-- Statistics Cards -->
    <div class="row cs_mb_30">
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #28a745;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5">{{ $stats['total'] }}</h3>
            <p class="cs_mb_0">Total Projects</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #f39c12;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5">{{ $stats['in_progress_count'] }}</h3>
            <p class="cs_mb_0">In Progress</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #28a745;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5">{{ $stats['completed_count'] }}</h3>
            <p class="cs_mb_0">Completed</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #007bff;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5">{{ number_format($stats['total_budget'], 0) }} DT</h3>
            <p class="cs_mb_0">Total Budget</p>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center cs_mb_30">
      <h2 class="cs_fs_38 cs_semibold mb-0">Project List</h2>
      <a href="{{ route('projects.create') }}" class="cs_btn cs_style_1">
        Add Project
        <i>
          <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </i>
      </a>
    </div>

    <form method="GET" class="cs_mb_30" id="projectsFilterForm">
      <div class="d-flex align-items-end gap-2">
        <input type="text" class="cs_form_input" name="q" value="{{ request('q') }}" placeholder="Search by name or description" style="min-width:260px">
        <select name="status" class="cs_form_input" onchange="document.getElementById('projectsFilterForm').submit()">
          <option value="">All statuses</option>
          @foreach(\App\Models\Projet::allowedStatuses() as $st)
            <option value="{{ $st }}" {{ request('status')===$st ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$st)) }}</option>
          @endforeach
        </select>
        <input type="date" class="cs_form_input" name="start_date" value="{{ request('start_date') }}" onchange="document.getElementById('projectsFilterForm').submit()">
        <input type="date" class="cs_form_input" name="end_date" value="{{ request('end_date') }}" onchange="document.getElementById('projectsFilterForm').submit()">
        <button type="submit" class="d-none">Apply</button>
      </div>
    </form>

    <div class="row cs_gap_y_50">
      @forelse($projects as $projet)
        <div class="col-lg-6">
          <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
           
            <div class="cs_card_info">
              <div class="d-flex justify-content-between align-items-start cs_mb_10">
                <h2 class="cs_fs_38 cs_mb_10 cs_semibold" style="line-height:1.2;">{{ $projet->name }}</h2>
                <span class="cs_badge" style="
                  background-color: {{ match($projet->status) {
                    'planned' => '#0d6efd',
                    'in_progress' => '#f39c12',
                    'completed' => '#28a745',
                    'cancelled' => '#dc3545',
                    default => '#6c757d'
                  } }};
                  color:#fff; white-space:nowrap;">
                  {{ ucfirst(str_replace('_', ' ', $projet->status)) }}
                </span>
              </div>

              <h5 class="cs_mb_14">{{ \Illuminate\Support\Str::limit($projet->description, 180) }}</h5>
              @if(!empty($projet->tags))
                <div class="cs_mb_10">
                  @foreach((array) $projet->tags as $tag)
                    <span class="cs_badge cs_badge_secondary" style="background:#e9ecef;color:#212529;">#{{ $tag }}</span>
                  @endforeach
                </div>
              @endif

              <div class="d-flex justify-content-between cs_mb_10">
                <p class="cs_fs_21 cs_semibold mb-0">Start : {{ optional($projet->start_date)->format('Y-m-d') }}</p>
                <p class="cs_fs_21 cs_semibold mb-0">End : {{ optional($projet->end_date)->format('Y-m-d') ?? '-' }}</p>
              </div>
              <div class="cs_progress_wrap">
                <div class="cs_progress" data-progress="{{ (int) $projet->progress_percentage }}">
                  <div class="cs_progress_in cs_accent_bg"><span>{{ (int) $projet->progress_percentage }}%</span></div>
                </div>
              </div>
              <div class="cs_progress_heading cs_mb_28">
                <h3 class="cs_fs_21 cs_semibold mb-0">Budget : {{ number_format((float) $projet->budget, 0) }} DT</h3>
              </div>
              <div class="d-flex gap-2">
                <a href="{{ route('projects.show', $projet) }}" class="cs_btn cs_style_1">
                  View Details
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </i>
                </a>
                <a href="{{ route('projects.edit', $projet) }}" class="cs_btn cs_style_1">
                  Edit
                </a>
                <form action="{{ route('projects.destroy', $projet) }}" method="POST" onsubmit="return confirm('Are you sure to delete this project?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="cs_btn cs_style_2">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="cs_notice cs_style_1">No projects found.</div>
        </div>
      @endforelse
    </div>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection
