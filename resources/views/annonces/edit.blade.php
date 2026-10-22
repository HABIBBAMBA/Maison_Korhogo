{{-- resources/views/annonces/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Modifier — ' . $annonce->titre)

@section('content')

<style>
    :root {
        --edit-bg: #f4f5f7;
        --card-bg: #ffffff;
        --dark: #1a1a2e;
        --text: #3a3a4a;
        --text-muted: #8888a0;
        --teal: #0d9488;
        --teal-hover: #0f766e;
        --teal-light: #ccfbf1;
        --teal-bg: #f0fdfa;
        --primary: #2563eb;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --border: #e5e7eb;
        --border-focus: #99f6e4;
        --input-bg: #fafafa;
        --radius: 16px;
        --radius-sm: 12px;
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 4px 12px rgba(0, 0, 0, 0.04);
        --shadow-focus: 0 0 0 3px rgba(13, 148, 136, 0.12);
        --transition: 0.2s ease;
    }

    .edit-page {
        background: var(--edit-bg);
        min-height: 100vh;
        padding-bottom: 5rem;
    }

    .edit-container {
        max-width: 820px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    /* ─── Header ─── */
    .edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .edit-header h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .edit-header h1 i {
        font-size: 1.3rem;
        color: var(--teal);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1.1rem;
        background: var(--card-bg);
        color: var(--text);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all var(--transition);
    }

    .btn-back:hover {
        background: var(--edit-bg);
        border-color: var(--text-muted);
        color: var(--dark);
    }

    /* ─── Form Cards ─── */
    .form-section {
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .form-section-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 800;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.75rem;
        padding-bottom: 0.85rem;
        border-bottom: 2px solid var(--edit-bg);
    }

    .form-section-title i {
        color: var(--teal);
        font-size: 1rem;
    }

    /* ─── Fields ─── */
    .field {
        margin-bottom: 1.35rem;
    }

    .field:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: block;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.45rem;
        letter-spacing: 0.01em;
    }

    .field-label .req {
        color: var(--danger);
        margin-left: 2px;
    }

    .field-input,
    .field-select,
    .field-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--input-bg);
        border: 2px solid transparent;
        border-radius: var(--radius-sm);
        font-size: 0.9rem;
        font-family: inherit;
        color: var(--dark);
        transition: all var(--transition);
        outline: none;
        box-sizing: border-box;
    }

    .field-input::placeholder,
    .field-textarea::placeholder {
        color: #c0c0c0;
    }

    .field-input:hover,
    .field-select:hover,
    .field-textarea:hover {
        background: #f5f5f5;
    }

    .field-input:focus,
    .field-select:focus,
    .field-textarea:focus {
        background: white;
        border-color: var(--teal);
        box-shadow: var(--shadow-focus);
    }

    .field-input.has-error,
    .field-select.has-error,
    .field-textarea.has-error {
        border-color: var(--danger);
        background: #fef2f2;
    }

    .field-input.has-error:focus,
    .field-textarea.has-error:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .field-textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.65;
    }

    .field-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%238888a0' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 0.4rem;
        font-size: 0.78rem;
        color: var(--danger);
        font-weight: 600;
    }

    .field-error::before {
        content: '!';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: var(--danger);
        color: white;
        font-size: 0.65rem;
        font-weight: 800;
        flex-shrink: 0;
    }

    /* ─── Row layout ─── */
    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .field-row.three {
        grid-template-columns: 1fr 1fr 1fr;
    }

    .field-row .field {
        margin-bottom: 0;
    }

    @media (max-width: 600px) {

        .field-row,
        .field-row.three {
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }
    }

    /* ─── Photos section ─── */
    .photos-grid {
        display: flex;
        gap: 0.65rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .photo-thumb {
        width: 100px;
        height: 78px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--border);
        transition: all var(--transition);
    }

    .photo-thumb:hover {
        border-color: var(--teal);
        transform: scale(1.05);
    }

    .photos-note {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.82rem;
        color: var(--text-muted);
        background: var(--teal-bg);
        padding: 0.65rem 0.9rem;
        border-radius: 10px;
        border-left: 3px solid var(--teal);
        margin-bottom: 1.25rem;
    }

    .photos-note i {
        color: var(--teal);
        font-size: 0.9rem;
    }

    .no-photos {
        font-size: 0.88rem;
        color: var(--text-muted);
        padding: 1.5rem 0;
        text-align: center;
    }

    /* ─── Upload zone ─── */
    .upload-zone {
        border: 2px dashed var(--border);
        border-radius: var(--radius-sm);
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all var(--transition);
        background: var(--input-bg);
    }

    .upload-zone:hover {
        border-color: var(--teal);
        background: var(--teal-bg);
    }

    .upload-zone i {
        font-size: 2.5rem;
        color: var(--teal);
        margin-bottom: 0.5rem;
        display: block;
    }

    .upload-zone p {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .upload-zone span {
        font-size: 0.78rem;
        color: var(--text-muted);
    }

    /* ─── Image previews ─── */
    .image-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-top: 0.75rem;
    }

    .image-preview {
        width: 100px;
        height: 78px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid var(--teal);
        box-shadow: 0 2px 8px rgba(13, 148, 136, 0.15);
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ─── Submit button ─── */
    .btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        padding: 1rem;
        background: var(--teal);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all var(--transition);
        box-shadow: 0 2px 10px rgba(13, 148, 136, 0.25);
        margin-top: 0.5rem;
    }

    .btn-submit:hover {
        background: var(--teal-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.35);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-submit i {
        font-size: 1.1rem;
    }

    /* ─── Animate entry ─── */
    .form-section {
        opacity: 0;
        transform: translateY(16px);
        animation: slideIn 0.4s ease forwards;
    }

    .form-section:nth-child(2) {
        animation-delay: 0.08s;
    }

    .form-section:nth-child(3) {
        animation-delay: 0.16s;
    }

    .form-section:nth-child(4) {
        animation-delay: 0.24s;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="edit-page">
    <div class="edit-container">

        {{-- Header --}}
        <div class="edit-header">
            <h1><i class="bi bi-pencil-square"></i> Modifier l'annonce</h1>
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <form method="POST" action="{{ route('annonces.update', $annonce) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ═══ Informations ═══ --}}
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-info-circle"></i> Informations
                </div>

                <div class="field">
                    <label class="field-label">Titre de l'annonce <span class="req">*</span></label>
                    <input type="text" name="titre"
                        class="field-input {{ $errors->has('titre') ? 'has-error' : '' }}"
                        value="{{ old('titre', $annonce->titre) }}"
                        placeholder="Ex : Villa moderne 4 chambres à Cocody">
                    @error('titre')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label class="field-label">Description <span class="req">*</span></label>
                    <textarea name="description"
                        class="field-textarea {{ $errors->has('description') ? 'has-error' : '' }}"
                        placeholder="Décrivez votre bien en détail...">{{ old('description', $annonce->description) }}</textarea>
                    @error('description')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                    <div class="field">
                        <label class="field-label">Type d'offre <span class="req">*</span></label>
                        <select name="type_offre" id="type_offre_select" class="field-select {{ $errors->has('type_offre') ? 'has-error' : '' }}">
                            <option value="location" {{ old('type_offre', $annonce->type_offre) == 'location' ? 'selected' : '' }}>Location classique (Bail mensuel)</option>
                            <option value="court_sejour" {{ old('type_offre', $annonce->type_offre) == 'court_sejour' ? 'selected' : '' }}>Court séjour (Résidence / Hôtel / Nuitée)</option>
                            <option value="vente" {{ old('type_offre', $annonce->type_offre) == 'vente' ? 'selected' : '' }}>Vente</option>
                        </select>
                        @error('type_offre')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="field-label">Type de bien <span class="req">*</span></label>
                        <select name="type_bien" id="type_bien_select" class="field-select {{ $errors->has('type_bien') ? 'has-error' : '' }}">
                            @php
                            $typesDispos = [
                                'residence_meublee' => ['label' => 'Résidence Meublée (Court séjour)', 'offres' => ['court_sejour', 'location']],
                                'chambre_hotel' => ['label' => 'Chambre d\'Hôtel / Auberge', 'offres' => ['court_sejour']],
                                'maison' => ['label' => 'Maison (Villa, Appartement)', 'offres' => ['location', 'vente']],
                                'terrain' => ['label' => 'Terrain', 'offres' => ['location', 'vente']],
                                'bureau' => ['label' => 'Bureau', 'offres' => ['location', 'vente']],
                                'magasin' => ['label' => 'Magasin', 'offres' => ['location', 'vente']],
                                'entrepot' => ['label' => 'Entrepôt', 'offres' => ['location', 'vente']],
                                'autre' => ['label' => 'Autre', 'offres' => ['location', 'vente']],
                            ];
                            $currentType = old('type_bien', $annonce->type_bien);
                            @endphp
                            @foreach($typesDispos as $val => $data)
                            <option value="{{ $val }}" data-offres="{{ implode(',', $data['offres']) }}" {{ $currentType == $val ? 'selected' : '' }}>
                                {{ $data['label'] }}
                            </option>
                            @endforeach
                            @if(!array_key_exists($currentType, $typesDispos) && $currentType)
                            <option value="{{ $currentType }}" selected>{{ ucfirst($currentType) }}</option>
                            @endif
                        </select>
                        @error('type_bien')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label class="field-label">Statut</label>
                        <select name="statut" class="field-select">
                            @foreach(['active','vendu','loue','inactive'] as $s)
                            <option value="{{ $s }}" {{ old('statut', $annonce->statut) == $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('loue', 'loué', $s)) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field"></div>
                </div>
            </div>

            {{-- ═══ Caractéristiques ═══ --}}
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-rulers"></i> Caractéristiques
                </div>

                <div class="field-row">
                    <div class="field">
                        <label class="field-label">Prix (FCFA) <span class="req">*</span></label>
                        <input type="number" name="prix"
                            class="field-input {{ $errors->has('prix') ? 'has-error' : '' }}"
                            value="{{ old('prix', $annonce->prix) }}"
                            placeholder="Ex : 75000000">
                        @error('prix')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="field-label">Superficie (m²)</label>
                        <input type="number" name="superficie" step="0.01"
                            class="field-input"
                            value="{{ old('superficie', $annonce->superficie) }}"
                            placeholder="Ex : 250">
                    </div>
                </div>

                <div class="field-row three">
                    <div class="field">
                        <label class="field-label">Pièces</label>
                        <input type="number" name="nombre_pieces"
                            class="field-input"
                            value="{{ old('nombre_pieces', $annonce->nombre_pieces) }}"
                            placeholder="0" min="0">
                    </div>
                    <div class="field">
                        <label class="field-label">Chambres</label>
                        <input type="number" name="nombre_chambres"
                            class="field-input"
                            value="{{ old('nombre_chambres', $annonce->nombre_chambres) }}"
                            placeholder="0" min="0">
                    </div>
                    <div class="field">
                        <label class="field-label">Salles de bain</label>
                        <input type="number" name="nombre_salles_bain"
                            class="field-input"
                            value="{{ old('nombre_salles_bain', $annonce->nombre_salles_bain) }}"
                            placeholder="0" min="0">
                    </div>
                    <div class="field">
                        <label class="field-label">Voyageurs max</label>
                        <input type="number" name="capacite_voyageurs"
                            class="field-input"
                            value="{{ old('capacite_voyageurs', $annonce->capacite_voyageurs) }}"
                            placeholder="Ex : 2" min="1">
                    </div>
                </div>
            </div>

            {{-- ═══ Localisation ═══ --}}
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-geo-alt"></i> Localisation
                </div>

                <div class="field">
                    <label class="field-label">Adresse</label>
                    <input type="text" name="adresse"
                        class="field-input"
                        value="{{ old('adresse', $annonce->adresse) }}"
                        placeholder="Ex : Rue des Jardins, Lot 12">
                </div>

                <div class="field">
                    <label class="field-label">Quartier</label>
                    <input type="text" name="quartier"
                        class="field-input"
                        value="{{ old('quartier', $annonce->quartier) }}"
                        placeholder="Ex : Cocody">
                </div>
            </div>
    </div>

    {{-- ═══ Photos ═══ --}}
    <div class="form-section">
        <div class="form-section-title">
            <i class="bi bi-images"></i> Photos
        </div>

        @if($annonce->images && count($annonce->images) > 0)
        <div class="photos-grid">
            @foreach($annonce->images as $img)
            <img src="{{ asset('storage/' . $img) }}" class="photo-thumb" alt="Photo annonce">
            @endforeach
        </div>
        <div class="photos-note">
            <i class="bi bi-info-circle-fill"></i>
            Si vous ajoutez de nouvelles photos, elles remplaceront toutes les photos actuelles.
        </div>
        @else
        <p class="no-photos">
            <i class="bi bi-image" style="font-size:2rem;display:block;margin-bottom:0.5rem;color:#d0d0d0;"></i>
            Aucune photo pour le moment
        </p>
        @endif

        <div class="field">
            <label class="field-label">Remplacer les photos (optionnel)</label>
            <div class="upload-zone" onclick="document.getElementById('images-input').click()">
                <i class="bi bi-cloud-arrow-up"></i>
                <p>Cliquez ici pour ajouter de nouvelles photos</p>
                <span>JPG, PNG, WEBP — Max 10 Mo chacune</span>
            </div>
            <input type="file" id="images-input" name="images[]" multiple accept="image/*"
                style="display:none;" onchange="previewImages(this)">
            <div id="image-previews" class="image-previews"></div>
        </div>
    </div>

    {{-- ═══ Submit ═══ --}}
    <button type="submit" class="btn-submit">
        <i class="bi bi-check-lg"></i> Enregistrer les modifications
    </button>
    </form>
</div>
</div>

@push('scripts')
<script>
    function previewImages(input) {
        const container = document.getElementById('image-previews');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'image-preview';
                    div.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const typeOffreSelect = document.getElementById('type_offre_select');
        const typeBienSelect = document.getElementById('type_bien_select');

        if (typeOffreSelect && typeBienSelect) {
            function filterTypeBienOptions() {
                const offre = typeOffreSelect.value;
                let currentSelectedValid = false;
                let firstValidOption = null;

                Array.from(typeBienSelect.options).forEach(opt => {
                    const offresStr = opt.getAttribute('data-offres');
                    if (!offresStr) return;
                    const allowed = offresStr.split(',').map(s => s.trim());
                    if (allowed.includes(offre)) {
                        opt.hidden = false;
                        opt.disabled = false;
                        if (!firstValidOption) firstValidOption = opt;
                        if (opt.value === typeBienSelect.value) currentSelectedValid = true;
                    } else {
                        opt.hidden = true;
                        opt.disabled = true;
                    }
                });

                if (!currentSelectedValid && firstValidOption) {
                    typeBienSelect.value = firstValidOption.value;
                }
            }

            typeOffreSelect.addEventListener('change', filterTypeBienOptions);
            filterTypeBienOptions();
        }
    });
</script>
@endpush
@endsection