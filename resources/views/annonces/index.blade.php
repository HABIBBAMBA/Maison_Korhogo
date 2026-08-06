@extends('layouts.app')

@section('title', 'Annonces — ImmoPro')

@section('content')

<style>
    :root {
        --index-bg: #f4f5f7;
        --card-bg: #ffffff;
        --dark: #1a1a2e;
        --text: #3a3a4a;
        --text-muted: #8888a0;
        --teal: #0d9488;
        --teal-hover: #0f766e;
        --teal-light: #ccfbf1;
        --teal-bg: #f0fdfa;
        --vente-color: #2563eb;
        --vente-bg: #dbeafe;
        --location-color: #7c3aed;
        --location-bg: #ede9fe;
        --border: #e5e7eb;
        --input-bg: #fafafa;
        --radius: 16px;
        --radius-sm: 12px;
        --radius-xs: 8px;
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 4px 12px rgba(0, 0, 0, 0.04);
        --shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.1);
        --transition: 0.25s ease;
    }

    .index-page {
        background: var(--index-bg);
        min-height: 100vh;
        padding-bottom: 4rem;
    }

    .index-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    /* ═══════ Header ═══════ */
    .index-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .index-header h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .index-header h1 i {
        color: var(--teal);
        font-size: 1.3rem;
    }

    .results-count {
        background: var(--teal-light);
        color: var(--teal-hover);
        font-size: 0.82rem;
        font-weight: 700;
        padding: 0.4rem 0.9rem;
        border-radius: 50px;
    }

    /* ═══════ Filters ═══════ */
    .filters-bar {
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        flex: 1;
        min-width: 140px;
    }

    .filter-group label {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .filter-group input,
    .filter-group select {
        padding: 0.65rem 0.85rem;
        background: var(--input-bg);
        border: 2px solid transparent;
        border-radius: var(--radius-xs);
        font-size: 0.88rem;
        font-family: inherit;
        color: var(--dark);
        outline: none;
        transition: all var(--transition);
        width: 100%;
        box-sizing: border-box;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        background: white;
        border-color: var(--teal);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
    }

    .filter-group input::placeholder {
        color: #c0c0c0;
    }

    .filter-group select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' fill='%238888a0' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        padding-right: 2rem;
    }

    .filter-group-flex0 {
        flex: 0 0 auto;
        min-width: auto;
    }

    .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.65rem 1.25rem;
        background: var(--teal);
        color: white;
        border: none;
        border-radius: var(--radius-xs);
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all var(--transition);
        white-space: nowrap;
    }

    .btn-filter:hover {
        background: var(--teal-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
    }

    @media (max-width: 768px) {
        .filters-bar {
            gap: 0.75rem;
        }

        .filter-group {
            min-width: calc(50% - 0.5rem);
        }
    }

    @media (max-width: 480px) {
        .filter-group {
            min-width: 100%;
        }
    }

    /* ═══════ Grid ═══════ */
    .annonces-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1.25rem;
    }

    /* ═══════ Card ═══════ */
    .annonce-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        transition: all var(--transition);
        opacity: 0;
        transform: translateY(20px);
        animation: cardIn 0.45s ease forwards;
    }

    .annonce-card:nth-child(1) {
        animation-delay: 0.00s;
    }

    .annonce-card:nth-child(2) {
        animation-delay: 0.05s;
    }

    .annonce-card:nth-child(3) {
        animation-delay: 0.10s;
    }

    .annonce-card:nth-child(4) {
        animation-delay: 0.15s;
    }

    .annonce-card:nth-child(5) {
        animation-delay: 0.20s;
    }

    .annonce-card:nth-child(6) {
        animation-delay: 0.25s;
    }

    .annonce-card:nth-child(7) {
        animation-delay: 0.30s;
    }

    .annonce-card:nth-child(8) {
        animation-delay: 0.35s;
    }

    .annonce-card:nth-child(9) {
        animation-delay: 0.40s;
    }

    .annonce-card:nth-child(10) {
        animation-delay: 0.45s;
    }

    .annonce-card:nth-child(11) {
        animation-delay: 0.50s;
    }

    .annonce-card:nth-child(12) {
        animation-delay: 0.55s;
    }

    @keyframes cardIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .annonce-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
    }

    .annonce-card:hover .card-image img {
        transform: scale(1.06);
    }

    /* ─── Card Image ─── */
    .card-image {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: #e8e8e8;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    /* ─── Badges ─── */
    .card-badges {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        display: flex;
        gap: 0.4rem;
    }

    .badge {
        padding: 0.3rem 0.7rem;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        backdrop-filter: blur(6px);
    }

    .badge-vente {
        background: rgba(37, 99, 235, 0.85);
        color: white;
    }

    .badge-location {
        background: rgba(124, 58, 237, 0.85);
        color: white;
    }

    .badge-type {
        background: rgba(255, 255, 255, 0.85);
        color: var(--text);
    }

    /* ─── Photo count ─── */
    .card-images-count {
        position: absolute;
        bottom: 0.75rem;
        right: 0.75rem;
        background: rgba(0, 0, 0, 0.65);
        color: white;
        padding: 0.3rem 0.65rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        backdrop-filter: blur(4px);
    }

    /* ─── Card Body ─── */
    .card-body {
        padding: 1.1rem 1.25rem 1.35rem;
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
        flex: 1;
    }

    .card-price {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--teal);
    }

    .card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-location {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.82rem;
        color: var(--text-muted);
    }

    .card-location i {
        color: var(--teal);
        font-size: 0.8rem;
    }

    /* ─── Specs row ─── */
    .card-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
        padding-top: 0.65rem;
        border-top: 1px solid var(--border);
    }

    .card-spec {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text);
        background: var(--index-bg);
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
    }

    .card-spec i {
        color: var(--teal);
        font-size: 0.75rem;
    }

    /* ═══════ Pagination ═══════ */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2.5rem;
    }

    .pagination-wrapper nav {
        background: var(--card-bg);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow);
        padding: 0.4rem;
    }

    /* Style Laravel default pagination if needed */
    .pagination {
        display: flex;
        justify-content: center;
    }

    /* ═══════ Empty state ═══════ */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .empty-state i.empty-icon {
        font-size: 4rem;
        color: #d0d5dd;
        margin-bottom: 1.25rem;
        display: block;
    }

    .empty-state h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.92rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.7rem 1.4rem;
        background: var(--teal);
        color: white;
        border: none;
        border-radius: var(--radius-xs);
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        transition: all var(--transition);
    }

    .btn-reset:hover {
        background: var(--teal-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(13, 148, 136, 0.3);
    }
</style>

<div class="index-page">
    <div class="index-container">

        {{-- Header --}}
        <div class="index-header">
            <h1><i class="bi bi-grid-3x3-gap-fill"></i> Annonces</h1>
            <span class="results-count">
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
            <div class="filter-group filter-group-flex0">
                <label>&nbsp;</label>
                <button type="submit" class="btn-filter">
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
                            {{ $annonce->nombre_pieces }} pcs
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

        <div class="pagination-wrapper">
            {{ $annonces->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-search empty-icon"></i>
            <h3>Aucune annonce trouvée</h3>
            <p>Modifiez vos filtres ou revenez plus tard.</p>
            <a href="{{ route('annonces.index') }}" class="btn-reset">
                <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser les filtres
            </a>
        </div>
        @endif

    </div>
</div>
@endsection