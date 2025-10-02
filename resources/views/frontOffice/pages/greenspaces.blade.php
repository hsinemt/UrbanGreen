@extends('frontOffice.layouts.app')
@section('title', 'GreenSpaces')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Gestion des Espaces Verts</h1>

        <div class="card mb-4">
            <div class="card-header">Créer / Modifier</div>
            <div class="card-body">
                <form id="greenSpaceForm">
                    <input type="hidden" id="gs-id">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nom</label>
                            <input type="text" id="gs-name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Localisation</label>
                            <input type="text" id="gs-location" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Surface (m²)</label>
                            <input type="number" step="0.01" id="gs-surface" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Disponible</label>
                            <select id="gs-availability" class="form-select">
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
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
                        <button type="submit" class="btn btn-primary" id="submitBtn">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" id="resetBtn">Réinitialiser</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Liste des Espaces Verts</span>
                <input type="search" id="searchInput" class="form-control" style="max-width: 260px;" placeholder="Rechercher...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Localisation</th>
                            <th>Surface</th>
                            <th>Disponible</th>
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
            <td>${g.availability ? 'Oui' : 'Non'}</td>
            <td>${escapeHtml(g.type ?? '')}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-2" data-action="edit" data-id="${g.id}">Éditer</button>
                <button class="btn btn-sm btn-outline-danger" data-action="delete" data-id="${g.id}">Supprimer</button>
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
        if (!res.ok) throw new Error('Erreur chargement');
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
        if (!res.ok) throw new Error('Échec de création');
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
        if (!res.ok) throw new Error('Échec de mise à jour');
        return res.json();
    }

    async function remove(id) {
        const res = await fetch(`${baseUrl}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!res.ok) throw new Error('Échec de suppression');
    }

    function resetForm() {
        idEl.value = '';
        form.reset();
        submitBtn.textContent = 'Enregistrer';
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
            submitBtn.textContent = 'Mettre à jour';
        } else if (action === 'delete') {
            if (!confirm('Supprimer cet élément ?')) return;
            try {
                await remove(id);
                await fetchAll();
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



