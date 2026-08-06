@extends('layouts.app')

@section('title', 'Contact — ImmoPro')

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
    .contact-hero {
        position: relative;
        min-height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        background:
            linear-gradient(160deg, #041e2b 0%, #0a3d52 40%, #0d9488 100%);
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 25% 75%, rgba(13, 148, 136, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 75% 25%, rgba(255, 255, 255, 0.04) 0%, transparent 40%);
        pointer-events: none;
    }

    .contact-hero::after {
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
        max-width: 680px;
        padding: 4.5rem 2rem 5.5rem;
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
        font-size: 3rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin: 0 0 1rem;
    }

    .hero-content h1 span {
        background: linear-gradient(135deg, #5eead4, #0d9488);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-content p {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.65);
        line-height: 1.7;
        margin: 0;
    }

    /* ═══════════════════════════════
       SECTION BASE
       ═══════════════════════════════ */
    .contact-section {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .contact-container {
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
       MAIN CONTACT AREA
       ═══════════════════════════════ */
    .contact-main {
        padding: 5rem 0 4rem;
        background: #fafafa;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 3rem;
        align-items: start;
    }

    /* ═══════════════════════════════
       FORM CARD
       ═══════════════════════════════ */
    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .form-card h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #111827;
        margin: 0 0 0.3rem;
    }

    .form-card>p {
        font-size: 0.88rem;
        color: #9ca3af;
        margin: 0 0 2rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.45rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.9rem;
        color: #111827;
        background: #fff;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #0d9488;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.08);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #c8ccd2;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .form-error {
        font-size: 0.78rem;
        color: #ef4444;
        margin-top: 0.3rem;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.85rem 2rem;
        background: linear-gradient(135deg, #0d9488, #0f766e);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.92rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
        width: 100%;
        justify-content: center;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(13, 148, 136, 0.25);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* ═══════════════════════════════
       CONTACT INFO SIDEBAR
       ═══════════════════════════════ */
    .contact-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.6rem 1.5rem;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
        border-color: #d1d5db;
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        margin-bottom: 1rem;
    }

    .info-card-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .info-card-icon.teal {
        background: #f0fdfa;
        color: #0d9488;
    }

    .info-card-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .info-card-icon.amber {
        background: #fffbeb;
        color: #d97706;
    }

    .info-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .info-card-text {
        font-size: 0.88rem;
        color: #6b7280;
        line-height: 1.7;
        margin: 0;
    }

    .info-card-text a {
        color: #0d9488;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .info-card-text a:hover {
        color: #0f766e;
    }

    .info-card-text strong {
        color: #374151;
        font-weight: 600;
    }

    /* Social links */
    .social-links {
        display: flex;
        gap: 0.7rem;
        margin-top: 0.8rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        color: #6b7280;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .social-link:hover {
        background: #0d9488;
        border-color: #0d9488;
        color: #fff;
        transform: translateY(-2px);
    }

    /* ═══════════════════════════════
       MAP SECTION
       ═══════════════════════════════ */
    .map-section {
        padding: 4rem 0;
        background: #fff;
    }

    .map-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .map-header .section-subtitle {
        margin: 0 auto;
    }

    .map-wrapper {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.04);
    }

    .map-wrapper iframe {
        display: block;
        width: 100%;
        height: 400px;
        border: none;
    }

    /* ═══════════════════════════════
       FAQ
       ═══════════════════════════════ */
    .faq-section {
        padding: 4.5rem 0;
        background: #fafafa;
    }

    .faq-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .faq-header .section-subtitle {
        margin: 0 auto;
    }

    .faq-list {
        max-width: 780px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .faq-item {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .faq-item:hover {
        border-color: #d1d5db;
    }

    .faq-item.active {
        border-color: #0d9488;
        box-shadow: 0 4px 16px rgba(13, 148, 136, 0.06);
    }

    .faq-question {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.2rem 1.5rem;
        background: none;
        border: none;
        font-family: inherit;
        font-size: 0.95rem;
        font-weight: 600;
        color: #111827;
        text-align: left;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .faq-question:hover {
        color: #0d9488;
    }

    .faq-question i {
        font-size: 0.85rem;
        color: #9ca3af;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
        color: #0d9488;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease;
    }

    .faq-answer-inner {
        padding: 0 1.5rem 1.3rem;
        font-size: 0.88rem;
        color: #6b7280;
        line-height: 1.7;
    }

    /* ═══════════════════════════════
       ALERT SUCCESS
       ═══════════════════════════════ */
    .alert-success-custom {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 1rem 1.4rem;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        color: #166534;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        animation: fadeUp 0.4s ease forwards;
    }

    .alert-success-custom i {
        font-size: 1.2rem;
        color: #22c55e;
    }

    /* ═══════════════════════════════
       RESPONSIVE
       ═══════════════════════════════ */
    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .contact-sidebar {
            flex-direction: row;
            flex-wrap: wrap;
        }

        .contact-sidebar .info-card {
            flex: 1;
            min-width: 250px;
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.1rem;
        }

        .hero-content {
            padding: 3.5rem 1.5rem 5rem;
        }

        .section-title {
            font-size: 1.65rem;
        }

        .form-card {
            padding: 1.8rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .contact-sidebar {
            flex-direction: column;
        }

        .contact-sidebar .info-card {
            min-width: auto;
        }

        .map-wrapper iframe {
            height: 280px;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 1.8rem;
        }

        .form-card {
            padding: 1.4rem;
        }
    }
</style>

<div class="contact-section">

    {{-- ═══════════════════════════
         HERO
         ═══════════════════════════ --}}
    <div class="contact-hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-chat-dots"></i> Parlons ensemble
            </div>
            <h1>Une question ? <span>Nous sommes là</span></h1>
            <p>
                Que ce soit pour un partenariat, une question technique ou un simple
                retour, notre équipe vous répond sous 24 heures.
            </p>
        </div>
    </div>

    {{-- ═══════════════════════════
         FORMULAIRE + INFOS
         ═══════════════════════════ --}}
    <div class="contact-main">
        <div class="contact-container">
            <div class="contact-grid">

                {{-- FORMULAIRE --}}
                <div class="form-card">
                    <h2>Envoyez-nous un message</h2>
                    <p>Remplissez le formulaire et nous vous répondrons rapidement.</p>

                    @if (session('success'))
                    <div class="alert-success-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom complet</label>
                                <input type="text"
                                    id="nom"
                                    name="nom"
                                    placeholder="Votre nom"
                                    value="{{ old('nom') }}"
                                    required>
                                @error('nom')
                                <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Adresse email</label>
                                <input type="email"
                                    id="email"
                                    name="email"
                                    placeholder="vous@exemple.com"
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sujet">Sujet</label>
                            <select id="sujet" name="sujet" required>
                                <option value="" disabled {{ old('sujet') ? '' : 'selected' }}>
                                    Choisissez un sujet
                                </option>
                                <option value="Question générale" {{ old('sujet') == 'Question générale' ? 'selected' : '' }}>
                                    Question générale
                                </option>
                                <option value="Problème technique" {{ old('sujet') == 'Problème technique' ? 'selected' : '' }}>
                                    Problème technique
                                </option>
                                <option value="Partenariat" {{ old('sujet') == 'Partenariat' ? 'selected' : '' }}>
                                    Partenariat
                                </option>
                                <option value="Signaler une annonce" {{ old('sujet') == 'Signaler une annonce' ? 'selected' : '' }}>
                                    Signaler une annonce
                                </option>
                                <option value="Suggestion" {{ old('sujet') == 'Suggestion' ? 'selected' : '' }}>
                                    Suggestion
                                </option>
                                <option value="Autre" {{ old('sujet') == 'Autre' ? 'selected' : '' }}>
                                    Autre
                                </option>
                            </select>
                            @error('sujet')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">Votre message</label>
                            <textarea id="message"
                                name="message"
                                placeholder="Décrivez votre demande en détail..."
                                required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="bi bi-send"></i>
                            Envoyer le message
                        </button>
                    </form>
                </div>

                {{-- SIDEBAR INFOS --}}
                <div class="contact-sidebar">

                    {{-- Email --}}
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon teal">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <h3 class="info-card-title">Email</h3>
                        </div>
                        <p class="info-card-text">
                            <a href="mailto:contact@immopro.com">contact@immopro.com</a><br>
                            <a href="mailto:support@immopro.com">support@immopro.com</a>
                        </p>
                    </div>

                    {{-- Téléphone --}}
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon blue">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <h3 class="info-card-title">Téléphone</h3>
                        </div>
                        <p class="info-card-text">
                            <strong>Lun — Ven :</strong> 8h00 — 18h00<br>
                            <a href="tel:+243000000000">+243 00 000 00 00</a>
                        </p>
                    </div>

                    {{-- Adresse --}}
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon amber">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h3 class="info-card-title">Adresse</h3>
                        </div>
                        <p class="info-card-text">
                            ImmoPro HQ<br>
                            123, Avenue de la Paix<br>
                            Kinshasa, RD Congo
                        </p>
                    </div>

                    {{-- Réseaux --}}
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon teal">
                                <i class="bi bi-share"></i>
                            </div>
                            <h3 class="info-card-title">Suivez-nous</h3>
                        </div>
                        <div class="social-links">
                            <a href="#" class="social-link" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-link" title="Twitter / X">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="#" class="social-link" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-link" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════
         CARTE
         ═══════════════════════════ --}}
    <div class="map-section">
        <div class="contact-container">
            <div class="map-header">
                <div class="section-tag">
                    <i class="bi bi-pin-map"></i> Notre localisation
                </div>
                <h2 class="section-title">Où nous trouver</h2>
                <p class="section-subtitle">
                    Nous sommes basés au coeur de Kinshasa. Visites sur rendez-vous.
                </p>
            </div>
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63837.84!2d15.2663!3d-4.3224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a33e48e386265%3A0x1a75ab6d38c580e!2sKinshasa%2C%20Democratic%20Republic%20of%20the%20Congo!5e0!3m2!1sfr!2sfr!4v1700000000000"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════
         FAQ
         ═══════════════════════════ --}}
    <div class="faq-section">
        <div class="contact-container">
            <div class="faq-header">
                <div class="section-tag">
                    <i class="bi bi-question-circle"></i> FAQ
                </div>
                <h2 class="section-title">Questions fréquentes</h2>
                <p class="section-subtitle">
                    Avant de nous écrire, consultez peut-être la réponse ici.
                </p>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Comment publier une annonce sur ImmoPro ?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Créez un compte gratuit, cliquez sur « Publier une annonce »,
                            remplissez les informations de votre bien, ajoutez des photos
                            et publiez. Votre annonce sera visible immédiatement par tous
                            les visiteurs.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        La publication d'annonce est-elle gratuite ?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Oui, la publication d'annonces sur ImmoPro est entièrement
                            gratuite pour les particuliers. Des options de mise en avant
                            seront prochainement disponibles.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Comment signaler une annonce suspecte ?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Utilisez ce formulaire de contact en sélectionnant le sujet
                            « Signaler une annonce » et en nous fournissant le lien ou
                            la référence de l'annonce concernée. Nous examinerons le
                            signalement sous 24 heures.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Sous quel délai recevrai-je une réponse ?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Nous nous engageons à répondre à toute demande sous 24 heures
                            ouvrées. Les demandes urgentes (problème technique bloquant)
                            sont traitées en priorité.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Puis-je devenir partenaire d'ImmoPro ?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Absolument ! Nous sommes ouverts aux partenariats avec des
                            agences immobilières, des promoteurs et des investisseurs.
                            Contactez-nous via ce formulaire avec le sujet « Partenariat »
                            et nous échangerons ensemble.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleFaq(btn) {
        const item = btn.parentElement;
        const answer = item.querySelector('.faq-answer');
        const isActive = item.classList.contains('active');

        // Fermer toutes les FAQ
        document.querySelectorAll('.faq-item').forEach(faq => {
            faq.classList.remove('active');
            faq.querySelector('.faq-answer').style.maxHeight = '0';
        });

        // Ouvrir celle cliquée (si elle était fermée)
        if (!isActive) {
            item.classList.add('active');
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }
    }
</script>
@endsection