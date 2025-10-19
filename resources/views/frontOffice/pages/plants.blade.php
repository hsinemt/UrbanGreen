@extends('frontOffice.layouts.app')
@section('title', 'Gestion des Plantes')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Gestion des Plantes</h1>

        <div class="card mb-4">
            <div class="card-header">Ajouter / Modifier une Plante</div>
            <div class="card-body">
                <form id="plantForm">
                    <input type="hidden" id="plant-id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom de la plante <span class="text-danger">*</span></label>
                            <input type="text" id="plant-nom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Espace Vert <span class="text-danger">*</span></label>
                            <select id="plant-green-space" class="form-select" required>
                                <option value="">Sélectionner un espace vert</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date de Plantation <span class="text-danger">*</span></label>
                            <input type="date" id="plant-date-plantation" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date Croissance Prévue <span class="text-danger">*</span></label>
                            <input type="date" id="plant-date-croissance" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Personne qui a planté <span class="text-danger">*</span></label>
                            <input type="text" id="plant-personne" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Milieu de Croissance <span class="text-danger">*</span></label>
                            <select id="plant-milieu" class="form-select" required>
                                <option value="">Sélectionner le milieu</option>
                                <option value="Intérieur">Intérieur</option>
                                <option value="Extérieur">Extérieur</option>
                                <option value="Serre">Serre</option>
                                <option value="Jardin">Jardin</option>
                                <option value="Balcon">Balcon</option>
                            </select>
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
                <span>Liste des Plantes</span>
                <div class="d-flex gap-2">
                    <select id="filterGreenSpace" class="form-select" style="max-width: 200px;">
                        <option value="">Tous les espaces</option>
                    </select>
                    <input type="search" id="searchInput" class="form-control" style="max-width: 260px;" placeholder="Rechercher...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Espace Vert</th>
                            <th>Date Plantation</th>
                            <th>Date Croissance</th>
                            <th>Personne</th>
                            <th>Milieu</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="plant-tbody"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const baseUrl = '/plants';

    const tbody = document.getElementById('plant-tbody');
    const form = document.getElementById('plantForm');
    const submitBtn = document.getElementById('submitBtn');
    const resetBtn = document.getElementById('resetBtn');
    const searchInput = document.getElementById('searchInput');
    const filterGreenSpace = document.getElementById('filterGreenSpace');

    const idEl = document.getElementById('plant-id');
    const nomEl = document.getElementById('plant-nom');
    const greenSpaceEl = document.getElementById('plant-green-space');
    const datePlantationEl = document.getElementById('plant-date-plantation');
    const dateCroissanceEl = document.getElementById('plant-date-croissance');
    const personneEl = document.getElementById('plant-personne');
    const milieuEl = document.getElementById('plant-milieu');

    let allRows = [];
    let greenSpaces = [];

    function toRow(p) {
        const tr = document.createElement('tr');
        const greenSpace = greenSpaces.find(gs => gs.id === p.green_space_id);
        const greenSpaceName = greenSpace ? greenSpace.name : 'N/A';
        
        // Calculer le statut
        const now = new Date();
        const dateCroissance = new Date(p.date_croissance_prevue);
        const joursRestants = Math.ceil((dateCroissance - now) / (1000 * 60 * 60 * 24));
        
        let statutBadge = '';
        if (joursRestants > 0) {
            statutBadge = `<span class="badge bg-info">${joursRestants} jours restants</span>`;
        } else if (joursRestants === 0) {
            statutBadge = `<span class="badge bg-warning">Croissance prévue aujourd'hui</span>`;
        } else {
            statutBadge = `<span class="badge bg-success">Croissance atteinte</span>`;
        }

        tr.innerHTML = `
            <td>${escapeHtml(p.nom ?? '')}</td>
            <td>${escapeHtml(greenSpaceName)}</td>
            <td>${formatDate(p.date_plantation)}</td>
            <td>${formatDate(p.date_croissance_prevue)}</td>
            <td>${escapeHtml(p.personne_plantation ?? '')}</td>
            <td>${escapeHtml(p.milieu_croissance ?? '')}</td>
            <td>${statutBadge}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-2" data-action="edit" data-id="${p.id}">Modifier</button>
                <button class="btn btn-sm btn-outline-danger" data-action="delete" data-id="${p.id}">Supprimer</button>
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

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR');
    }

    async function fetchGreenSpaces() {
        const res = await fetch('/green-spaces');
        if (!res.ok) throw new Error('Erreur lors du chargement des espaces verts');
        greenSpaces = await res.json();
        
        // Remplir les select
        const greenSpaceSelect = document.getElementById('plant-green-space');
        const filterSelect = document.getElementById('filterGreenSpace');
        
        greenSpaceSelect.innerHTML = '<option value="">Sélectionner un espace vert</option>';
        filterSelect.innerHTML = '<option value="">Tous les espaces</option>';
        
        greenSpaces.forEach(gs => {
            const option1 = document.createElement('option');
            option1.value = gs.id;
            option1.textContent = gs.name;
            greenSpaceSelect.appendChild(option1);
            
            const option2 = document.createElement('option');
            option2.value = gs.id;
            option2.textContent = gs.name;
            filterSelect.appendChild(option2);
        });
    }

    async function fetchAll() {
        const res = await fetch(baseUrl);
        if (!res.ok) throw new Error('Erreur lors du chargement');
        const data = await res.json();
        allRows = data;
        render(data);
    }

    function render(rows) {
        tbody.innerHTML = '';
        rows.forEach(p => tbody.appendChild(toRow(p)));
    }

    function filter() {
        const searchQ = searchInput.value.toLowerCase();
        const filterQ = filterGreenSpace.value;
        
        const rows = allRows.filter(p => {
            const matchesSearch = !searchQ || 
                (p.nom ?? '').toLowerCase().includes(searchQ) ||
                (p.personne_plantation ?? '').toLowerCase().includes(searchQ) ||
                (p.milieu_croissance ?? '').toLowerCase().includes(searchQ);
            
            const matchesFilter = !filterQ || p.green_space_id == filterQ;
            
            return matchesSearch && matchesFilter;
        });
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
        if (!res.ok) throw new Error('Erreur lors de la création');
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
        if (!res.ok) throw new Error('Erreur lors de la mise à jour');
        return res.json();
    }

    async function remove(id) {
        const res = await fetch(`${baseUrl}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!res.ok) throw new Error('Erreur lors de la suppression');
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
            const p = allRows.find(x => String(x.id) === String(id));
            if (!p) return;
            idEl.value = p.id;
            nomEl.value = p.nom ?? '';
            greenSpaceEl.value = p.green_space_id ?? '';
            datePlantationEl.value = p.date_plantation ?? '';
            dateCroissanceEl.value = p.date_croissance_prevue ?? '';
            personneEl.value = p.personne_plantation ?? '';
            milieuEl.value = p.milieu_croissance ?? '';
            submitBtn.textContent = 'Mettre à jour';
        } else if (action === 'delete') {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette plante ?')) return;
            try {
                await remove(id);
                await fetchAll();
                alert('Plante supprimée avec succès !');
            } catch (err) {
                alert(err.message);
            }
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const payload = {
            nom: nomEl.value.trim(),
            green_space_id: greenSpaceEl.value,
            date_plantation: datePlantationEl.value,
            date_croissance_prevue: dateCroissanceEl.value,
            personne_plantation: personneEl.value.trim(),
            milieu_croissance: milieuEl.value,
        };
        
        try {
            if (idEl.value) {
                await update(idEl.value, payload);
                alert('Plante mise à jour avec succès !');
            } else {
                await create(payload);
                alert('Plante ajoutée avec succès !');
            }
            resetForm();
            await fetchAll();
        } catch (err) {
            alert(err.message);
        }
    });

    resetBtn.addEventListener('click', resetForm);
    searchInput.addEventListener('input', filter);
    filterGreenSpace.addEventListener('change', filter);

    // Initialisation
    fetchGreenSpaces().then(() => fetchAll()).catch(err => alert(err.message));
})();
</script>
@endpush
