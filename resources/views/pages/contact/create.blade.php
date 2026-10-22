@extends('layouts.app')

@section('title', 'Contacter l\'Annonceur — ImmoPro')

@section('content')

<div class="property-contact-page">
    <div class="property-contact-container">

        {{-- Fil d'ariane --}}
        <div class="contact-breadcrumb-bar">
            <a href="{{ route('annonces.show', $annonceId) }}" class="back-link">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                <span>Retour à la fiche de l'annonce</span>
            </a>
        </div>

        <div class="contact-card-split">

            {{-- Panneau d'information latéral gauche --}}
            <div class="contact-context-panel">
                <div class="context-eyebrow">
                    <i class="bi bi-shield-check" aria-hidden="true"></i>
                    <span>Contact Direct Propriétaire</span>
                </div>

                <h1 class="context-title">
                    Intéressé par ce bien immobilier ?
                </h1>

                <p class="context-desc">
                    Votre message sera transmis instantanément au propriétaire ou à l'agence mandataire. Nous veillons à la confidentialité de vos coordonnées.
                </p>

                <div class="context-perks">
                    <div class="perk-item">
                        <div class="perk-icon" aria-hidden="true">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <div>
                            <strong>Notification immédiate</strong>
                            <span>Le propriétaire reçoit votre demande en temps réel.</span>
                        </div>
                    </div>

                    <div class="perk-item">
                        <div class="perk-icon" aria-hidden="true">
                            <i class="bi bi-lock"></i>
                        </div>
                        <div>
                            <strong>Données strictement protégées</strong>
                            <span>Vos informations ne sont ni cédées ni exploitées à des fins publicitaires.</span>
                        </div>
                    </div>

                    <div class="perk-item">
                        <div class="perk-icon" aria-hidden="true">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <strong>Échange direct sans frais</strong>
                            <span>Convenez ensemble d'un créneau de visite physique sur Korhogo.</span>
                        </div>
                    </div>
                </div>

                <div class="ref-badge tabular-nums">
                    Référence Annonce #{{ str_pad($annonceId, 5, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            {{-- Panneau formulaire droit --}}
            <div class="contact-form-panel">
                <div class="form-header-box">
                    <h2 class="form-title">Rédigez votre demande</h2>
                    <p class="form-subtitle">Tous les champs signalés par un astérisque sont indispensables.</p>
                </div>

                @if ($errors->any())
                <div class="alert-box alert-error" role="alert">
                    <i class="bi bi-exclamation-octagon-fill" aria-hidden="true"></i>
                    <div>
                        <strong>Des erreurs ont été détectées :</strong>
                        <ul style="margin: 0.35rem 0 0 1rem; padding: 0;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('contacts.store') }}" method="POST" class="contact-actual-form">
                    @csrf
                    <input type="hidden" name="id_bien" value="{{ $annonceId }}">

                    {{-- Nom complet --}}
                    <div class="form-group">
                        <label for="nom" class="input-label">Nom et Prénoms *</label>
                        <div class="input-with-icon">
                            <i class="bi bi-person input-icon" aria-hidden="true"></i>
                            <input
                                type="text"
                                id="nom"
                                name="nom"
                                class="form-input with-icon @error('nom') input-error @enderror"
                                placeholder="Votre nom complet"
                                value="{{ old('nom', auth()->user()->name ?? '') }}"
                                required>
                        </div>
                        @error('nom')
                        <span class="field-error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email & Téléphone --}}
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="email" class="input-label">Adresse Email *</label>
                            <div class="input-with-icon">
                                <i class="bi bi-envelope input-icon" aria-hidden="true"></i>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input with-icon @error('email') input-error @enderror"
                                    placeholder="vous@exemple.ci"
                                    value="{{ old('email', auth()->user()->email ?? '') }}"
                                    required>
                            </div>
                            @error('email')
                            <span class="field-error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telephone" class="input-label">Numéro de Téléphone *</label>
                            <div class="input-with-icon">
                                <i class="bi bi-telephone input-icon" aria-hidden="true"></i>
                                <input
                                    type="tel"
                                    id="telephone"
                                    name="telephone"
                                    class="form-input with-icon tabular-nums @error('telephone') input-error @enderror"
                                    placeholder="+225 07 00 00 00 00"
                                    value="{{ old('telephone') }}"
                                    required>
                            </div>
                            @error('telephone')
                            <span class="field-error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Message --}}
                    <div class="form-group">
                        <label for="message" class="input-label">Votre Message *</label>
                        <textarea
                            id="message"
                            name="message"
                            class="form-textarea @error('message') input-error @enderror"
                            rows="5"
                            placeholder="Bonjour, je souhaite des précisions sur ce bien et convenir d'une date de visite..."
                            required>{{ old('message') }}</textarea>
                        @error('message')
                        <span class="field-error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-submit-full">
                        <i class="bi bi-send-fill" aria-hidden="true"></i>
                        <span>Transmettre mon message au propriétaire</span>
                    </button>
                </form>

                <div class="form-footer-notice">
                    <i class="bi bi-info-circle" aria-hidden="true"></i>
                    <span>En soumettant ce formulaire, vous acceptez d'être recontacté(e) par le bailleur au sujet de cette annonce.</span>
                </div>
            </div>

        </div>

    </div>
</div>

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES CONTACT D'ANNONCE (STANDARDS SKILL_DESIGN, ZÉRO DÉGRADÉ)     ║
       ╚══════════════════════════════════════════════════════════════════════╝ */
    .property-contact-page {
        background-color: var(--surface-sunken);
        min-height: calc(100vh - var(--nav-height));
        padding-block: 2rem 5rem;
    }

    .property-contact-container {
        max-width: 1120px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    .contact-breadcrumb-bar {
        margin-bottom: 1.5rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-secondary);
        transition: color var(--duration-fast) var(--ease-out-expo);
    }

    .back-link:hover {
        color: var(--accent-brand);
    }

    .contact-card-split {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-overlay);
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1.35fr;
    }

    /* Panneau gauche sombre solide */
    .contact-context-panel {
        background-color: var(--surface-dark-base);
        color: var(--text-inverse);
        padding: clamp(2.5rem, 5vw, 3.5rem);
        border-inline-end: 1px solid var(--border-dark);
        display: flex;
        flex-direction: column;
    }

    .context-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--accent-warm);
        margin-bottom: 1.25rem;
    }

    .context-title {
        font-size: clamp(1.6rem, 2.8vw, 2.1rem);
        color: var(--text-inverse);
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .context-desc {
        font-size: 0.9rem;
        color: var(--text-inverse-muted);
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }

    .context-perks {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: auto;
    }

    .perk-item {
        display: flex;
        gap: 0.85rem;
        align-items: flex-start;
    }

    .perk-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-xs);
        background-color: var(--surface-dark-sunken);
        border: 1px solid var(--border-dark);
        color: var(--accent-brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .perk-item strong {
        display: block;
        font-size: 0.88rem;
        color: var(--text-inverse);
        margin-bottom: 0.2rem;
    }

    .perk-item span {
        font-size: 0.8rem;
        color: var(--text-inverse-muted);
        line-height: 1.55;
    }

    .ref-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        color: var(--text-inverse-muted);
        padding-top: 2rem;
        border-top: 1px solid var(--border-dark);
        margin-top: 2rem;
    }

    /* Panneau droit formulaire */
    .contact-form-panel {
        padding: clamp(2rem, 5vw, 3.5rem);
        background-color: var(--surface-raised);
    }

    .form-header-box {
        margin-bottom: 1.75rem;
    }

    .form-title {
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.35rem;
    }

    .form-subtitle {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .contact-actual-form {
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
        gap: 0.35rem;
    }

    .input-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--text-secondary);
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon .input-icon {
        position: absolute;
        inset-inline-start: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.9rem;
        color: var(--text-muted);
        pointer-events: none;
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

    .form-input.with-icon {
        padding-inline-start: 2.25rem;
    }

    .form-input:hover,
    .form-textarea:hover {
        border-color: var(--border-strong);
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        background-color: var(--surface-raised);
        border-color: var(--accent-brand);
        box-shadow: 0 0 0 3px oklch(0.460 0.075 195 / 0.15);
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

    .btn-submit-full {
        width: 100%;
        justify-content: center;
        margin-top: 0.5rem;
    }

    .form-footer-notice {
        display: flex;
        gap: 0.5rem;
        font-size: 0.78rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-top: 1.25rem;
    }

    .form-footer-notice i {
        color: var(--accent-brand);
        flex-shrink: 0;
        margin-top: 1px;
    }

    .alert-box {
        display: flex;
        gap: 0.75rem;
        padding: 0.85rem 1.15rem;
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        margin-bottom: 1.25rem;
    }

    .alert-error {
        background-color: var(--status-danger-bg);
        color: var(--status-danger-text);
        border: 1px solid var(--status-danger-border);
    }

    @media (max-width: 900px) {
        .contact-card-split {
            grid-template-columns: 1fr;
        }

        .contact-context-panel {
            border-inline-end: none;
            border-bottom: 1px solid var(--border-dark);
        }
    }

    @media (max-width: 600px) {
        .form-row-2 {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@endsection