@extends('layouts.app')

@section('title', 'À Propos — ImmoPro Côte d\'Ivoire')

@section('content')

<div class="about-page">

    {{-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  HERO SECTION DE LA PAGE À PROPOS (SOLIDE, SANS DÉGRADÉ)            ║
         ╚══════════════════════════════════════════════════════════════════════╝ --}}
    <section class="about-hero-section">
        <div class="about-hero-container">
            <div class="about-hero-eyebrow">
                <i class="bi bi-compass" aria-hidden="true"></i>
                <span>Notre Histoire & Raison d'Être</span>
            </div>

            <h1 class="about-hero-title">
                Redéfinir le standard immobilier<br>
                <span class="hero-accent">par la rigueur et l'intégrité.</span>
            </h1>

            <p class="about-hero-lead">
                Fondée avec la volonté de professionnaliser les transactions foncières et résidentielles à Korhogo et en Côte d'Ivoire, ImmoPro allie expertise de terrain, vérification juridique et technologies modernes.
            </p>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  BARRE DES CHIFFRES CLÉS (TABULAR-NUMS)                             ║
         ╚══════════════════════════════════════════════════════════════════════╝ --}}
    <section class="about-metrics-section">
        <div class="about-container">
            <div class="metrics-grid">
                <div class="metric-card">
                    <span class="metric-num tabular-nums">100%</span>
                    <span class="metric-title">Biens audités au cadastre</span>
                    <p class="metric-sub">Aucun bien mis en ligne sans justificatif de propriété vérifié.</p>
                </div>

                <div class="metric-card">
                    <span class="metric-num tabular-nums">48h</span>
                    <span class="metric-title">Délai d'organisation de visite</span>
                    <p class="metric-sub">Un réseau d'experts réactifs sur tout le territoire de Korhogo.</p>
                </div>

                <div class="metric-card">
                    <span class="metric-num tabular-nums">0 FCFA</span>
                    <span class="metric-title">Frais d'intermédiaire cachés</span>
                    <p class="metric-sub">Tarification transparente scellée par mandat écrit.</p>
                </div>

                <div class="metric-card">
                    <span class="metric-num tabular-nums">10+</span>
                    <span class="metric-title">Années d'ancrage régional</span>
                    <p class="metric-sub">Une maîtrise intime des dynamiques urbaines du Poro.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  NOTRE MISSION & VISION ARCHITECTURALE                              ║
         ╚══════════════════════════════════════════════════════════════════════╝ --}}
    <section class="about-pillars-section">
        <div class="about-container">
            <div class="section-title-wrap">
                <span class="section-eyebrow">Nos Fondations</span>
                <h2 class="section-heading">Une vision axée sur la sécurisation foncière</h2>
                <p class="section-desc">Face à la complexité des transactions en Afrique de l'Ouest, nous apportons clarté, traçabilité et conseil avisé.</p>
            </div>

            <div class="vision-grid">
                <div class="vision-card">
                    <div class="vision-icon-wrap" aria-hidden="true">
                        <i class="bi bi-shield-shaded"></i>
                    </div>
                    <h3 class="vision-title">Sécurité Juridique Absolue</h3>
                    <p class="vision-text">
                        En Côte d'Ivoire, l'achat d'un terrain ou d'un immeuble nécessite une vigilance extrême. Nous travaillons main dans la main avec les services du Ministère de la Construction et les notaires pour valider les ACD, CMP et droits coutumiers purgés.
                    </p>
                </div>

                <div class="vision-card">
                    <div class="vision-icon-wrap" aria-hidden="true">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h3 class="vision-title">Ancrage Nord & National</h3>
                    <p class="vision-text">
                        Korhogo connaît un essor économique et universitaire sans précédent. Nous offrons aux résidents locaux comme à la diaspora ivoirienne un canal fiable pour investir sereinement dans leur région d'origine.
                    </p>
                </div>

                <div class="vision-card">
                    <div class="vision-icon-wrap" aria-hidden="true">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h3 class="vision-title">Technologie & Simplicité</h3>
                    <p class="vision-text">
                        Une plateforme fluide, sans décalage, responsive et optimisée pour tous les terminaux. Recherche granulaire, photographies nettes, fiches techniques précises et prise de rendez-vous directe.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  NOTRE PROCESSUS EN 4 ÉTAPES (CHORÉGRAPHIE SOLIDE)                  ║
         ╚══════════════════════════════════════════════════════════════════════╝ --}}
    <section class="about-process-section">
        <div class="about-container">
            <div class="section-title-wrap">
                <span class="section-eyebrow">Méthodologie Éprouvée</span>
                <h2 class="section-heading">Comment nous protégeons votre projet</h2>
            </div>

            <div class="process-grid">
                <div class="process-card">
                    <span class="process-step-num tabular-nums">01</span>
                    <h4 class="process-step-title">Audit Initial & Visite</h4>
                    <p class="process-step-desc">Inspection physique du bien sur le terrain, relevé photographique et métrage réel des superficies.</p>
                </div>

                <div class="process-card">
                    <span class="process-step-num tabular-nums">02</span>
                    <h4 class="process-step-title">Contrôle Foncier</h4>
                    <p class="process-step-desc">Vérification de l'authenticité des titres auprès de la conservation foncière et des autorités préfectorales.</p>
                </div>

                <div class="process-card">
                    <span class="process-step-num tabular-nums">03</span>
                    <h4 class="process-step-title">Visite Accompagnée</h4>
                    <p class="process-step-desc">Organisation d'une visite détaillée avec un conseiller accrédité qui répond à toutes les questions techniques.</p>
                </div>

                <div class="process-card">
                    <span class="process-step-num tabular-nums">04</span>
                    <h4 class="process-step-title">Signature Notariée</h4>
                    <p class="process-step-desc">Rédaction des actes officiels devant notaire, sécurisation des fonds et remise solennelle des clés.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  BANNIÈRE CTA SOLIDE                                                ║
         ╚══════════════════════════════════════════════════════════════════════╝ --}}
    <section class="about-cta-section">
        <div class="about-container">
            <div class="about-cta-panel">
                <h2 class="cta-heading">Vous avez un projet immobilier à Korhogo ?</h2>
                <p class="cta-text">Que vous souhaitiez acquérir une villa, louer un local commercial ou valoriser un lotissement, nos équipes vous accueillent.</p>
                <div class="cta-buttons-wrap">
                    <a href="{{ route('annonces.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-buildings" aria-hidden="true"></i>
                        <span>Explorer les biens</span>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-chat-square-dots" aria-hidden="true"></i>
                        <span>Échanger avec un conseiller</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES DE LA PAGE À PROPOS (STANDARDS SKILL_DESIGN, ZÉRO DÉGRADÉ)   ║
       ╚══════════════════════════════════════════════════════════════════════╝ */
    .about-page {
        background-color: var(--surface-sunken);
    }

    .about-container {
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    /* Hero */
    .about-hero-section {
        background-color: var(--surface-dark-sunken);
        color: var(--text-inverse);
        padding-block: clamp(4rem, 8vw, 6.5rem);
        border-bottom: 1px solid var(--border-dark);
        text-align: center;
    }

    .about-hero-container {
        max-width: 800px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    .about-hero-eyebrow {
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
    }

    .about-hero-title {
        font-size: clamp(2rem, 4.5vw, 3.25rem);
        color: var(--text-inverse);
        line-height: 1.15;
        margin-bottom: 1.25rem;
        letter-spacing: -0.025em;
    }

    .hero-accent {
        color: var(--accent-brand);
    }

    .about-hero-lead {
        font-size: clamp(1rem, 1.8vw, 1.15rem);
        color: var(--text-inverse-muted);
        line-height: 1.7;
    }

    /* Chiffres clés */
    .about-metrics-section {
        padding-block: 4.5rem;
        background-color: var(--surface-sunken);
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .metric-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 2rem 1.75rem;
        box-shadow: var(--shadow-raised);
        display: flex;
        flex-direction: column;
    }

    .metric-num {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent-primary);
        line-height: 1;
        margin-bottom: 0.75rem;
    }

    .metric-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.35rem;
    }

    .metric-sub {
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.55;
    }

    /* Piliers / Vision */
    .about-pillars-section {
        padding-block: 5.5rem;
        background-color: var(--surface-base);
        border-top: 1px solid var(--border-subtle);
        border-bottom: 1px solid var(--border-subtle);
    }

    .section-title-wrap {
        text-align: center;
        max-width: 650px;
        margin: 0 auto 3.5rem;
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

    .section-desc {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-top: 0.4rem;
    }

    .vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .vision-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 2.25rem 2rem;
        box-shadow: var(--shadow-raised);
    }

    .vision-icon-wrap {
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

    .vision-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.65rem;
    }

    .vision-text {
        font-size: 0.88rem;
        color: var(--text-secondary);
        line-height: 1.7;
    }

    /* Processus */
    .about-process-section {
        padding-block: 5.5rem;
        background-color: var(--surface-sunken);
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .process-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 2rem 1.75rem;
        box-shadow: var(--shadow-raised);
        position: relative;
    }

    .process-step-num {
        font-family: 'JetBrains Mono', monospace;
        font-size: 2rem;
        font-weight: 700;
        color: var(--accent-brand);
        display: block;
        margin-bottom: 0.75rem;
        line-height: 1;
    }

    .process-step-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .process-step-desc {
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    /* CTA final */
    .about-cta-section {
        padding-block: 5rem;
        background-color: var(--surface-sunken);
    }

    .about-cta-panel {
        background-color: var(--surface-dark-base);
        color: var(--text-inverse);
        border: 1px solid var(--border-dark);
        border-radius: var(--radius-lg);
        padding: clamp(2.5rem, 6vw, 4rem) 2rem;
        text-align: center;
        max-width: 900px;
        margin: 0 auto;
        box-shadow: var(--shadow-card);
    }

    .cta-heading {
        font-size: clamp(1.75rem, 3.2vw, 2.35rem);
        color: var(--text-inverse);
        line-height: 1.25;
        margin-bottom: 0.85rem;
    }

    .cta-text {
        font-size: 1rem;
        color: var(--text-inverse-muted);
        line-height: 1.7;
        max-width: 580px;
        margin: 0 auto 2rem;
    }

    .cta-buttons-wrap {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
</style>
@endpush

@endsection