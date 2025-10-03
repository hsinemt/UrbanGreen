@extends('frontOffice.layouts.app')
@section('title', $projet->exists ? 'Edit Project' : 'Add Project')

@section('content')
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">{{ $projet->exists ? 'Edit Project' : 'Add Project' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active">{{ $projet->exists ? 'Edit' : 'Add' }}</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    @if ($errors->any())
      <div class="cs_notice cs_style_1 cs_red_bg cs_white_color cs_mb_30">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ $projet->exists ? route('projects.update', $projet) : route('projects.store') }}" method="POST" class="cs_form">
      @csrf
      @if($projet->exists)
        @method('PUT')
      @endif

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Name</label>
        <input type="text" name="name" value="{{ old('name', $projet->name) }}" class="cs_form_input" required>
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Description</label>
        <textarea name="description" class="cs_form_input" rows="5" required>{{ old('description', $projet->description) }}</textarea>
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Status</label>
        <select name="status" class="cs_form_input" required>
          <option value="">Select status</option>
          @foreach($statuses as $status)
            <option value="{{ $status }}" {{ old('status', $projet->status) === $status ? 'selected' : '' }}>
              {{ ucfirst(str_replace('_', ' ', $status)) }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Start Date</label>
          <input type="date" name="start_date" value="{{ old('start_date', optional($projet->start_date)->format('Y-m-d')) }}" class="cs_form_input" required>
        </div>
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">End Date (optional)</label>
          <input type="date" name="end_date" value="{{ old('end_date', optional($projet->end_date)->format('Y-m-d')) }}" class="cs_form_input">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Progress Percentage</label>
          <input type="number" name="progress_percentage" min="0" max="100" value="{{ old('progress_percentage', $projet->progress_percentage) }}" class="cs_form_input" required>
        </div>
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Budget</label>
          <input type="number" step="0.01" min="0" name="budget" value="{{ old('budget', $projet->budget) }}" class="cs_form_input" required>
        </div>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="cs_btn cs_style_1">{{ $projet->exists ? 'Update' : 'Create' }}</button>
        <a href="{{ route('projects.index') }}" class="cs_btn cs_style_2">Cancel</a>
      </div>
    </form>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection


