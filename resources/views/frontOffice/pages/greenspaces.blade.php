@extends('frontOffice.layouts.app')
@section('title', 'GreenSpaces')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Green Spaces Management</h1>

        <div class="card mb-4">
            <div class="card-header">Create / Edit</div>
            <div class="card-body">
                <form id="greenSpaceForm">
                    <input type="hidden" id="gs-id">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" id="gs-name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Location</label>
                            <input type="text" id="gs-location" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Area (m²)</label>
                            <input type="number" step="0.01" id="gs-surface" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Available</label>
                            <select id="gs-availability" class="form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type</label>
                            <input type="text" id="gs-type" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea id="gs-description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                        <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Green Spaces List</span>
                <input type="search" id="searchInput" class="form-control" style="max-width: 260px;" placeholder="Search...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Area</th>
                            <th>Available</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="gs-tbody"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const baseUrl = '/green-spaces';

    const tbody = document.getElementById('gs-tbody');
    const form = document.getElementById('greenSpaceForm');
    const submitBtn = document.getElementById('submitBtn');
    const resetBtn = document.getElementById('resetBtn');
    const searchInput = document.getElementById('searchInput');

    const idEl = document.getElementById('gs-id');
    const nameEl = document.getElementById('gs-name');
    const locEl = document.getElementById('gs-location');
    const surfaceEl = document.getElementById('gs-surface');
    const availEl = document.getElementById('gs-availability');
    const typeEl = document.getElementById('gs-type');
    const descEl = document.getElementById('gs-description');

    let allRows = [];

    function toRow(g) {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${escapeHtml(g.name ?? '')}</td>
            <td>${escapeHtml(g.location ?? '')}</td>
            <td>${Number(g.surface).toFixed(2)}</td>
            <td>${g.availability ? 'Yes' : 'No'}</td>
            <td>${escapeHtml(g.type ?? '')}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-2" data-action="edit" data-id="${g.id}">Edit</button>
                <button class="btn btn-sm btn-outline-danger me-2" data-action="delete" data-id="${g.id}">Delete</button>
                <button class="btn btn-sm ${g.availability ? 'btn-success' : 'btn-secondary'}"
                        data-action="book"
                        data-id="${g.id}"
                        ${!g.availability ? 'disabled' : ''}>
                    ${g.availability ? 'Book' : 'Unavailable'}
                </button>
            </td>
        `;
        return tr;
    }

    function escapeHtml(s) {
        return String(s)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    async function fetchAll() {
        const res = await fetch(baseUrl);
        if (!res.ok) throw new Error('Loading error');
        const data = await res.json();
        allRows = data;
        render(data);
    }

    function render(rows) {
        tbody.innerHTML = '';
        rows.forEach(g => tbody.appendChild(toRow(g)));
    }

    function filter() {
        const q = searchInput.value.toLowerCase();
        const rows = allRows.filter(g =>
            (g.name ?? '').toLowerCase().includes(q) ||
            (g.location ?? '').toLowerCase().includes(q) ||
            (g.type ?? '').toLowerCase().includes(q)
        );
        render(rows);
    }

    async function create(payload) {
        const res = await fetch(baseUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        });
        if (!res.ok) throw new Error('Creation failed');
        return res.json();
    }

    async function update(id, payload) {
        const res = await fetch(`${baseUrl}/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        });
        if (!res.ok) throw new Error('Update failed');
        return res.json();
    }

    async function remove(id) {
        const res = await fetch(`${baseUrl}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!res.ok) throw new Error('Deletion failed');
    }

    async function book(id) {
        const res = await fetch(`${baseUrl}/${id}/book`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!res.ok) throw new Error('Booking failed');
        return res.json();
    }

    function resetForm() {
        idEl.value = '';
        form.reset();
        submitBtn.textContent = 'Save';
    }

    tbody.addEventListener('click', async (e) => {
        const btn = e.target.closest('button[data-action]');
        if (!btn) return;
        const id = btn.getAttribute('data-id');
        const action = btn.getAttribute('data-action');
        if (action === 'edit') {
            const g = allRows.find(x => String(x.id) === String(id));
            if (!g) return;
            idEl.value = g.id;
            nameEl.value = g.name ?? '';
            locEl.value = g.location ?? '';
            surfaceEl.value = g.surface ?? '';
            availEl.value = g.availability ? '1' : '0';
            typeEl.value = g.type ?? '';
            descEl.value = g.description ?? '';
            submitBtn.textContent = 'Update';
        } else if (action === 'delete') {
            if (!confirm('Delete this item?')) return;
            try {
                await remove(id);
                await fetchAll();
            } catch (err) {
                alert(err.message);
            }
        } else if (action === 'book') {
            const g = allRows.find(x => String(x.id) === String(id));
            if (!g || !g.availability) return;

            if (!confirm(`Do you want to book the green space "${g.name}"?`)) return;

            try {
                await book(id);
                await fetchAll();
                alert('Green space booked successfully!');
            } catch (err) {
                alert(err.message);
            }
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const payload = {
            name: nameEl.value.trim(),
            location: locEl.value.trim(),
            surface: Number(surfaceEl.value),
            availability: availEl.value === '1',
            description: descEl.value.trim() || null,
            type: typeEl.value.trim() || null,
        };
        try {
            if (idEl.value) {
                await update(idEl.value, payload);
            } else {
                await create(payload);
            }
            resetForm();
            await fetchAll();
        } catch (err) {
            alert(err.message);
        }
    });

    resetBtn.addEventListener('click', resetForm);
    searchInput.addEventListener('input', filter);

    fetchAll().catch(err => alert(err.message));
})();
</script>
@endpush



