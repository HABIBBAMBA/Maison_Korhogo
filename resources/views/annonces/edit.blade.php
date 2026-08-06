{{-- resources/views/annonces/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Modifier — ' . $annonce->titre)

@section('content')
<div class="page-container">

    <div class="page-header">
        <h1><i class="bi bi-pencil-square" style="color:var(--teal)"></i> Modifier l'annonce</h1>
        <a href="{{ route('annonces.show', $annonce) }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <form method="POST" action="{{ route('annonces.update', $annonce) }}" enctype="multipart/form-data" class="form-page">
        @csrf
        @method('PUT')

        {{-- ══════ Informations ══════ --}}
        <div class="form-card">
            <h3><i class="bi bi-info-circle"></i> Informations</h3>

            <div class="form-group">
                <label class="form-label">Titre de l'annonce *</label>
                <input type="text" name="titre"
                    class="form-input {{ $errors->has('titre') ? 'error' : '' }}"
                    value="{{ old('titre', $annonce->titre) }}">
                @error('titre')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Description *</label>
                <textarea name="description"
                    class="form-textarea {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $annonce->description) }}</textarea>
                @error('description')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Type de bien *</label>
                    <select name="type" class="form-select {{ $errors->has('type') ? 'error' : '' }}">
                        @foreach(['maison','appartement','terrain','bureau','commerce','entrepot'] as $t)
                        <option value="{{ $t }}" {{ old('type', $annonce->type) == $t ? 'selected' : '' }}>
                            {{ ucfirst($t) }}
                        </option>
                        @endforeach
                    </select>
                    @error('type')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie *</label>
                    <select name="categorie" class="form-select {{ $errors->has('categorie') ? 'error' : '' }}">
                        <option value="vente" {{ old('categorie', $annonce->categorie) == 'vente' ? 'selected' : '' }}>Vente</option>
                        <option value="location" {{ old('categorie', $annonce->categorie) == 'location' ? 'selected' : '' }}>Location</option>
                    </select>
                    @error('categorie')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Statut *</label>
                    <select name="statut" class="form-select">
                        @foreach(['active','vendu','loue','inactive'] as $s)
                        <option value="{{ $s }}" {{ old('statut', $annonce->statut) == $s ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('loue', 'loué', $s)) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group"></div>
            </div>
        </div>

        {{-- ══════ Caractéristiques ══════ --}}
        <div class="form-card">
            <h3><i class="bi bi-rulers"></i> Caractéristiques</h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Prix (FCFA) *</label>
                    <input type="number" name="prix"
                        class="form-input {{ $errors->has('prix') ? 'error' : '' }}"
                        value="{{ old('prix', $annonce->prix) }}">
                    @error('prix')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Superficie (m²)</label>
                    <input type="number" name="superficie" step="0.01"
                        class="form-input"
                        value="{{ old('superficie', $annonce->superficie) }}">
                </div>
            </div>

            <div class="form-row three">
                <div class="form-group">
                    <label class="form-label">Pièces</label>
                    <input type="number" name="nombre_pieces"
                        class="form-input"
                        value="{{ old('nombre_pieces', $annonce->nombre_pieces) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Chambres</label>
                    <input type="number" name="nombre_chambres"
                        class="form-input"
                        value="{{ old('nombre_chambres', $annonce->nombre_chambres) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Salles de bain</label>
                    <input type="number" name="nombre_salles_bain"
                        class="form-input"
                        value="{{ old('nombre_salles_bain', $annonce->nombre_salles_bain) }}">
                </div>
            </div>
        </div>

        {{-- ══════ Localisation ══════ --}}
        <div class="form-card">
            <h3><i class="bi bi-geo-alt"></i> Localisation</h3>

            <div class="form-group">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse"
                    class="form-input"
                    value="{{ old('adresse', $annonce->adresse) }}">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <input type="text" name="ville"
                        class="form-input"
                        value="{{ old('ville', $annonce->ville) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Quartier</label>
                    <input type="text" name="quartier"
                        class="form-input"
                        value="{{ old('quartier', $annonce->quartier) }}">
                </div>
            </div>
        </div>

        {{-- ══════ Photos ══════ --}}
        <div class="form-card">
            <h3><i class="bi bi-images"></i> Photos actuelles</h3>

            @if($annonce->images && count($annonce->images) > 0)
            <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-bottom:1rem;">
                @foreach($annonce->images as $img)
                <img src="{{ asset('storage/' . $img) }}"
                    style="width:100px;height:80px;object-fit:cover;border-radius:8px;"
                    alt="Photo annonce">
                @endforeach
            </div>
            <p style="font-size:0.85rem;color:#888;">
                <i class="bi bi-info-circle"></i>
                Si vous ajoutez de nouvelles photos, elles remplaceront toutes les photos actuelles.
            </p>
            @else
            <p style="font-size:0.88rem;color:#999;">Aucune photo pour le moment.</p>
            @endif

            <div style="margin-top:1rem;">
                <label class="form-label">Remplacer les photos (optionnel)</label>
                <div class="upload-zone" onclick="document.getElementById('images-input').click()">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <p>Cliquez ici pour ajouter de nouvelles photos</p>
                    <span>JPG, PNG, WEBP — Max 2 Mo chacune</span>
                </div>
                <input type="file" id="images-input" name="images[]" multiple accept="image/*"
                    style="display:none;" onchange="previewImages(this)">
                <div id="image-previews" class="image-previews"></div>
            </div>
        </div>

        {{-- ══════ Soumettre ══════ --}}
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:1rem;">
            <i class="bi bi-check-lg"></i> Enregistrer les modifications
        </button>
    </form>

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
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endpush
@endsection