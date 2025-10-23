@extends('dashboard.layouts.dashboard')
@section('title', 'Create Competition')

@section('breadcrumb')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Create Competition</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="{{ route('back.competitions.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                Competitions
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Create</li>
    </ul>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-9 mx-auto">
        <div class="card h-100 shadow-sm radius-12 border-0">
            <div class="card-header border-0 bg-primary text-white py-3 px-4 d-flex align-items-center justify-content-between">
                <h4 class="fw-semibold mb-0">🎯 Create New Competition</h4>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('back.competitions.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                   

                    {{-- Partner + Project + Reward --}}
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Partner <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg radius-8 @error('partner_id') is-invalid @enderror" name="partner_id" required>
                                <option value="">Select Partner</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('partner_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Project <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg radius-8 @error('projet_id') is-invalid @enderror" name="projet_id" required>
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('projet_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('projet_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Reward <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg radius-8 @error('reward') is-invalid @enderror"
                                   name="reward" value="{{ old('reward') }}" placeholder="e.g., $10,000 cash prize" required>
                            @error('reward')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                        <textarea class="form-control form-control-lg radius-8 @error('description') is-invalid @enderror"
                                  name="description" rows="4"
                                  placeholder="Describe the competition details, rules, and criteria...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Associations --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Associations <span class="text-danger">*</span>
                        </label>

                        <div class="d-flex justify-content-between mb-2">
                            <input type="text" id="assocSearch" class="form-control form-control-sm w-50"
                                   placeholder="🔍 Search associations by name">
                            <div>
                                <button type="button" id="assocSelectAll" class="btn btn-sm btn-outline-success me-1">Select All</button>
                                <button type="button" id="assocClearAll" class="btn btn-sm btn-outline-secondary">Clear</button>
                            </div>
                        </div>

                        <div id="selectedChips" class="mb-3 d-flex flex-wrap gap-2"></div>

                        <div id="assocList"
                             class="border radius-8 p-3 bg-light"
                             style="min-height: 140px; max-height: 250px; overflow-y: auto;">
                            @if($associations->count() > 0)
                                <div class="row row-cols-1 row-cols-md-2 g-2">
                                    @foreach($associations as $association)
                                        <div class="col">
                                            <div class="form-check border rounded-3 p-2 bg-white shadow-sm d-flex align-items-center">
                                                <input class="form-check-input me-2" type="checkbox"
                                                       name="association_ids[]"
                                                       value="{{ $association->id }}"
                                                       id="association_{{ $association->id }}"
                                                       {{ in_array($association->id, old('association_ids', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label flex-grow-1" for="association_{{ $association->id }}">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar-sm rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center" style="width:30px; height:30px;">
                                                            {{ Str::substr($association->name, 0, 2) }}
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold">{{ $association->name }}</div>
                                                            <small class="text-muted">{{ $association->email }}</small>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4 text-muted">
                                    <iconify-icon icon="solar:users-group-rounded-outline" class="text-xl mb-2"></iconify-icon>
                                    <p class="mb-0">No associations available</p>
                                </div>
                            @endif
                        </div>

                        <small class="form-text text-muted">Select at least one association to participate in this competition</small>
                        @error('association_ids')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('back.competitions.index') }}" class="btn btn-light border">
                            <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                            Create Competition
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const search = document.getElementById('assocSearch');
    const list = document.getElementById('assocList');
    const chips = document.getElementById('selectedChips');
    const btnAll = document.getElementById('assocSelectAll');
    const btnClear = document.getElementById('assocClearAll');

    function updateChips() {
        chips.innerHTML = '';
        list.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            if (cb.checked) {
                const label = cb.closest('label');
                const name = label.querySelector('.fw-semibold')?.textContent.trim() || 'Association';
                const chip = document.createElement('span');
                chip.className = 'badge bg-secondary d-flex align-items-center gap-1 px-2 py-1';
                chip.innerHTML = `${name} <button type="button" class="btn-close btn-close-white btn-sm ms-1" aria-label="Remove"></button>`;
                chip.querySelector('button').addEventListener('click', () => {
                    cb.checked = false;
                    updateChips();
                });
                chips.appendChild(chip);
            }
        });
    }

    if (search) {
        search.addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            list.querySelectorAll('.form-check').forEach(item => {
                const name = item.textContent.toLowerCase();
                item.style.display = name.includes(q) ? '' : 'none';
            });
        });
    }

    btnAll?.addEventListener('click', () => {
        list.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
        updateChips();
    });

    btnClear?.addEventListener('click', () => {
        list.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        updateChips();
    });

    list.addEventListener('change', e => {
        if (e.target.type === 'checkbox') updateChips();
    });

    updateChips();
});
</script>
@endpush
