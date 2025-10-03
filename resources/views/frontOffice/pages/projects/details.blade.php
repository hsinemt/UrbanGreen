@extends('frontOffice.layouts.app')
@section('title', $projet->name)

@section('content')
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">{{ $projet->name }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active">{{ $projet->name }}</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="row cs_gap_y_80">
      <div class="col-lg-8">
        <div class="cs_details_content">

          <div class="d-flex justify-content-between align-items-start cs_mb_30">
            <div>
              <h2 class="cs_fs_42 cs_semibold cs_mb_15">{{ $projet->name }}</h2>
              <span class="cs_badge" style="background-color: {{ match($projet->status) {
                'planned' => '#0d6efd',
                'in_progress' => '#f39c12',
                'completed' => '#28a745',
                'cancelled' => '#dc3545',
                default => '#6c757d'
              } }}; color:#fff; padding: 8px 16px; border-radius: 20px;">
                {{ ucfirst(str_replace('_', ' ', $projet->status)) }}
              </span>
            </div>
            <div class="text-end">
              <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5">{{ number_format($projet->budget, 0) }} DT</h3>
              <p class="cs_fs_16 cs_muted">Total Budget</p>
            </div>
          </div>

          <p class="cs_fs_18 cs_mb_30" style="line-height: 1.6;">{{ $projet->description }}</p>

          @if($projet->tags)
            <div class="cs_mb_40">
              <h3 class="cs_fs_24 cs_semibold cs_mb_15">Project Tags</h3>
              @foreach((array) $projet->tags as $tag)
                <span class="cs_badge" style="background:#e3f2fd;color:#1976d2;padding: 6px 12px;margin: 2px;border-radius: 15px;">#{{ $tag }}</span>
              @endforeach
            </div>
          @endif

          <!-- Progress Section -->
          <div class="cs_card cs_style_1 cs_white_bg cs_shadow_1 cs_mb_40" style="border-left: 4px solid #28a745;">
            <div class="cs_card_in">
              <h3 class="cs_fs_24 cs_semibold cs_mb_20">Project Progress</h3>
              <div class="cs_progress_wrap cs_mb_15">
                <div class="cs_progress" data-progress="{{ $projet->progress_percentage }}">
                  <div class="cs_progress_in cs_accent_bg"><span>{{ $projet->progress_percentage }}%</span></div>
                </div>
              </div>
              <p class="cs_fs_16 cs_muted cs_mb_0">{{ $projet->progress_percentage }}% completed</p>
            </div>
          </div>

          <!-- Timeline Section -->
          <div class="cs_card cs_style_1 cs_white_bg cs_shadow_1 cs_mb_40" style="border-left: 4px solid #007bff;">
            <div class="cs_card_in">
              <h3 class="cs_fs_24 cs_semibold cs_mb_20">Project Timeline</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="cs_info_card cs_gray_bg cs_mb_15">
                    <div class="d-flex align-items-center">
                      <i class="fa-solid fa-play-circle cs_fs_24 cs_accent_color cs_mr_15"></i>
                      <div>
                        <h4 class="cs_fs_18 cs_semibold cs_mb_5">Start Date</h4>
                        <p class="cs_fs_16 cs_mb_0">{{ $projet->start_date->format('d M Y') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="cs_info_card cs_gray_bg cs_mb_15">
                    <div class="d-flex align-items-center">
                      <i class="fa-solid fa-flag-checkered cs_fs_24 cs_accent_color cs_mr_15"></i>
                      <div>
                        <h4 class="cs_fs_18 cs_semibold cs_mb_5">End Date</h4>
                        <p class="cs_fs_16 cs_mb_0">{{ $projet->end_date ? $projet->end_date->format('d M Y') : 'Ongoing' }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

{{--          @if($projet->risks && $projet->risks->count() > 0)--}}
{{--            <div class="cs_card cs_style_1 cs_white_bg cs_shadow_1 cs_mb_40" style="border-left: 4px solid #ff9800;">--}}
{{--              <div class="cs_card_in">--}}
{{--                <h3 class="cs_fs_24 cs_semibold cs_mb_20">--}}
{{--                  <i class="fa-solid fa-exclamation-triangle cs_mr_10 cs_accent_color"></i>--}}
{{--                  Project Risks--}}
{{--                </h3>--}}
{{--                @foreach($projet->risks as $risk)--}}
{{--                  <div class="cs_card cs_style_1 cs_gray_bg cs_mb_15">--}}
{{--                    <div class="cs_card_in">--}}
{{--                      <div class="d-flex justify-content-between align-items-start cs_mb_10">--}}
{{--                        <h4 class="cs_fs_18 cs_semibold cs_mb_0">{{ $risk->title }}</h4>--}}
{{--                        <span class="cs_badge" style="background-color: {{ match($risk->probability) { 'low' => '#28a745', 'medium' => '#f39c12', 'high' => '#dc3545', default => '#6c757d' } }}; color:#fff; padding: 4px 8px; border-radius: 12px;">--}}
{{--                          {{ ucfirst($risk->probability) }} Risk--}}
{{--                        </span>--}}
{{--                      </div>--}}
{{--                      @if($risk->description)--}}
{{--                        <p class="cs_mb_10 cs_fs_16">{{ $risk->description }}</p>--}}
{{--                      @endif--}}
{{--                      @if($risk->mitigation)--}}
{{--                        <div class="cs_mb_0">--}}
{{--                          <p class="cs_fs_14 cs_semibold cs_mb_5" style="color: #28a745;">Mitigation Strategy:</p>--}}
{{--                          <p class="cs_fs_14 cs_mb_0">{{ $risk->mitigation }}</p>--}}
{{--                        </div>--}}
{{--                      @endif--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                @endforeach--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          @endif--}}

{{--          @if($projet->issues && $projet->issues->count() > 0)--}}
{{--            <div class="cs_card cs_style_1 cs_white_bg cs_shadow_1 cs_mb_40" style="border-left: 4px solid #f44336;">--}}
{{--              <div class="cs_card_in">--}}
{{--                <h3 class="cs_fs_24 cs_semibold cs_mb_20">--}}
{{--                  <i class="fa-solid fa-bug cs_mr_10 cs_accent_color"></i>--}}
{{--                  Project Issues--}}
{{--                </h3>--}}
{{--                @foreach($projet->issues as $issue)--}}
{{--                  <div class="cs_card cs_style_1 cs_gray_bg cs_mb_15">--}}
{{--                    <div class="cs_card_in">--}}
{{--                      <div class="d-flex justify-content-between align-items-start cs_mb_10">--}}
{{--                        <h4 class="cs_fs_18 cs_semibold cs_mb_0">{{ $issue->title }}</h4>--}}
{{--                        <span class="cs_badge" style="background-color: {{ match($issue->severity) { 'minor' => '#28a745', 'major' => '#f39c12', 'critical' => '#dc3545', default => '#6c757d' } }}; color:#fff; padding: 4px 8px; border-radius: 12px;">--}}
{{--                          {{ ucfirst($issue->severity) }}--}}
{{--                        </span>--}}
{{--                      </div>--}}
{{--                      @if($issue->description)--}}
{{--                        <p class="cs_mb_0 cs_fs_16">{{ $issue->description }}</p>--}}
{{--                      @endif--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                @endforeach--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          @endif--}}
        </div>
      </div>

      <div class="col-lg-4">
        <div class="cs_card cs_style_1 cs_white_bg cs_shadow_1 cs_mb_30">
          <div class="cs_card_in">
            <h3 class="cs_fs_24 cs_semibold cs_mb_20">
              <i class="fa-solid fa-info-circle cs_mr_10 cs_accent_color"></i>
              Project Details
            </h3>
            <div class="cs_mb_20">
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">Status</span>
                <span class="cs_badge" style="background-color: {{ match($projet->status) {
                  'planned' => '#0d6efd',
                  'in_progress' => '#f39c12',
                  'completed' => '#28a745',
                  'cancelled' => '#dc3545',
                  default => '#6c757d'
                } }}; color:#fff; padding: 4px 8px; border-radius: 12px;">{{ ucfirst(str_replace('_', ' ', $projet->status)) }}</span>
              </div>
              @if(isset($projet->priority))
                <div class="d-flex justify-content-between align-items-center cs_mb_10">
                  <span class="cs_fs_16 cs_semibold">Priority</span>
                  <span class="cs_fs_16">{{ $projet->priority }}/5</span>
                </div>
              @endif
              @if(isset($projet->visibility))
                <div class="d-flex justify-content-between align-items-center cs_mb_10">
                  <span class="cs_fs_16 cs_semibold">Visibility</span>
                  <span class="cs_fs_16">{{ ucfirst($projet->visibility) }}</span>
                </div>
              @endif
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">Start Date</span>
                <span class="cs_fs_16">{{ $projet->start_date->format('d M Y') }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">End Date</span>
                <span class="cs_fs_16">{{ $projet->end_date ? $projet->end_date->format('d M Y') : 'Ongoing' }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">Progress</span>
                <span class="cs_fs_16 cs_accent_color cs_semibold">{{ $projet->progress_percentage }}%</span>
              </div>
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">Budget</span>
                <span class="cs_fs_16 cs_accent_color cs_semibold">{{ number_format($projet->budget, 0) }} DT</span>
              </div>
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">Risks</span>
                <span class="cs_fs_16">{{ $projet->risks ? $projet->risks->count() : 0 }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center cs_mb_10">
                <span class="cs_fs_16 cs_semibold">Issues</span>
                <span class="cs_fs_16">{{ $projet->issues ? $projet->issues->count() : 0 }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="cs_height_50 cs_height_lg_40"></div>

        <div class="cs_card cs_style_1 cs_white_bg cs_shadow_1">
          <div class="cs_card_in">
            <h3 class="cs_fs_24 cs_semibold cs_mb_20">
              <i class="fa-solid fa-cog cs_mr_10 cs_accent_color"></i>
              Project Actions
            </h3>
            <div class="d-grid gap-2">
              <a href="{{ route('projects.edit', $projet) }}" class="cs_btn cs_style_1">
                <i class="fa-solid fa-edit cs_mr_10"></i>
                Edit Project
              </a>
              <form action="{{ route('projects.destroy', $projet) }}" method="POST" onsubmit="return confirm('Are you sure to delete this project?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="cs_btn cs_style_3 w-100">
                  <i class="fa-solid fa-trash cs_mr_10"></i>
                  Delete Project
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if($relatedProjects->count() > 0)
      <div class="cs_height_80 cs_height_lg_50"></div>
      <div class="cs_section_heading cs_style_1 text-center">
        <h2 class="cs_fs_51 mb-0">Related Projects</h2>
      </div>
      <div class="cs_height_50 cs_height_lg_30"></div>
      <div class="row cs_gap_y_50">
        @foreach($relatedProjects as $relatedProject)
          <div class="col-lg-4">
            <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
              <div class="cs_card_thumb">
                <img src="{{ asset('frontOffice/img/others/project_details_1.jpg') }}" alt="{{ $relatedProject->name }}" class="w-100">
              </div>
              <div class="cs_card_info">
                <h3 class="cs_fs_24 cs_semibold cs_mb_10">{{ $relatedProject->name }}</h3>
                <p class="cs_mb_15">{{ \Illuminate\Support\Str::limit($relatedProject->description, 100) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <p class="cs_fs_16 cs_mb_0">{{ $relatedProject->progress_percentage }}% Complete</p>
                    <p class="cs_fs_16 cs_mb_0">{{ number_format($relatedProject->budget, 0) }} DT</p>
                  </div>
                  <a href="{{ route('projects.show', $relatedProject) }}" class="cs_btn cs_style_2">View</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection
