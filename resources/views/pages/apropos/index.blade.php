@extends('layouts.app')

@section('title', 'À propos — ImmoPro')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    /* ═══════════════════════════════
       HERO
       ═══════════════════════════════ */
    .about-hero {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        background:
            linear-gradient(160deg, #041e2b 0%, #0a3d52 40%, #0d9488 100%);
    }

    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.25) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.04) 0%, transparent 40%);
        pointer-events: none;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 80px;
        background: #fafafa;
        clip-path: polygon(0 60%, 100% 0%, 100% 100%, 0 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 720px;
        padding: 5rem 2rem 6rem;
        animation: fadeUp 0.7s ease forwards;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        padding: 0.4rem 1rem;
        border-radius: 100px;
        font-size: 0.78rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.85);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 1.5rem;
    }

    .hero-badge i {
        font-size: 0.72rem;
        color: #5eead4;
    }

    .hero-content h1 {
        font-size: 3.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin: 0 0 1.2rem;
    }

    .hero-content h1 span {
        background: linear-gradient(135deg, #5eead4, #0d9488);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-content p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.7;
        margin: 0;
    }

    /* ═══════════════════════════════
       SECTION BASE
       ═══════════════════════════════ */
    .about-section {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .about-container {
        max-width: 1160px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.74rem;
        font-weight: 700;
        color: #0d9488;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 0.8rem;
    }

    .section-tag i {
        font-size: 0.65rem;
    }

    .section-title {
        font-size: 2.1rem;
        font-weight: 800;
        color: #111827;
        margin: 0 0 1rem;
        line-height: 1.25;
    }

    .section-subtitle {
        font-size: 1rem;
        color: #6b7280;
        line-height: 1.7;
        margin: 0;
        max-width: 620px;
    }

    /* ═══════════════════════════════
       MISSION — 2 colonnes
       ═══════════════════════════════ */
    .mission-section {
        padding: 5rem 0 4rem;
        background: #fafafa;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: 1fr 1.1fr;
        gap: 4rem;
        align-items: center;
    }

    .mission-visual {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.08);
    }

    .mission-visual img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
    }

    .mission-visual::after {
        content: '';
        position: absolute;
        inset: 0;
        border: 1px solid rgba(0, 0, 0, 0.04);
        border-radius: 20px;
        pointer-events: none;
    }

    .mission-card-float {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(16px);
        border-radius: 14px;
        padding: 1.2rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .mission-card-float i {
        font-size: 1.8rem;
        color: #0d9488;
    }

    .mission-card-float strong {
        display: block;
        font-size: 0.95rem;
        color: #111827;
    }

    .mission-card-float span {
        font-size: 0.82rem;
        color: #9ca3af;
    }

    .mission-text p {
        font-size: 1rem;
        color: #4b5563;
        line-height: 1.8;
        margin-bottom: 1.2rem;
    }

    .mission-text p:last-child {
        margin-bottom: 0;
    }

    /* ═══════════════════════════════
       CHIFFRES CLÉS
       ═══════════════════════════════ */
    .stats-section {
        padding: 4.5rem 0;
        background: #fff;
    }

    .stats-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .stats-header .section-subtitle {
        margin: 0 auto;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .stat-card {
        text-align: center;
        padding: 2.5rem 1.5rem;
        background: #fafafa;
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
        border-color: #e5e7eb;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.4rem;
    }

    .stat-icon.teal {
        background: #f0fdfa;
        color: #0d9488;
    }

    .stat-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .stat-icon.amber {
        background: #fffbeb;
        color: #d97706;
    }

    .stat-icon.violet {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .stat-number {
        font-family: 'JetBrains Mono', monospace;
        font-size: 2.2rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
        margin-bottom: 0.4rem;
    }

    .stat-label {
        font-size: 0.88rem;
        color: #9ca3af;
        font-weight: 500;
    }

    /* ═══════════════════════════════
       VALEURS
       ═══════════════════════════════ */
    .values-section {
        padding: 5rem 0;
        background: #fafafa;
    }

    .values-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .values-header .section-subtitle {
        margin: 0 auto;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.8rem;
    }

    .value-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 2.2rem 1.8rem;
        transition: all 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.06);
        border-color: #d1d5db;
    }

    .value-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 1.3rem;
        margin-bottom: 1.3rem;
    }

    .value-icon.teal {
        background: #f0fdfa;
        color: #0d9488;
    }

    .value-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .value-icon.amber {
        background: #fffbeb;
        color: #d97706;
    }

    .value-icon.rose {
        background: #fef2f2;
        color: #e11d48;
    }

    .value-icon.violet {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .value-icon.green {
        background: #f0fdf4;
        color: #16a34a;
    }

    .value-card h3 {
        font-size: 1.08rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.6rem;
    }

    .value-card p {
        font-size: 0.88rem;
        color: #6b7280;
        line-height: 1.65;
        margin: 0;
    }

    /* ═══════════════════════════════
       PROCESSUS
       ═══════════════════════════════ */
    .process-section {
        padding: 5rem 0;
        background: #fff;
    }

    .process-header {
        text-align: center;
        margin-bottom: 3.5rem;
    }

    .process-header .section-subtitle {
        margin: 0 auto;
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        position: relative;
    }

    .process-steps::before {
        content: '';
        position: absolute;
        top: 40px;
        left: 12.5%;
        right: 12.5%;
        height: 2px;
        background: repeating-linear-gradient(90deg,
                #0d9488 0px,
                #0d9488 8px,
                transparent 8px,
                transparent 16px);
        opacity: 0.3;
        z-index: 0;
    }

    .process-step {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .step-circle {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d9488, #0f766e);
        color: #fff;
        font-size: 1.6rem;
        box-shadow: 0 8px 24px rgba(13, 148, 136, 0.25);
        position: relative;
    }

    .step-circle::after {
        content: attr(data-step);
        position: absolute;
        top: -4px;
        right: -4px;
        width: 24px;
        height: 24px;
        background: #111827;
        color: #fff;
        border-radius: 50%;
        font-size: 0.65rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    .process-step h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.4rem;
    }

    .process-step p {
        font-size: 0.82rem;
        color: #9ca3af;
        line-height: 1.55;
        margin: 0;
        padding: 0 0.5rem;
    }

    /* ═══════════════════════════════
       CTA FINAL
       ═══════════════════════════════ */
    .about-cta {
        padding: 5rem 0;
        background: #fafafa;
    }

    .cta-box {
        background: linear-gradient(155deg, #041e2b, #0a3d52, #0d9488);
        border-radius: 24px;
        padding: 4rem 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 30% 50%, rgba(13, 148, 136, 0.25), transparent 60%),
            radial-gradient(circle at 80% 30%, rgba(255, 255, 255, 0.04), transparent 40%);
        pointer-events: none;
    }

    .cta-box h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 0.8rem;
        position: relative;
    }

    .cta-box p {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.65);
        margin: 0 auto 2rem;
        max-width: 520px;
        line-height: 1.7;
        position: relative;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        position: relative;
    }

    .cta-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.9rem 2rem;
        background: #fff;
        color: #0d9488;
        border: none;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.92rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .cta-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    .cta-btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.9rem 2rem;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.92rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        backdrop-filter: blur(10px);
    }

    .cta-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.18);
        transform: translateY(-2px);
    }

    /* ═══════════════════════════════
       RESPONSIVE
       ═══════════════════════════════ */
    @media (max-width: 992px) {
        .mission-grid {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .values-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .process-steps {
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem;
        }

        .process-steps::before {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }

        .hero-content {
            padding: 4rem 1.5rem 5rem;
        }

        .section-title {
            font-size: 1.65rem;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1.8rem 1rem;
        }

        .stat-number {
            font-size: 1.7rem;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .process-steps {
            grid-template-columns: 1fr;
        }

        .cta-box {
            padding: 3rem 1.5rem;
        }

        .cta-box h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 1.85rem;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<div class="about-section">

    {{-- ═══════════════════════════
         HERO
         ═══════════════════════════ --}}
    <div class="about-hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-building"></i> Qui sommes-nous
            </div>
            <h1>Nous rendons l'immobilier <span>simple et accessible</span></h1>
            <p>
                ImmoPro est née de la conviction que trouver, vendre ou louer un bien
                immobilier ne devrait jamais être compliqué. Nous construisons l'outil
                que nous aurions aimé avoir.
            </p>
        </div>
    </div>

    {{-- ═══════════════════════════
         MISSION
         ═══════════════════════════ --}}
    <div class="mission-section">
        <div class="about-container">
            <div class="mission-grid">
                <div class="mission-visual">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&h=600&fit=crop"
                        alt="Bureau moderne immobilier">
                    <div class="mission-card-float">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <strong>Transactions sécurisées</strong>
                            <span>Chaque annonce est vérifiée</span>
                        </div>
                    </div>
                </div>
                <div class="mission-text">
                    <div class="section-tag">
                        <i class="bi bi-bullseye"></i> Notre mission
                    </div>
                    <h2 class="section-title">Démocratiser l'accès<br>à l'immobilier</h2>
                    <p>
                        En Afrique et partout dans le monde francophone, le marché
                        immobilier reste opaque, fragmenté et souvent inaccessible. Les
                        particuliers peinent à trouver des informations fiables, et les
                        professionnels manquent d'outils adaptés à leurs besoins.
                    </p>
                    <p>
                        ImmoPro a été conçu pour changer cela. Notre plateforme met en
                        relation directe propriétaires, locataires et acheteurs dans un
                        environnement transparent, moderne et sécurisé.
                    </p>
                    <p>
                        Que vous cherchiez un appartement, un terrain ou un local
                        commercial, nous croyons que vous méritez la même qualité
                        d'expérience que les grandes plateformes mondiales.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════
         CHIFFRES CLÉS
         ═══════════════════════════ --}}
    <div class="stats-section">
        <div class="about-container">
            <div class="stats-header">
                <div class="section-tag">
                    <i class="bi bi-bar-chart-line"></i> En chiffres
                </div>
                <h2 class="section-title">L'impact qu'on construit chaque jour</h2>
                <p class="section-subtitle">
                    Des chiffres qui reflètent la confiance de notre communauté
                    d'utilisateurs et partenaires.
                </p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon teal">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <div class="stat-number">1 200+</div>
                    <div class="stat-label">Annonces publiées</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-number">850+</div>
                    <div class="stat-label">Utilisateurs actifs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon amber">
                        <i class="bi bi-house-check"></i>
                    </div>
                    <div class="stat-number">340+</div>
                    <div class="stat-label">Biens vendus ou loués</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon violet">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Villes couvertes</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════
         NOS VALEURS
         ═══════════════════════════ --}}
    <div class="values-section">
        <div class="about-container">
            <div class="values-header">
                <div class="section-tag">
                    <i class="bi bi-heart"></i> Nos valeurs
                </div>
                <h2 class="section-title">Ce qui guide chacune de nos décisions</h2>
                <p class="section-subtitle">
                    Pas de discours creux — voici les principes sur lesquels nous ne
                    faisons jamais de compromis.
                </p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon teal">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3>Transparence totale</h3>
                    <p>
                        Chaque annonce est vérifiée. Pas de frais cachés, pas de
                        mauvaises surprises. Ce que vous voyez est exactement ce que
                        vous obtenez.
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon blue">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h3>Sécurité des données</h3>
                    <p>
                        Vos informations personnelles ne sont jamais vendues ni partagées.
                        Nous appliquons les meilleures pratiques de protection des données.
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon amber">
                        <i class="bi bi-lightning"></i>
                    </div>
                    <h3>Simplicité d'usage</h3>
                    <p>
                        Publier une annonce prend moins de 3 minutes. Trouver un bien se
                        fait en quelques clics. L'immobilier n'a pas besoin d'être
                        compliqué.
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon rose">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Communauté d'abord</h3>
                    <p>
                        Nous écoutons nos utilisateurs avant tout. Chaque nouvelle
                        fonctionnalité naît d'un besoin réel exprimé par notre
                        communauté.
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon violet">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <h3>Ancrage local</h3>
                    <p>
                        Nous comprenons les réalités du marché immobilier africain et
                        francophone. Notre plateforme est conçue pour ce contexte, pas
                        copiée ailleurs.
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon green">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h3>Amélioration continue</h3>
                    <p>
                        Nous publions des mises à jour chaque semaine. La plateforme
                        d'aujourd'hui est toujours meilleure que celle d'hier.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════
         COMMENT ÇA MARCHE
         ═══════════════════════════ --}}
    <div class="process-section">
        <div class="about-container">
            <div class="process-header">
                <div class="section-tag">
                    <i class="bi bi-list-check"></i> Comment ça marche
                </div>
                <h2 class="section-title">Publier un bien en 4 étapes</h2>
                <p class="section-subtitle">
                    Un processus conçu pour être rapide et intuitif, même pour une
                    première utilisation.
                </p>
            </div>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-circle" data-step="01">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h4>Créez votre compte</h4>
                    <p>Inscription gratuite en 30 secondes avec votre email.</p>
                </div>
                <div class="process-step">
                    <div class="step-circle" data-step="02">
                        <i class="bi bi-camera"></i>
                    </div>
                    <h4>Ajoutez votre bien</h4>
                    <p>Photos, description, prix — tout en un seul formulaire simple.</p>
                </div>
                <div class="process-step">
                    <div class="step-circle" data-step="03">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h4>Publiez l'annonce</h4>
                    <p>Votre bien est immédiatement visible par des milliers de visiteurs.</p>
                </div>
                <div class="process-step">
                    <div class="step-circle" data-step="04">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h4>Recevez des contacts</h4>
                    <p>Les intéressés vous contactent directement via la plateforme.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════
         CTA
         ═══════════════════════════ --}}
    <div class="about-cta">
        <div class="about-container">
            <div class="cta-box">
                <h2>Prêt à trouver votre prochain bien ?</h2>
                <p>
                    Rejoignez des centaines d'utilisateurs qui font déjà confiance à
                    ImmoPro pour leurs projets immobiliers.
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('annonces.index') }}" class="cta-btn-primary">
                        <i class="bi bi-search"></i> Explorer les annonces
                    </a>
                    <a href="{{ route('annonces.create') }}" class="cta-btn-secondary">
                        <i class="bi bi-plus-lg"></i> Publier une annonce
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection