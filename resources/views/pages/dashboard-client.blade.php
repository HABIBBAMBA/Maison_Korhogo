@extends('layouts.app')

@section('title', 'Espace Client — ImmoPro')

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  TABLEAU DE BORD CLIENT — CONCEPTION HAUT DE GAMME (SKILL_DESIGN)    ║
       ║  RÈGLE STRICTE : ZÉRO DÉGRADÉ — SURFACES SOLIDES CALIBRÉES           ║
       ║  Tokens officiels : #F8F9FA, #1B3A5C, #5A6B7B, #E8734A, #222831      ║
       ╚══════════════════════════════════════════════════════════════════════╝ */

    .client-dash-wrapper {
        max-width: 1240px;
        margin: 0 auto;
        padding: 2.25rem clamp(1rem, 3vw, 2.5rem) 4.5rem;
    }

    /* Fil d'Ariane */
    .dash-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }

    .dash-breadcrumb a {
        color: var(--text-secondary);
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        transition: color var(--duration-fast) var(--ease-out);
    }

    .dash-breadcrumb a:hover {
        color: var(--primary);
    }

    .dash-breadcrumb .sep {
        color: var(--border-strong);
        font-size: 0.75rem;
    }

    .dash-breadcrumb .current {
        color: var(--text-primary);
        font-weight: 600;
    }

    /* En-tête Client */
    .dash-header {
        background-color: var(--surface-base);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-lg);
        padding: 1.75rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        box-shadow: var(--shadow-raised);
    }

    .dash-header-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .dash-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        align-self: flex-start;
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background-color: #F0F3F6;
        color: var(--primary);
        border: 1px solid var(--border-default);
    }

    .dash-role-badge i {
        font-size: 0.85rem;
        color: var(--accent-cta);
    }

    .dash-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        color: var(--primary);
        line-height: 1.2;
        letter-spacing: -0.02em;
        margin: 0;
    }

    .dash-title em {
        font-style: normal;
        color: var(--accent-cta);
    }

    .dash-subtitle {
        color: var(--secondary);
        font-size: 0.9375rem;
        margin: 0;
        max-width: 620px;
        line-height: 1.5;
    }

    .dash-header-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-shrink: 0;
    }

    /* Barre de navigation interne (Tabs Client) */
    .dash-tabs {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem;
        background-color: var(--surface-base);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-full);
        margin-bottom: 2rem;
        overflow-x: auto;
        box-shadow: var(--shadow-raised);
    }

    .dash-tab-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: var(--radius-full);
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--secondary);
        text-decoration: none;
        white-space: nowrap;
        transition: background-color var(--duration-fast) var(--ease-out),
                    color var(--duration-fast) var(--ease-out);
    }

    .dash-tab-link:hover {
        background-color: var(--surface-sunken);
        color: var(--primary);
    }

    .dash-tab-link.active {
        background-color: var(--primary);
        color: #FFFFFF;
    }

    /* Grille de KPIs Client */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .kpi-card {
        background-color: var(--surface-base);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 1.25rem 1.5rem;
        box-shadow: var(--shadow-raised);
        display: flex;
        flex-direction: column;
        transition: transform var(--duration-fast) var(--ease-out),
                    border-color var(--duration-fast) var(--ease-out);
    }

    .kpi-card:hover {
        transform: translateY(-2px);
        border-color: var(--border-strong);
    }

    .kpi-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .kpi-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--primary);
    }

    .kpi-icon.cta {
        color: var(--accent-cta);
        background-color: #FFF7ED;
        border-color: #FFEDD5;
    }

    .kpi-value {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1.1;
        margin-bottom: 0.25rem;
    }

    .kpi-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.2rem;
    }

    .kpi-subtext {
        font-size: 0.75rem;
        color: var(--secondary);
    }

    /* Hub de Catégories de Recherche */
    .category-hub-section {
        margin-bottom: 2rem;
    }

    .section-headline-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .section-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--accent-cta);
        font-size: 1.1rem;
    }

    .category-hub-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .category-tile {
        background-color: var(--surface-base);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-md);
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        text-decoration: none;
        box-shadow: var(--shadow-raised);
        transition: transform var(--duration-fast) var(--ease-out),
                    border-color var(--duration-fast) var(--ease-out),
                    background-color var(--duration-fast) var(--ease-out);
    }

    .category-tile:hover {
        transform: translateY(-2px);
        border-color: var(--primary);
        background-color: #FFFFFF;
    }

    .category-tile-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .category-tile-title {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        display: block;
    }

    .category-tile-desc {
        font-size: 0.75rem;
        color: var(--secondary);
        display: block;
        margin-top: 0.15rem;
    }

    /* Disposition principale 2 colonnes */
    .dash-main-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 1.75rem;
        align-items: start;
        margin-bottom: 2rem;
    }

    /* Carte Générique */
    .dash-card {
        background-color: var(--surface-base);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-raised);
        overflow: hidden;
    }

    .dash-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-subtle);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dash-card-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .dash-card-title i {
        color: var(--accent-cta);
    }

    .dash-card-link {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        transition: color var(--duration-fast) var(--ease-out);
    }

    .dash-card-link:hover {
        color: var(--accent-cta);
    }

    .dash-card-body {
        padding: 1.25rem 1.5rem;
    }

    /* Liste des Annonces Recommandées */
    .recommended-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .recommended-item {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 0.875rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        transition: transform var(--duration-fast) var(--ease-out),
                    border-color var(--duration-fast) var(--ease-out),
                    background-color var(--duration-fast) var(--ease-out);
    }

    .recommended-item:hover {
        transform: translateY(-1px);
        border-color: var(--border-strong);
        background-color: #FFFFFF;
    }

    .recommended-thumb-wrapper {
        width: 100px;
        height: 75px;
        border-radius: var(--radius-sm);
        overflow: hidden;
        background-color: var(--border-default);
        flex-shrink: 0;
        position: relative;
    }

    .recommended-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .offer-badge {
        position: absolute;
        top: 4px;
        left: 4px;
        padding: 0.15rem 0.45rem;
        border-radius: 4px;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #FFFFFF;
        background-color: var(--primary);
    }

    .offer-badge.vente {
        background-color: var(--accent-cta);
    }

    .recommended-content {
        flex: 1;
        min-width: 0;
    }

    .recommended-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.25rem;
    }

    .recommended-location {
        font-size: 0.75rem;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-bottom: 0.35rem;
    }

    .recommended-price {
        font-size: 0.9375rem;
        font-weight: 800;
        color: var(--primary);
    }

    .btn-view-property {
        padding: 0.45rem 0.875rem;
        font-size: 0.78125rem;
        font-weight: 600;
        border-radius: var(--radius-sm);
        background-color: var(--surface-base);
        border: 1px solid var(--border-default);
        color: var(--primary);
        text-decoration: none;
        flex-shrink: 0;
        transition: background-color var(--duration-fast) var(--ease-out),
                    border-color var(--duration-fast) var(--ease-out);
    }

    .btn-view-property:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        color: #FFFFFF;
    }

    /* Liste des Prises de Contact (Colonne Droite) */
    .requests-list {
        display: flex;
        flex-direction: column;
        gap: 0.875rem;
    }

    .request-card {
        padding: 0.875rem 1rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .request-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.6875rem;
        color: var(--text-muted);
    }

    .request-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.15rem 0.5rem;
        border-radius: var(--radius-full);
        font-size: 0.6875rem;
        font-weight: 600;
        background-color: var(--status-success-bg);
        color: var(--status-success-text);
        border: 1px solid var(--status-success-border);
    }

    .request-message-snippet {
        font-size: 0.8125rem;
        color: var(--text-secondary);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .empty-state-box {
        text-align: center;
        padding: 2rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .empty-state-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--secondary);
        margin-bottom: 0.875rem;
    }

    .empty-state-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.35rem;
    }

    .empty-state-desc {
        font-size: 0.8125rem;
        color: var(--secondary);
        max-width: 280px;
        line-height: 1.45;
        margin-bottom: 1rem;
    }

    /* Carte d'assistance personnalisée */
    .concierge-card {
        margin-top: 1.5rem;
        background-color: var(--surface-dark-base);
        border: 1px solid var(--border-dark);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        color: #FFFFFF;
        box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.1), var(--shadow-raised);
    }

    .concierge-eyebrow {
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--accent-cta);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .concierge-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: #FFFFFF;
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }

    .concierge-desc {
        font-size: 0.8125rem;
        color: var(--text-inverse-muted);
        line-height: 1.5;
        margin-bottom: 1.25rem;
    }

    .btn-concierge {
        width: 100%;
        padding: 0.625rem 1rem;
        border-radius: var(--radius-sm);
        background-color: var(--accent-cta);
        border: 1px solid var(--accent-cta);
        color: #FFFFFF;
        font-size: 0.8125rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.25);
        transition: background-color var(--duration-fast) var(--ease-out),
                    border-color var(--duration-fast) var(--ease-out);
    }

    .btn-concierge:hover {
        background-color: var(--accent-cta-hover);
        border-color: var(--accent-cta-hover);
        color: #FFFFFF;
    }

    /* ═══════════════════════════════════════════
       RESPONSIVE DESIGN (GRILLE 2X)
       ═══════════════════════════════════════════ */
    @media (max-width: 1024px) {
        .kpi-grid,
        .category-hub-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dash-main-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dash-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.25rem;
        }

        .dash-header-actions {
            width: 100%;
            flex-direction: column;
        }

        .dash-header-actions .btn {
            width: 100%;
            justify-content: center;
        }

        .kpi-grid,
        .category-hub-grid {
            grid-template-columns: 1fr;
        }

        .recommended-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .recommended-thumb-wrapper {
            width: 100%;
            height: 140px;
        }

        .btn-view-property {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="client-dash-wrapper">

    {{-- Fil d'Ariane --}}
    <nav class="dash-breadcrumb" aria-label="Fil d'Ariane">
        <a href="{{ route('home') }}">
            <i class="bi bi-house-door" aria-hidden="true"></i>
            <span>Accueil</span>
        </a>
        <span class="sep" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
        <span class="current">Espace Client</span>
    </nav>

    {{-- En-tête Client Personnalisé --}}
    <header class="dash-header">
        <div class="dash-header-info">
            <p class="dash-role-badge">
                <i class="bi bi-person-check-fill" aria-hidden="true"></i>
                <span>Espace Client / Acquéreur</span>
            </p>
            <h1 class="dash-title">
                Bienvenue sur votre espace, <em>{{ $user->name }}</em>
            </h1>
            <p class="dash-subtitle">
                Suivez vos démarches, découvrez en exclusivité les nouveaux biens certifiés à Korhogo et explorez le catalogue selon vos préférences.
            </p>
        </div>

        <div class="dash-header-actions">
            <a href="{{ route('annonces.index') }}" class="btn btn-cta">
                <i class="bi bi-search" aria-hidden="true"></i>
                <span>Explorer les annonces</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
                <i class="bi bi-person-gear" aria-hidden="true"></i>
                <span>Mon Profil</span>
            </a>
        </div>
    </header>

    {{-- Onglets de Navigation Client --}}
    <nav class="dash-tabs" aria-label="Navigation client">
        <a href="{{ route('dashboard') }}" class="dash-tab-link active">
            <i class="bi bi-grid-fill" aria-hidden="true"></i>
            <span>Vue d'ensemble</span>
        </a>
        <a href="{{ route('annonces.index') }}" class="dash-tab-link">
            <i class="bi bi-building" aria-hidden="true"></i>
            <span>Tout le catalogue</span>
        </a>
        <a href="{{ route('annonces.index', ['type_offre' => 'court_sejour']) }}" class="dash-tab-link">
            <i class="bi bi-moon-stars-fill" aria-hidden="true"></i>
            <span>Hôtels &amp; Résidences</span>
        </a>
        <a href="{{ route('annonces.index', ['type_offre' => 'location']) }}" class="dash-tab-link">
            <i class="bi bi-key" aria-hidden="true"></i>
            <span>Locations</span>
        </a>
        <a href="{{ route('annonces.index', ['type_offre' => 'vente']) }}" class="dash-tab-link">
            <i class="bi bi-tag" aria-hidden="true"></i>
            <span>Achats & Ventes</span>
        </a>
        <a href="{{ route('contact') }}" class="dash-tab-link">
            <i class="bi bi-headset" aria-hidden="true"></i>
            <span>Assistance ImmoPro</span>
        </a>
    </nav>

    {{-- Grille de KPIs Client --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon"><i class="bi bi-houses"></i></div>
                <span style="font-size: 0.6875rem; color: var(--text-muted); font-weight: 600;">EN LIGNE</span>
            </div>
            <div class="kpi-value tabular-nums">{{ $statsClient['total_biens'] }}</div>
            <div class="kpi-label">Biens certifiés disponibles</div>
            <div class="kpi-subtext">
                <span class="tabular-nums">{{ $statsClient['total_locations'] }}</span> locations • <span class="tabular-nums">{{ $statsClient['total_ventes'] }}</span> ventes
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon cta"><i class="bi bi-send-check"></i></div>
                <span style="font-size: 0.6875rem; color: var(--accent-cta); font-weight: 700;">TRANSMIS</span>
            </div>
            <div class="kpi-value tabular-nums">{{ $statsClient['mes_demandes'] }}</div>
            <div class="kpi-label">Prises de contact effectuées</div>
            <div class="kpi-subtext">Messages et demandes de visites</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon"><i class="bi bi-geo-alt"></i></div>
                <span style="font-size: 0.6875rem; color: var(--text-muted); font-weight: 600;">SECTEURS</span>
            </div>
            <div class="kpi-value" style="font-size: 1.35rem; padding-top: 0.25rem;">Korhogo</div>
            <div class="kpi-label">Zone urbaine prioritaire</div>
            <div class="kpi-subtext">Koko, Résidentiel, Sinistré...</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon"><i class="bi bi-shield-check"></i></div>
                <span style="font-size: 0.6875rem; color: #166534; font-weight: 700;">GRATUIT</span>
            </div>
            <div class="kpi-value" style="font-size: 1.35rem; padding-top: 0.25rem;">100% Acquéreur</div>
            <div class="kpi-label">Sécurité & Transparence</div>
            <div class="kpi-subtext">Aucun frais pour les locataires</div>
        </div>
    </div>

    {{-- Hub de recherche par catégorie --}}
    <section class="category-hub-section" aria-label="Catégories rapides">
        <div class="section-headline-row">
            <h2 class="section-title">
                <i class="bi bi-compass"></i>
                <span>Recherche directe par type de bien</span>
            </h2>
            <a href="{{ route('annonces.index') }}" class="dash-card-link">
                <span>Tous les filtres</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="category-hub-grid">
            <a href="{{ route('annonces.index', ['type_bien' => 'villa']) }}" class="category-tile">
                <div class="category-tile-icon"><i class="bi bi-house-heart"></i></div>
                <div>
                    <span class="category-tile-title">Villas de Standing</span>
                    <span class="category-tile-desc">Résidences haut de gamme</span>
                </div>
            </a>

            <a href="{{ route('annonces.index', ['type_bien' => 'maison']) }}" class="category-tile">
                <div class="category-tile-icon"><i class="bi bi-house-door"></i></div>
                <div>
                    <span class="category-tile-title">Maisons Familiales</span>
                    <span class="category-tile-desc">Cour privée & quartier calme</span>
                </div>
            </a>

            <a href="{{ route('annonces.index', ['type_offre' => 'location']) }}" class="category-tile">
                <div class="category-tile-icon"><i class="bi bi-door-open"></i></div>
                <div>
                    <span class="category-tile-title">Locations Meublées</span>
                    <span class="category-tile-desc">Prêtes à habiter immédiatement</span>
                </div>
            </a>

            <a href="{{ route('annonces.index', ['type_bien' => 'terrain']) }}" class="category-tile">
                <div class="category-tile-icon"><i class="bi bi-map"></i></div>
                <div>
                    <span class="category-tile-title">Terrains & Parcelles</span>
                    <span class="category-tile-desc">Titres fonciers & ACD vérifiés</span>
                </div>
            </a>
        </div>
    </section>

    {{-- Disposition Principale 2 Colonnes --}}
    <div class="dash-main-grid">

        {{-- Colonne Gauche : Dernières Opportunités Recommandées --}}
        <div class="dash-card">
            <div class="dash-card-header">
                <h3 class="dash-card-title">
                    <i class="bi bi-stars"></i>
                    <span>Dernières opportunités à découvrir</span>
                </h3>
                <a href="{{ route('annonces.index') }}" class="dash-card-link">
                    <span>Voir tout le catalogue</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="dash-card-body">
                <div class="recommended-list">
                    @forelse($annoncesRecommandees as $annonce)
                    <div class="recommended-item">
                        <div class="recommended-thumb-wrapper">
                            <img src="{{ $annonce->premiere_image }}" alt="{{ $annonce->titre }}" class="recommended-thumb" loading="lazy">
                            <span class="offer-badge {{ $annonce->type_offre }}">
                                {{ $annonce->type_offre === 'vente' ? 'Vente' : 'Location' }}
                            </span>
                        </div>

                        <div class="recommended-content">
                            <h4 class="recommended-title" title="{{ $annonce->titre }}">{{ $annonce->titre }}</h4>
                            <div class="recommended-location">
                                <i class="bi bi-geo-alt-fill" style="color: var(--accent-cta);"></i>
                                <span>{{ $annonce->quartier ? $annonce->quartier . ', Korhogo' : 'Korhogo' }}</span>
                            </div>
                            <div class="recommended-price tabular-nums">{{ $annonce->prix_formate }}</div>
                        </div>

                        <a href="{{ route('annonces.show', $annonce) }}" class="btn-view-property">
                            <span>Consulter</span>
                        </a>
                    </div>
                    @empty
                    <div class="empty-state-box">
                        <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                        <h4 class="empty-state-title">Aucune offre pour l'instant</h4>
                        <p class="empty-state-desc">Les nouvelles annonces certifiées apparaîtront ici dès leur publication.</p>
                        <a href="{{ route('annonces.index') }}" class="btn btn-secondary btn-sm">Actualiser le catalogue</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Colonne Droite : Suivi des Réservations, Prises de Contact & Conciergerie --}}
        <div>
            {{-- Mes Réservations de séjour (Hôtels & Résidences) --}}
            <div class="dash-card" style="margin-bottom: 1.5rem;">
                <div class="dash-card-header">
                    <h3 class="dash-card-title">
                        <i class="bi bi-moon-stars"></i>
                        <span>Mes réservations de séjour</span>
                    </h3>
                    <a href="{{ route('annonces.index', ['type_offre' => 'court_sejour']) }}" class="dash-card-link">
                        <span>Où dormir ?</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="dash-card-body">
                    @if(isset($mesReservations) && $mesReservations->isNotEmpty())
                    <div class="requests-list">
                        @foreach($mesReservations as $res)
                        @php
                            $hoteTel = $res->annonce->user->proprietaire->telephone ?? $res->annonce->user->agence->telephone ?? null;
                            $hoteNom = $res->annonce->user->proprietaire ? ($res->annonce->user->proprietaire->prenom . ' ' . $res->annonce->user->proprietaire->nom) : ($res->annonce->user->agence->nom_agence ?? $res->annonce->user->name);
                        @endphp
                        <div class="request-card" style="border-left: 3px solid var(--accent-cta); padding: 0.85rem;">
                            <div class="request-header" style="margin-bottom: 0.35rem;">
                                <a href="{{ route('annonces.show', $res->id_annonce) }}" style="font-weight: 700; color: var(--primary); text-decoration: none; font-size: 0.82rem;">
                                    #{{ $res->id }} • {{ Str::limit($res->annonce->titre, 26) }}
                                </a>
                                <span class="request-status-pill" style="
                                    background-color: {{ $res->statut === 'confirmee' ? 'var(--status-success-bg)' : ($res->statut === 'en_attente' ? 'var(--status-warning-bg)' : 'var(--status-danger-bg)') }};
                                    color: {{ $res->statut === 'confirmee' ? 'var(--status-success-text)' : ($res->statut === 'en_attente' ? 'var(--status-warning-text)' : 'var(--status-danger-text)') }};
                                    border-color: {{ $res->statut === 'confirmee' ? 'var(--status-success-border)' : ($res->statut === 'en_attente' ? 'var(--status-warning-border)' : 'var(--status-danger-border)') }};
                                ">
                                    <span>{{ $res->statut_label }}</span>
                                </span>
                            </div>

                            <div style="font-size: 0.78rem; color: var(--text-secondary); line-height: 1.45;">
                                <div><i class="bi bi-calendar-range"></i> {{ $res->periode_formatee }} ({{ $res->nombre_nuits }} nuit(s))</div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.35rem;">
                                    <strong class="tabular-nums" style="color: var(--accent-cta); font-size: 0.95rem;">{{ $res->prix_total_formate }}</strong>
                                    <span>{{ $res->nombre_personnes }} voyageur(s)</span>
                                </div>
                            </div>

                            @if($hoteTel)
                            <div style="display: flex; gap: 0.45rem; margin-top: 0.65rem; padding-top: 0.5rem; border-top: 1px solid var(--border-subtle);">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $hoteTel) }}?text=Bonjour%20{{ urlencode($hoteNom) }},%20au%20sujet%20de%20ma%20réservation%20#{{ $res->id }}%20sur%20ImmoPro..."
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-brand"
                                    style="flex: 1; font-size: 0.75rem; padding: 0.35rem 0.5rem; justify-content: center;">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>WhatsApp Hôte</span>
                                </a>
                                <a href="tel:{{ $hoteTel }}"
                                    class="btn btn-sm btn-secondary"
                                    style="font-size: 0.75rem; padding: 0.35rem 0.6rem;">
                                    <i class="bi bi-telephone"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state-box">
                        <div class="empty-state-icon"><i class="bi bi-moon-stars"></i></div>
                        <h4 class="empty-state-title">Aucune réservation en cours</h4>
                        <p class="empty-state-desc">Vous cherchez une chambre d'hôtel ou une résidence meublée à Korhogo ? Réservez en direct sans commission.</p>
                        <a href="{{ route('annonces.index', ['type_offre' => 'court_sejour']) }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-search"></i>
                            <span>Trouver un hébergement</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-header">
                    <h3 class="dash-card-title">
                        <i class="bi bi-chat-left-dots"></i>
                        <span>Mes prises de contact</span>
                    </h3>
                </div>

                <div class="dash-card-body">
                    @if($mesDemandes->isNotEmpty())
                    <div class="requests-list">
                        @foreach($mesDemandes as $demande)
                        <div class="request-card">
                            <div class="request-header">
                                <span class="tabular-nums">{{ $demande->created_at ? $demande->created_at->format('d/m/Y à H:i') : 'Récemment' }}</span>
                                <span class="request-status-pill">
                                    <i class="bi bi-check2"></i>
                                    <span>Transmis</span>
                                </span>
                            </div>
                            <p class="request-message-snippet">
                                « {{ $demande->message }} »
                            </p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state-box">
                        <div class="empty-state-icon"><i class="bi bi-chat-heart"></i></div>
                        <h4 class="empty-state-title">Aucune demande en cours</h4>
                        <p class="empty-state-desc">
                            Lorsque vous contactez une agence ou un propriétaire depuis une annonce, vos demandes seront archivées ici.
                        </p>
                        <a href="{{ route('annonces.index') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-search"></i>
                            <span>Trouver un bien</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Encadré Conciergerie / Accompagnement Local --}}
            <div class="concierge-card">
                <div class="concierge-eyebrow">
                    <i class="bi bi-shield-check"></i>
                    <span>Service d'Accompagnement</span>
                </div>
                <h4 class="concierge-title">Une recherche spécifique à Korhogo ?</h4>
                <p class="concierge-desc">
                    Vous ne trouvez pas exactement ce que vous cherchez ? Nos conseillers partenaires vous orientent gratuitement vers les biens hors marché correspondant à votre budget.
                </p>
                <a href="{{ route('contact') }}" class="btn-concierge">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Échanger avec un conseiller</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
