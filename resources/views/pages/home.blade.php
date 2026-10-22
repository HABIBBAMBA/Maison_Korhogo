@extends('layouts.app')

@section('title', 'ImmoPro — Plateforme Immobilière de Référence à Korhogo et en Côte d\'Ivoire')

@section('content')

@php
    $heroImages = $heroPhotos->isNotEmpty()
        ? $heroPhotos
        : $annoncesRecentes
            ->flatMap(fn ($annonce) => $annonce->images ?? [])
            ->filter(fn ($image) => is_string($image) && $image !== '')
            ->unique()
            ->take(5)
            ->map(fn ($image) => asset('storage/' . $image))
            ->values();
@endphp

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  HERO SECTION ARCHITECTURALE (SOLIDE, ZÉRO DÉGRADÉ)                ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="hero-arch" data-hero-carousel aria-label="Présentation générale">
    {{-- Carrousel de fond matériel avec opacité physique --}}
    <div class="hero-carousel-viewport hero-carousel__slides" aria-hidden="true">
        @if($heroImages->isNotEmpty())
            @foreach($heroImages as $image)
            <img
                src="{{ $image }}"
                class="hero-carousel__slide{{ $loop->first ? ' is-active' : '' }}"
                alt=""
                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                fetchpriority="{{ $loop->first ? 'high' : 'auto' }}">
            @endforeach
        @endif
        {{-- Masque solide pour contraste 100% sans dégradé --}}
        <div class="hero-solid-scrim"></div>
    </div>

    <div class="hero-container">
        {{-- En-tête héroïque --}}
        <div class="hero-header-box">
            <div class="hero-eyebrow">
                <i class="bi bi-shield-check" aria-hidden="true"></i>
                <span>Korhogo & Côte d'Ivoire • Immobilier de Confiance</span>
            </div>

            <h1 class="hero-title">
                Trouvez le bien<br>
                <span class="hero-title-accent">de vos rêves</span>
            </h1>

            <p class="hero-desc">
                Découvrez des résidences d'exception, des villas d'architecte et des terrains titrés rigoureusement contrôlés par nos experts locaux.
            </p>

            <div class="hero-cta-buttons" style="display: flex; gap: var(--space-3); flex-wrap: wrap; margin-top: var(--space-4); margin-bottom: var(--space-6);">
                <a href="{{ route('biens.index') }}" class="btn btn-primary">
                    <i class="bi bi-search" aria-hidden="true"></i>
                    <span>Explorer les biens</span>
                </a>
                <a href="{{ url('/contact') }}" class="btn btn-cta">
                    <i class="bi bi-telephone" aria-hidden="true"></i>
                    <span>Nous contacter</span>
                </a>
            </div>
        </div>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  MOTEUR DE RECHERCHE RAPIDE INTÉGRÉ (CARTE SURÉLEVÉE SOLIDE)        ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <div class="hero-search-card">
            <form action="{{ route('annonces.index') }}" method="GET" class="hero-search-form">
                {{-- Type de transaction --}}
                <div class="search-field">
                    <label for="search-offre" class="field-label">Transaction</label>
                    <div class="select-wrapper">
                        <select name="type_offre" id="search-offre" class="field-control">
                            <option value="">Toutes offres</option>
                            <option value="vente">Achat / Vente</option>
                            <option value="location">Location classique</option>
                            <option value="court_sejour">Court séjour (Résidences & Hôtels)</option>
                        </select>
                        <i class="bi bi-chevron-down select-chevron" aria-hidden="true"></i>
                    </div>
                </div>

                {{-- Type de bien --}}
                <div class="search-field">
                    <label for="search-type" class="field-label">Type de bien</label>
                    <div class="select-wrapper">
                        <select name="type_bien" id="search-type" class="field-control">
                            <option value="">Tous les types</option>
                            <option value="residence_meublee">Résidence meublée</option>
                            <option value="chambre_hotel">Chambre d'hôtel / Auberge</option>
                            <option value="villa">Villa de standing</option>
                            <option value="maison">Maison individuelle</option>
                            <option value="appartement">Appartement</option>
                            <option value="terrain">Terrain titré</option>
                            <option value="magasin">Magasin / Commerce</option>
                            <option value="bureau">Bureau professionnel</option>
                        </select>
                        <i class="bi bi-chevron-down select-chevron" aria-hidden="true"></i>
                    </div>
                </div>

                {{-- Quartier ou Ville --}}
                <div class="search-field">
                    <label for="search-recherche" class="field-label">Quartier ou Ville</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-geo-alt input-icon" aria-hidden="true"></i>
                        <input
                            type="text"
                            name="recherche"
                            id="search-recherche"
                            class="field-control with-icon"
                            placeholder="Ex: Résidentiel, Koko, Sinistré...">
                    </div>
                </div>

                {{-- Budget maximum --}}
                <div class="search-field">
                    <label for="search-budget" class="field-label">Budget max (FCFA)</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-cash input-icon" aria-hidden="true"></i>
                        <input
                            type="number"
                            name="prix_max"
                            id="search-budget"
                            class="field-control with-icon tabular-nums"
                            placeholder="Montant max"
                            min="0"
                            step="50000">
                    </div>
                </div>

                {{-- Bouton de soumission --}}
                <div class="search-action">
                    <button type="submit" class="btn btn-cta btn-search-submit">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <span>Rechercher</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  BARRE DE MÉTRIQUES DE PRÉCISION (TABULAR-NUMS)                     ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <div class="hero-kpis-strip">
            <div class="kpi-block">
                <span class="kpi-value tabular-nums">{{ number_format($stats['total'], 0, ',', ' ') }}</span>
                <span class="kpi-label">Biens certifiés actifs</span>
            </div>
            <div class="kpi-separator" aria-hidden="true"></div>
            <div class="kpi-block">
                <span class="kpi-value tabular-nums">{{ number_format($stats['vente'], 0, ',', ' ') }}</span>
                <span class="kpi-label">Biens en vente directe</span>
            </div>
            <div class="kpi-separator" aria-hidden="true"></div>
            <div class="kpi-block">
                <span class="kpi-value tabular-nums">{{ number_format($stats['location'], 0, ',', ' ') }}</span>
                <span class="kpi-label">Locations disponibles</span>
            </div>
            <div class="kpi-separator" aria-hidden="true"></div>
            <div class="kpi-block">
                <span class="kpi-value tabular-nums">100%</span>
                <span class="kpi-label">Vérification sur le terrain</span>
            </div>
        </div>

        {{-- Commandes du carrousel --}}
        @if($heroImages->count() > 1)
        <div class="hero-carousel-nav" role="group" aria-label="Navigation des images">
            <button type="button" class="carousel-step-btn" data-carousel-previous aria-label="Diapositive précédente">
                <i class="bi bi-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="carousel-dots-list">
                @foreach($heroImages as $index => $image)
                    <button
                        type="button"
                        class="carousel-dot{{ $loop->first ? ' is-active' : '' }}"
                        data-carousel-dot="{{ $index }}"
                        aria-label="Diapositive {{ $index + 1 }}"
                        aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                    </button>
                @endforeach
            </div>
            <button type="button" class="carousel-step-btn" data-carousel-next aria-label="Diapositive suivante">
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
        @endif
    </div>
</section>

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION BIENS EN VEDETTE (SURFACES & CARTES MATÉRIELLES)           ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="featured-section">
    <div class="section-container">
        <div class="section-header">
            <div class="section-titles">
                <span class="section-eyebrow">Sélection Rigoureuse</span>
                <h2 class="section-heading">Dernières opportunités immobilières</h2>
                <p class="section-subtitle">Chaque bien a été visité et ses pièces justificatives foncières vérifiées par nos soins.</p>
            </div>
            <div class="section-header-actions">
                <a href="{{ route('annonces.index') }}" class="btn btn-secondary">
                    <span>Explorer toutes les annonces</span>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        {{-- Filtres de catégories rapides (Pills solides) --}}
        <div class="quick-category-pills" role="tablist">
            <a href="{{ route('annonces.index') }}" class="category-pill active">Tous les biens</a>
            <a href="{{ route('annonces.index', ['type_offre' => 'court_sejour']) }}" class="category-pill">
                <i class="bi bi-moon-stars-fill"></i> Hôtels & Résidences
            </a>
            <a href="{{ route('annonces.index', ['type_offre' => 'vente']) }}" class="category-pill">En Vente</a>
            <a href="{{ route('annonces.index', ['type_offre' => 'location']) }}" class="category-pill">En Location</a>
            <a href="{{ route('annonces.index', ['type_bien' => 'villa']) }}" class="category-pill">Villas</a>
            <a href="{{ route('annonces.index', ['type_bien' => 'terrain']) }}" class="category-pill">Terrains</a>
        </div>

        {{-- Grille des annonces récentes --}}
        <div class="properties-grid">
            @forelse($annoncesRecentes as $annonce)
            <article class="property-card" onclick="window.location='{{ route('annonces.show', $annonce->id) }}'">
                {{-- Cadre média solide avec ratio 16:10 --}}
                <div class="card-media">
                    @if($annonce->images && count($annonce->images) > 0)
                        <img
                            src="{{ asset('storage/' . $annonce->images[0]) }}"
                            alt="{{ $annonce->titre }}"
                            class="card-img"
                            loading="lazy">
                    @else
                        {{-- Placeholder architectural solide (Zéro Dégradé) --}}
                        <div class="card-img-placeholder" aria-hidden="true">
                            <i class="bi bi-building"></i>
                            <span>ImmoPro Cliché en cours</span>
                        </div>
                    @endif

                    {{-- Badges flottants --}}
                    <div class="card-badges-row">
                        <span class="badge-tag {{ $annonce->isCourtSejour() ? 'tag-court-sejour' : ($annonce->type_offre === 'vente' ? 'tag-vente' : 'tag-location') }}">
                            {{ $annonce->isCourtSejour() ? 'COURT SÉJOUR' : strtoupper($annonce->type_offre ?? 'VENTE') }}
                        </span>
                        <span class="badge-tag tag-type">
                            {{ $annonce->type_bien_label ?? ucfirst($annonce->type_bien ?? 'Bien') }}
                        </span>
                    </div>

                    {{-- Prix solide en pilule avec tabular-nums --}}
                    <div class="card-price-pill tabular-nums">
                        {{ number_format($annonce->prix, 0, ',', ' ') }} <span class="currency">FCFA</span>{{ $annonce->isCourtSejour() ? '/nuit' : ($annonce->type_offre === 'location' ? '/mois' : '') }}
                    </div>
                </div>

                {{-- Corps de la carte --}}
                <div class="card-body">
                    <div class="card-location">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <span>{{ $annonce->quartier ?? 'Korhogo' }}, Côte d'Ivoire</span>
                    </div>

                    <h3 class="card-title">
                        <a href="{{ route('annonces.show', $annonce->id) }}">
                            {{ $annonce->titre }}
                        </a>
                    </h3>

                    <p class="card-description">
                        {{ Str::limit($annonce->description, 110) }}
                    </p>

                    {{-- Caractéristiques techniques en chiffres tabulaires --}}
                    <div class="card-specs-strip">
                        @if($annonce->superficie)
                        <div class="spec-unit" title="Superficie">
                            <i class="bi bi-arrows-fullscreen spec-icon" aria-hidden="true"></i>
                            <span class="spec-number tabular-nums">{{ $annonce->superficie }}</span>
                            <span class="spec-label">m²</span>
                        </div>
                        @endif

                        @if($annonce->nombre_chambres)
                        <div class="spec-unit" title="Chambres">
                            <i class="bi bi-door-open spec-icon" aria-hidden="true"></i>
                            <span class="spec-number tabular-nums">{{ $annonce->nombre_chambres }}</span>
                            <span class="spec-label">chb</span>
                        </div>
                        @endif

                        @if($annonce->nombre_salles_bain)
                        <div class="spec-unit" title="Salles de bain">
                            <i class="bi bi-droplet spec-icon" aria-hidden="true"></i>
                            <span class="spec-number tabular-nums">{{ $annonce->nombre_salles_bain }}</span>
                            <span class="spec-label">sdb</span>
                        </div>
                        @elseif($annonce->nombre_pieces)
                        <div class="spec-unit" title="Pièces totales">
                            <i class="bi bi-grid-1x2 spec-icon" aria-hidden="true"></i>
                            <span class="spec-number tabular-nums">{{ $annonce->nombre_pieces }}</span>
                            <span class="spec-label">pces</span>
                        </div>
                        @endif
                    </div>

                    {{-- Séparateur structurel 1px --}}
                    <div class="card-footer-strip">
                        <div class="card-publisher">
                            <span class="publisher-avatar" aria-hidden="true">
                                {{ strtoupper(substr($annonce->user->name ?? 'A', 0, 1)) }}
                            </span>
                            <span class="publisher-name">
                                {{ $annonce->user->name ?? 'Agence Partenaire' }}
                            </span>
                        </div>

                        <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-secondary btn-sm" onclick="event.stopPropagation();">
                            <span>Consulter</span>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            {{-- État vide structuré (empty state) conforme à skill_design --}}
            <div class="empty-state-card">
                <div class="empty-icon-wrap" aria-hidden="true">
                    <i class="bi bi-inbox"></i>
                </div>
                <h3 class="empty-title">Aucune annonce actuellement publiée</h3>
                <p class="empty-desc">
                    Nous renouvelons régulièrement nos biens immobiliers. Vous pouvez publier votre annonce dès aujourd'hui ou découvrir notre catalogue complet.
                </p>
                <div class="empty-actions">
                    @auth
                        @if(auth()->user()->peutPublierAnnonce())
                        <a href="{{ route('annonces.create') }}" class="btn btn-cta">
                            <i class="bi bi-plus-lg" aria-hidden="true"></i>
                            <span>Déposer la première annonce</span>
                        </a>
                        @else
                        <a href="{{ route('annonces.index') }}" class="btn btn-cta">
                            <i class="bi bi-search" aria-hidden="true"></i>
                            <span>Voir le catalogue complet</span>
                        </a>
                        @endif
                    @else
                        <a href="{{ route('annonces.create') }}" class="btn btn-cta">
                            <i class="bi bi-plus-lg" aria-hidden="true"></i>
                            <span>Déposer la première annonce</span>
                        </a>
                    @endauth
                </div>
            </div>
            @endforelse
        </div>

        @if($annoncesRecentes->count() > 0)
        <div class="section-footer-cta">
            <a href="{{ route('annonces.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-buildings" aria-hidden="true"></i>
                <span>Parcourir l'ensemble du catalogue</span>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION LES 4 PILIERS DE CONFIANCE (SURFACE RAISED SOLIDE)          ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="pillars-section">
    <div class="section-container">
        <div class="pillars-header">
            <span class="section-eyebrow">Notre Engagement de Rigueur</span>
            <h2 class="section-heading">Une sécurité juridique et technique sans compromis</h2>
            <p class="section-subtitle">Nous instaurons un standard de transparence immobilière inédit en Côte d'Ivoire.</p>
        </div>

        <div class="pillars-grid">
            {{-- Pilier 1 --}}
            <div class="pillar-card">
                <div class="pillar-icon-box" aria-hidden="true">
                    <i class="bi bi-file-earmark-check"></i>
                </div>
                <h3 class="pillar-title">Titres Fonciers Vérifiés</h3>
                <p class="pillar-text">
                    Chaque terrain ou maison est soumis à une vérification systématique de son titre (ACD, CMP, Lettre d'Attribution) auprès du cadastre.
                </p>
            </div>

            {{-- Pilier 2 --}}
            <div class="pillar-card">
                <div class="pillar-icon-box" aria-hidden="true">
                    <i class="bi bi-pin-map"></i>
                </div>
                <h3 class="pillar-title">Ancrage Local à Korhogo</h3>
                <p class="pillar-text">
                    Une connaissance approfondie des quartiers de Korhogo (Résidentiel, Sinistré, Belle-Ville, Koko) et des dynamiques du marché du Poro.
                </p>
            </div>

            {{-- Pilier 3 --}}
            <div class="pillar-card">
                <div class="pillar-icon-box" aria-hidden="true">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h3 class="pillar-title">Transactions Sécurisées</h3>
                <p class="pillar-text">
                    Accompagnement notarié rigoureux. Aucun versement d'acompte sans quittance légale et contrat d'engagement scellé.
                </p>
            </div>

            {{-- Pilier 4 --}}
            <div class="pillar-card">
                <div class="pillar-icon-box" aria-hidden="true">
                    <i class="bi bi-headset"></i>
                </div>
                <h3 class="pillar-title">Conseillers Dédiés 7j/7</h3>
                <p class="pillar-text">
                    Des interlocuteurs physiquement disponibles pour organiser vos visites sur mesure, vous conseiller et négocier au juste prix.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  BANNIÈRE CTA ARCHITECTURALE (SURFACE SOMBRE SOLIDE, SANS DÉGRADÉ)  ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="cta-banner-section">
    <div class="section-container">
        <div class="cta-banner-box">
            <div class="cta-content">
                <span class="cta-badge">Propriétaires & Promoteurs</span>
                <h2 class="cta-title">Valorisez votre patrimoine immobilier à Korhogo</h2>
                <p class="cta-desc">
                    Rejoignez la plateforme immobilière la plus visitée du nord de la Côte d'Ivoire.
                    Touchez des acheteurs solvables et des locataires qualifiés en moins de 48 heures.
                </p>
                <div class="cta-actions">
                    @auth
                        @if(auth()->user()->peutPublierAnnonce())
                        <a href="{{ route('annonces.create') }}" class="btn btn-brand btn-lg">
                            <i class="bi bi-plus-circle" aria-hidden="true"></i>
                            <span>Déposer une annonce maintenant</span>
                        </a>
                        @else
                        <a href="{{ route('annonces.index') }}" class="btn btn-brand btn-lg">
                            <i class="bi bi-search" aria-hidden="true"></i>
                            <span>Consulter nos biens disponibles</span>
                        </a>
                        @endif
                    @else
                        <a href="{{ route('annonces.create') }}" class="btn btn-brand btn-lg">
                            <i class="bi bi-plus-circle" aria-hidden="true"></i>
                            <span>Déposer une annonce maintenant</span>
                        </a>
                    @endauth
                    <a href="{{ route('contact') }}" class="btn btn-inverse-outline btn-lg">
                        <i class="bi bi-telephone" aria-hidden="true"></i>
                        <span>Parler à un conseiller</span>
                    </a>
                </div>
            </div>

            <div class="cta-stats-card" aria-hidden="true">
                <div class="cta-stat-item">
                    <span class="stat-number tabular-nums">48h</span>
                    <span class="stat-text">Délai moyen de première visite</span>
                </div>
                <div class="cta-divider"></div>
                <div class="cta-stat-item">
                    <span class="stat-number tabular-nums">0 FCFA</span>
                    <span class="stat-text">Frais de mise en ligne initiale</span>
                </div>
                <div class="cta-divider"></div>
                <div class="cta-stat-item">
                    <span class="stat-number tabular-nums">100%</span>
                    <span class="stat-text">Visibilité ciblée Korhogo & Diaspora</span>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES DE LA PAGE D'ACCUEIL (ZÉRO DÉGRADÉ, STANDARDS SENIOR)        ║
       ╚══════════════════════════════════════════════════════════════════════╝ */

    /* Hero Architecturale */
    .hero-arch {
        position: relative;
        background-color: var(--surface-dark-sunken) ;
        color: var(--white);
        padding-top: clamp(3rem, 7vw, 6rem);
        padding-bottom: clamp(4rem, 8vw, 7rem);
        overflow: hidden;
        border-bottom: 1px solid var(--border-dark);
    }

    .hero-carousel-viewport {
        position: absolute;
        inset: 0;
        z-index: 1;
        overflow: hidden;
    }

    .hero-carousel-slide,
    .hero-carousel__slide {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 600ms var(--ease-out-expo);
        transform: scale(1.02);
    }

    .hero-carousel-slide.is-active,
    .hero-carousel__slide.is-active {
        opacity: 0.35; /* Légère présence photo sous le voile solide */
        transform: scale(1);
        transition: opacity 600ms var(--ease-out-expo), transform 6000ms linear;
    }

    /* Voile solide pour contraste mathématique sans dégradé */
    .hero-solid-scrim {
        position: absolute;
        inset: 0;
        background-color: oklch(0.145 0.015 250 / 0.88);
        border-bottom: 1px solid var(--border-dark);
    }

    .hero-container {
        position: relative;
        z-index: 2;
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    .hero-header-box {
        max-width: 760px;
        margin-bottom: 2.75rem;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.85rem;
        background-color: var(--surface-dark-raised);
        border: 1px solid var(--border-dark);
        border-radius: var(--radius-full);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--accent-warm);
        margin-bottom: 1.5rem;
        box-shadow: inset 0 1px 0 0 oklch(1 0 0 / 0.1);
    }

    .hero-title {
        font-size: clamp(2.25rem, 5vw, 3.75rem);
        color: var(--text-inverse);
        line-height: 1.12;
        margin-bottom: 1.25rem;
        letter-spacing: -0.025em;
    }

    .hero-title-accent {
        color: var(--accent-brand);
    }

    .hero-desc {
        font-size: clamp(1rem, 1.8vw, 1.15rem);
        line-height: 1.65;
        color: var(--text-inverse-muted);
        max-width: 620px;
    }

    /* Moteur de Recherche Rapide (Carte Surélevée) */
    .hero-search-card {
        background-color: var(--surface-raised);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-subtle);
        box-shadow: var(--shadow-overlay);
        padding: 1.25rem;
        margin-bottom: 3rem;
    }

    .hero-search-form {
        display: grid;
        grid-template-columns: 1.2fr 1.3fr 1.5fr 1.3fr auto;
        gap: 0.75rem;
        align-items: flex-end;
    }

    .search-field {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .field-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-secondary);
    }

    .field-control {
        width: 100%;
        height: 44px;
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

    .field-control:hover {
        border-color: var(--border-strong);
    }

    .field-control:focus {
        outline: none;
        background-color: var(--surface-raised);
        border-color: var(--accent-brand);
        box-shadow: 0 0 0 3px oklch(0.460 0.075 195 / 0.15);
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        padding-inline-end: 2rem;
        cursor: pointer;
    }

    .select-chevron {
        position: absolute;
        inset-inline-end: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.75rem;
        color: var(--text-muted);
        pointer-events: none;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon-wrapper .input-icon {
        position: absolute;
        inset-inline-start: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.9rem;
        color: var(--text-muted);
        pointer-events: none;
    }

    .field-control.with-icon {
        padding-inline-start: 2.25rem;
    }

    .btn-search-submit {
        height: 44px;
        padding-inline: 1.5rem;
    }

    /* Barre de KPIs tabulaires */
    .hero-kpis-strip {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border-dark);
    }

    .kpi-block {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .kpi-value {
        font-family: 'Playfair Display', serif;
        font-size: 2.1rem;
        font-weight: 700;
        color: var(--text-inverse);
        line-height: 1;
    }

    .kpi-label {
        font-size: 0.8rem;
        color: var(--text-inverse-muted);
        font-weight: 500;
    }

    .kpi-separator {
        width: 1px;
        height: 38px;
        background-color: var(--border-dark);
    }

    /* Commandes du Carrousel */
    .hero-carousel-nav {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 2rem;
    }

    .carousel-step-btn {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-xs);
        background-color: var(--surface-dark-base);
        border: 1px solid var(--border-dark);
        color: var(--text-inverse);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color var(--duration-fast) var(--ease-out-expo);
    }

    .carousel-step-btn:hover {
        background-color: var(--surface-dark-raised);
    }

    .carousel-dots-list {
        display: flex;
        gap: 0.4rem;
    }

    .carousel-dot {
        width: 8px;
        height: 8px;
        padding: 0;
        border: none;
        border-radius: var(--radius-full);
        background-color: oklch(1 0 0 / 0.25);
        cursor: pointer;
        transition: background-color var(--duration-fast) var(--ease-out-expo),
                    width var(--duration-fast) var(--ease-out-expo);
    }

    .carousel-dot.is-active {
        width: 22px;
        background-color: var(--accent-warm);
    }

    /* Section Biens en vedette */
    .featured-section {
        padding-block: 5rem;
        background-color: var(--surface-sunken);
    }

    .section-container {
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    .section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .section-eyebrow {
        display: inline-block;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--accent-brand);
        margin-bottom: 0.4rem;
    }

    .section-heading {
        font-size: clamp(1.75rem, 3.2vw, 2.35rem);
        color: var(--text-primary);
        letter-spacing: -0.02em;
    }

    .section-subtitle {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-top: 0.35rem;
    }

    /* Quick category pills */
    .quick-category-pills {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 2.25rem;
    }

    .category-pill {
        padding: 0.45rem 1rem;
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-full);
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-secondary);
        transition: background-color var(--duration-fast) var(--ease-out-expo),
                    color var(--duration-fast) var(--ease-out-expo),
                    border-color var(--duration-fast) var(--ease-out-expo);
    }

    .category-pill:hover {
        background-color: var(--surface-sunken);
        color: var(--text-primary);
        border-color: var(--border-strong);
    }

    .category-pill.active {
        background-color: var(--accent-primary);
        color: var(--surface-raised);
        border-color: var(--accent-primary);
        box-shadow: inset 0 1px 0 0 oklch(1 0 0 / 0.12);
    }

    /* Grille de Propriétés */
    .properties-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    /* Carte de Bien Immobilière (Surface Stacking + Hairline 1px) */
    .property-card {
        background-color: var(--surface-raised);
        border-radius: var(--radius-md);
        border: 1px solid var(--border-subtle);
        box-shadow: var(--shadow-raised);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform var(--duration-base) var(--ease-out-expo),
                    box-shadow var(--duration-base) var(--ease-out-expo),
                    border-color var(--duration-base) var(--ease-out-expo);
    }

    .property-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-card);
        border-color: var(--border-default);
    }

    .card-media {
        position: relative;
        height: 230px;
        background-color: var(--surface-dark-base);
        overflow: hidden;
        border-bottom: 1px solid var(--border-subtle);
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 400ms var(--ease-out-expo);
    }

    .property-card:hover .card-img {
        transform: scale(1.03);
    }

    .card-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background-color: var(--surface-dark-base);
        color: var(--text-inverse-muted);
    }

    .card-img-placeholder i {
        font-size: 2.5rem;
        color: var(--border-dark);
    }

    .card-img-placeholder span {
        font-size: 0.75rem;
        font-family: 'JetBrains Mono', monospace;
    }

    .card-badges-row {
        position: absolute;
        top: 0.85rem;
        inset-inline-start: 0.85rem;
        display: flex;
        gap: 0.4rem;
        z-index: 2;
    }

    .badge-tag {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.25rem 0.65rem;
        border-radius: var(--radius-xs);
        border: 1px solid transparent;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .tag-vente {
        background-color: var(--color-primary);
        color: #ffffff;
        border-color: var(--color-primary);
        box-shadow: 0 1px 2px rgba(27, 58, 92, 0.2);
    }

    .tag-location {
        background-color: var(--color-secondary);
        color: #ffffff;
        border-color: var(--color-secondary);
        box-shadow: 0 1px 2px rgba(90, 107, 123, 0.2);
    }

    .tag-type {
        background-color: #ffffff;
        color: var(--color-text-main);
        border-color: var(--border-default);
    }

    /* Pilule de prix solide */
    .card-price-pill {
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

    .card-price-pill .currency {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--color-cta);
    }

    /* Corps de carte */
    .card-body {
        padding: 1.35rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .card-location {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--color-secondary);
        margin-bottom: 0.4rem;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }

    .card-title a {
        color: var(--text-primary);
    }

    .card-title a:hover {
        color: var(--color-cta);
    }

    .card-description {
        font-size: 0.84rem;
        color: var(--text-secondary);
        line-height: 1.55;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Specs strip */
    .card-specs-strip {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding-block: 0.85rem;
        border-top: 1px solid var(--border-subtle);
        margin-top: auto;
    }

    .spec-unit {
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
        font-size: 0.85rem;
        color: var(--text-primary);
    }

    .spec-icon {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .spec-number {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
    }

    .spec-label {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .card-footer-strip {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.85rem;
        border-top: 1px solid var(--border-subtle);
    }

    .card-publisher {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .publisher-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--text-secondary);
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .publisher-name {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text-secondary);
    }

    /* État vide */
    .empty-state-card {
        grid-column: 1 / -1;
        background-color: var(--surface-raised);
        border-radius: var(--radius-md);
        border: 1px dashed var(--border-strong);
        padding: 4rem 2rem;
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
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

    .empty-title {
        font-size: 1.25rem;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-desc {
        font-size: 0.9rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .section-footer-cta {
        text-align: center;
        margin-top: 3.5rem;
    }

    /* Section Piliers de Confiance */
    .pillars-section {
        padding-block: 5.5rem;
        background-color: var(--surface-base);
        border-top: 1px solid var(--border-subtle);
        border-bottom: 1px solid var(--border-subtle);
    }

    .pillars-header {
        text-align: center;
        max-width: 650px;
        margin: 0 auto 3.5rem;
    }

    .pillars-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    .pillar-card {
        background-color: var(--surface-raised);
        border-radius: var(--radius-md);
        border: 1px solid var(--border-subtle);
        padding: 2.25rem 1.75rem;
        box-shadow: var(--shadow-raised);
        transition: transform var(--duration-fast) var(--ease-out-expo),
                    border-color var(--duration-fast) var(--ease-out-expo);
    }

    .pillar-card:hover {
        transform: translateY(-2px);
        border-color: var(--border-default);
    }

    .pillar-icon-box {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--accent-brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin-bottom: 1.25rem;
    }

    .pillar-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.65rem;
    }

    .pillar-text {
        font-size: 0.875rem;
        color: var(--text-secondary);
        line-height: 1.65;
    }

    /* Bannière CTA Finale */
    .cta-banner-section {
        padding-block: 5rem;
        background-color: var(--surface-sunken);
    }

    .cta-banner-box {
        background-color: var(--surface-dark-base);
        color: var(--text-inverse);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-dark);
        padding: clamp(2.5rem, 5vw, 4rem);
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 3.5rem;
        align-items: center;
        box-shadow: var(--shadow-card);
    }

    .cta-badge {
        display: inline-block;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--accent-warm);
        margin-bottom: 0.75rem;
    }

    .cta-title {
        font-size: clamp(1.75rem, 3.2vw, 2.5rem);
        color: var(--text-inverse);
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .cta-desc {
        color: var(--text-inverse-muted);
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 540px;
    }

    .cta-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .cta-stats-card {
        background-color: var(--surface-dark-sunken);
        border: 1px solid var(--border-dark);
        border-radius: var(--radius-md);
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .cta-stat-item {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .stat-number {
        font-family: 'Playfair Display', serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--text-inverse);
        line-height: 1;
    }

    .stat-text {
        font-size: 0.8rem;
        color: var(--text-inverse-muted);
    }

    .cta-divider {
        height: 1px;
        background-color: var(--border-dark);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-search-form {
            grid-template-columns: 1fr 1fr;
        }

        .search-action {
            grid-column: 1 / -1;
        }

        .btn-search-submit {
            width: 100%;
        }

        .cta-banner-box {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
    }

    @media (max-width: 640px) {
        .hero-search-form {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .hero-kpis-strip {
            gap: 1.5rem;
        }

        .kpi-separator {
            display: none;
        }

        .properties-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Carrousel héroïque fluide
    document.querySelectorAll('.hero-arch').forEach((hero) => {
        const slides = Array.from(hero.querySelectorAll('.hero-carousel__slide, .hero-carousel-slide'));
        const dots = Array.from(hero.querySelectorAll('[data-carousel-dot]'));
        const prevBtn = hero.querySelector('[data-carousel-previous]');
        const nextBtn = hero.querySelector('[data-carousel-next]');

        if (slides.length < 2) return;

        let activeIdx = 0;

        const setSlide = (idx) => {
            activeIdx = (idx + slides.length) % slides.length;
            slides.forEach((slide, i) => {
                slide.classList.toggle('is-active', i === activeIdx);
            });
            dots.forEach((dot, i) => {
                const isActive = i === activeIdx;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-pressed', String(isActive));
            });
        };

        if (prevBtn) prevBtn.addEventListener('click', () => setSlide(activeIdx - 1));
        if (nextBtn) nextBtn.addEventListener('click', () => setSlide(activeIdx + 1));

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => setSlide(i));
        });

        // Rotation automatique délicate
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            setInterval(() => setSlide(activeIdx + 1), 7000);
        }
    });
</script>
@endpush

@endsection