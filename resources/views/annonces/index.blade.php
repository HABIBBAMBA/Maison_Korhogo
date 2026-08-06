{{-- resources/views/annonces/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Annonces — ImmoPro')

@section('content')
<div class="page-container">

    {{-- En-tête --}}
    <div class="page-header">
        <h1><i class="bi bi-grid-3x3-gap-fill" style="color:var(--teal)"></i> Annonces</h1>
        <span style="color:#888;font-size:0.9rem;">
            {{ $annonces->total() }} bien(s) trouvé(s)
        </span>
    </div>

    {{-- Filtres --}}
    <form action="{{ route('annonces.index') }}" method="GET" class="filters-bar">
        <div class="filter-group" style="flex:2;">
            <label>Recherche</label>
            <input type="text" name="recherche" placeholder="Titre, ville, quartier..."
                value="{{ request('recherche') }}">
        </div>
        <div class="filter-group">
            <label>Type</label>
            <select name="type">
                <option value="">Tous</option>
                <option value="maison" {{ request('type') == 'maison' ? 'selected' : '' }}>Maison</option>
                <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                <option value="terrain" {{ request('type') == 'terrain' ? 'selected' : '' }}>Terrain</option>
                <option value="bureau" {{ request('type') == 'bureau' ? 'selected' : '' }}>Bureau</option>
                <option value="commerce" {{ request('type') == 'commerce' ? 'selected' : '' }}>Commerce</option>
                <option value="entrepot" {{ request('type') == 'entrepot' ? 'selected' : '' }}>Entrepôt</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Catégorie</label>
            <select name="categorie">
                <option value="">Toutes</option>
                <option value="vente" {{ request('categorie') == 'vente' ? 'selected' : '' }}>Vente</option>
                <option value="location" {{ request('categorie') == 'location' ? 'selected' : '' }}>Location</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Prix min</label>
            <input type="number" name="prix_min" placeholder="0" value="{{ request('prix_min') }}">
        </div>
        <div class="filter-group">
            <label>Prix max</label>
            <input type="number" name="prix_max" placeholder="∞" value="{{ request('prix_max') }}">
        </div>
        <div class="filter-group" style="flex:0;">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary btn-sm" style="width:100%;">
                <i class="bi bi-search"></i> Filtrer
            </button>
        </div>
    </form>

    {{-- Grille --}}
    @if($annonces->count() > 0)
    <div class="annonces-grid">
        @foreach($annonces as $annonce)
        <a href="{{ route('annonces.show', $annonce) }}" class="annonce-card">
            <div class="card-image">
                <img src="{{ $annonce->premiere_image }}" alt="{{ $annonce->titre }}">
                <div class="card-badges">
                    <span class="badge badge-{{ $annonce->categorie }}">
                        {{ ucfirst($annonce->categorie) }}
                    </span>
                    <span class="badge badge-type">
                        {{ ucfirst($annonce->type) }}
                    </span>
                </div>
                @if($annonce->nombre_images > 1)
                <div class="card-images-count">
                    <i class="bi bi-camera-fill"></i> {{ $annonce->nombre_images }}
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="card-price">{{ $annonce->prix_formate }}</div>
                <div class="card-title">{{ $annonce->titre }}</div>
                <div class="card-location">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $annonce->quartier ? $annonce->quartier . ', ' : '' }}{{ $annonce->ville ?? 'Non précisé' }}
                </div>
                <div class="card-specs">
                    @if($annonce->superficie)
                    <span class="card-spec">
                        <i class="bi bi-arrows-fullscreen"></i>
                        {{ number_format($annonce->superficie, 0, ',', '.') }} m²
                    </span>
                    @endif
                    @if($annonce->nombre_pieces)
                    <span class="card-spec">
                        <i class="bi bi-door-open"></i>
                        {{ $annonce->nombre_pieces }} pièces
                    </span>
                    @endif
                    @if($annonce->nombre_chambres)
                    <span class="card-spec">
                        <i class="bi bi-lamp"></i>
                        {{ $annonce->nombre_chambres }} ch.
                    </span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="pagination">
        {{ $annonces->links() }}
    </div>
    @else
    <div class="empty-state">
        <i class="bi bi-search"></i>
        <h3>Aucune annonce trouvée</h3>
        <p>Modifiez vos filtres ou revenez plus tard.</p>
        <a href="{{ route('annonces.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser les filtres
        </a>
    </div>
    @endif

</div>
@endsection