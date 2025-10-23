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
    <div class="col-lg-8 mx-auto">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h4 class="fw-semibold mb-0">Create New Competition</h4>
            </div>
            <div class="card-body p-24">
                <form action="{{ route('back.competitions.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Competition Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control radius-8 @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   placeholder="Enter competition name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Partner <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-control radius-8 @error('partner_id') is-invalid @enderror" name="partner_id" required>
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
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Project <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-control radius-8 @error('projet_id') is-invalid @enderror" name="projet_id" required>
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
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Reward <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control radius-8 @error('reward') is-invalid @enderror" 
                                   name="reward" value="{{ old('reward') }}" 
                                   placeholder="e.g., $10,000 cash prize" required>
                            @error('reward')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Description
                        </label>
                        <textarea class="form-control radius-8 @error('description') is-invalid @enderror" 
                                  name="description" rows="4" 
                                  placeholder="Describe the competition details, rules, and criteria...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Associations <span class="text-danger-600">*</span>
                        </label>
                        <div class="border radius-8 p-3 @error('association_ids') border-danger @enderror" style="min-height: 120px; max-height: 200px; overflow-y: auto; background: #f8f9fa;">
                            @if($associations->count() > 0)
                                @foreach($associations as $association)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" 
                                               name="association_ids[]" 
                                               value="{{ $association->id }}" 
                                               id="association_{{ $association->id }}"
                                               {{ in_array($association->id, old('association_ids', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label d-flex align-items-center" for="association_{{ $association->id }}">
                                            <div class="me-2">
                                                <div class="w-8 h-8 bg-primary-100 rounded-circle d-flex align-items-center justify-content-center">
                                                    <span class="text-primary fw-semibold text-sm">
                                                        {{ Str::of($association->first_name.' '.$association->last_name)->trim()->explode(' ')->map(fn($p)=>Str::substr($p,0,1))->take(2)->implode('') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $association->name }}</div>
                                                <small class="text-muted">{{ $association->email }}</small>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
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
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('back.competitions.index') }}" class="btn btn-secondary">
                            <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
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
    const form = document.querySelector('form');
    const associationCheckboxes = document.querySelectorAll('input[name="association_ids[]"]');
    
    form.addEventListener('submit', function(e) {
        const checkedAssociations = Array.from(associationCheckboxes).filter(cb => cb.checked);
        
        if (checkedAssociations.length === 0) {
            e.preventDefault();
            
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger mt-3';
            errorDiv.innerHTML = '<strong>Error:</strong> Please select at least one association to participate in this competition.';
            
            // Remove any existing error messages
            const existingError = form.querySelector('.alert-danger');
            if (existingError) {
                existingError.remove();
            }
            
            // Add error message before submit buttons
            const buttonContainer = form.querySelector('.d-flex.justify-content-end');
            buttonContainer.parentNode.insertBefore(errorDiv, buttonContainer);
            
            // Scroll to error message
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            return false;
        }
    });
    
    // Remove error message when user selects an association
    associationCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const errorDiv = form.querySelector('.alert-danger');
            if (errorDiv && Array.from(associationCheckboxes).some(cb => cb.checked)) {
                errorDiv.remove();
            }
        });
    });
});
</script>
@endpush
