@extends('layouts.app')

@section('title', 'Catalogue des Biens — ImmoPro Korhogo & Côte d\'Ivoire')

@section('content')

@php
    $query = \App\Models\Annonce::with('user')->where('statut', 'active');

    if (request('type_bien')) {
        if (request('type_bien') === 'maison') {
            $query->whereIn('type_bien', ['maison', 'appartement', 'villa']);
        } elseif (request('type_bien') === 'magasin') {
            $query->whereIn('type_bien', ['magasin', 'commerce']);
        } else {
            $query->where('type_bien', request('type_bien'));
        }
    }

    $biens = $query->latest()->paginate(9);
@endphp

<div class="biens-page">
    <div class="biens-container">

        {{-- En-tête --}}
        <header class="biens-header">
            <nav class="biens-breadcrumb" aria-label="Fil d'Ariane">
                <a href="{{ url('/') }}">Accueil</a>
                <span class="sep" aria-hidden="true">/</span>
                <span class="current">Catalogue des Biens</span>
            </nav>

            <div class="biens-header-content">
                <div>
                    <h1 class="biens-title">Biens Immobiliers d'Exception</h1>
                    <p class="biens-desc">Explorez notre inventaire de propriétés certifiées par nos géomètres et notaires partenaires.</p>
                </div>
                <div class="biens-counter tabular-nums">
                    <span>{{ $biens->total() }}</span> bien(s) vérifié(s)
                </div>
            </div>
        </header>

        {{-- Filtres horizontaux par type de bien --}}
        <div class="biens-filter-bar" role="tablist">
            <a href="{{ route('biens.index') }}"
                class="filter-pill {{ !request('type_bien') ? 'active' : '' }}">
                <span>Tous les biens</span>
            </a>
            <a href="{{ route('biens.index', ['type_bien' => 'maison']) }}"
                class="filter-pill {{ request('type_bien') == 'maison' ? 'active' : '' }}">
                <i class="bi bi-house" aria-hidden="true"></i>
                <span>Maisons & Résidences</span>
            </a>
            <a href="{{ route('biens.index', ['type_bien' => 'terrain']) }}"
                class="filter-pill {{ request('type_bien') == 'terrain' ? 'active' : '' }}">
                <i class="bi bi-geo" aria-hidden="true"></i>
                <span>Terrains</span>
            </a>
            <a href="{{ route('biens.index', ['type_bien' => 'bureau']) }}"
                class="filter-pill {{ request('type_bien') == 'bureau' ? 'active' : '' }}">
                <i class="bi bi-briefcase" aria-hidden="true"></i>
                <span>Bureaux</span>
            </a>
            <a href="{{ route('biens.index', ['type_bien' => 'magasin']) }}"
                class="filter-pill {{ request('type_bien') == 'magasin' ? 'active' : '' }}">
                <i class="bi bi-shop" aria-hidden="true"></i>
                <span>Magasins</span>
            </a>
            <a href="{{ route('biens.index', ['type_bien' => 'entrepot']) }}"
                class="filter-pill {{ request('type_bien') == 'entrepot' ? 'active' : '' }}">
                <i class="bi bi-building" aria-hidden="true"></i>
                <span>Entrepôts</span>
            </a>
        </div>

        {{-- Grille des biens --}}
        <div class="biens-grid">
            @forelse($biens as $bien)
            <article class="bien-card" onclick="window.location='{{ route('annonces.show', $bien->id) }}'">
                <div class="bien-media">
                    @if($bien->images && count($bien->images) > 0)
                        <img
                            src="{{ asset('storage/' . $bien->images[0]) }}"
                            alt="{{ $bien->titre }}"
                            class="bien-img"
                            loading="lazy">
                    @else
                        <div class="bien-img-placeholder" aria-hidden="true">
                            <i class="bi bi-building"></i>
                            <span>Document en cours</span>
                        </div>
                    @endif

                    <div class="bien-badges">
                        <span class="badge-solid {{ $bien->type_offre === 'location' ? 'badge-teal' : 'badge-navy' }}">
                            {{ strtoupper($bien->type_offre ?? 'VENTE') }}
                        </span>
                        <span class="badge-solid badge-neutral">
                            {{ ucfirst($bien->type_bien ?? 'Bien') }}
                        </span>
                    </div>

                    <div class="bien-price-tag tabular-nums">
                        {{ number_format($bien->prix, 0, ',', ' ') }} <span class="currency">FCFA</span>{{ $bien->type_offre === 'location' ? '/mois' : '' }}
                    </div>
                </div>

                <div class="bien-body">
                    <div class="bien-location">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <span>{{ $bien->quartier ?? 'Korhogo, Côte d\'Ivoire' }}</span>
                    </div>

                    <h2 class="bien-title">
                        <a href="{{ route('annonces.show', $bien->id) }}">
                            {{ $bien->titre }}
                        </a>
                    </h2>

                    <p class="bien-desc">
                        {{ Str::limit($bien->description, 110) }}
                    </p>

                    <div class="bien-specs">
                        @if($bien->superficie)
                        <div class="spec-cell">
                            <i class="bi bi-arrows-fullscreen spec-icon" aria-hidden="true"></i>
                            <span class="tabular-nums font-semibold">{{ $bien->superficie }}</span>
                            <span class="spec-dim">m²</span>
                        </div>
                        @endif

                        @if($bien->nombre_chambres)
                        <div class="spec-cell">
                            <i class="bi bi-door-open spec-icon" aria-hidden="true"></i>
                            <span class="tabular-nums font-semibold">{{ $bien->nombre_chambres }}</span>
                            <span class="spec-dim">chb</span>
                        </div>
                        @elseif($bien->nombre_pieces)
                        <div class="spec-cell">
                            <i class="bi bi-grid-1x2 spec-icon" aria-hidden="true"></i>
                            <span class="tabular-nums font-semibold">{{ $bien->nombre_pieces }}</span>
                            <span class="spec-dim">pcs</span>
                        </div>
                        @endif
                    </div>

                    <div class="bien-footer">
                        <span class="bien-ref tabular-nums">Réf. #{{ str_pad($bien->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <a href="{{ route('annonces.show', $bien->id) }}" class="btn btn-secondary btn-sm" onclick="event.stopPropagation();">
                            <span>Consulter</span>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="biens-empty-state">
                <div class="empty-icon-wrap" aria-hidden="true">
                    <i class="bi bi-inbox"></i>
                </div>
                <h3>Aucun bien disponible pour cette catégorie</h3>
                <p>Aucune offre ne correspond à ce filtre actuellement. Consultez toutes les opportunités disponibles.</p>
                <a href="{{ route('biens.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    <span>Afficher tous les biens</span>
                </a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($biens->hasPages())
        <div class="biens-pagination">
            {{ $biens->appends(request()->query())->links() }}
        </div>
        @endif

    </div>
</div>

@push('styles')
<style>
    .biens-page {
        background-color: var(--surface-sunken);
        min-height: calc(100vh - var(--nav-height));
        padding-block: 2.5rem 5rem;
    }

    .biens-container {
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    .biens-header {
        margin-bottom: 2rem;
    }

    .biens-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 0.75rem;
    }

    .biens-breadcrumb a {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .biens-breadcrumb .sep {
        color: var(--border-strong);
    }

    .biens-breadcrumb .current {
        color: var(--text-primary);
        font-weight: 600;
    }

    .biens-header-content {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .biens-title {
        font-size: clamp(1.75rem, 3.2vw, 2.35rem);
        color: var(--text-primary);
        letter-spacing: -0.02em;
    }

    .biens-desc {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-top: 0.35rem;
        max-width: 620px;
    }

    .biens-counter {
        padding: 0.45rem 0.95rem;
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-secondary);
        box-shadow: var(--shadow-raised);
    }

    .biens-counter span {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent-brand);
    }

    /* Filtres horizontaux */
    .biens-filter-bar {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        padding: 0.85rem 1.25rem;
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-raised);
        margin-bottom: 2.5rem;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 1rem;
        border-radius: var(--radius-full);
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-secondary);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        transition: all var(--duration-fast) var(--ease-out-expo);
    }

    .filter-pill:hover {
        background-color: var(--surface-raised);
        border-color: var(--border-strong);
        color: var(--text-primary);
    }

    .filter-pill.active {
        background-color: var(--accent-primary);
        border-color: var(--accent-primary);
        color: var(--surface-raised);
        box-shadow: inset 0 1px 0 0 oklch(1 0 0 / 0.15);
    }

    /* Grille */
    .biens-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
    }

    .bien-card {
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

    .bien-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-card);
        border-color: var(--border-default);
    }

    .bien-media {
        position: relative;
        height: 220px;
        background-color: var(--surface-dark-base);
        overflow: hidden;
        border-bottom: 1px solid var(--border-subtle);
    }

    .bien-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 400ms var(--ease-out-expo);
    }

    .bien-card:hover .bien-img {
        transform: scale(1.03);
    }

    .bien-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: var(--text-inverse-muted);
    }

    .bien-img-placeholder i {
        font-size: 2.5rem;
        color: var(--border-dark);
    }

    .bien-img-placeholder span {
        font-size: 0.75rem;
        font-family: 'JetBrains Mono', monospace;
    }

    .bien-badges {
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

    .badge-navy {
        background-color: var(--accent-primary);
        color: var(--surface-raised);
        border-color: var(--border-dark);
    }

    .badge-teal {
        background-color: var(--accent-brand);
        color: var(--surface-raised);
        border-color: oklch(0.35 0.07 195);
    }

    .badge-neutral {
        background-color: var(--surface-overlay);
        color: var(--text-primary);
        border-color: var(--border-default);
    }

    .bien-price-tag {
        position: absolute;
        bottom: 0.85rem;
        inset-inline-end: 0.85rem;
        background-color: var(--surface-dark-sunken);
        color: var(--text-inverse);
        padding: 0.35rem 0.85rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-dark);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.95rem;
        font-weight: 700;
        box-shadow: 0 2px 4px oklch(0 0 0 / 0.25);
    }

    .bien-price-tag .currency {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--accent-warm);
    }

    .bien-body {
        padding: 1.35rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .bien-location {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--accent-brand);
        margin-bottom: 0.35rem;
    }

    .bien-title {
        font-size: 1.125rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }

    .bien-title a {
        color: var(--text-primary);
    }

    .bien-title a:hover {
        color: var(--accent-brand);
    }

    .bien-desc {
        font-size: 0.84rem;
        color: var(--text-secondary);
        line-height: 1.55;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .bien-specs {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding-block: 0.85rem;
        border-top: 1px solid var(--border-subtle);
        margin-top: auto;
    }

    .spec-cell {
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
        font-size: 0.85rem;
        color: var(--text-primary);
        font-family: 'JetBrains Mono', monospace;
    }

    .spec-icon {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .spec-dim {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .bien-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.85rem;
        border-top: 1px solid var(--border-subtle);
    }

    .bien-ref {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .biens-empty-state {
        grid-column: 1 / -1;
        background-color: var(--surface-raised);
        border: 1px dashed var(--border-strong);
        border-radius: var(--radius-md);
        padding: 4.5rem 2rem;
        text-align: center;
        max-width: 600px;
        margin: 2rem auto;
    }

    .empty-icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: var(--text-muted);
        margin: 0 auto 1.25rem;
    }

    .biens-empty-state h3 {
        font-size: 1.3rem;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .biens-empty-state p {
        font-size: 0.92rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .biens-pagination {
        display: flex;
        justify-content: center;
        margin-top: 3.5rem;
    }

    @media (max-width: 640px) {
        .biens-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .biens-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@endsection