@extends('frontOffice.layouts.app')

@section('content')
<style>
    .smooth-transition {
        transition: all 0.3s ease-in-out;
    }
    .list-group-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .btn {
        transition: all 0.2s ease;
    }
    .btn:hover {
        transform: scale(1.05);
    }
    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    .event-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    .event-placeholder {
        width: 60px;
        height: 60px;
        background-color: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 1.5rem;
    }
    .search-form {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .bulk-actions {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        display: none;
    }
    .bulk-actions.show {
        display: block;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4 smooth-transition">
                <h1 class="display-4 text-dark">Events</h1>
                <a href="{{ route('events.create') }}" class="btn btn-success btn-lg smooth-transition">
                    <i class="fas fa-plus"></i> Create New Event
                </a>
            </div>

            <!-- Live Search Form -->
            <div class="search-form smooth-transition">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" 
                                   id="liveSearch"
                                   class="form-control" 
                                   placeholder="Start typing to search events by name, location, or description..." 
                                   value="{{ request('search') }}">
                            <button type="button" class="btn btn-outline-secondary" id="clearSearch" style="display: none;">
                                <i class="fas fa-times"></i> Clear
                            </button>
                        </div>
                 
                    </div>
                </div>
            </div>

            <!-- Bulk Actions -->
            <div id="bulkActions" class="bulk-actions">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong id="selectedCount">0</strong> event(s) selected
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmBulkDelete()">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearSelection()">
                            <i class="fas fa-times"></i> Clear Selection
                        </button>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Search Results Indicator -->
            <div id="searchResults" class="alert alert-info" style="display: none;">
                <i class="fas fa-info-circle"></i>
                <span id="searchResultsText"></span>
            </div>

            <div class="card smooth-transition">
                <div class="card-body" id="eventsContainer">
                    @include('frontOffice.pages.events.partials.event-list', ['events' => $events])
                </div>
            </div>

            @if(method_exists($events, 'hasPages') && $events->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bulk Delete Form (Hidden) -->
<form id="bulkDeleteForm" action="{{ route('events.bulk-delete') }}" method="POST" style="display: none;">
    @csrf
    <div id="selectedEventIds"></div>
</form>

<script>
let searchTimeout;

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.event-checkbox:checked');
    const count = checkboxes.length;
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');
    const selectAll = document.getElementById('selectAll');
    
    selectedCount.textContent = count;
    
    if (count > 0) {
        bulkActions.classList.add('show');
    } else {
        bulkActions.classList.remove('show');
    }
    
    // Update select all checkbox
    const totalCheckboxes = document.querySelectorAll('.event-checkbox').length;
    if (selectAll) {
        selectAll.checked = count === totalCheckboxes && totalCheckboxes > 0;
        selectAll.indeterminate = count > 0 && count < totalCheckboxes;
    }
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.event-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

function clearSelection() {
    const checkboxes = document.querySelectorAll('.event-checkbox');
    const selectAll = document.getElementById('selectAll');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    if (selectAll) {
        selectAll.checked = false;
        selectAll.indeterminate = false;
    }
    
    updateBulkActions();
}

function confirmBulkDelete() {
    const checkboxes = document.querySelectorAll('.event-checkbox:checked');
    
    if (checkboxes.length === 0) {
        alert('Please select at least one event to delete.');
        return;
    }
    
    const count = checkboxes.length;
    const message = count === 1 
        ? 'Are you sure you want to delete this event?' 
        : `Are you sure you want to delete these ${count} events?`;
    
    if (confirm(message + ' This action cannot be undone.')) {
        // Add selected IDs to the form
        const selectedEventIds = document.getElementById('selectedEventIds');
        selectedEventIds.innerHTML = '';
        
        checkboxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'event_ids[]';
            input.value = checkbox.value;
            selectedEventIds.appendChild(input);
        });
        
        // Submit the form
        document.getElementById('bulkDeleteForm').submit();
    }
}

function performLiveSearch(searchTerm) {
    const eventsContainer = document.getElementById('eventsContainer');
    const searchResults = document.getElementById('searchResults');
    const searchResultsText = document.getElementById('searchResultsText');
    const clearButton = document.getElementById('clearSearch');
    
    // Show loading state
    eventsContainer.innerHTML = '<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Searching...</p></div>';
    
    // Make AJAX request
    fetch(`{{ route('events.search') }}?search=${encodeURIComponent(searchTerm)}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update events container
        eventsContainer.innerHTML = data.html;
        
        // Update search results indicator
        if (searchTerm.trim() !== '') {
            searchResultsText.textContent = `Showing search results for: "${searchTerm}" (${data.count} event(s) found)`;
            searchResults.style.display = 'block';
            clearButton.style.display = 'block';
        } else {
            searchResults.style.display = 'none';
            clearButton.style.display = 'none';
        }
        
        // Reset bulk actions
        updateBulkActions();
    })
    .catch(error => {
        console.error('Search error:', error);
        eventsContainer.innerHTML = '<div class="text-center py-5 text-danger"><i class="fas fa-exclamation-triangle fa-2x"></i><p class="mt-2">Error loading search results. Please try again.</p></div>';
    });
}

function clearSearch() {
    const liveSearchInput = document.getElementById('liveSearch');
    const searchResults = document.getElementById('searchResults');
    const clearButton = document.getElementById('clearSearch');
    
    liveSearchInput.value = '';
    searchResults.style.display = 'none';
    clearButton.style.display = 'none';
    
    // Perform search with empty term to show all events
    performLiveSearch('');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const liveSearchInput = document.getElementById('liveSearch');
    const clearButton = document.getElementById('clearSearch');
    
    // Live search functionality
    liveSearchInput.addEventListener('input', function() {
        const searchTerm = this.value;
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        // Set new timeout to avoid too many requests
        searchTimeout = setTimeout(() => {
            performLiveSearch(searchTerm);
        }, 300); // Wait 300ms after user stops typing
    });
    
    // Clear search functionality
    clearButton.addEventListener('click', clearSearch);
    
    // Show clear button if there's initial search value
    if (liveSearchInput.value.trim() !== '') {
        clearButton.style.display = 'block';
    }
    
    // Initialize bulk actions
    updateBulkActions();
});
</script>
@endsection