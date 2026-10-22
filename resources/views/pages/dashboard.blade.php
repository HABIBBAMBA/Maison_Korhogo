@extends('layouts.app')

@section('title', 'Tableau de bord — ImmoPro')

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  TABLEAU DE BORD IMMOPRO — CONCEPTION HAUT DE GAMME                  ║
       ║  RÈGLE STRICTE : ZÉRO DÉGRADÉ — SURFACES SOLIDES CALIBRÉES           ║
       ║  Tokens officiels : #F8F9FA, #1B3A5C, #5A6B7B, #E8734A, #222831      ║
       ╚══════════════════════════════════════════════════════════════════════╝ */

    .dash-wrapper {
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
        transition: color var(--duration-fast) var(--ease-out-expo);
    }

    .dash-breadcrumb a:hover {
        color: var(--color-primary);
    }

    .dash-breadcrumb .sep {
        color: var(--border-strong);
        font-size: 0.75rem;
    }

    .dash-breadcrumb .current {
        color: var(--text-primary);
        font-weight: 600;
    }

    /* En-tête du Dashboard */
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
        background-color: oklch(0.96 0.01 255);
        color: var(--color-primary);
        border: 1px solid var(--border-default);
    }

    .dash-role-badge i {
        font-size: 0.85rem;
        color: var(--color-cta);
    }

    .dash-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        color: var(--color-primary);
        line-height: 1.2;
        letter-spacing: -0.02em;
        margin: 0;
    }

    .dash-title em {
        font-style: normal;
        color: var(--color-cta);
    }

    .dash-subtitle {
        color: var(--color-secondary);
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

    /* Barre de navigation interne (Tabs de navigation) */
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
        color: var(--color-secondary);
        text-decoration: none;
        white-space: nowrap;
        transition: background-color var(--duration-fast) var(--ease-out-expo),
                    color var(--duration-fast) var(--ease-out-expo);
    }

    .dash-tab-link:hover {
        color: var(--color-primary);
        background-color: var(--surface-sunken);
    }

    .dash-tab-link.active {
        background-color: var(--color-primary);
        color: #ffffff;
        box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.15);
    }

    .dash-tab-link.active i {
        color: var(--color-cta);
    }

    /* Grille des KPI Metrics */
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
        padding: 1.35rem 1.25rem;
        box-shadow: var(--shadow-raised);
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        transition: transform var(--duration-fast) var(--ease-out-expo),
                    box-shadow var(--duration-fast) var(--ease-out-expo),
                    border-color var(--duration-fast) var(--ease-out-expo);
    }

    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-card);
        border-color: var(--border-strong);
    }

    .kpi-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kpi-icon-wrap {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .kpi-icon-wrap.primary {
        background-color: oklch(0.96 0.02 250);
        color: var(--color-primary);
        border: 1px solid oklch(0.90 0.03 250);
    }

    .kpi-icon-wrap.cta {
        background-color: oklch(0.96 0.03 45);
        color: var(--color-cta);
        border: 1px solid oklch(0.90 0.05 45);
    }

    .kpi-icon-wrap.slate {
        background-color: oklch(0.96 0.01 230);
        color: var(--color-secondary);
        border: 1px solid oklch(0.90 0.02 230);
    }

    .kpi-icon-wrap.success {
        background-color: oklch(0.96 0.03 145);
        color: #196C45;
        border: 1px solid oklch(0.88 0.06 145);
    }

    .kpi-pill {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.2rem 0.55rem;
        border-radius: var(--radius-full);
        background-color: var(--surface-sunken);
        color: var(--text-secondary);
        border: 1px solid var(--border-subtle);
    }

    .kpi-pill.success {
        background-color: #EBF8F2;
        color: #196C45;
        border-color: #A3E3C1;
    }

    .kpi-value {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--color-primary);
        line-height: 1.1;
        letter-spacing: -0.02em;
    }

    .kpi-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-secondary);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    /* Grille d'actions rapides */
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2.25rem;
    }

    .action-tile {
        background-color: var(--surface-base);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 1.1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow-raised);
        transition: transform var(--duration-fast) var(--ease-out-expo),
                    border-color var(--duration-fast) var(--ease-out-expo),
                    box-shadow var(--duration-fast) var(--ease-out-expo);
    }

    .action-tile:hover {
        transform: translateY(-2px);
        border-color: var(--color-primary);
        box-shadow: var(--shadow-card);
    }

    .action-tile:active {
        transform: translateY(0);
    }

    .action-tile-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        color: var(--color-primary);
        flex-shrink: 0;
        transition: background-color var(--duration-fast) var(--ease-out-expo),
                    color var(--duration-fast) var(--ease-out-expo);
    }

    .action-tile:hover .action-tile-icon {
        background-color: var(--color-primary);
        color: #ffffff;
        border-color: var(--color-primary);
    }

    .action-tile-content {
        display: flex;
        flex-direction: column;
    }

    .action-tile-title {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--color-primary);
    }

    .action-tile-desc {
        font-size: 0.775rem;
        color: var(--color-secondary);
    }

    /* Section Tableau des Biens Récents */
    .dash-card {
        background-color: var(--surface-base);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-raised);
        margin-bottom: 2.25rem;
        overflow: hidden;
    }

    .dash-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-subtle);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: var(--surface-base);
    }

    .dash-card-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-primary);
        margin: 0;
    }

    .dash-card-title i {
        color: var(--color-cta);
        font-size: 1rem;
    }

    .dash-card-link {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-primary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: color var(--duration-fast) var(--ease-out-expo);
    }

    .dash-card-link:hover {
        color: var(--color-cta);
    }

    /* Tableau Architectural Solide */
    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .pro-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
        text-align: left;
    }

    .pro-table th {
        background-color: var(--surface-sunken);
        color: var(--color-secondary);
        font-weight: 600;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid var(--border-default);
        white-space: nowrap;
    }

    .pro-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border-subtle);
        color: var(--color-text-main);
        vertical-align: middle;
    }

    .pro-table tbody tr {
        transition: background-color var(--duration-fast) var(--ease-out-expo);
    }

    .pro-table tbody tr:hover {
        background-color: oklch(0.99 0.003 250);
    }

    .pro-table tbody tr:last-child td {
        border-bottom: none;
    }

    .bien-meta-title {
        font-weight: 700;
        color: var(--color-primary);
        text-decoration: none;
        display: block;
        line-height: 1.3;
        transition: color var(--duration-fast) var(--ease-out-expo);
    }

    .bien-meta-title:hover {
        color: var(--color-cta);
    }

    .bien-meta-location {
        font-size: 0.75rem;
        color: var(--color-secondary);
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.15rem;
    }

    .price-cell {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        color: var(--color-primary);
        font-size: 0.9rem;
        white-space: nowrap;
    }

    /* Badges de Statut Solides */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.22rem 0.6rem;
        border-radius: var(--radius-full);
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        white-space: nowrap;
        border: 1px solid transparent;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-badge.active {
        background-color: #EBF8F2;
        color: #196C45;
        border-color: #A3E3C1;
    }
    .status-badge.active .status-dot { background-color: #196C45; }

    .status-badge.warning {
        background-color: #FFFBEB;
        color: #92400E;
        border-color: #FCD34D;
    }
    .status-badge.warning .status-dot { background-color: #D97706; }

    .status-badge.muted {
        background-color: var(--surface-sunken);
        color: var(--color-secondary);
        border-color: var(--border-default);
    }
    .status-badge.muted .status-dot { background-color: var(--color-secondary); }

    /* Actions de tableau */
    .table-actions {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .btn-action-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-default);
        background-color: var(--surface-base);
        color: var(--color-secondary);
        text-decoration: none;
        cursor: pointer;
        transition: background-color var(--duration-fast) var(--ease-out-expo),
                    color var(--duration-fast) var(--ease-out-expo),
                    border-color var(--duration-fast) var(--ease-out-expo);
    }

    .btn-action-icon:hover {
        background-color: var(--surface-sunken);
        color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .btn-action-icon.danger:hover {
        background-color: #FDF2F2;
        color: #991B1B;
        border-color: #FCA5A5;
    }

    /* Grille inférieure (Double Colonne : Activité & Messages) */
    .dual-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .feed-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feed-item {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-subtle);
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        transition: background-color var(--duration-fast) var(--ease-out-expo);
    }

    .feed-item:last-child {
        border-bottom: none;
    }

    .feed-item:hover {
        background-color: oklch(0.99 0.003 250);
    }

    .feed-bullet {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-top: 0.45rem;
        flex-shrink: 0;
    }

    .feed-bullet.primary { background-color: var(--color-primary); }
    .feed-bullet.cta     { background-color: var(--color-cta); }
    .feed-bullet.success { background-color: #196C45; }
    .feed-bullet.slate   { background-color: var(--color-secondary); }

    .feed-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .feed-title {
        font-size: 0.875rem;
        color: var(--color-text-main);
        line-height: 1.4;
    }

    .feed-time {
        font-size: 0.75rem;
        color: var(--color-secondary);
        font-family: 'JetBrains Mono', monospace;
    }

    /* État Vide (Empty State) */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: var(--color-secondary);
    }

    .empty-state-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: var(--color-secondary);
    }

    .empty-state-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-bottom: 0.35rem;
    }

    .empty-state-desc {
        font-size: 0.85rem;
        color: var(--color-secondary);
        margin-bottom: 1.25rem;
        max-width: 400px;
        margin-inline: auto;
    }

    /* Adaptabilité Mobile & Responsive */
    @media (max-width: 1024px) {
        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .dual-grid {
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
            justify-content: stretch;
        }
        .dash-header-actions .btn {
            flex: 1;
            text-align: center;
        }
        .kpi-grid {
            grid-template-columns: 1fr;
        }
        .actions-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="dash-wrapper">

    {{-- Fil d'Ariane --}}
    <nav class="dash-breadcrumb" aria-label="Fil d'Ariane">
        <a href="{{ route('home') }}"><i class="bi bi-house-door" aria-hidden="true"></i> Accueil</a>
        <span class="sep" aria-hidden="true">/</span>
        <span class="current">Espace Personnel</span>
    </nav>

    {{-- En-tête du Dashboard --}}
    <header class="dash-header">
        <div class="dash-header-info">
            <div class="dash-role-badge">
                @if($user->estAdmin())
                    <i class="bi bi-shield-check" aria-hidden="true"></i>
                    <span>Administrateur Système</span>
                @elseif($user->role === 'agence')
                    <i class="bi bi-building" aria-hidden="true"></i>
                    <span>Agence Immobilière Agréée</span>
                @elseif($user->role === 'proprietaire')
                    <i class="bi bi-key" aria-hidden="true"></i>
                    <span>Propriétaire Bailleur</span>
                @else
                    <i class="bi bi-person" aria-hidden="true"></i>
                    <span>Espace Client / Acquéreur</span>
                @endif
            </div>

            <h1 class="dash-title">
                Bienvenue, <em>{{ explode(' ', $user->name)[0] }}</em>
            </h1>

            <p class="dash-subtitle">
                @if($user->estAdmin())
                    Supervision globale de la plateforme ImmoPro, suivi des biens et gestion des utilisateurs en Côte d'Ivoire.
                @elseif($user->role === 'agence')
                    Gérez votre portefeuille de mandats immobiliers, vos annonces et suivez les demandes de contact de vos prospects.
                @elseif($user->role === 'proprietaire')
                    Administrez vos propriétés à Korhogo et dans toute la région, analysez vos consultations et vos visites.
                @else
                    Retrouvez votre historique de recherche, vos demandes d'information et vos biens enregistrés.
                @endif
            </p>
        </div>

        <div class="dash-header-actions">
           
            @if($user->peutPublierAnnonce())
                <a href="{{ route('annonces.create') }}" class="btn btn-cta">
                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    <span>Nouveau bien</span>
                </a>
            @else
                <a href="{{ route('annonces.index') }}" class="btn btn-primary">
                    <i class="bi bi-search" aria-hidden="true"></i>
                    <span>Consulter les annonces</span>
                </a>
            @endif
        </div>
    </header>

    {{-- Navigation interne / Onglets rapides --}}
    <nav class="dash-tabs" aria-label="Navigation du tableau de bord">
        <a href="{{ route('dashboard') }}" class="dash-tab-link active">
            <i class="bi bi-grid-fill" aria-hidden="true"></i>
            <span>Vue d'ensemble</span>
        </a>
        @if($user->peutPublierAnnonce())
        <a href="{{ route('annonces.mes-annonces') }}" class="dash-tab-link">
            <i class="bi bi-building" aria-hidden="true"></i>
            <span>Mes annonces ({{ $stats['total_biens'] ?? 0 }})</span>
        </a>
        <a href="{{ route('annonces.create') }}" class="dash-tab-link">
            <i class="bi bi-plus-circle" aria-hidden="true"></i>
            <span>Déposer une annonce</span>
        </a>
        @else
        <a href="{{ route('annonces.index') }}" class="dash-tab-link">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Rechercher un bien</span>
        </a>
        @endif
        @if($user->estAdmin())
            <a href="{{ route('admin.biens.index') }}" class="dash-tab-link">
                <i class="bi bi-collection" aria-hidden="true"></i>
                <span>Catalogue Global</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="dash-tab-link">
                <i class="bi bi-people" aria-hidden="true"></i>
                <span>Utilisateurs</span>
            </a>
            <a href="{{ route('admin.agences.index') }}" class="dash-tab-link">
                <i class="bi bi-shop" aria-hidden="true"></i>
                <span>Agences</span>
            </a>
        @endif
        <a href="{{ route('profile.edit') }}" class="dash-tab-link">
            <i class="bi bi-gear" aria-hidden="true"></i>
            <span>Mon Profil</span>
        </a>
    </nav>

    {{-- Indicateurs Clés de Performance (KPI) --}}
    <section aria-labelledby="kpi-heading">
        <h2 id="kpi-heading" class="visually-hidden" style="position: absolute; width: 1px; height: 1px; margin: -1px; padding: 0; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">Indicateurs clés</h2>
        <div class="kpi-grid">
            {{-- KPI 1 : Biens publiés --}}
            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap primary" aria-hidden="true">
                        <i class="bi bi-building"></i>
                    </div>
                    <span class="kpi-pill success tabular-nums">+{{ $stats['biens_publies'] ?? 0 }} en ligne</span>
                </div>
                <div class="kpi-value tabular-nums">{{ $stats['total_biens'] ?? 0 }}</div>
                <div class="kpi-label">Biens publiés</div>
            </div>

            {{-- KPI 2 : Vues totales --}}
            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap cta" aria-hidden="true">
                        <i class="bi bi-eye"></i>
                    </div>
                    <span class="kpi-pill tabular-nums">+{{ $stats['vues_cette_semaine'] ?? 0 }}% sem.</span>
                </div>
                <div class="kpi-value tabular-nums">{{ number_format($stats['total_vues'] ?? 0, 0, ',', ' ') }}</div>
                <div class="kpi-label">Vues totales</div>
            </div>

            {{-- KPI 3 : Messages reçus --}}
            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap slate" aria-hidden="true">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <span class="kpi-pill tabular-nums">+{{ $stats['nouveaux_messages'] ?? 0 }} récents</span>
                </div>
                <div class="kpi-value tabular-nums">{{ $stats['total_messages'] ?? 0 }}</div>
                <div class="kpi-label">Messages reçus</div>
            </div>

            {{-- KPI 4 : Réservations séjours (Hôtels & Résidences) --}}
            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap cta" aria-hidden="true">
                        <i class="bi bi-moon-stars-fill"></i>
                    </div>
                    <span class="kpi-pill tabular-nums">{{ $stats['reservations_en_attente'] ?? 0 }} en attente</span>
                </div>
                <div class="kpi-value tabular-nums">{{ $stats['total_reservations'] ?? 0 }}</div>
                <div class="kpi-label">Réservations séjours</div>
            </div>
        </div>

        {{-- Statistiques Système Supplémentaires pour Administrateur --}}
        @if($user->estAdmin() && isset($stats['total_users']))
        <div class="kpi-grid" style="margin-top: -0.75rem;">
            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap primary" aria-hidden="true"><i class="bi bi-people"></i></div>
                    <span class="kpi-pill tabular-nums">{{ $stats['users_actifs'] ?? 0 }} actifs</span>
                </div>
                <div class="kpi-value tabular-nums">{{ $stats['total_users'] }}</div>
                <div class="kpi-label">Utilisateurs inscrits</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap slate" aria-hidden="true"><i class="bi bi-shop"></i></div>
                    <span class="kpi-pill tabular-nums">Partenaires</span>
                </div>
                <div class="kpi-value tabular-nums">{{ $stats['total_agences'] ?? 0 }}</div>
                <div class="kpi-label">Agences certifiées</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap success" aria-hidden="true"><i class="bi bi-check2-circle"></i></div>
                    <span class="kpi-pill success tabular-nums">Finalisées</span>
                </div>
                <div class="kpi-value tabular-nums">{{ $stats['total_transactions'] ?? 0 }}</div>
                <div class="kpi-label">Transactions conclues</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-card-header">
                    <div class="kpi-icon-wrap cta" aria-hidden="true"><i class="bi bi-shield-lock"></i></div>
                    <span class="kpi-pill tabular-nums">Sécurité</span>
                </div>
                <div class="kpi-value tabular-nums">100%</div>
                <div class="kpi-label">Plateforme certifiée</div>
            </div>
        </div>
        @endif
    </section>

    {{-- Grille d'actions rapides --}}
    <div class="actions-grid">
        @if($user->peutPublierAnnonce())
            <a href="{{ route('annonces.create') }}" class="action-tile">
                <div class="action-tile-icon" aria-hidden="true"><i class="bi bi-plus-lg"></i></div>
                <div class="action-tile-content">
                    <span class="action-tile-title">Nouveau bien</span>
                    <span class="action-tile-desc">Publier une annonce</span>
                </div>
            </a>
            <a href="{{ route('annonces.mes-annonces') }}" class="action-tile">
                <div class="action-tile-icon" aria-hidden="true"><i class="bi bi-collection"></i></div>
                <div class="action-tile-content">
                    <span class="action-tile-title">Mes annonces</span>
                    <span class="action-tile-desc">Gérer mon portefeuille</span>
                </div>
            </a>
        @else
            <a href="{{ route('annonces.index') }}" class="action-tile">
                <div class="action-tile-icon" aria-hidden="true"><i class="bi bi-search"></i></div>
                <div class="action-tile-content">
                    <span class="action-tile-title">Catalogue</span>
                    <span class="action-tile-desc">Trouver un logement</span>
                </div>
            </a>
        @endif

        @if($user->estAdmin())
            <a href="{{ route('admin.users.index') }}" class="action-tile">
                <div class="action-tile-icon" aria-hidden="true"><i class="bi bi-people"></i></div>
                <div class="action-tile-content">
                    <span class="action-tile-title">Gestion des utilisateurs</span>
                    <span class="action-tile-desc">Gérer les comptes</span>
                </div>
            </a>

            <a href="{{ route('admin.agences.index') }}" class="action-tile">
                <div class="action-tile-icon" aria-hidden="true"><i class="bi bi-buildings"></i></div>
                <div class="action-tile-content">
                    <span class="action-tile-title">Gestion des agences</span>
                    <span class="action-tile-desc">Gérer les agences</span>
                </div>
            </a>
        @endif

        <a href="{{ route('profile.edit') }}" class="action-tile">
            <div class="action-tile-icon" aria-hidden="true"><i class="bi bi-person-gear"></i></div>
            <div class="action-tile-content">
                <span class="action-tile-title">Mon Profil</span>
                <span class="action-tile-desc">Coordonnées et sécurité</span>
            </div>
        </a>
    </div>

    {{-- Tableau des Demandes de Réservations Court Séjour (Hôtels & Résidences) --}}
    @if($user->peutPublierAnnonce() && isset($reservationsRecues) && $reservationsRecues->isNotEmpty())
    <div class="dash-card">
        <div class="dash-card-header">
            <h3 class="dash-card-title">
                <i class="bi bi-calendar-check" aria-hidden="true"></i>
                <span>Demandes de Réservations (Hôtels &amp; Résidences)</span>
                @if(($stats['reservations_en_attente'] ?? 0) > 0)
                <span class="badge-pill warning" style="font-size: 0.72rem; padding: 0.2rem 0.55rem; background-color: var(--status-warning-bg); color: var(--status-warning-text); border: 1px solid var(--status-warning-border); border-radius: var(--radius-full); font-weight: 700;">
                    {{ $stats['reservations_en_attente'] }} en attente
                </span>
                @endif
            </h3>
        </div>

        <div class="table-container">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Réf</th>
                        <th>Hébergement</th>
                        <th>Voyageur</th>
                        <th>Dates séjour</th>
                        <th>Personnes</th>
                        <th>Montant estimé</th>
                        <th>Statut</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservationsRecues as $res)
                    <tr>
                        <td>
                            <span class="tabular-nums" style="font-weight: 700; color: var(--color-primary);">
                                #{{ $res->id }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('annonces.show', $res->id_annonce) }}" style="font-weight: 600; color: var(--color-primary); text-decoration: none;">
                                {{ Str::limit($res->annonce->titre, 28) }}
                            </a>
                        </td>
                        <td>
                            <div>
                                <strong style="display: block; font-size: 0.85rem; color: var(--color-primary);">{{ $res->nom_client }}</strong>
                                <span class="tabular-nums" style="font-size: 0.75rem; color: var(--color-secondary);">{{ $res->telephone }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.8rem;">
                                <div class="tabular-nums">{{ $res->periode_formatee }}</div>
                                <span style="font-size: 0.72rem; color: var(--color-secondary);">{{ $res->nombre_nuits }} nuit(s)</span>
                            </div>
                        </td>
                        <td>
                            <span class="tabular-nums" style="font-size: 0.85rem;">{{ $res->nombre_personnes }} pers.</span>
                        </td>
                        <td>
                            <strong class="tabular-nums" style="color: var(--color-cta); font-size: 0.92rem;">
                                {{ $res->prix_total_formate }}
                            </strong>
                        </td>
                        <td>
                            <span class="status-pill {{ $res->statut === 'confirmee' ? 'badge-teal' : ($res->statut === 'en_attente' ? 'badge-muted' : 'badge-danger') }}">
                                <span class="status-dot"></span>
                                <span>{{ $res->statut_label }}</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <div class="table-actions" style="justify-content: flex-end; gap: 0.35rem;">
                                @if($res->statut === 'en_attente')
                                <form action="{{ route('reservations.update-statut', $res) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="confirmee">
                                    <button type="submit" class="btn btn-sm btn-primary" title="Confirmer la réservation" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                        <i class="bi bi-check-lg"></i> Valider
                                    </button>
                                </form>
                                <form action="{{ route('reservations.update-statut', $res) }}" method="POST"
                                    data-confirm="Souhaitez-vous refuser cette demande de réservation pour « {{ $res->annonce->titre ?? 'cette annonce' }} » ?"
                                    data-confirm-title="Refuser la réservation"
                                    data-confirm-btn="Refuser la demande"
                                    data-confirm-danger="false"
                                    data-confirm-warning="Le client sera notifié du refus de sa demande."
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="refusee">
                                    <button type="submit" class="btn btn-sm btn-secondary" title="Refuser" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                                @endif

                                @if($res->telephone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $res->telephone) }}?text=Bonjour%20{{ urlencode($res->nom_client) }},%20suite%20à%20votre%20demande%20de%20réservation%20#{{ $res->id }}%20pour%20«%20{{ urlencode($res->annonce->titre) }}%20»..."
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn-action-icon"
                                    title="Échanger sur WhatsApp"
                                    style="color: #25D366;">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="tel:{{ $res->telephone }}" class="btn-action-icon" title="Appeler le voyageur">
                                    <i class="bi bi-telephone"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Tableau des Biens Récents --}}
    @if($user->peutPublierAnnonce())
    <div class="dash-card">
        <div class="dash-card-header">
            <h3 class="dash-card-title">
                <i class="bi bi-building" aria-hidden="true"></i>
                <span>Vos biens récents</span>
            </h3>
            <a href="{{ route('annonces.mes-annonces') }}" class="dash-card-link">
                <span>Tous mes biens</span>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <div class="table-container">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th scope="col">Bien & Emplacement</th>
                        <th scope="col">Type</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Consultations</th>
                        <th scope="col">Date</th>
                        <th scope="col" style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBiens ?? [] as $bien)
                    <tr>
                        <td>
                            <a href="{{ route('annonces.show', $bien['id']) }}" class="bien-meta-title">
                                {{ Str::limit($bien['titre'] ?? '', 40) }}
                            </a>
                            <span class="bien-meta-location">
                                <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                {{ $bien['ville'] ?? 'Korhogo' }}
                            </span>
                        </td>
                        <td>
                            <span style="font-weight: 600; color: var(--color-secondary);">
                                {{ ucfirst($bien['type'] ?? 'Maison') }}
                            </span>
                        </td>
                        <td>
                            <span class="price-cell tabular-nums">
                                {{ number_format((float) ($bien['prix'] ?? 0), 0, ',', ' ') }} FCFA
                            </span>
                        </td>
                        <td>
                            @php
                                $isPublie = ($bien['statut'] ?? '') === 'Publiée' || ($bien['statut'] ?? '') === 'active';
                            @endphp
                            <span class="status-badge {{ $isPublie ? 'active' : 'muted' }}">
                                <span class="status-dot"></span>
                                <span>{{ $bien['statut'] ?? 'Publiée' }}</span>
                            </span>
                        </td>
                        <td>
                            <span class="tabular-nums" style="font-weight: 600; color: var(--color-primary);">
                                {{ $bien['vues'] ?? 0 }}
                            </span>
                        </td>
                        <td>
                            <span class="tabular-nums" style="font-size: 0.8125rem; color: var(--color-secondary);">
                                {{ $bien['date'] ?? '' }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <div class="table-actions" style="justify-content: flex-end;">
                                <a href="{{ route('annonces.show', $bien['id']) }}" class="btn-action-icon" title="Voir l'annonce">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('annonces.edit', $bien['id']) }}" class="btn-action-icon" title="Modifier l'annonce">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('annonces.destroy', $bien['id']) }}" method="POST"
                                    data-confirm="Êtes-vous sûr de vouloir supprimer définitivement l'annonce « {{ $bien['titre'] }} » ?"
                                    data-confirm-title="Supprimer l'annonce"
                                    data-confirm-btn="Supprimer définitivement"
                                    data-confirm-warning="Cette annonce et ses photos seront retirées immédiatement de la plateforme."
                                    style="margin: 0; display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-icon danger" title="Supprimer l'annonce">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon" aria-hidden="true"><i class="bi bi-building-add"></i></div>
                                <h4 class="empty-state-title">Aucun bien publié pour le moment</h4>
                                <p class="empty-state-desc">Vous n'avez pas encore d'annonce répertoriée dans votre portefeuille immobilier.</p>
                                <a href="{{ route('annonces.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                                    <span>Déposer mon premier bien</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Double Colonne : Activités & Messages récents --}}
    <div class="dual-grid">
        {{-- Colonne 1 : Activité récente --}}
        <div class="dash-card" style="margin-bottom: 0;">
            <div class="dash-card-header">
                <h3 class="dash-card-title">
                    <i class="bi bi-clock-history" aria-hidden="true"></i>
                    <span>Activité récente</span>
                </h3>
            </div>
            <ul class="feed-list">
                @forelse($recentActivities ?? [] as $activity)
                <li class="feed-item">
                    <div class="feed-bullet {{ $activity['color'] === 'teal' ? 'primary' : ($activity['color'] ?? 'primary') }}"></div>
                    <div class="feed-content">
                        <span class="feed-title">{{ $activity['text'] ?? '' }}</span>
                        <span class="feed-time">{{ $activity['time'] ?? 'Récemment' }}</span>
                    </div>
                </li>
                @empty
                <li class="feed-item">
                    <div class="feed-bullet slate"></div>
                    <div class="feed-content">
                        <span class="feed-title">Aucune activité récente enregistrée</span>
                        <span class="feed-time">Votre historique apparaîtra ici</span>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>

        {{-- Colonne 2 : Messages récents --}}
        <div class="dash-card" style="margin-bottom: 0;">
            <div class="dash-card-header">
                <h3 class="dash-card-title">
                    <i class="bi bi-chat-square-text" aria-hidden="true"></i>
                    <span>Messages & Contacts</span>
                </h3>
                @if($user->estAdmin())
                    <a href="{{ route('contacts.index') }}" class="dash-card-link">
                        <span>Voir tout</span>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
            <ul class="feed-list">
                @forelse($recentMessages ?? [] as $message)
                <li class="feed-item">
                    <div class="feed-bullet {{ ($message['lu'] ?? false) ? 'slate' : 'cta' }}"></div>
                    <div class="feed-content">
                        <span class="feed-title">
                            <strong>{{ $message['sender'] ?? 'Visiteur' }}</strong> — {{ Str::limit($message['contenu'] ?? '', 60) }}
                        </span>
                        <span class="feed-time">{{ $message['time'] ?? 'Récemment' }}</span>
                    </div>
                </li>
                @empty
                <li class="feed-item">
                    <div class="feed-bullet cta"></div>
                    <div class="feed-content">
                        <span class="feed-title">Aucun message de contact récent</span>
                        <span class="feed-time">Les demandes de vos visiteurs s'afficheront ici</span>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
@endsection