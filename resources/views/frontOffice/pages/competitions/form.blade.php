@extends('frontOffice.layouts.app')
@section('title', $competition->exists ? 'Edit Competition' : 'Create Competition')

@section('content')
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">{{ $competition->exists ? 'Edit Competition' : 'Create Competition' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('competitions.index') }}">Competitions</a></li>
        <li class="breadcrumb-item active">{{ $competition->exists ? 'Edit' : 'Create' }}</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <form action="{{ $competition->exists ? route('competitions.update', $competition) : route('competitions.store') }}" method="POST">
      @csrf
      @if($competition->exists)
        @method('PUT')
      @endif

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Project</label>
        <select name="projet_id" class="cs_form_input @error('projet_id') is-invalid @enderror" required>
          <option value="">Select a project</option>
          @foreach($projects as $project)
            <option value="{{ $project->id }}" {{ old('projet_id', $competition->projet_id) == $project->id ? 'selected' : '' }}>
              {{ $project->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Associations</label>
        <div class="cs_mb_10" style="display:flex; gap:10px; align-items:center;">
          <input type="text" id="assocSearch" class="cs_form_input" placeholder="Search associations by name" style="max-width:380px;">
          <button type="button" id="assocSelectAll" class="cs_btn cs_style_2">Select All</button>
          <button type="button" id="assocClearAll" class="cs_btn cs_style_2">Clear</button>
        </div>
        <div id="selectedChips" class="cs_mb_10" style="display:flex; flex-wrap:wrap; gap:8px;"></div>
        <div id="assocList" class="cs_card cs_style_1 cs_white_bg" style="max-height:260px; overflow:auto; padding:12px; border:1px solid #e9ecef; border-radius:10px;">
          @php($selected = old('association_ids', $competition->exists ? $competition->associations->pluck('id')->toArray() : []))
          @foreach($associations as $assoc)
            <label class="cs_checkbox_label" data-name="{{ Str::lower($assoc->name) }}" style="display:flex; align-items:center; gap:10px; padding:6px 4px; cursor:pointer;">
              <input type="checkbox" name="association_ids[]" value="{{ $assoc->id }}" {{ in_array($assoc->id, $selected) ? 'checked' : '' }}>
              <span class="cs_avatar" style="width:28px;height:28px;border-radius:50%;background:#e9f5ee;color:#197b4f;display:inline-flex;align-items:center;justify-content:center;font-weight:600;">
                {{ Str::of($assoc->first_name.' '.$assoc->last_name)->trim()->explode(' ')->map(fn($p)=>Str::substr($p,0,1))->take(2)->implode('') }}
              </span>
              <span>{{ $assoc->name }}</span>
            </label>
          @endforeach
        </div>
        <small>Select one or more associations allowed to participate</small>
        @error('association_ids')
          <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
        @enderror
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Reward</label>
        <input type="text" name="reward" class="cs_form_input @error('reward') is-invalid @enderror" value="{{ old('reward', $competition->reward) }}" required>
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Description</label>
        <textarea name="description" class="cs_form_input @error('description') is-invalid @enderror" rows="5">{{ old('description', $competition->description) }}</textarea>
      </div>

      <button type="submit" class="cs_btn cs_style_1">{{ $competition->exists ? 'Update' : 'Create' }}</button>
    </form>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection

@push('scripts')
<script>
  (function(){
    const search = document.getElementById('assocSearch');
    const list = document.getElementById('assocList');
    const chips = document.getElementById('selectedChips');
    const btnAll = document.getElementById('assocSelectAll');
    const btnClear = document.getElementById('assocClearAll');

    function updateChips(){
      if(!chips) return;
      chips.innerHTML = '';
      list.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        if(cb.checked){
          const label = cb.closest('label');
          const name = label ? label.querySelector('span:last-child').textContent : 'Association';
          const chip = document.createElement('span');
          chip.className = 'cs_badge cs_badge_secondary';
          chip.style.cssText = 'background:#e9ecef;color:#212529; display:inline-flex; align-items:center; gap:6px; padding-right:8px;';
          chip.textContent = name;
          const x = document.createElement('button');
          x.type = 'button';
          x.textContent = '×';
          x.style.cssText = 'border:none;background:transparent;cursor:pointer;font-weight:700;';
          x.addEventListener('click', ()=>{ cb.checked = false; updateChips(); });
          chip.appendChild(x);
          chips.appendChild(chip);
        }
      });
    }

    if(search){
      search.addEventListener('input', function(){
        const q = this.value.trim().toLowerCase();
        list.querySelectorAll('label[data-name]').forEach(row => {
          const name = row.getAttribute('data-name');
          row.style.display = (!q || name.includes(q)) ? 'flex' : 'none';
        });
      });
    }

    if(btnAll){
      btnAll.addEventListener('click', function(){
        list.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
        updateChips();
      });
    }
    if(btnClear){
      btnClear.addEventListener('click', function(){
        list.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        updateChips();
      });
    }

    list.addEventListener('change', function(e){
      if(e.target && e.target.type === 'checkbox') updateChips();
    });

    // initial
    updateChips();
  })();
</script>
@endpush


