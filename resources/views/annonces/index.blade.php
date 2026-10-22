@extends('layouts.app')

@section('title', 'Toutes les Annonces Immobilières — ImmoPro Côte d\'Ivoire')

@section('content')

<div class="catalog-page">
    <div class="catalog-container">

        {{-- En-tête de page & Fil d'Ariane --}}
        <header class="catalog-header">
            <nav class="catalog-breadcrumb" aria-label="Fil d'Ariane">
                <a href="{{ url('/') }}">Accueil</a>
                <span class="breadcrumb-sep" aria-hidden="true">/</span>
                <span class="breadcrumb-current">Annonces</span>
            </nav>

            <div class="catalog-header-main">
                <div>
                    <h1 class="catalog-title">Catalogue des Annonces Immobilières</h1>
                    <p class="catalog-subtitle">Maisons vérifiées, villas contemporaines, parcelles titrées et locaux commerciaux en Côte d'Ivoire.</p>
                </div>
                <div class="catalog-count-badge">
                    <span class="count-number tabular-nums">{{ $annonces->total() }}</span>
                    <span class="count-label">bien(s) répertorié(s)</span>
                </div>
            </div>
        </header>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  BARRE DE FILTRAGE TECHNIQUE (SURFACE SOLIDE SURÉLEVÉE)              ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <form action="{{ route('annonces.index') }}" method="GET" class="filter-panel" role="search">
            {{-- Champ de recherche textuelle --}}
            <div class="filter-col filter-col-search">
                <label for="filter-recherche" class="filter-label">Recherche par mot-clé</label>
                <div class="filter-input-wrap">
                    <i class="bi bi-search filter-icon" aria-hidden="true"></i>
                    <input
                        type="text"
                        name="recherche"
                        id="filter-recherche"
                        class="filter-control with-icon"
                        placeholder="Quartier, ville, titre..."
                        value="{{ request('recherche') }}">
                </div>
            </div>

            {{-- Type de bien --}}
            <div class="filter-col">
                <label for="filter-type" class="filter-label">Type de bien</label>
                <div class="filter-select-wrap">
                    <select name="type_bien" id="filter-type" class="filter-control">
                        <option value="">Tous les types</option>
                        <option value="residence_meublee" {{ request('type_bien') == 'residence_meublee' ? 'selected' : '' }}>Résidence Meublée</option>
                        <option value="chambre_hotel" {{ request('type_bien') == 'chambre_hotel' ? 'selected' : '' }}>Chambre d'Hôtel / Auberge</option>
                        <option value="maison" {{ request('type_bien') == 'maison' ? 'selected' : '' }}>Maison (Villa, Appartement)</option>
                        <option value="terrain" {{ request('type_bien') == 'terrain' ? 'selected' : '' }}>Terrain</option>
                        <option value="bureau" {{ request('type_bien') == 'bureau' ? 'selected' : '' }}>Bureau</option>
                        <option value="magasin" {{ request('type_bien') == 'magasin' ? 'selected' : '' }}>Magasin</option>
                        <option value="entrepot" {{ request('type_bien') == 'entrepot' ? 'selected' : '' }}>Entrepôt</option>
                        <option value="autre" {{ request('type_bien') == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    <i class="bi bi-chevron-down select-arrow" aria-hidden="true"></i>
                </div>
            </div>

            {{-- Type d'offre / Transaction --}}
            <div class="filter-col">
                <label for="filter-offre" class="filter-label">Transaction</label>
                <div class="filter-select-wrap">
                    <select name="type_offre" id="filter-offre" class="filter-control">
                        <option value="">Toutes les offres</option>
                        <option value="vente" {{ request('type_offre') == 'vente' ? 'selected' : '' }}>Vente</option>
                        <option value="location" {{ request('type_offre') == 'location' ? 'selected' : '' }}>Location classique</option>
                        <option value="court_sejour" {{ request('type_offre') == 'court_sejour' ? 'selected' : '' }}>Court séjour (Résidences & Hôtels)</option>
                    </select>
                    <i class="bi bi-chevron-down select-arrow" aria-hidden="true"></i>
                </div>
            </div>

            {{-- Prix minimum --}}
            <div class="filter-col">
                <label for="filter-prix-min" class="filter-label">Prix min (FCFA)</label>
                <input
                    type="number"
                    name="prix_min"
                    id="filter-prix-min"
                    class="filter-control tabular-nums"
                    placeholder="0"
                    min="0"
                    step="50000"
                    value="{{ request('prix_min') }}">
            </div>

            {{-- Prix maximum --}}
            <div class="filter-col">
                <label for="filter-prix-max" class="filter-label">Prix max (FCFA)</label>
                <input
                    type="number"
                    name="prix_max"
                    id="filter-prix-max"
                    class="filter-control tabular-nums"
                    placeholder="Illimité"
                    min="0"
                    step="50000"
                    value="{{ request('prix_max') }}">
            </div>

            {{-- Boutons d'action --}}
            <div class="filter-actions-group">
                <button type="submit" class="btn btn-cta btn-filter-submit">
                    <i class="bi bi-funnel-fill" aria-hidden="true"></i>
                    <span>Filtrer</span>
                </button>
                @if(request()->hasAny(['recherche', 'type_bien', 'type_offre', 'prix_min', 'prix_max']))
                <a href="{{ route('annonces.index') }}" class="btn btn-secondary btn-filter-reset" title="Réinitialiser tous les filtres">
                    <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    <span>Effacer</span>
                </a>
                @endif
            </div>
        </form>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  GRILLE DES BIENS IMMOBILIERS                                       ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        @if($annonces->count() > 0)
        <div class="catalog-grid">
            @foreach($annonces as $annonce)
            <article class="catalog-card" onclick="window.location='{{ route('annonces.show', $annonce) }}'">
                {{-- Cadre média 16:10 --}}
                <div class="catalog-card-media">
                    @if($annonce->premiere_image)
                        <img
                            src="{{ $annonce->premiere_image }}"
                            alt="{{ $annonce->titre }}"
                            class="catalog-img"
                            loading="lazy">
                    @elseif($annonce->images && count($annonce->images) > 0)
                        <img
                            src="{{ asset('storage/' . $annonce->images[0]) }}"
                            alt="{{ $annonce->titre }}"
                            class="catalog-img"
                            loading="lazy">
                    @else
                        <div class="catalog-placeholder" aria-hidden="true">
                            <i class="bi bi-building"></i>
                            <span>Visuel non fourni</span>
                        </div>
                    @endif

                    {{-- Badges matériels solides --}}
                    <div class="catalog-badges-wrap">
                        <span class="badge-solid {{ $annonce->isCourtSejour() ? 'badge-court-sejour' : ($annonce->type_offre === 'vente' ? 'badge-vente' : 'badge-location') }}">
                            {{ $annonce->isCourtSejour() ? 'COURT SÉJOUR' : strtoupper($annonce->type_offre ?? 'VENTE') }}
                        </span>
                        <span class="badge-solid badge-neutral">
                            {{ $annonce->type_bien_label ?? ucfirst($annonce->type_bien ?? 'Bien') }}
                        </span>
                    </div>

                    {{-- Compteur de photos --}}
                    @if($annonce->images && count($annonce->images) > 1)
                    <div class="catalog-photos-count tabular-nums">
                        <i class="bi bi-camera-fill" aria-hidden="true"></i>
                        <span>{{ count($annonce->images) }}</span>
                    </div>
                    @endif

                    {{-- Prix solide tabulaire --}}
                    <div class="catalog-price-tag tabular-nums">
                        {{ number_format($annonce->prix, 0, ',', ' ') }} <span class="currency">FCFA</span>{{ $annonce->isCourtSejour() ? '/nuit' : ($annonce->type_offre === 'location' ? '/mois' : '') }}
                    </div>
                </div>

                {{-- Corps de la carte --}}
                <div class="catalog-card-body">
                    <div class="catalog-card-location">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <span>{{ $annonce->quartier ?? $annonce->adresse ?? 'Korhogo, Côte d\'Ivoire' }}</span>
                    </div>

                    <h2 class="catalog-card-title">
                        <a href="{{ route('annonces.show', $annonce) }}">
                            {{ $annonce->titre }}
                        </a>
                    </h2>

                    <p class="catalog-card-desc">
                        {{ Str::limit($annonce->description, 115) }}
                    </p>

                    {{-- Spécifications techniques tabulaires --}}
                    <div class="catalog-specs-row">
                        @if($annonce->superficie)
                        <div class="spec-item" title="Superficie">
                            <i class="bi bi-arrows-fullscreen spec-item-icon" aria-hidden="true"></i>
                            <span class="tabular-nums">{{ number_format($annonce->superficie, 0, ',', ' ') }}</span>
                            <span class="spec-unit">m²</span>
                        </div>
                        @endif

                        @if($annonce->nombre_chambres)
                        <div class="spec-item" title="Nombre de chambres">
                            <i class="bi bi-door-open spec-item-icon" aria-hidden="true"></i>
                            <span class="tabular-nums">{{ $annonce->nombre_chambres }}</span>
                            <span class="spec-unit">chb</span>
                        </div>
                        @endif

                        @if($annonce->nombre_pieces)
                        <div class="spec-item" title="Pièces totales">
                            <i class="bi bi-grid-1x2 spec-item-icon" aria-hidden="true"></i>
                            <span class="tabular-nums">{{ $annonce->nombre_pieces }}</span>
                            <span class="spec-unit">pcs</span>
                        </div>
                        @endif
                    </div>

                    {{-- Pied de carte --}}
                    <div class="catalog-card-footer">
                        <span class="catalog-date tabular-nums">
                            <i class="bi bi-clock" aria-hidden="true"></i>
                            {{ $annonce->created_at ? $annonce->created_at->diffForHumans() : 'Récemment' }}
                        </span>

                        <a href="{{ route('annonces.show', $annonce) }}" class="btn btn-secondary btn-sm" onclick="event.stopPropagation();">
                            <span>Détails</span>
                            <i class="bi bi-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination tabulaire --}}
        <div class="catalog-pagination-wrap">
            {{ $annonces->links() }}
        </div>

        @else
        {{-- État vide structuré conforme aux 8 états obligatoires --}}
        <div class="empty-results-box" role="status">
            <div class="empty-results-icon" aria-hidden="true">
                <i class="bi bi-search"></i>
            </div>
            <h3 class="empty-results-title">Aucun bien ne correspond à ces critères</h3>
            <p class="empty-results-desc">
                Essayez d'ajuster votre budget maximal, de sélectionner un quartier plus large ou d'effacer les filtres actuels.
            </p>
            <div class="empty-results-actions">
                <a href="{{ route('annonces.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    <span>Réinitialiser les critères</span>
                </a>
                @auth
                    @if(auth()->user()->peutPublierAnnonce())
                    <a href="{{ route('annonces.create') }}" class="btn btn-secondary">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        <span>Publier un bien similaire</span>
                    </a>
                    @endif
                @else
                    <a href="{{ route('annonces.create') }}" class="btn btn-secondary">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        <span>Publier un bien similaire</span>
                    </a>
                @endauth
            </div>
        </div>
        @endif

    </div>
</div>

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES CATALOGUE (STANDARDS SKILL_DESIGN, ZÉRO DÉGRADÉ)             ║
       ╚══════════════════════════════════════════════════════════════════════╝ */
    .catalog-page {
        background-color: var(--surface-sunken);
        min-height: calc(100vh - var(--nav-height));
        padding-block: 2.5rem 5rem;
    }

    .catalog-container {
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    /* En-tête */
    .catalog-header {
        margin-bottom: 2rem;
    }

    .catalog-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 0.75rem;
    }

    .catalog-breadcrumb a {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .catalog-breadcrumb a:hover {
        color: var(--accent-brand);
    }

    .breadcrumb-sep {
        color: var(--border-strong);
    }

    .breadcrumb-current {
        color: var(--text-primary);
        font-weight: 600;
    }

    .catalog-header-main {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .catalog-title {
        font-size: clamp(1.75rem, 3.2vw, 2.35rem);
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .catalog-subtitle {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-top: 0.35rem;
        max-width: 650px;
    }

    .catalog-count-badge {
        display: flex;
        align-items: baseline;
        gap: 0.4rem;
        padding: 0.45rem 0.95rem;
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-raised);
    }

    .count-number {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--accent-brand);
    }

    .count-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Panneau de filtres solide */
    .filter-panel {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-raised);
        padding: 1.25rem;
        margin-bottom: 2.25rem;
        display: grid;
        grid-template-columns: 2fr 1.3fr 1.2fr 1.1fr 1.1fr auto;
        gap: 0.85rem;
        align-items: flex-end;
    }

    .filter-col {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .filter-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-secondary);
    }

    .filter-control {
        width: 100%;
        height: 42px;
        padding: 0.5rem 0.85rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        font-family: inherit;
        font-size: 0.875rem;
        color: var(--text-primary);
        transition: border-color var(--duration-fast) var(--ease-out-expo),
                    background-color var(--duration-fast) var(--ease-out-expo),
                    box-shadow var(--duration-fast) var(--ease-out-expo);
    }

    .filter-control:hover {
        border-color: var(--border-strong);
    }

    .filter-control:focus {
        outline: none;
        background-color: var(--surface-raised);
        border-color: var(--accent-brand);
        box-shadow: 0 0 0 3px oklch(0.460 0.075 195 / 0.15);
    }

    .filter-input-wrap,
    .filter-select-wrap {
        position: relative;
    }

    .filter-input-wrap .filter-icon {
        position: absolute;
        inset-inline-start: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.85rem;
        color: var(--text-muted);
        pointer-events: none;
    }

    .filter-control.with-icon {
        padding-inline-start: 2.25rem;
    }

    .filter-select-wrap select {
        appearance: none;
        -webkit-appearance: none;
        padding-inline-end: 2rem;
        cursor: pointer;
    }

    .filter-select-wrap .select-arrow {
        position: absolute;
        inset-inline-end: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.75rem;
        color: var(--text-muted);
        pointer-events: none;
    }

    .filter-actions-group {
        display: flex;
        gap: 0.5rem;
    }

    .btn-filter-submit,
    .btn-filter-reset {
        height: 42px;
    }

    /* Grille de cartes */
    .catalog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.75rem;
    }

    .catalog-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-raised);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform var(--duration-base) var(--ease-out-expo),
                    box-shadow var(--duration-base) var(--ease-out-expo),
                    border-color var(--duration-base) var(--ease-out-expo);
    }

    .catalog-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-card);
        border-color: var(--border-default);
    }

    .catalog-card-media {
        position: relative;
        height: 220px;
        background-color: var(--surface-dark-base);
        overflow: hidden;
        border-bottom: 1px solid var(--border-subtle);
    }

    .catalog-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 400ms var(--ease-out-expo);
    }

    .catalog-card:hover .catalog-img {
        transform: scale(1.03);
    }

    .catalog-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: var(--text-inverse-muted);
    }

    .catalog-placeholder i {
        font-size: 2.5rem;
        color: var(--border-dark);
    }

    .catalog-placeholder span {
        font-size: 0.75rem;
        font-family: 'JetBrains Mono', monospace;
    }

    .catalog-badges-wrap {
        position: absolute;
        top: 0.85rem;
        inset-inline-start: 0.85rem;
        display: flex;
        gap: 0.4rem;
        z-index: 2;
    }

    .badge-solid {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.25rem 0.65rem;
        border-radius: var(--radius-xs);
        border: 1px solid transparent;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .badge-vente {
        background-color: var(--color-primary);
        color: #ffffff;
        border-color: var(--color-primary);
    }

    .badge-location {
        background-color: var(--color-secondary);
        color: #ffffff;
        border-color: var(--color-secondary);
    }

    .badge-court-sejour {
        background-color: var(--color-cta);
        color: #ffffff;
        border-color: var(--color-cta);
    }

    .badge-neutral {
        background-color: #ffffff;
        color: var(--color-text-main);
        border-color: var(--border-default);
    }

    .catalog-photos-count {
        position: absolute;
        top: 0.85rem;
        inset-inline-end: 0.85rem;
        background-color: var(--surface-dark-base);
        color: #ffffff;
        padding: 0.25rem 0.6rem;
        border-radius: var(--radius-xs);
        border: 1px solid var(--border-dark);
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        z-index: 2;
    }

    .catalog-price-tag {
        position: absolute;
        bottom: 0.85rem;
        inset-inline-end: 0.85rem;
        background-color: var(--surface-dark-base);
        color: #ffffff;
        padding: 0.35rem 0.85rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-dark);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.95rem;
        font-weight: 700;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
    }

    .catalog-price-tag .currency {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--color-cta);
    }

    /* Corps */
    .catalog-card-body {
        padding: 1.35rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .catalog-card-location {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--color-secondary);
        margin-bottom: 0.35rem;
    }

    .catalog-card-title {
        font-size: 1.125rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }

    .catalog-card-title a {
        color: var(--text-primary);
    }

    .catalog-card-title a:hover {
        color: var(--color-cta);
    }

    .catalog-card-desc {
        font-size: 0.84rem;
        color: var(--text-secondary);
        line-height: 1.55;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .catalog-specs-row {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding-block: 0.85rem;
        border-top: 1px solid var(--border-subtle);
        margin-top: auto;
    }

    .spec-item {
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
        font-size: 0.85rem;
        color: var(--text-primary);
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
    }

    .spec-item-icon {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .spec-unit {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .catalog-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.85rem;
        border-top: 1px solid var(--border-subtle);
    }

    .catalog-date {
        font-size: 0.78rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* Pagination */
    .catalog-pagination-wrap {
        display: flex;
        justify-content: center;
        margin-top: 3.5rem;
    }

    /* État vide */
    .empty-results-box {
        background-color: var(--surface-raised);
        border: 1px dashed var(--border-strong);
        border-radius: var(--radius-md);
        padding: 4.5rem 2rem;
        text-align: center;
        max-width: 620px;
        margin: 2rem auto;
    }

    .empty-results-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: var(--text-muted);
        margin: 0 auto 1.5rem;
    }

    .empty-results-title {
        font-size: 1.35rem;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-results-desc {
        font-size: 0.92rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.75rem;
    }

    .empty-results-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .filter-panel {
            grid-template-columns: 1fr 1fr;
        }

        .filter-col-search {
            grid-column: 1 / -1;
        }

        .filter-actions-group {
            grid-column: 1 / -1;
        }

        .btn-filter-submit,
        .btn-filter-reset {
            flex: 1;
        }
    }

    @media (max-width: 640px) {
        .filter-panel {
            grid-template-columns: 1fr;
        }

        .catalog-header-main {
            flex-direction: column;
            align-items: flex-start;
        }

        .catalog-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@endsection