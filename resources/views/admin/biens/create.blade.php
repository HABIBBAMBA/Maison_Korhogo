@extends('layouts.app')

@section('title', 'Nouveau bien — Admin')

@section('content')
<section style="max-width: 800px; margin: 0 auto; padding: 3rem 2rem;">

    <a href="{{ route('admin.biens.index') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
        <i class="bi bi-arrow-left"></i> Retour aux biens
    </a>

    <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 1rem 0 2rem;">
        <i class="bi bi-plus-lg" style="color: var(--teal);"></i> Nouveau bien immobilier
    </h1>

    @if(($errors ?? null) && $errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.biens.store') }}" method="POST" enctype="multipart/form-data" style="
        background: white; border-radius: 14px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    ">
        @csrf

        {{-- Informations principales --}}
        <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f3f4f6;">
            Informations principales
        </h3>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Titre *</label>
            <input type="text" name="titre" value="{{ old('titre') }}" required placeholder="Ex : Appartement 3 pièces centre-ville"
                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Type *</label>
                <select name="type_bien" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    @foreach($types as $type)
                    <option value="{{ $type }}" {{ old('type_bien') === $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Offre *</label>
                <select name="type_offre" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    <option value="vente" {{ old('type_offre', 'vente') === 'vente' ? 'selected' : '' }}>Vente</option>
                    <option value="location" {{ old('type_offre') === 'location' ? 'selected' : '' }}>Location</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Statut *</label>
                <select name="statut" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    @foreach($statuts as $statut)
                    <option value="{{ $statut }}" {{ old('statut') === $statut ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $statut)) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Prix (FCFA) *</label>
                <input type="number" name="prix" value="{{ old('prix') }}" required step="1" min="0" placeholder="150000"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Description</label>
            <textarea name="description" rows="4" placeholder="Description détaillée du bien..."
                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; resize: vertical;">{{ old('description') }}</textarea>
        </div>

        {{-- Caractéristiques --}}
        <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f3f4f6;">
            Caractéristiques
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Pièces</label>
                <input type="number" name="nombre_pieces" value="{{ old('nombre_pieces') }}" min="0"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        {{-- Localisation --}}
        <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f3f4f6;">
            Localisation
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Adresse</label>
                <input type="text" name="adresse" value="{{ old('adresse') }}"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Quartier</label>
                <input type="text" name="quartier" value="{{ old('quartier') }}"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        {{-- Association --}}
        <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f3f4f6;">
            Association
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Agence</label>
                <select name="id_agence"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    <option value="">— Aucune agence —</option>
                    @foreach($agences as $agence)
                    <option value="{{ $agence->id }}" {{ old('id_agence') == $agence->id ? 'selected' : '' }}>
                        {{ $agence->nom_agence }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Propriétaire</label>
                <select name="id_proprietaire"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    <option value="">— Aucun propriétaire —</option>
                    @foreach($proprietaires as $p)
                    <option value="{{ $p->id }}" {{ old('id_proprietaire') == $p->id ? 'selected' : '' }}>
                        {{ $p->nom }} {{ $p->prenom ?? '' }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Photos --}}
        <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f3f4f6;">
            Photos
        </h3>

        <div style="margin-bottom: 1.5rem;">
            <div id="uploadZone" style="
                border: 2px dashed #d1d5db; border-radius: 12px; padding: 2rem;
                text-align: center; cursor: pointer; transition: all .3s ease;
                background: #f9fafb; position: relative;
            ">
                <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #9ca3af; display: block; margin-bottom: 0.5rem;"></i>
                <p style="font-weight: 600; font-size: 0.9rem; color: #6b7280; margin-bottom: 0.25rem;">Cliquez ou glissez vos photos ici</p>
                <p style="font-size: 0.8rem; color: #9ca3af;">JPG, PNG, WEBP — 10 Mo max par photo</p>
                <input type="file" name="photos[]" id="photoInput" multiple accept="image/jpeg,image/png,image/webp" style="
                    position: absolute; inset: 0; opacity: 0; cursor: pointer;
                ">
            </div>
            <div id="previewGrid" style="
                display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 0.75rem; margin-top: 1rem;
            "></div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.biens.index') }}" class="btn btn-outline" style="font-size: 0.9rem;">Annuler</a>
            <button type="submit" class="btn btn-primary" style="font-size: 0.9rem;">
                <i class="bi bi-check-lg"></i> Créer le bien
            </button>
        </div>
    </form>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('photoInput');
    const previewGrid = document.getElementById('previewGrid');
    const uploadZone = document.getElementById('uploadZone');
    const selectedFiles = [];

    function addFiles(fileList) {
        const incoming = Array.from(fileList);
        for (const file of incoming) {
            if (selectedFiles.length >= 10) break;
            if (!/^image\/(jpeg|png|webp)$/.test(file.type)) continue;
            selectedFiles.push(file);
        }
        renderPreviews();
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        renderPreviews();
    }

    function renderPreviews() {
        previewGrid.innerHTML = '';
        selectedFiles.forEach(function(file, index) {
            const wrapper = document.createElement('div');
            wrapper.style.cssText = 'position:relative; aspect-ratio:1; border-radius:8px; overflow:hidden; border:2px solid #e5e7eb;';

            const img = document.createElement('img');
            img.alt = 'Photo ' + (index + 1);
            img.style.cssText = 'width:100%; height:100%; object-fit:cover;';

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = '<i class="bi bi-x"></i>';
            btn.style.cssText = 'position:absolute; top:4px; right:4px; width:22px; height:22px; background:rgba(0,0,0,0.55); color:white; border:none; border-radius:50%; cursor:pointer; font-size:0.7rem; display:grid; place-items:center;';
            btn.addEventListener('click', function() { removeFile(index); });

            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            previewGrid.appendChild(wrapper);

            const reader = new FileReader();
            reader.addEventListener('load', function(e) { img.src = e.target.result; });
            reader.readAsDataURL(file);
        });
    }

    if (photoInput) {
        photoInput.addEventListener('change', function() {
            addFiles(this.files);
            this.value = '';
        });
    }

    // Drag & Drop
    if (uploadZone) {
        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadZone.style.borderColor = 'var(--teal)';
            uploadZone.style.background = 'rgba(44, 110, 110, 0.04)';
        });
        uploadZone.addEventListener('dragleave', function() {
            uploadZone.style.borderColor = '#d1d5db';
            uploadZone.style.background = '#f9fafb';
        });
        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadZone.style.borderColor = '#d1d5db';
            uploadZone.style.background = '#f9fafb';
            addFiles(e.dataTransfer.files);
        });
    }

    // Synchroniser les fichiers vers l'input AVANT la soumission
    const form = photoInput?.closest('form');
    if (form) {
        form.addEventListener('submit', function() {
            if (selectedFiles.length === 0) return;
            const dt = new DataTransfer();
            selectedFiles.forEach(function(f) { dt.items.add(f); });
            photoInput.files = dt.files;
        });
    }
});
</script>
@endsection