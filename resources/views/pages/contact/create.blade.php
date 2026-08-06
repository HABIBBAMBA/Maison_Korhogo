@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* ═══ CONTACT PAGE ═══ */
    body {
        background: var(--light-bg) !important;
    }

    .contact-page {
        min-height: calc(100vh - 72px);
        display: flex;
        margin-top: 72px;
    }

    /* ═══ Left Panel ═══ */
    .contact-info-panel {
        flex: 0 0 42%;
        background: var(--primary);
        color: #fff;
        padding: 4rem 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .contact-info-panel::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -20%;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(60, 110, 113, 0.25) 0%, transparent 70%);
        pointer-events: none;
    }

    .contact-info-panel::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--teal), transparent);
    }

    .info-eyebrow {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-eyebrow::before {
        content: '';
        width: 28px;
        height: 1px;
        background: var(--teal);
    }

    .info-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 3.5vw, 2.8rem);
        font-weight: 700;
        line-height: 1.15;
        margin-bottom: 1.25rem;
    }

    .info-title span {
        color: var(--teal);
    }

    .info-desc {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.65);
        line-height: 1.7;
        margin-bottom: 3rem;
        max-width: 400px;
    }

    .info-details {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-details li {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.75);
    }

    .info-details li .icon-wrap {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        color: var(--teal);
        font-size: 1rem;
    }

    .info-details li strong {
        display: block;
        color: #fff;
        font-weight: 600;
        margin-bottom: 0.15rem;
    }

    /* ═══ Right Panel ═══ */
    .contact-form-panel {
        flex: 1;
        background: var(--white);
        padding: 4rem 3.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .contact-form-panel::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 1px;
        background: linear-gradient(180deg, transparent 0%, var(--gray) 20%, var(--gray) 80%, transparent 100%);
    }

    .form-wrapper {
        width: 100%;
        max-width: 480px;
    }

    .form-header {
        margin-bottom: 2.5rem;
    }

    .form-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.4rem;
    }

    .form-header p {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
        color: #999;
        line-height: 1.5;
    }

    /* ═══ Property Tag ═══ */
    .property-tag {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        background: var(--light-bg);
        border: 1px solid var(--gray);
        border-left: 3px solid var(--teal);
        border-radius: var(--radius);
        margin-bottom: 2rem;
    }

    .property-tag i {
        color: var(--teal);
        font-size: 1.1rem;
    }

    .property-tag .tag-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #999;
    }

    .property-tag .tag-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--dark);
    }

    /* ═══ Error Alert ═══ */
    .alert-error {
        background: #fef2f2;
        border: 1px solid rgba(220, 38, 38, 0.15);
        border-radius: var(--radius);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .alert-error ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .alert-error li {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.82rem;
        color: #dc2626;
        padding: 0.2rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert-error li::before {
        content: '\F623';
        font-family: 'bootstrap-icons';
        font-size: 0.75rem;
    }

    /* ═══ Form Elements ═══ */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .form-group label .required {
        color: var(--teal);
        margin-left: 0.15rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 0.95rem;
        pointer-events: none;
        transition: color 0.2s ease;
    }

    .input-wrapper .textarea-icon {
        top: 1.1rem;
        transform: none;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.75rem;
        border: 1px solid var(--gray);
        border-radius: var(--radius);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
        color: var(--dark);
        background: #fff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        box-sizing: border-box;
    }

    .form-group textarea {
        padding-top: 0.9rem;
        resize: vertical;
        min-height: 120px;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #bbb;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--teal);
        box-shadow: 0 0 0 3px rgba(60, 110, 113, 0.1);
    }

    .form-group input:focus~i,
    .form-group textarea:focus~i {
        color: var(--teal);
    }

    /* ═══ Submit Button ═══ */
    .btn-submit {
        width: 100%;
        padding: 0.85rem;
        margin-top: 0.5rem;
        background: linear-gradient(135deg, var(--primary), var(--teal));
        color: #fff;
        border: none;
        border-radius: 50px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        box-shadow: 0 4px 15px rgba(40, 75, 99, 0.3);
        transition: var(--transition);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(40, 75, 99, 0.4);
    }

    .btn-submit:active {
        transform: scale(0.985);
    }

    .btn-submit i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }

    .btn-submit:hover i {
        transform: translateX(3px);
    }

    /* ═══ Bottom Note ═══ */
    .form-note {
        text-align: center;
        margin-top: 1.5rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        color: #999;
    }

    .form-note i {
        color: var(--teal);
        margin-right: 0.3rem;
    }

    /* ═══ Responsive ═══ */
    @media (max-width: 900px) {
        .contact-page {
            flex-direction: column;
        }

        .contact-info-panel {
            flex: none;
            padding: 3rem 2rem;
        }

        .contact-info-panel::after {
            height: 2px;
            bottom: auto;
            top: 0;
            background: linear-gradient(90deg, var(--teal), var(--primary));
        }

        .contact-form-panel {
            padding: 2.5rem 1.5rem;
        }

        .contact-form-panel::before {
            display: none;
        }

        .info-desc {
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 500px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .contact-info-panel {
            padding: 2rem 1.25rem;
        }

        .contact-form-panel {
            padding: 2rem 1.25rem;
        }

        .info-title {
            font-size: 1.7rem;
        }
    }
</style>

<section class="contact-page">

    {{-- ═══ Left: Info Panel ═══ --}}
    <div class="contact-info-panel">
        <div class="info-eyebrow">Formulaire de contact</div>

        <h1 class="info-title">
            Intéressé par<br>ce <span>bien</span> ?
        </h1>

        <p class="info-desc">
            Remplissez le formulaire ci-contre et le propriétaire sera notifié
            immédiatement. Nous vous encourageons à fournir un maximum de détails
            pour faciliter l'échange.
        </p>

        <ul class="info-details">
            <li>
                <div class="icon-wrap"><i class="bi bi-clock"></i></div>
                <div>
                    <strong>Réponse rapide</strong>
                    Le propriétaire est notifié par email en temps réel
                </div>
            </li>
            <li>
                <div class="icon-wrap"><i class="bi bi-shield-check"></i></div>
                <div>
                    <strong>Données protégées</strong>
                    Vos informations ne sont partagées qu'avec le propriétaire
                </div>
            </li>
            <li>
                <div class="icon-wrap"><i class="bi bi-telephone"></i></div>
                <div>
                    <strong>Contact direct</strong>
                    Échangez ensuite par téléphone ou email selon vos préférences
                </div>
            </li>
        </ul>
    </div>

    {{-- ═══ Right: Form Panel ═══ --}}
    <div class="contact-form-panel">
        <div class="form-wrapper">

            <div class="form-header">
                <h2>Envoyer un message</h2>
                <p>Tous les champs marqués d'un astérisque sont obligatoires.</p>
            </div>

            @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_bien" value="{{ $annonceId }}">

                {{-- Nom --}}
                <div class="form-group">
                    <label for="nom">
                        Nom complet <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="nom" name="nom"
                            value="{{ old('nom') }}" required
                            placeholder="Votre nom complet">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                {{-- Prénom --}}
                <div class="form-group">
                    <label for="prenom">
                        Prénom
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="prenom" name="prenom"
                            value="{{ old('prenom') }}"
                            placeholder="Votre prénom">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                {{-- Email + Téléphone --}}
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">
                            Email <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email"
                                value="{{ old('email') }}" required
                                placeholder="votre@email.com">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telephone">
                            Téléphone <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="tel" id="telephone" name="telephone"
                                value="{{ old('telephone') }}" required
                                placeholder="+221 77 000 00 00">
                            <i class="bi bi-telephone"></i>
                        </div>
                    </div>
                </div>

                {{-- Message --}}
                <div class="form-group">
                    <label for="message">
                        Message <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <textarea id="message" name="message" rows="5"
                            required
                            placeholder="Décrivez votre projet, vos disponibilités pour une visite...">{{ old('message') }}</textarea>
                        <i class="bi bi-chat-dots textarea-icon"></i>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">
                    Envoyer le message
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="form-note">
                <i class="bi bi-lock-fill"></i>
                Vos données restent confidentielles
            </div>

        </div>
    </div>

</section>
@endsection