@extends('layouts.app')

@section('title', 'Contact & Assistance — ImmoPro Côte d\'Ivoire')

@section('content')

<div class="contact-page">

    {{-- Hero Section Solide --}}
    <section class="contact-hero-section">
        <div class="contact-hero-container">
            <div class="contact-hero-eyebrow">
                <i class="bi bi-chat-dots" aria-hidden="true"></i>
                <span>Assistance & Partenariat</span>
            </div>

            <h1 class="contact-hero-title">
                Une équipe dédiée,<br>
                <span class="hero-accent">à votre écoute en Côte d'Ivoire.</span>
            </h1>

            <p class="contact-hero-lead">
                Que vous soyez acquéreur, propriétaire, promoteur ou agence partenaire, nos experts de Korhogo et d'Abidjan répondent à vos questions sous 24h ouvrées.
            </p>
        </div>
    </section>

    {{-- Section Formulaire & Coordonnées --}}
    <section class="contact-main-section">
        <div class="contact-container">
            <div class="contact-grid">

                {{-- Formulaire de contact --}}
                <div class="contact-form-card">
                    <div class="form-header">
                        <h2 class="form-title">Transmettez-nous votre message</h2>
                        <p class="form-desc">Remplissez les champs ci-dessous. Un conseiller dédié prendra contact avec vous.</p>
                    </div>

                    @if (session('success'))
                    <div class="alert-box alert-success" role="alert">
                        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="{{ url('/contact') }}" method="POST" class="contact-form-body">
                        @csrf

                        <div class="form-row-2">
                            <div class="form-group">
                                <label for="nom" class="input-label">Nom et Prénoms *</label>
                                <input
                                    type="text"
                                    id="nom"
                                    name="nom"
                                    class="form-input @error('nom') input-error @enderror"
                                    placeholder="Ex: Kouamé Jean"
                                    value="{{ old('nom') }}"
                                    required>
                                @error('nom')
                                <span class="field-error-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="input-label">Adresse Email *</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input @error('email') input-error @enderror"
                                    placeholder="vous@exemple.ci"
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                <span class="field-error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label for="telephone" class="input-label">Numéro de Téléphone (WhatsApp)</label>
                                <input
                                    type="tel"
                                    id="telephone"
                                    name="telephone"
                                    class="form-input tabular-nums"
                                    placeholder="+225 07 00 00 00 00"
                                    value="{{ old('telephone') }}">
                            </div>

                            <div class="form-group">
                                <label for="sujet" class="input-label">Objet de votre demande *</label>
                                <div class="select-wrap">
                                    <select id="sujet" name="sujet" class="form-input @error('sujet') input-error @enderror" required>
                                        <option value="" disabled {{ old('sujet') ? '' : 'selected' }}>Sélectionnez un sujet</option>
                                        <option value="Achat de bien" {{ old('sujet') == 'Achat de bien' ? 'selected' : '' }}>Projet d'achat / acquisition</option>
                                        <option value="Location de bien" {{ old('sujet') == 'Location de bien' ? 'selected' : '' }}>Recherche de location</option>
                                        <option value="Mise en vente" {{ old('sujet') == 'Mise en vente' ? 'selected' : '' }}>Mise en vente de mon bien à Korhogo</option>
                                        <option value="Partenariat agence" {{ old('sujet') == 'Partenariat agence' ? 'selected' : '' }}>Partenariat agence / promoteur</option>
                                        <option value="Question générale" {{ old('sujet') == 'Question générale' ? 'selected' : '' }}>Renseignement général</option>
                                        <option value="Autre" {{ old('sujet') == 'Autre' ? 'selected' : '' }}>Autre demande</option>
                                    </select>
                                    <i class="bi bi-chevron-down select-chevron" aria-hidden="true"></i>
                                </div>
                                @error('sujet')
                                <span class="field-error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="input-label">Détails de votre projet ou question *</label>
                            <textarea
                                id="message"
                                name="message"
                                class="form-textarea @error('message') input-error @enderror"
                                rows="5"
                                placeholder="Indiquez le type de bien recherché, la localisation souhaitée ou toute précision utile..."
                                required>{{ old('message') }}</textarea>
                            @error('message')
                            <span class="field-error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-cta btn-lg btn-submit-full">
                            <i class="bi bi-send-fill" aria-hidden="true"></i>
                            <span>Transmettre mon message</span>
                        </button>
                    </form>
                </div>

                {{-- Sidebar d'informations de contact réelles --}}
                <aside class="contact-sidebar">

                    {{-- Carte Siège Korhogo --}}
                    <div class="info-block">
                        <div class="info-block-icon" aria-hidden="true">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="info-block-content">
                            <h3 class="info-block-title">Agence Korhogo (Siège Nord)</h3>
                            <p class="info-block-desc">
                                Quartier Résidentiel, non loin du Commissariat<br>
                                Korhogo, Région du Poro, Côte d'Ivoire
                            </p>
                        </div>
                    </div>

                    {{-- Carte Téléphone & Horaires --}}
                    <div class="info-block">
                        <div class="info-block-icon" aria-hidden="true">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="info-block-content">
                            <h3 class="info-block-title">Lignes Directes</h3>
                            <p class="info-block-desc tabular-nums">
                                Principal : +225 07 00 00 00 00<br>
                                WhatsApp : +225 05 00 00 00 00<br>
                                <span style="font-size: 0.78rem; color: var(--text-muted);">Du lundi au samedi : 08h00 — 18h30</span>
                            </p>
                        </div>
                    </div>

                    {{-- Carte Email --}}
                    <div class="info-block">
                        <div class="info-block-icon" aria-hidden="true">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="info-block-content">
                            <h3 class="info-block-title">Courrier Électronique</h3>
                            <p class="info-block-desc">
                                contact@immopro-ci.com<br>
                                support@immopro-ci.com
                            </p>
                        </div>
                    </div>

                    {{-- Encadré de confiance --}}
                    <div class="trust-notice-box">
                        <i class="bi bi-patch-check-fill notice-icon" aria-hidden="true"></i>
                        <div>
                            <strong>Accompagnement Sécurisé</strong>
                            <p>Toutes nos visites sur Korhogo sont conduites par un agent muni d'un badge professionnel ImmoPro.</p>
                        </div>
                    </div>

                </aside>

            </div>
        </div>
    </section>

</div>

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES DE LA PAGE CONTACT (STANDARDS SKILL_DESIGN, ZÉRO DÉGRADÉ)    ║
       ╚══════════════════════════════════════════════════════════════════════╝ */
    .contact-page {
        background-color: var(--surface-sunken);
    }

    .contact-container {
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    /* Hero */
    .contact-hero-section {
        background-color: var(--surface-dark-sunken);
        color: var(--text-inverse);
        padding-block: clamp(3.5rem, 7vw, 5.5rem);
        border-bottom: 1px solid var(--border-dark);
        text-align: center;
    }

    .contact-hero-container {
        max-width: 760px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    .contact-hero-eyebrow {
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

    .contact-hero-title {
        font-size: clamp(2rem, 4.2vw, 3rem);
        color: var(--text-inverse);
        line-height: 1.15;
        margin-bottom: 1.25rem;
        letter-spacing: -0.02em;
    }

    .hero-accent {
        color: var(--accent-brand);
    }

    .contact-hero-lead {
        font-size: clamp(0.95rem, 1.8vw, 1.1rem);
        color: var(--text-inverse-muted);
        line-height: 1.7;
    }

    /* Section principale */
    .contact-main-section {
        padding-block: 4.5rem;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 2.5rem;
        align-items: flex-start;
    }

    /* Carte Formulaire */
    .contact-form-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: clamp(1.75rem, 4vw, 2.75rem);
        box-shadow: var(--shadow-raised);
    }

    .form-header {
        margin-bottom: 2rem;
    }

    .form-title {
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.35rem;
    }

    .form-desc {
        font-size: 0.88rem;
        color: var(--text-secondary);
    }

    .contact-form-body {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .input-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.65rem 0.95rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        font-family: inherit;
        font-size: 0.88rem;
        color: var(--text-primary);
        transition: border-color var(--duration-fast) var(--ease-out-expo),
                    background-color var(--duration-fast) var(--ease-out-expo),
                    box-shadow var(--duration-fast) var(--ease-out-expo);
    }

    .form-input:hover,
    .form-textarea:hover {
        border-color: var(--border-strong);
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        background-color: var(--surface-raised);
        border-color: var(--accent-cta);
        box-shadow: 0 0 0 3px rgba(232, 115, 74, 0.15);
    }

    .input-error {
        border-color: var(--status-danger-border) !important;
        background-color: var(--status-danger-bg) !important;
    }

    .field-error-msg {
        font-size: 0.75rem;
        color: var(--status-danger-text);
        font-weight: 600;
    }

    .select-wrap {
        position: relative;
    }

    .select-wrap select {
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

    .btn-submit-full {
        width: 100%;
        justify-content: center;
        margin-top: 0.5rem;
    }

    /* Sidebar info */
    .contact-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .info-block {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        box-shadow: var(--shadow-raised);
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .info-block-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--accent-brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .info-block-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.35rem;
    }

    .info-block-desc {
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    .trust-notice-box {
        background-color: var(--surface-dark-sunken);
        color: var(--text-inverse);
        border: 1px solid var(--border-dark);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        display: flex;
        gap: 0.75rem;
    }

    .notice-icon {
        font-size: 1.35rem;
        color: var(--accent-warm);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .trust-notice-box strong {
        display: block;
        font-size: 0.85rem;
        color: var(--text-inverse);
        margin-bottom: 0.25rem;
    }

    .trust-notice-box p {
        font-size: 0.78rem;
        color: var(--text-inverse-muted);
        line-height: 1.5;
        margin: 0;
    }

    .alert-box {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1.15rem;
        border-radius: var(--radius-sm);
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background-color: var(--status-success-bg);
        color: var(--status-success-text);
        border: 1px solid var(--status-success-border);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .form-row-2 {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@endsection