@extends('layouts.app')

@section('title', 'Modifier utilisateur — Admin')

@section('content')

<style>
    :root {
        --edit-bg: #f0f4f8;
        --edit-card: #ffffff;
        --edit-input-bg: #f7f9fb;
        --edit-border: #dce3ea;
        --edit-border-focus: #2a7d7f;
        --edit-primary: #1b3a4f;
        --edit-teal: #2a7d7f;
        --edit-teal-light: #5db8b5;
        --edit-teal-muted: rgba(42, 125, 127, 0.08);
        --edit-primary-muted: rgba(27, 58, 79, 0.07);
        --edit-green: #16a34a;
        --edit-green-muted: rgba(22, 163, 74, 0.08);
        --edit-red: #dc2626;
        --edit-red-muted: rgba(220, 38, 38, 0.06);
        --edit-orange: #ea580c;
        --edit-text: #1a2332;
        --edit-text-secondary: #475569;
        --edit-text-muted: #94a3b8;
        --edit-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        --edit-shadow-md: 0 4px 12px rgba(0, 0, 0, 0.07);
        --edit-radius: 16px;
        --edit-radius-sm: 10px;
    }

    /* ===== PAGE WRAPPER ===== */
    .edit-page {
        max-width: 840px;
        margin: 0 auto;
        padding: 1.5rem 1rem 5rem;
    }

    /* ===== BREADCRUMB ===== */
    .edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .edit-breadcrumb a {
        font-size: 0.8rem;
        color: var(--edit-text-muted);
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: color 0.2s;
    }

    .edit-breadcrumb a:hover {
        color: var(--edit-teal);
    }

    .edit-breadcrumb .sep {
        color: var(--edit-border);
        font-size: 0.65rem;
    }

    .edit-breadcrumb .current {
        font-size: 0.8rem;
        color: var(--edit-text-secondary);
        font-weight: 700;
    }

    /* ===== HERO BANNER ===== */
    .edit-hero {
        background: linear-gradient(135deg, var(--edit-primary) 0%, #2a5a6d 60%, var(--edit-teal) 100%);
        border-radius: var(--edit-radius);
        padding: 2rem 2.25rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(27, 58, 79, 0.3);
    }

    .edit-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -12%;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
    }

    .edit-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -5%;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(93, 184, 181, 0.08);
    }

    .edit-hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .edit-hero-avatar {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        background: linear-gradient(135deg, var(--edit-teal-light), var(--edit-teal));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        font-weight: 800;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(42, 125, 127, 0.4);
    }

    .edit-hero-info {
        flex: 1;
    }

    .edit-hero-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.2;
    }

    .edit-hero-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 0.35rem;
        flex-wrap: wrap;
    }

    .edit-hero-meta span {
        font-size: 0.78rem;
        color: rgba(255, 255, 255, 0.55);
        display: flex;
        align-items: center;
        gap: 0.3rem;
        font-weight: 500;
    }

    .edit-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: var(--edit-card);
        border: 1px solid var(--edit-border);
        border-radius: var(--edit-radius);
        box-shadow: var(--edit-shadow);
        overflow: hidden;
        opacity: 0;
        animation: fadeUp 0.5s ease forwards;
        animation-delay: 0.1s;
    }

    /* ===== ERROR ALERT ===== */
    .form-alert {
        background: var(--edit-red-muted);
        border: 1.5px solid rgba(220, 38, 38, 0.15);
        border-radius: var(--edit-radius-sm);
        padding: 1.1rem 1.4rem;
        margin-bottom: 1.5rem;
        animation: fadeUp 0.4s ease forwards;
    }

    .form-alert-title {
        font-size: 0.82rem;
        font-weight: 800;
        color: var(--edit-red);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .form-alert ul li {
        font-size: 0.82rem;
        color: #991b1b;
        line-height: 1.7;
        font-weight: 500;
    }

    /* ===== FORM SECTIONS ===== */
    .form-section {
        padding: 1.75rem 2rem;
    }

    .form-section+.form-section {
        border-top: 1px solid var(--edit-border);
    }

    .form-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.4rem;
    }

    .form-section-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .form-section-icon.primary {
        background: var(--edit-primary-muted);
        color: var(--edit-primary);
    }

    .form-section-icon.teal {
        background: var(--edit-teal-muted);
        color: var(--edit-teal);
    }

    .form-section-icon.green {
        background: var(--edit-green-muted);
        color: var(--edit-green);
    }

    .form-section-title {
        font-size: 1rem;
        font-weight: 800;
        color: var(--edit-text);
        line-height: 1.2;
    }

    .form-section-subtitle {
        font-size: 0.74rem;
        color: var(--edit-text-muted);
        font-weight: 500;
        margin-top: 0.15rem;
    }

    /* ===== FORM GRID ===== */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.1rem 1.25rem;
    }

    .form-grid .span-2 {
        grid-column: 1 / -1;
    }

    /* ===== LABELS ===== */
    .form-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--edit-text-secondary);
        margin-bottom: 0.4rem;
    }

    .form-label .req {
        color: var(--edit-red);
        margin-left: 0.15rem;
    }

    /* ===== INPUTS (VISIBLE) ===== */
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid var(--edit-border);
        border-radius: var(--edit-radius-sm);
        font-size: 0.88rem;
        font-weight: 500;
        color: var(--edit-text);
        background: var(--edit-input-bg);
        outline: none;
        transition: all 0.25s ease;
        box-sizing: border-box;
    }

    .form-input::placeholder {
        color: var(--edit-text-muted);
        font-weight: 400;
    }

    .form-input:focus {
        border-color: var(--edit-teal);
        background: #ffffff;
        box-shadow: 0 0 0 3px var(--edit-teal-muted);
    }

    .form-input:hover:not(:focus) {
        border-color: #b0bec5;
    }

    /* ===== SELECT ===== */
    .form-select {
        width: 100%;
        padding: 0.75rem 2.5rem 0.75rem 1rem;
        border: 1.5px solid var(--edit-border);
        border-radius: var(--edit-radius-sm);
        font-size: 0.88rem;
        font-weight: 500;
        color: var(--edit-text);
        background: var(--edit-input-bg);
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%2394a3b8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        cursor: pointer;
        transition: all 0.25s ease;
        box-sizing: border-box;
    }

    .form-select:focus {
        border-color: var(--edit-teal);
        background-color: #ffffff;
        box-shadow: 0 0 0 3px var(--edit-teal-muted);
    }

    .form-select:hover:not(:focus) {
        border-color: #b0bec5;
    }

    /* ===== INPUT WITH ICON ===== */
    .input-icon-wrap {
        position: relative;
    }

    .input-icon-wrap .form-input {
        padding-left: 2.6rem;
    }

    .input-icon-wrap i {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--edit-text-muted);
        font-size: 0.95rem;
        pointer-events: none;
        transition: color 0.25s;
    }

    .input-icon-wrap:focus-within i {
        color: var(--edit-teal);
    }

    /* ===== HINT ===== */
    .form-hint {
        font-size: 0.72rem;
        color: var(--edit-text-muted);
        margin-top: 0.35rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-hint i {
        font-size: 0.8rem;
        color: var(--edit-teal);
    }

    /* ===== PASSWORD STRENGTH ===== */
    .password-strength {
        display: flex;
        gap: 0.35rem;
        margin-top: 0.5rem;
    }

    .password-strength .bar {
        flex: 1;
        height: 4px;
        border-radius: 10px;
        background: var(--edit-border);
        transition: background 0.3s;
    }

    .password-strength .bar.active-weak {
        background: var(--edit-red);
    }

    .password-strength .bar.active-mid {
        background: var(--edit-orange);
    }

    .password-strength .bar.active-strong {
        background: var(--edit-green);
    }

    /* ===== FORM ACTIONS FOOTER ===== */
    .form-actions {
        padding: 1.25rem 2rem;
        background: #f8fafc;
        border-top: 1px solid var(--edit-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .form-actions-left {
        font-size: 0.74rem;
        color: var(--edit-text-muted);
        display: flex;
        align-items: center;
        gap: 0.3rem;
        font-weight: 500;
    }

    .form-actions-left i {
        font-size: 0.85rem;
        color: var(--edit-teal);
    }

    .form-actions-right {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    /* ===== BUTTONS ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.65rem 1.3rem;
        border-radius: var(--edit-radius-sm);
        font-size: 0.82rem;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--edit-primary), #2a5a6d);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(27, 58, 79, 0.25);
    }

    .btn-primary:hover {
        box-shadow: 0 4px 16px rgba(27, 58, 79, 0.35);
        transform: translateY(-1px);
    }

    .btn-outline {
        background: var(--edit-card);
        color: var(--edit-text-secondary);
        border: 1.5px solid var(--edit-border);
    }

    .btn-outline:hover {
        border-color: #b0bec5;
        background: #f8fafc;
    }

    /* ===== DANGER ZONE ===== */
    .danger-card {
        background: var(--edit-card);
        border: 1px solid rgba(220, 38, 38, 0.12);
        border-radius: var(--edit-radius);
        margin-top: 1.25rem;
        overflow: hidden;
        opacity: 0;
        animation: fadeUp 0.5s ease forwards;
        animation-delay: 0.15s;
    }

    .danger-zone {
        padding: 1.5rem 2rem;
        background: linear-gradient(180deg, rgba(220, 38, 38, 0.02) 0%, rgba(220, 38, 38, 0.05) 100%);
    }

    .danger-zone-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .danger-zone-text h4 {
        font-size: 0.92rem;
        font-weight: 800;
        color: var(--edit-red);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .danger-zone-text p {
        font-size: 0.78rem;
        color: var(--edit-text-muted);
        margin-top: 0.2rem;
        font-weight: 500;
    }

    .btn-danger-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.2rem;
        border-radius: var(--edit-radius-sm);
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        background: var(--edit-card);
        color: var(--edit-red);
        border: 1.5px solid rgba(220, 38, 38, 0.25);
        transition: all 0.2s ease;
    }

    .btn-danger-outline:hover {
        background: var(--edit-red-muted);
        border-color: var(--edit-red);
    }

    /* ===== ACTIVITY CARD ===== */
    .activity-card {
        background: var(--edit-card);
        border: 1px solid var(--edit-border);
        border-radius: var(--edit-radius);
        padding: 1.5rem 1.75rem;
        margin-top: 1.25rem;
        box-shadow: var(--edit-shadow);
        opacity: 0;
        animation: fadeUp 0.5s ease forwards;
        animation-delay: 0.2s;
    }

    .activity-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.1rem;
    }

    .activity-card-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: var(--edit-text);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .activity-card-title i {
        color: var(--edit-teal);
    }

    .activity-card-sub {
        font-size: 0.72rem;
        color: var(--edit-text-muted);
        font-weight: 600;
    }

    .activity-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.85rem;
    }

    .activity-stat {
        text-align: center;
        padding: 0.85rem 0.5rem;
        border-radius: var(--edit-radius-sm);
        background: var(--edit-input-bg);
        border: 1px solid var(--edit-border);
        transition: all 0.2s;
    }

    .activity-stat:hover {
        border-color: var(--edit-teal);
        background: var(--edit-teal-muted);
    }

    .activity-stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--edit-text);
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .activity-stat-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--edit-text-muted);
        font-weight: 700;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .edit-page {
            padding: 1rem 0.75rem 4rem;
        }

        .edit-hero-inner {
            flex-direction: column;
            text-align: center;
        }

        .edit-hero-meta {
            justify-content: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-section {
            padding: 1.25rem;
        }

        .form-actions {
            flex-direction: column-reverse;
            gap: 0.75rem;
        }

        .form-actions-right {
            width: 100%;
            flex-direction: column;
        }

        .form-actions-right .btn {
            width: 100%;
            justify-content: center;
        }

        .form-actions-left {
            justify-content: center;
        }

        .danger-zone-header {
            flex-direction: column;
            text-align: center;
        }

        .activity-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<div class="edit-page">

    <!-- Breadcrumb -->
    <nav class="edit-breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-3x3-gap"></i> Admin
        </a>
        <span class="sep"><i class="bi bi-chevron-right"></i></span>
        <a href="{{ route('admin.users.index') }}">Utilisateurs</a>
        <span class="sep"><i class="bi bi-chevron-right"></i></span>
        <span class="current">Modifier</span>
    </nav>

    <!-- Hero -->
    <div class="edit-hero">
        <div class="edit-hero-inner">
            <div class="edit-hero-avatar">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div class="edit-hero-info">
                <div class="edit-hero-name">{{ $user->name }}</div>
                <div class="edit-hero-meta">
                    <span><i class="bi bi-envelope"></i> {{ $user->email ?? 'Pas d\'email' }}</span>
                    <span><i class="bi bi-clock"></i> Inscrit le {{ $user->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="edit-hero-badge">
                @if($user->role === 'admin')
                <i class="bi bi-shield-fill-check"></i> Administrateur
                @elseif($user->role === 'agence')
                <i class="bi bi-shop"></i> Agence
                @elseif($user->role === 'proprietaire')
                <i class="bi bi-house-door"></i> Propriétaire
                @else
                <i class="bi bi-person"></i> Locataire
                @endif
            </div>
        </div>
    </div>

    <!-- Errors -->
    @if($errors->any())
    <div class="form-alert">
        <div class="form-alert-title">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Veuillez corriger les erreurs ci-dessous
        </div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-card">

            <!-- Section: Identité -->
            <div class="form-section">
                <div class="form-section-header">
                    <div class="form-section-icon primary">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <div class="form-section-title">Informations personnelles</div>
                        <div class="form-section-subtitle">Identité et coordonnées de l'utilisateur</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label class="form-label">Nom complet <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-person"></i>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="form-input" required placeholder="Ex: Jean Dupont">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Adresse email <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-input" required placeholder="jean@exemple.com">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Téléphone</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-telephone"></i>
                            <input type="text" name="telephone" value="{{ old('telephone', $user->telephone ?? '') }}"
                                class="form-input" placeholder="+241 XX XX XX XX">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Ville</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-geo-alt"></i>
                            <input type="text" name="ville" value="{{ old('ville', $user->ville ?? '') }}"
                                class="form-input" placeholder="Ex: Libreville">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Mot de passe -->
            <div class="form-section">
                <div class="form-section-header">
                    <div class="form-section-icon teal">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <div>
                        <div class="form-section-title">Sécurité du compte</div>
                        <div class="form-section-subtitle">Modifier le mot de passe — laissez vide pour conserver l'actuel</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label class="form-label">Nouveau mot de passe</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-key"></i>
                            <input type="password" name="password" id="password-input"
                                class="form-input" placeholder="••••••••" oninput="checkStrength(this.value)">
                        </div>
                        <div class="password-strength" id="pw-strength">
                            <div class="bar" id="pw-bar-1"></div>
                            <div class="bar" id="pw-bar-2"></div>
                            <div class="bar" id="pw-bar-3"></div>
                            <div class="bar" id="pw-bar-4"></div>
                        </div>
                        <div class="form-hint" id="pw-hint">
                            <i class="bi bi-info-circle"></i> Minimum 8 caractères recommandés
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Confirmer le mot de passe</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password_confirmation"
                                class="form-input" placeholder="Retapez le mot de passe">
                        </div>
                        <div class="form-hint">
                            <i class="bi bi-arrow-return-left"></i> Les deux mots de passe doivent correspondre
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Rôle -->
            <div class="form-section">
                <div class="form-section-header">
                    <div class="form-section-icon green">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                    <div>
                        <div class="form-section-title">Rôle & permissions</div>
                        <div class="form-section-subtitle">Définir le rôle et l'affectation de l'agence</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label class="form-label">Rôle <span class="req">*</span></label>
                        <select name="role" id="role-select" required class="form-select"
                            onchange="toggleAgenceField(this.value)">
                            @foreach($roles as $role)
                            <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                                @if($role === 'admin') Administrateur
                                @elseif($role === 'agence') Agent immobilier
                                @elseif($role === 'proprietaire') Propriétaire
                                @else Locataire
                                @endif
                            </option>
                            @endforeach
                        </select>
                        <div class="form-hint" id="role-description">
                            <i class="bi bi-info-circle"></i>
                            @if($user->role === 'admin') Accès total à la plateforme
                            @elseif($user->role === 'agence') Gère les biens et les clients
                            @elseif($user->role === 'proprietaire') Gère ses propres biens
                            @else Recherche et loue des biens
                            @endif
                        </div>
                    </div>
                    <div id="agence-field" style="display: {{ old('role', $user->role) === 'agence' ? 'block' : 'none' }};">
                        <label class="form-label">Agence assignée</label>
                        <select name="agence_id" class="form-select">
                            <option value="">— Aucune agence —</option>
                            @foreach($agences as $agence)
                            <option value="{{ $agence->id }}" {{ old('agence_id', $user->agence_id) == $agence->id ? 'selected' : '' }}>
                                {{ $agence->nom_agence }}
                            </option>
                            @endforeach
                        </select>
                        <div class="form-hint">
                            <i class="bi bi-building"></i> Associer l'utilisateur à une agence
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <div class="form-actions-left">
                    <i class="bi bi-clock-history"></i>
                    Dernière modification : {{ $user->updated_at->format('d/m/Y à H:i') }}
                </div>
                <div class="form-actions-right">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-all"></i> Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Danger Zone -->
    <div class="danger-card">
        <div class="danger-zone">
            <div class="danger-zone-header">
                <div class="danger-zone-text">
                    <h4><i class="bi bi-exclamation-octagon"></i> Zone dangereuse</h4>
                    <p>La suppression est irréversible et efface toutes les données.</p>
                </div>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                    onsubmit="return confirm('Supprimer cet utilisateur ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger-outline">
                        <i class="bi bi-trash3"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Activity -->
    <div class="activity-card">
        <div class="activity-card-header">
            <span class="activity-card-title">
                <i class="bi bi-bar-chart-line"></i> Aperçu de l'activité
            </span>
            <span class="activity-card-sub">Depuis l'inscription</span>
        </div>
        <div class="activity-grid">
            <div class="activity-stat">
                <div class="activity-stat-value">{{ $user->annonces_count ?? 0 }}</div>
                <div class="activity-stat-label">Annonces</div>
            </div>
            <div class="activity-stat">
                <div class="activity-stat-value">{{ $user->messages_count ?? 0 }}</div>
                <div class="activity-stat-label">Messages</div>
            </div>
            <div class="activity-stat">
                <div class="activity-stat-value">{{ $user->rendezvous_count ?? 0 }}</div>
                <div class="activity-stat-label">Rendez-vous</div>
            </div>
            <div class="activity-stat">
                <div class="activity-stat-value">{{ $user->created_at->diffInDays(now()) }}</div>
                <div class="activity-stat-label">Jours actif</div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleAgenceField(role) {
        document.getElementById('agence-field').style.display = (role === 'agence') ? 'block' : 'none';
        var descs = {
            'admin': 'Accès total à la plateforme',
            'agence': 'Gère les biens et les clients',
            'proprietaire': 'Gère ses propres biens',
            'locataire': 'Recherche et loue des biens'
        };
        document.getElementById('role-description').innerHTML =
            '<i class="bi bi-info-circle"></i> ' + (descs[role] || '');
    }

    function checkStrength(pw) {
        var bars = [1, 2, 3, 4].map(function(i) {
            return document.getElementById('pw-bar-' + i);
        });
        var hint = document.getElementById('pw-hint');

        bars.forEach(function(b) {
            b.className = 'bar';
        });

        if (!pw) {
            hint.innerHTML = '<i class="bi bi-info-circle"></i> Minimum 8 caractères recommandés';
            return;
        }

        var score = 0;
        if (pw.length >= 6) score++;
        if (pw.length >= 8) score++;
        if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
        if (/[0-9]/.test(pw) || /[^a-zA-Z0-9]/.test(pw)) score++;

        var levels = ['weak', 'mid', 'mid', 'strong'];
        var labels = [
            '<i class="bi bi-x-circle"></i> Faible',
            '<i class="bi bi-dash-circle"></i> Moyen',
            '<i class="bi bi-check-circle"></i> Correct',
            '<i class="bi bi-shield-check"></i> Fort'
        ];

        for (var i = 0; i < score; i++) {
            bars[i].classList.add('active-' + levels[score - 1]);
        }

        hint.innerHTML = labels[score - 1] || labels[0];
    }
</script>

@endsection