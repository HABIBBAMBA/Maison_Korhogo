@extends('layouts.app')

@section('title', 'Mon Profil Utilisateur — ImmoPro')

@section('content')
<div class="profile-page">
    <div class="profile-container">

        {{-- Fil d'Ariane --}}
        <nav class="profile-breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ url('/') }}">Accueil</a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <a href="{{ route('dashboard') }}">Tableau de bord</a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span class="breadcrumb-current">Mon profil</span>
        </nav>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  CARTE D'IDENTITÉ PRINCIPALE DU COMPTE                               ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <div class="profile-hero-card">
            <div class="profile-hero-main">
                <div class="profile-avatar-wrapper">
                    @if($user->role === 'agence' && $profile?->logo)
                        <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo {{ $user->name }}" class="profile-avatar-img">
                    @else
                        <div class="profile-avatar-fallback">
                            {{ strtoupper(substr($user->name ?: $user->email, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="profile-hero-details">
                    <div class="profile-title-row">
                        <h1 class="profile-user-name">{{ $user->name ?: 'Utilisateur ImmoPro' }}</h1>
                        
                        @if($user->role === 'client')
                            <span class="profile-role-badge role-client">
                                <i class="bi bi-person-check-fill" aria-hidden="true"></i> Client Particulier
                            </span>
                        @elseif($user->role === 'proprietaire')
                            <span class="profile-role-badge role-proprio">
                                <i class="bi bi-house-check-fill" aria-hidden="true"></i> Propriétaire Bailleur
                            </span>
                        @elseif($user->role === 'agence')
                            <span class="profile-role-badge role-agence">
                                <i class="bi bi-buildings-fill" aria-hidden="true"></i> Agence Immobilière Agréée
                            </span>
                        @elseif($user->role === 'admin')
                            <span class="profile-role-badge role-admin">
                                <i class="bi bi-shield-lock-fill" aria-hidden="true"></i> Administrateur Plateforme
                            </span>
                        @endif
                    </div>

                    <div class="profile-meta-list">
                        <span class="meta-item">
                            <i class="bi bi-envelope" aria-hidden="true"></i>
                            <span class="tabular-nums">{{ $user->email }}</span>
                        </span>

                        @if(!empty($profile?->telephone))
                            <span class="meta-item">
                                <i class="bi bi-telephone" aria-hidden="true"></i>
                                <span class="tabular-nums">{{ $profile->telephone }}</span>
                            </span>
                        @endif

                        @if(!empty($profile?->adresse))
                            <span class="meta-item">
                                <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                <span>{{ $profile->adresse }}</span>
                            </span>
                        @endif

                        <span class="meta-item">
                            <i class="bi bi-calendar3" aria-hidden="true"></i>
                            <span>Membre depuis le <strong class="tabular-nums">{{ $user->created_at?->format('d/m/Y') }}</strong></span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Bandeau de statistiques selon le rôle --}}
            @if(!empty($stats))
            <div class="profile-stats-strip">
                @if($user->role === 'client')
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['total_reservations'] ?? 0 }}</span>
                            <span class="stat-txt">Réservations effectuées</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon warning"><i class="bi bi-hourglass-split"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['reservations_en_attente'] ?? 0 }}</span>
                            <span class="stat-txt">En attente d'approbation</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon success"><i class="bi bi-check-circle-fill"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['reservations_confirmees'] ?? 0 }}</span>
                            <span class="stat-txt">Réservations confirmées</span>
                        </div>
                    </div>
                @elseif($user->role === 'proprietaire')
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="bi bi-collection-fill"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['total_annonces'] ?? 0 }}</span>
                            <span class="stat-txt">Annonces publiées</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon success"><i class="bi bi-broadcast"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['annonces_actives'] ?? 0 }}</span>
                            <span class="stat-txt">Actives sur la plateforme</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon warning"><i class="bi bi-calendar-check-fill"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['reservations_recues'] ?? 0 }}</span>
                            <span class="stat-txt">Demandes reçues</span>
                        </div>
                    </div>
                @elseif($user->role === 'agence')
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="bi bi-building"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['total_annonces'] ?? 0 }}</span>
                            <span class="stat-txt">Annonces en ligne</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon info"><i class="bi bi-folder-check"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['total_biens'] ?? 0 }}</span>
                            <span class="stat-txt">Biens en gestion</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon success"><i class="bi bi-calendar-check-fill"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['reservations_recues'] ?? 0 }}</span>
                            <span class="stat-txt">Demandes clients reçues</span>
                        </div>
                    </div>
                @elseif($user->role === 'admin')
                    <div class="stat-pill">
                        <div class="stat-icon info"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['total_users'] ?? 0 }}</span>
                            <span class="stat-txt">Utilisateurs enregistrés</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="bi bi-buildings"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">{{ $stats['total_annonces'] ?? 0 }}</span>
                            <span class="stat-txt">Annonces globales</span>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-icon success"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <span class="stat-num tabular-nums">100%</span>
                            <span class="stat-txt">Accès superviseur actif</span>
                        </div>
                    </div>
                @endif
            </div>
            @endif
        </div>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  GRILLE DE GESTION DU PROFIL (2 COLONNES)                            ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <div class="profile-grid">

            {{-- ── COLONNE 1 : INFORMATIONS PERSONNELLES DU RÔLE ── --}}
            <div class="profile-card">
                <div class="card-header">
                    <div class="header-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>
                    <div>
                        <h2 class="card-title">Informations du profil</h2>
                        <p class="card-subtitle">
                            @if($user->role === 'client')
                                Vos coordonnées personnelles pour vos démarches et réservations.
                            @elseif($user->role === 'proprietaire')
                                Vos informations de contact visibles par les acquéreurs et locataires.
                            @elseif($user->role === 'agence')
                                Coordonnées professionnelles, représentant et identité de l'agence.
                            @else
                                Identité et adresse email d'administration.
                            @endif
                        </p>
                    </div>
                </div>

                @if(session('status') === 'profile-updated' || session('success'))
                    <div class="alert-success-box" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') ?? 'Votre profil a été mis à jour avec succès.' }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="profile-form">
                    @csrf
                    @method('PATCH')

                    {{-- ── CHAMPS SPÉCIFIQUES : CLIENT ── --}}
                    @if($user->role === 'client')
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom" class="form-label">Prénom <span class="req">*</span></label>
                                <input type="text" name="prenom" id="prenom" class="form-input @error('prenom') error @enderror"
                                    value="{{ old('prenom', $profile?->prenom ?? explode(' ', $user->name, 2)[0] ?? '') }}" required>
                                @error('prenom')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nom" class="form-label">Nom de famille <span class="req">*</span></label>
                                <input type="text" name="nom" id="nom" class="form-input @error('nom') error @enderror"
                                    value="{{ old('nom', $profile?->nom ?? explode(' ', $user->name, 2)[1] ?? '') }}" required>
                                @error('nom')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephone" class="form-label">Numéro de téléphone / WhatsApp</label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-telephone input-icon"></i>
                                <input type="tel" name="telephone" id="telephone" class="form-input with-icon tabular-nums @error('telephone') error @enderror"
                                    placeholder="+225 07 00 00 00 00"
                                    value="{{ old('telephone', $profile?->telephone ?? '') }}">
                            </div>
                            <span class="form-hint">Utilisé pour vous joindre lors de vos réservations ou demandes de visite.</span>
                            @error('telephone')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                    {{-- ── CHAMPS SPÉCIFIQUES : PROPRIÉTAIRE ── --}}
                    @elseif($user->role === 'proprietaire')
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom" class="form-label">Prénom du propriétaire <span class="req">*</span></label>
                                <input type="text" name="prenom" id="prenom" class="form-input @error('prenom') error @enderror"
                                    value="{{ old('prenom', $profile?->prenom ?? explode(' ', $user->name, 2)[0] ?? '') }}" required>
                                @error('prenom')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nom" class="form-label">Nom de famille <span class="req">*</span></label>
                                <input type="text" name="nom" id="nom" class="form-input @error('nom') error @enderror"
                                    value="{{ old('nom', $profile?->nom ?? explode(' ', $user->name, 2)[1] ?? '') }}" required>
                                @error('nom')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="telephone" class="form-label">Numéro de téléphone direct</label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-telephone input-icon"></i>
                                    <input type="tel" name="telephone" id="telephone" class="form-input with-icon tabular-nums @error('telephone') error @enderror"
                                        placeholder="+225 07 00 00 00 00"
                                        value="{{ old('telephone', $profile?->telephone ?? '') }}">
                                </div>
                                @error('telephone')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="adresse" class="form-label">Quartier / Ville de résidence</label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-geo-alt input-icon"></i>
                                    <input type="text" name="adresse" id="adresse" class="form-input with-icon @error('adresse') error @enderror"
                                        placeholder="Ex: Korhogo, Quartier Résidentiel"
                                        value="{{ old('adresse', $profile?->adresse ?? '') }}">
                                </div>
                                @error('adresse')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    {{-- ── CHAMPS SPÉCIFIQUES : AGENCE ── --}}
                    @elseif($user->role === 'agence')
                        <div class="form-group">
                            <label for="nom_agence" class="form-label">Raison sociale / Nom commercial de l'agence <span class="req">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-buildings input-icon"></i>
                                <input type="text" name="nom_agence" id="nom_agence" class="form-input with-icon @error('nom_agence') error @enderror"
                                    placeholder="Ex: Agence Immobilière du Nord"
                                    value="{{ old('nom_agence', $profile?->nom_agence ?? $user->name) }}" required>
                            </div>
                            @error('nom_agence')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom_responsable" class="form-label">Nom du directeur / gérant <span class="req">*</span></label>
                                <input type="text" name="nom_responsable" id="nom_responsable" class="form-input @error('nom_responsable') error @enderror"
                                    placeholder="Ex: Konan Kouassi"
                                    value="{{ old('nom_responsable', $profile?->nom_responsable ?? '') }}" required>
                                @error('nom_responsable')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telephone" class="form-label">Ligne directe de l'agence <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-telephone input-icon"></i>
                                    <input type="tel" name="telephone" id="telephone" class="form-input with-icon tabular-nums @error('telephone') error @enderror"
                                        placeholder="+225 27 00 00 00"
                                        value="{{ old('telephone', $profile?->telephone ?? '') }}" required>
                                </div>
                                @error('telephone')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="adresse" class="form-label">Adresse physique du siège / Bureau</label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-geo-alt input-icon"></i>
                                <input type="text" name="adresse" id="adresse" class="form-input with-icon @error('adresse') error @enderror"
                                    placeholder="Ex: Korhogo Centre, Rue du Commerce, Immeuble Horizon"
                                    value="{{ old('adresse', $profile?->adresse ?? '') }}">
                            </div>
                            @error('adresse')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Upload Logo Agence --}}
                        <div class="form-group">
                            <label class="form-label">Logo officiel de l'agence</label>
                            <div class="logo-upload-box">
                                <div class="current-logo-preview">
                                    @if($profile?->logo)
                                        <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" id="logoPreviewImg" class="preview-img">
                                    @else
                                        <div class="logo-preview-placeholder" id="logoPlaceholder">
                                            <i class="bi bi-image"></i>
                                        </div>
                                        <img src="" alt="Aperçu" id="logoPreviewImg" class="preview-img" style="display: none;">
                                    @endif
                                </div>
                                <div class="logo-upload-content">
                                    <input type="file" name="logo" id="logoInput" accept="image/jpeg,image/png,image/webp" class="file-input" onchange="previewLogo(event)">
                                    <label for="logoInput" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-upload"></i> Choisir un logo
                                    </label>
                                    <span class="upload-note">Formats recommandés : PNG, JPG, WebP. Taille max : 2 Mo.</span>
                                </div>
                            </div>
                            @error('logo')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                    {{-- ── CHAMPS PAR DÉFAUT / ADMIN ── --}}
                    @else
                        <div class="form-group">
                            <label for="name" class="form-label">Nom d'affichage <span class="req">*</span></label>
                            <input type="text" name="name" id="name" class="form-input @error('name') error @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    {{-- ── CHAMP EMAIL COMMUN ── --}}
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse email de connexion <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email" id="email" class="form-input with-icon tabular-nums @error('email') error @enderror"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── COLONNE 2 : SÉCURITÉ & MOT DE PASSE ── --}}
            <div class="profile-card">
                <div class="card-header">
                    <div class="header-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <div>
                        <h2 class="card-title">Sécurité du compte</h2>
                        <p class="card-subtitle">Mettez à jour votre mot de passe pour garantir la sécurité de votre espace.</p>
                    </div>
                </div>

                @if(session('status') === 'password-updated')
                    <div class="alert-success-box" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Votre mot de passe a été mis à jour avec succès.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password" class="form-label">Mot de passe actuel <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-key input-icon"></i>
                            <input type="password" name="current_password" id="current_password" class="form-input with-icon @error('current_password', 'updatePassword') error @enderror"
                                placeholder="••••••••" required autocomplete="current-password">
                        </div>
                        @error('current_password', 'updatePassword')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Nouveau mot de passe <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-input with-icon @error('password', 'updatePassword') error @enderror"
                                placeholder="Minimum 8 caractères" required autocomplete="new-password">
                        </div>
                        @error('password', 'updatePassword')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-shield-check input-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input with-icon @error('password_confirmation', 'updatePassword') error @enderror"
                                placeholder="Confirmez à l'identique" required autocomplete="new-password">
                        </div>
                        @error('password_confirmation', 'updatePassword')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-secondary">
                            <i class="bi bi-shield-check"></i> Changer le mot de passe
                        </button>
                    </div>
                </form>

                <div class="security-recommendations">
                    <div class="rec-title"><i class="bi bi-info-circle"></i> Conseils de sécurité</div>
                    <ul class="rec-list">
                        <li>Utilisez au moins 8 caractères avec majuscules, chiffres et symboles.</li>
                        <li>Ne partagez jamais vos identifiants d'accès ImmoPro.</li>
                        <li>En cas d'activité suspecte, modifiez immédiatement votre mot de passe.</li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  ZONE DANGEREUSE : SUPPRESSION DÉFINITIVE DU COMPTE                  ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <div class="profile-card danger-card">
            <div class="danger-card-header">
                <div class="danger-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h2 class="danger-title">Zone critique : Suppression du compte</h2>
                    <p class="danger-desc">
                        La suppression de votre compte est une action irréversible. L'ensemble de vos données,
                        profil, historique de réservations et annonces associées seront définitivement supprimés de la plateforme.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="danger-form"
                data-confirm="Êtes-vous certain de vouloir supprimer définitivement votre compte ImmoPro ? Toutes vos données associées seront effacées."
                data-confirm-title="Supprimer mon compte utilisateur"
                data-confirm-btn="Supprimer définitivement"
                data-confirm-warning="Cette opération est irréversible et clôturera immédiatement votre accès à la plateforme.">
                @csrf
                @method('DELETE')

                <div class="danger-input-row">
                    <div class="form-group" style="margin-bottom: 0; flex: 1; max-width: 380px;">
                        <label for="delete_password" class="form-label" style="color: var(--status-danger-text);">Confirmez votre mot de passe pour supprimer :</label>
                        <input type="password" name="password" id="delete_password" class="form-input @error('password', 'userDeletion') error @enderror"
                            placeholder="Votre mot de passe actuel" required autocomplete="current-password">
                        @error('password', 'userDeletion')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger-solid">
                        <i class="bi bi-trash3"></i> Supprimer définitivement mon compte
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES DE LA PAGE PROFIL (SKILL_DESIGN, ZÉRO DÉGRADÉ)               ║
       ╚══════════════════════════════════════════════════════════════════════╝ */
    .profile-page {
        background-color: var(--surface-sunken);
        min-height: calc(100vh - var(--nav-height));
        padding-block: 2rem 4.5rem;
    }

    .profile-container {
        max-width: 1160px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    /* Fil d'Ariane */
    .profile-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }

    .profile-breadcrumb a {
        color: var(--text-secondary);
        transition: color var(--duration-fast) var(--ease-out-expo);
    }

    .profile-breadcrumb a:hover {
        color: var(--text-primary);
    }

    .breadcrumb-sep {
        opacity: 0.5;
    }

    .breadcrumb-current {
        color: var(--text-primary);
        font-weight: 600;
    }

    /* ═══════ CARTE HERO PRINCIPALE ═══════ */
    .profile-hero-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-raised);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .profile-hero-main {
        display: flex;
        align-items: center;
        gap: 1.75rem;
    }

    .profile-avatar-wrapper {
        flex-shrink: 0;
    }

    .profile-avatar-img {
        width: 80px;
        height: 80px;
        border-radius: var(--radius-md);
        object-fit: cover;
        border: 2px solid var(--border-subtle);
        background-color: var(--surface-sunken);
        box-shadow: var(--shadow-raised);
    }

    .profile-avatar-fallback {
        width: 80px;
        height: 80px;
        border-radius: var(--radius-md);
        background-color: var(--accent-primary);
        color: #FFFFFF;
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
    }

    .profile-hero-details {
        flex: 1;
        min-width: 0;
    }

    .profile-title-row {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        flex-wrap: wrap;
        margin-bottom: 0.65rem;
    }

    .profile-user-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .profile-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .role-client {
        background-color: #EBF8F2;
        color: #196C45;
        border: 1px solid #A3E3C1;
    }

    .role-proprio {
        background-color: #EFF6FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
    }

    .role-agence {
        background-color: #FFF7ED;
        color: #C2410C;
        border: 1px solid #FED7AA;
    }

    .role-admin {
        background-color: #F5F3FF;
        color: #6D28D9;
        border: 1px solid #DDD6FE;
    }

    .profile-meta-list {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex-wrap: wrap;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .meta-item i {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* ═══════ BANDEAU DE STATS ═══════ */
    .profile-stats-strip {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-top: 1.75rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-subtle);
    }

    .stat-pill {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.85rem 1rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-sm);
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-xs);
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        color: var(--accent-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .stat-icon.success {
        color: #16A34A;
        border-color: #BBF7D0;
    }

    .stat-icon.warning {
        color: #D97706;
        border-color: #FDE68A;
    }

    .stat-icon.info {
        color: #2563EB;
        border-color: #BFDBFE;
    }

    .stat-num {
        display: block;
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.1;
    }

    .stat-txt {
        display: block;
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 600;
    }

    /* ═══════ GRILLE 2 COLONNES ═══════ */
    .profile-grid {
        display: grid;
        grid-template-columns: 1.35fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
        align-items: start;
    }

    .profile-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-raised);
        padding: 1.75rem;
    }

    .card-header {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--border-subtle);
    }

    .header-icon {
        width: 42px;
        height: 42px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--accent-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.01em;
        margin-bottom: 0.2rem;
    }

    .card-subtitle {
        font-size: 0.82rem;
        color: var(--text-secondary);
        line-height: 1.45;
        margin: 0;
    }

    .alert-success-box {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.75rem 1rem;
        border-radius: var(--radius-sm);
        background-color: #EBF8F2;
        border: 1px solid #A3E3C1;
        color: #196C45;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }

    /* ═══════ FORMULAIRES ═══════ */
    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .form-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .form-label .req {
        color: #DC2626;
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon-wrap .input-icon {
        position: absolute;
        inset-inline-start: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 0.95rem;
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        height: 44px;
        padding: 0.55rem 0.95rem;
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
        padding-inline-start: 2.35rem;
    }

    .form-input:hover {
        border-color: var(--border-strong);
    }

    .form-input:focus {
        outline: none;
        background-color: var(--surface-raised);
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px oklch(0.24 0.08 245 / 0.15);
    }

    .form-input.error {
        border-color: #DC2626;
        background-color: #FEF2F2;
    }

    .form-error {
        font-size: 0.78rem;
        color: #DC2626;
        font-weight: 600;
        margin-top: 2px;
    }

    .form-hint {
        font-size: 0.75rem;
        color: var(--text-muted);
        line-height: 1.4;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-subtle);
    }

    /* Upload Logo Box */
    .logo-upload-box {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 0.9rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
    }

    .current-logo-preview {
        width: 58px;
        height: 58px;
        border-radius: var(--radius-xs);
        border: 1px solid var(--border-default);
        background-color: var(--surface-raised);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .current-logo-preview .preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .logo-preview-placeholder {
        font-size: 1.5rem;
        color: var(--text-muted);
    }

    .logo-upload-content {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .file-input {
        display: none;
    }

    .upload-note {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* Conseils sécurité */
    .security-recommendations {
        margin-top: 1.75rem;
        padding: 1rem 1.15rem;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
    }

    .rec-title {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.5rem;
    }

    .rec-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        font-size: 0.78rem;
        color: var(--text-secondary);
        padding-inline-start: 1.15rem;
    }

    .rec-list li {
        position: relative;
    }

    .rec-list li::before {
        content: '•';
        position: absolute;
        inset-inline-start: -0.85rem;
        color: var(--accent-cta);
        font-weight: bold;
    }

    /* ═══════ ZONE CRITIQUE DANGER ═══════ */
    .danger-card {
        border-color: #FCA5A5;
        background-color: #FFFDFD;
    }

    .danger-card-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .danger-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        background-color: #FEE2E2;
        border: 1px solid #FCA5A5;
        color: #DC2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .danger-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: #991B1B;
        margin-bottom: 0.25rem;
    }

    .danger-desc {
        font-size: 0.85rem;
        color: #7F1D1D;
        line-height: 1.5;
        margin: 0;
    }

    .danger-input-row {
        display: flex;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
        padding-top: 1rem;
        border-top: 1px solid #FEE2E2;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .profile-hero-main {
            flex-direction: column;
            text-align: center;
        }

        .profile-title-row {
            justify-content: center;
        }

        .profile-meta-list {
            justify-content: center;
        }

        .danger-input-row {
            flex-direction: column;
            align-items: stretch;
        }

        .danger-input-row .form-group {
            max-width: 100% !important;
        }
    }

    @media (max-width: 600px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function previewLogo(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logoPreviewImg');
            const placeholder = document.getElementById('logoPlaceholder');
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            if (placeholder) {
                placeholder.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
@endsection
