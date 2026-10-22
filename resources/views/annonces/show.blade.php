@extends('layouts.app')

@section('title', $annonce->titre . ' — ImmoPro Côte d\'Ivoire')

@section('content')

@php
    $images = is_string($annonce->images) ? json_decode($annonce->images, true) : $annonce->images;
    if (!is_array($images)) $images = [];
    $images = array_values(array_filter($images, fn($img) => !empty($img)));

    $equips = is_string($annonce->equipements) ? json_decode($annonce->equipements, true) : $annonce->equipements;
    if (!is_array($equips)) $equips = [];

    $telephone = $annonce->user->proprietaire->telephone ?? $annonce->user->agence->telephone ?? null;
    $proprietaireNom = $annonce->user->proprietaire ? ($annonce->user->proprietaire->prenom . ' ' . $annonce->user->proprietaire->nom) : ($annonce->user->agence->nom_agence ?? $annonce->user->name);
    $userInitial = strtoupper(substr($proprietaireNom, 0, 1));
@endphp

<div class="detail-page">
    <div class="detail-container">

        {{-- Barre de navigation supérieure & fil d'Ariane --}}
        <div class="detail-top-nav">
            <nav class="detail-breadcrumb" aria-label="Fil d'Ariane">
                <a href="{{ url('/') }}">Accueil</a>
                <span class="sep" aria-hidden="true">/</span>
                <a href="{{ route('annonces.index') }}">Annonces</a>
                <span class="sep" aria-hidden="true">/</span>
                <span class="current">{{ Str::limit($annonce->titre, 35) }}</span>
            </nav>

            <div class="detail-status-pill {{ $annonce->statut === 'active' ? 'status-active' : 'status-inactive' }}">
                <span class="status-dot" aria-hidden="true"></span>
                <span>{{ $annonce->statut === 'active' ? 'Disponible' : 'Indisponible' }}</span>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-box alert-success" role="alert" style="margin-bottom: 1.5rem; background-color: var(--status-success-bg); border: 1px solid var(--status-success-border); color: var(--status-success-text); padding: 1rem 1.25rem; border-radius: var(--radius-sm); display: flex; align-items: center; gap: 0.75rem;">
            <i class="bi bi-check-circle-fill" style="font-size: 1.2rem; flex-shrink: 0;"></i>
            <div>
                <strong>Confirmation :</strong>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="alert-box alert-error" role="alert" style="margin-bottom: 1.5rem; background-color: var(--status-danger-bg); border: 1px solid var(--status-danger-border); color: var(--status-danger-text); padding: 1rem 1.25rem; border-radius: var(--radius-sm); display: flex; align-items: flex-start; gap: 0.75rem;">
            <i class="bi bi-exclamation-octagon-fill" style="font-size: 1.2rem; margin-top: 2px; flex-shrink: 0;"></i>
            <div>
                <strong>Attention :</strong>
                <ul style="margin: 0.25rem 0 0 1rem; padding: 0;">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  GALERIE PHOTO MATÉRIELLE SOLIDE (ZÉRO DÉGRADÉ)                     ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <section class="gallery-section" aria-label="Photographies du bien">
            @if(count($images) > 0)
            <div class="gallery-viewport">
                <div class="gallery-track" id="galleryTrack">
                    @foreach($images as $index => $img)
                    <div class="gallery-slide" data-slide-index="{{ $index }}">
                        <img
                            src="{{ asset('storage/' . $img) }}"
                            alt="Vue {{ $index + 1 }} - {{ $annonce->titre }}"
                            class="gallery-image"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                    </div>
                    @endforeach
                </div>

                @if(count($images) > 1)
                <button type="button" class="gallery-nav-btn btn-prev" onclick="navGallery(-1)" aria-label="Photo précédente">
                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                </button>
                <button type="button" class="gallery-nav-btn btn-next" onclick="navGallery(1)" aria-label="Photo suivante">
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </button>
                <div class="gallery-counter tabular-nums" id="galleryCounter">
                    <i class="bi bi-camera-fill" aria-hidden="true"></i>
                    <span>1 / {{ count($images) }}</span>
                </div>
                @endif
            </div>

            {{-- Bande de vignettes --}}
            @if(count($images) > 1)
            <div class="gallery-thumbnails" role="tablist" aria-label="Sélection des photos">
                @foreach($images as $index => $img)
                <button
                    type="button"
                    class="thumb-btn{{ $loop->first ? ' active' : '' }}"
                    onclick="selectSlide({{ $index }})"
                    aria-label="Afficher la photo {{ $index + 1 }}"
                    data-thumb-index="{{ $index }}">
                    <img src="{{ asset('storage/' . $img) }}" alt="" loading="lazy">
                </button>
                @endforeach
            </div>
            @endif

            @else
            <div class="gallery-empty-frame" aria-hidden="true">
                <i class="bi bi-image" style="font-size: 3rem; color: var(--border-strong);"></i>
                <span>Aucune photographie fournie pour ce bien</span>
            </div>
            @endif
        </section>

        {{-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  DISPOSITION PRINCIPALE (GRILLE CONTENU + SIDEBAR)                 ║
             ╚══════════════════════════════════════════════════════════════════════╝ --}}
        <div class="detail-layout">

            {{-- Colonne principale --}}
            <main class="detail-main-col">

                {{-- Bloc Titre & Localisation --}}
                <div class="detail-card">
                    <div class="detail-meta-tags">
                        <span class="detail-type-badge">{{ ucfirst($annonce->type_bien ?? 'Bien') }}</span>
                        <span class="detail-offre-badge {{ $annonce->type_offre === 'location' ? 'badge-teal' : 'badge-navy' }}">
                            {{ strtoupper($annonce->type_offre ?? 'VENTE') }}
                        </span>
                        <span class="detail-date-badge tabular-nums">
                            Réf. #{{ str_pad($annonce->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <h1 class="detail-property-title">{{ $annonce->titre }}</h1>

                    <div class="detail-location-bar">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <span>{{ $annonce->adresse ?? '' }} {{ $annonce->quartier ? '(' . $annonce->quartier . ')' : '' }}, Korhogo, Côte d'Ivoire</span>
                    </div>

                    {{-- Prix proéminent avec tabular-nums --}}
                    <div class="detail-price-box">
                        <div class="price-amount tabular-nums">
                            {{ number_format($annonce->prix, 0, ',', ' ') }}
                            <span class="price-currency">FCFA</span>
                        </div>
                        @if($annonce->isCourtSejour())
                        <span class="price-period">/ nuitée</span>
                        @elseif($annonce->type_offre === 'location')
                        <span class="price-period">/ mois</span>
                        @endif
                    </div>
                </div>

                {{-- Spécifications matérielles clés --}}
                <div class="detail-card specs-matrix-card">
                    <h2 class="card-section-title">
                        <i class="bi bi-sliders2" aria-hidden="true"></i>
                        <span>Caractéristiques Techniques</span>
                    </h2>

                    <div class="specs-grid">
                        @if($annonce->capacite_voyageurs)
                        <div class="spec-tile">
                            <span class="spec-tile-icon" aria-hidden="true"><i class="bi bi-people-fill"></i></span>
                            <div class="spec-tile-data">
                                <span class="spec-tile-value tabular-nums">{{ $annonce->capacite_voyageurs }} personnes</span>
                                <span class="spec-tile-label">Capacité d'accueil</span>
                            </div>
                        </div>
                        @endif

                        @if($annonce->superficie)
                        <div class="spec-tile">
                            <span class="spec-tile-icon" aria-hidden="true"><i class="bi bi-arrows-fullscreen"></i></span>
                            <div class="spec-tile-data">
                                <span class="spec-tile-value tabular-nums">{{ number_format($annonce->superficie, 0, ',', ' ') }} m²</span>
                                <span class="spec-tile-label">Superficie</span>
                            </div>
                        </div>
                        @endif

                        @if($annonce->nombre_pieces)
                        <div class="spec-tile">
                            <span class="spec-tile-icon" aria-hidden="true"><i class="bi bi-grid-1x2"></i></span>
                            <div class="spec-tile-data">
                                <span class="spec-tile-value tabular-nums">{{ $annonce->nombre_pieces }}</span>
                                <span class="spec-tile-label">Nombre de pièces</span>
                            </div>
                        </div>
                        @endif

                        @if($annonce->nombre_chambres)
                        <div class="spec-tile">
                            <span class="spec-tile-icon" aria-hidden="true"><i class="bi bi-door-open"></i></span>
                            <div class="spec-tile-data">
                                <span class="spec-tile-value tabular-nums">{{ $annonce->nombre_chambres }}</span>
                                <span class="spec-tile-label">Chambres autonomes</span>
                            </div>
                        </div>
                        @endif

                        @if($annonce->nombre_salles_bain)
                        <div class="spec-tile">
                            <span class="spec-tile-icon" aria-hidden="true"><i class="bi bi-droplet"></i></span>
                            <div class="spec-tile-data">
                                <span class="spec-tile-value tabular-nums">{{ $annonce->nombre_salles_bain }}</span>
                                <span class="spec-tile-label">Salles d'eau / bains</span>
                            </div>
                        </div>
                        @endif

                        @if($annonce->date_disponibilite)
                        <div class="spec-tile">
                            <span class="spec-tile-icon" aria-hidden="true"><i class="bi bi-calendar-event"></i></span>
                            <div class="spec-tile-data">
                                <span class="spec-tile-value tabular-nums">{{ \Carbon\Carbon::parse($annonce->date_disponibilite)->format('d/m/Y') }}</span>
                                <span class="spec-tile-label">Disponibilité</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Description complète --}}
                @if($annonce->description)
                <div class="detail-card">
                    <h2 class="card-section-title">
                        <i class="bi bi-text-paragraph" aria-hidden="true"></i>
                        <span>Description Détaillée du Bien</span>
                    </h2>
                    <div class="detail-prose">
                        {!! nl2br(e($annonce->description)) !!}
                    </div>
                </div>
                @endif

                {{-- Équipements et commodités --}}
                @if(count($equips) > 0)
                <div class="detail-card">
                    <h2 class="card-section-title">
                        <i class="bi bi-check2-circle" aria-hidden="true"></i>
                        <span>Équipements & Commodités</span>
                    </h2>

                    <div class="equipments-list">
                        @foreach($equips as $index => $equip)
                        <div class="equipment-chip">
                            <i class="bi bi-check-lg chip-icon" aria-hidden="true"></i>
                            <span>{{ $annonce->equipements_labels[$index] ?? (is_string($equip) ? ucfirst(str_replace('_', ' ', $equip)) : ($equip['nom'] ?? '')) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </main>

            {{-- Sidebar de Contact & Sécurité --}}
            <aside class="detail-sidebar" aria-label="Interlocuteur et contact">
                <div class="sidebar-sticky-card">

                    {{-- En-tête Annonceur --}}
                    <div class="agent-profile-box">
                        <div class="agent-avatar" aria-hidden="true">
                            {{ $userInitial }}
                        </div>
                        <div class="agent-info">
                            <span class="agent-label">Annonceur vérifié</span>
                            <h3 class="agent-name">{{ $proprietaireNom }}</h3>
                            <span class="agent-role">{{ ucfirst($annonce->user->role ?? 'Partenaire certifié') }}</span>
                        </div>
                    </div>

                    @if($annonce->isCourtSejour())
                    {{-- ╔══════════════════════════════════════════════════════════════════════╗
                         ║  WIDGET DE RÉSERVATION COURT SÉJOUR (HÔTEL & RÉSIDENCE MEUBLÉE)     ║
                         ╚══════════════════════════════════════════════════════════════════════╝ --}}
                    <div class="booking-widget-box" x-data="{
                        dateArrivee: '{{ date('Y-m-d') }}',
                        dateDepart: '{{ date('Y-m-d', strtotime('+1 day')) }}',
                        prixNuit: {{ (float) $annonce->prix }},
                        personnes: 1,
                        get nuits() {
                            if (!this.dateArrivee || !this.dateDepart) return 1;
                            const d1 = new Date(this.dateArrivee);
                            const d2 = new Date(this.dateDepart);
                            const diff = Math.round((d2 - d1) / (1000 * 60 * 60 * 24));
                            return diff > 0 ? diff : 1;
                        },
                        get total() {
                            return this.nuits * this.prixNuit;
                        },
                        get whatsappUrl() {
                            const text = encodeURIComponent(`Bonjour {{ $proprietaireNom }}, je souhaite réserver votre hébergement ImmoPro : « {{ $annonce->titre }} » du ${this.dateArrivee} au ${this.dateDepart} (${this.nuits} nuit(s) pour ${this.personnes} personne(s)). Montant estimé : ${this.formatPrix(this.total)}. Le logement est-il disponible ?`);
                            return `https://wa.me/{{ preg_replace('/[^0-9]/', '', $telephone ?? '') }}?text=${text}`;
                        },
                        formatPrix(val) {
                            return new Intl.NumberFormat('fr-FR').format(val) + ' FCFA';
                        }
                    }">
                        <div class="booking-widget-header">
                            <span class="booking-badge"><i class="bi bi-moon-stars-fill"></i> Nuitée & Court séjour</span>
                            <div class="booking-price-row">
                                <span class="booking-price-val tabular-nums">{{ number_format($annonce->prix, 0, ',', ' ') }}</span>
                                <span class="booking-price-curr">FCFA</span>
                                <span class="booking-price-sub">/ nuit</span>
                            </div>
                        </div>

                        <form action="{{ route('reservations.store') }}" method="POST" class="booking-form">
                            @csrf
                            <input type="hidden" name="id_annonce" value="{{ $annonce->id }}">

                            <div class="booking-date-inputs">
                                <div class="booking-field">
                                    <label class="booking-label">Arrivée (Check-in)</label>
                                    <input type="date" name="date_arrivee" x-model="dateArrivee" min="{{ date('Y-m-d') }}" class="booking-input" required>
                                </div>
                                <div class="booking-field">
                                    <label class="booking-label">Départ (Check-out)</label>
                                    <input type="date" name="date_depart" x-model="dateDepart" :min="dateArrivee" class="booking-input" required>
                                </div>
                            </div>

                            <div class="booking-field" style="margin-top: 0.75rem;">
                                <label class="booking-label">Nombre de personnes</label>
                                <select name="nombre_personnes" x-model.number="personnes" class="booking-select">
                                    @for($p = 1; $p <= max(6, (int)($annonce->capacite_voyageurs ?? 4)); $p++)
                                    <option value="{{ $p }}">{{ $p }} voyageur{{ $p > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="booking-calc-breakdown">
                                <div class="calc-row">
                                    <span>Calcul séjour :</span>
                                    <span class="calc-val tabular-nums">
                                        <span x-text="nuits">1</span> nuit(s) × {{ number_format($annonce->prix, 0, ',', ' ') }}
                                    </span>
                                </div>
                                <div class="calc-total-row">
                                    <span>Total estimé :</span>
                                    <strong class="calc-total-val tabular-nums" x-text="formatPrix(total)">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</strong>
                                </div>
                            </div>

                            <div class="booking-guest-info">
                                <div class="booking-field">
                                    <label class="booking-label">Nom du voyageur *</label>
                                    <input type="text" name="nom_client" value="{{ old('nom_client', auth()->user()->name ?? '') }}" class="booking-input" placeholder="Votre nom" required>
                                </div>
                                <div class="booking-field" style="margin-top: 0.5rem;">
                                    <label class="booking-label">Téléphone (appel/WhatsApp) *</label>
                                    <input type="tel" name="telephone" value="{{ old('telephone', auth()->user()->client->telephone ?? '') }}" class="booking-input tabular-nums" placeholder="+225 07..." required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-cta btn-block" style="margin-top: 1rem;">
                                <i class="bi bi-calendar-check-fill" aria-hidden="true"></i>
                                <span>Demander la réservation</span>
                            </button>

                            @if($telephone)
                            <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer" class="btn btn-brand btn-block" style="margin-top: 0.5rem;">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                                <span>Réserver via WhatsApp</span>
                            </a>
                            <button type="button" class="btn btn-secondary btn-block" onclick="ouvrirModalAppel()" style="margin-top: 0.5rem;">
                                <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                                <span>Appeler l'hôte</span>
                            </button>
                            @endif
                        </form>
                    </div>

                    @else
                    {{-- Actions de contact classique (Vente / Location bail) --}}
                    <div class="agent-actions">
                        @if($telephone)
                        <button type="button" class="btn btn-cta btn-block" onclick="ouvrirModalAppel()">
                            <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                            <span>Contacter l'agent</span>
                        </button>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $telephone) }}?text=Bonjour,%20je%20suis%20intéressé(e)%20par%20votre%20annonce%20ImmoPro%20:{{ urlencode($annonce->titre) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-brand btn-block">
                            <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            <span>Échanger sur WhatsApp</span>
                        </a>
                        @endif

                        <a href="{{ route('contacts.create', $annonce) }}" class="btn btn-secondary btn-block">
                            <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                            <span>Envoyer un message en ligne</span>
                        </a>
                    </div>
                    @endif

                    {{-- Sceau de sécurité foncière --}}
                    <div class="security-seal-box">
                        <div class="seal-icon" aria-hidden="true">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="seal-text">
                            <strong>Charte de Rigueur Foncière</strong>
                            <p>Toute transaction doit être scellée par quittance légale. Visites accompagnées par des conseillers accrédités.</p>
                        </div>
                    </div>

                </div>
            </aside>

        </div>

    </div>
</div>

{{-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  MODALE D'APPEL TÉLÉPHONIQUE (SOLIDE, SANS DÉGRADÉ)                 ║
     ╚══════════════════════════════════════════════════════════════════════╝ --}}
@if($telephone)
<div class="modal-backdrop" id="modalAppel" role="dialog" aria-modal="true" aria-labelledby="modalTitle" style="display: none;">
    <div class="modal-card">
        <button type="button" class="modal-close-btn" onclick="fermerModalAppel()" aria-label="Fermer la fenêtre">
            <i class="bi bi-x-lg" aria-hidden="true"></i>
        </button>

        <div class="modal-icon-badge" aria-hidden="true">
            <i class="bi bi-telephone"></i>
        </div>

        <h3 class="modal-title" id="modalTitle">Contacter l'annonceur</h3>
        <p class="modal-desc">Numéro direct enregistré pour {{ $proprietaireNom }} :</p>

        <div class="modal-phone-display tabular-nums">
            {{ $telephone }}
        </div>

        <div class="modal-btn-row">
            <a href="tel:{{ $telephone }}" class="btn btn-cta" style="flex: 1;">
                <i class="bi bi-telephone-outbound" aria-hidden="true"></i>
                <span>Composer l'appel</span>
            </a>
            <button type="button" class="btn btn-secondary" onclick="fermerModalAppel()" style="flex: 1;">
                Fermer
            </button>
        </div>
    </div>
</div>
@endif

@push('styles')
<style>
    /* ╔══════════════════════════════════════════════════════════════════════╗
       ║  STYLES FICHE DÉTAIL DU BIEN (STANDARDS SKILL_DESIGN)                ║
       ╚══════════════════════════════════════════════════════════════════════╝ */
    .detail-page {
        background-color: var(--surface-sunken);
        min-height: calc(100vh - var(--nav-height));
        padding-block: 2rem 5rem;
    }

    .detail-container {
        max-width: 1240px;
        margin: 0 auto;
        padding-inline: clamp(1rem, 4vw, 2.5rem);
    }

    /* Barre supérieure */
    .detail-top-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .detail-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        color: var(--text-muted);
    }

    .detail-breadcrumb a {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .detail-breadcrumb a:hover {
        color: var(--accent-brand);
    }

    .detail-breadcrumb .sep {
        color: var(--border-strong);
    }

    .detail-breadcrumb .current {
        color: var(--text-primary);
        font-weight: 600;
    }

    .detail-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.35rem 0.85rem;
        border-radius: var(--radius-full);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-active {
        background-color: var(--status-success-bg);
        color: var(--status-success-text);
        border: 1px solid var(--status-success-border);
    }

    .status-inactive {
        background-color: var(--status-danger-bg);
        color: var(--status-danger-text);
        border: 1px solid var(--status-danger-border);
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: currentColor;
    }

    /* Galerie de photos solide */
    .gallery-section {
        margin-bottom: 2.25rem;
    }

    .gallery-viewport {
        position: relative;
        background-color: var(--surface-dark-sunken);
        border: 1px solid var(--border-dark);
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-raised);
    }

    .gallery-track {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .gallery-track::-webkit-scrollbar {
        display: none;
    }

    .gallery-slide {
        min-width: 100%;
        height: clamp(340px, 50vw, 520px);
        scroll-snap-align: start;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-dark-base);
        border: 1px solid var(--border-dark);
        color: var(--text-inverse);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
        font-size: 1.1rem;
        transition: background-color var(--duration-fast) var(--ease-out-expo);
    }

    .gallery-nav-btn:hover {
        background-color: var(--surface-dark-raised);
    }

    .gallery-nav-btn.btn-prev {
        inset-inline-start: 1rem;
    }

    .gallery-nav-btn.btn-next {
        inset-inline-end: 1rem;
    }

    .gallery-counter {
        position: absolute;
        bottom: 1rem;
        inset-inline-end: 1rem;
        background-color: var(--surface-dark-sunken);
        color: var(--text-inverse);
        border: 1px solid var(--border-dark);
        padding: 0.35rem 0.85rem;
        border-radius: var(--radius-sm);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.82rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        z-index: 5;
    }

    .gallery-thumbnails {
        display: flex;
        gap: 0.65rem;
        margin-top: 0.75rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .thumb-btn {
        width: 80px;
        height: 56px;
        border-radius: var(--radius-xs);
        border: 2px solid transparent;
        overflow: hidden;
        cursor: pointer;
        padding: 0;
        background: none;
        flex-shrink: 0;
        opacity: 0.6;
        transition: opacity var(--duration-fast) var(--ease-out-expo),
                    border-color var(--duration-fast) var(--ease-out-expo);
    }

    .thumb-btn.active, .thumb-btn:hover {
        opacity: 1;
        border-color: var(--accent-brand);
    }

    .thumb-btn img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-empty-frame {
        height: 320px;
        background-color: var(--surface-raised);
        border: 1px dashed var(--border-strong);
        border-radius: var(--radius-md);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Disposition Grille 2 Colonnes */
    .detail-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 2.25rem;
        align-items: flex-start;
    }

    .detail-main-col {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }

    .detail-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 2rem;
        box-shadow: var(--shadow-raised);
    }

    .detail-meta-tags {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .detail-type-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.3rem 0.75rem;
        border-radius: var(--radius-xs);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--text-primary);
    }

    .detail-offre-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.3rem 0.75rem;
        border-radius: var(--radius-xs);
        color: var(--surface-raised);
    }

    .badge-navy {
        background-color: var(--accent-primary);
        border: 1px solid var(--border-dark);
    }

    .badge-teal {
        background-color: var(--accent-brand);
        border: 1px solid oklch(0.35 0.07 195);
    }

    .detail-date-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-inline-start: auto;
    }

    .detail-property-title {
        font-size: clamp(1.6rem, 2.8vw, 2.2rem);
        color: var(--text-primary);
        line-height: 1.25;
        margin-bottom: 0.75rem;
    }

    .detail-location-bar {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.95rem;
        color: var(--accent-brand);
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .detail-price-box {
        display: inline-flex;
        align-items: baseline;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
    }

    .price-amount {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
    }

    .price-currency {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--accent-brand);
    }

    .price-period {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .card-section-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-subtle);
    }

    .card-section-title i {
        color: var(--accent-brand);
    }

    /* Grille de Caractéristiques */
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.25rem;
    }

    .spec-tile {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 1rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-sm);
    }

    .spec-tile-icon {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-xs);
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        color: var(--accent-brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .spec-tile-data {
        display: flex;
        flex-direction: column;
    }

    .spec-tile-value {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .spec-tile-label {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* Prose */
    .detail-prose {
        font-size: 0.95rem;
        line-height: 1.8;
        color: var(--text-secondary);
        max-width: 65ch;
    }

    /* Équipements */
    .equipments-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.65rem;
    }

    .equipment-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.5rem 0.95rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .chip-icon {
        color: var(--status-success-text);
        font-size: 0.95rem;
    }

    /* Sidebar */
    .sidebar-sticky-card {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-md);
        padding: 1.75rem;
        box-shadow: var(--shadow-raised);
        position: sticky;
        top: calc(var(--nav-height) + 1.5rem);
    }

    .agent-profile-box {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-subtle);
        margin-bottom: 1.5rem;
    }

    .agent-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: var(--accent-primary);
        border: 1px solid var(--border-dark);
        color: var(--surface-raised);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .agent-info {
        display: flex;
        flex-direction: column;
    }

    .agent-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--accent-brand);
    }

    .agent-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .agent-role {
        font-size: 0.78rem;
        color: var(--text-muted);
    }

    .agent-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.75rem;
    }

    .btn-block {
        width: 100%;
        justify-content: center;
        padding-block: 0.7rem;
    }

    /* Styles Widget Réservation Court Séjour (Zero Dégradé) */
    .booking-widget-box {
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .booking-widget-header {
        margin-bottom: 1rem;
        padding-bottom: 0.85rem;
        border-bottom: 1px solid var(--border-subtle);
    }

    .booking-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--accent-brand);
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        padding: 0.2rem 0.55rem;
        border-radius: var(--radius-full);
        margin-bottom: 0.4rem;
    }

    .booking-price-row {
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
    }

    .booking-price-val {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
    }

    .booking-price-curr {
        font-weight: 700;
        color: var(--accent-brand);
        font-size: 0.95rem;
    }

    .booking-price-sub {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .booking-form {
        display: flex;
        flex-direction: column;
    }

    .booking-date-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.65rem;
    }

    .booking-field {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .booking-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-secondary);
    }

    .booking-input,
    .booking-select {
        width: 100%;
        padding: 0.55rem 0.7rem;
        background-color: var(--surface-raised);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-xs);
        font-family: inherit;
        font-size: 0.85rem;
        color: var(--text-primary);
        transition: border-color var(--duration-fast);
    }

    .booking-input:focus,
    .booking-select:focus {
        outline: none;
        border-color: var(--accent-brand);
    }

    .booking-calc-breakdown {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-xs);
        padding: 0.75rem 0.85rem;
        margin-block: 0.85rem;
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        font-size: 0.82rem;
    }

    .calc-row {
        display: flex;
        justify-content: space-between;
        color: var(--text-muted);
    }

    .calc-val {
        font-weight: 600;
        color: var(--text-secondary);
    }

    .calc-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.4rem;
        border-top: 1px solid var(--border-subtle);
        font-weight: 700;
        color: var(--text-primary);
    }

    .calc-total-val {
        font-size: 0.98rem;
        color: var(--accent-brand);
    }

    .booking-guest-info {
        background-color: var(--surface-raised);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-xs);
        padding: 0.75rem 0.85rem;
        margin-bottom: 0.5rem;
    }

    .security-seal-box {
        display: flex;
        gap: 0.75rem;
        padding: 1rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-sm);
    }

    .seal-icon {
        font-size: 1.35rem;
        color: var(--accent-warm);
        flex-shrink: 0;
        margin-top: 1px;
    }

    .seal-text strong {
        display: block;
        font-size: 0.82rem;
        color: var(--text-primary);
        margin-bottom: 0.2rem;
    }

    .seal-text p {
        font-size: 0.75rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* Modale d'appel */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background-color: oklch(0.145 0.015 250 / 0.75);
        backdrop-filter: blur(8px);
        z-index: 2000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-card {
        background-color: var(--surface-overlay);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-overlay);
        max-width: 420px;
        width: 100%;
        padding: 2.25rem 2rem;
        text-align: center;
        position: relative;
        animation: modalPop 180ms var(--ease-out-expo);
    }

    @keyframes modalPop {
        from {
            opacity: 0;
            transform: scale(0.96) translateY(8px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .modal-close-btn {
        position: absolute;
        top: 1rem;
        inset-inline-end: 1rem;
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.1rem;
        cursor: pointer;
        padding: 0.25rem;
    }

    .modal-close-btn:hover {
        color: var(--text-primary);
    }

    .modal-icon-badge {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-sm);
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        color: var(--accent-brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1.25rem;
    }

    .modal-title {
        font-size: 1.25rem;
        color: var(--text-primary);
        margin-bottom: 0.35rem;
    }

    .modal-desc {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 1.25rem;
    }

    .modal-phone-display {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        padding: 0.85rem;
        background-color: var(--surface-sunken);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-sm);
        margin-bottom: 1.5rem;
        letter-spacing: 0.05em;
    }

    .modal-btn-row {
        display: flex;
        gap: 0.75rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .detail-layout {
            grid-template-columns: 1fr;
        }

        .sidebar-sticky-card {
            position: static;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    let activeSlideIndex = 0;
    const track = document.getElementById('galleryTrack');
    const counter = document.getElementById('galleryCounter');
    const thumbBtns = document.querySelectorAll('.thumb-btn');

    function selectSlide(idx) {
        if (!track) return;
        const slides = track.querySelectorAll('.gallery-slide');
        if (idx < 0 || idx >= slides.length) return;
        activeSlideIndex = idx;
        track.scrollTo({
            left: activeSlideIndex * track.offsetWidth,
            behavior: 'smooth'
        });
        if (counter) {
            counter.querySelector('span').textContent = (activeSlideIndex + 1) + ' / ' + slides.length;
        }
        thumbBtns.forEach((btn, i) => {
            btn.classList.toggle('active', i === activeSlideIndex);
        });
    }

    function navGallery(direction) {
        if (!track) return;
        const slides = track.querySelectorAll('.gallery-slide');
        const nextIdx = (activeSlideIndex + direction + slides.length) % slides.length;
        selectSlide(nextIdx);
    }

    function ouvrirModalAppel() {
        const modal = document.getElementById('modalAppel');
        if (modal) modal.style.display = 'flex';
    }

    function fermerModalAppel() {
        const modal = document.getElementById('modalAppel');
        if (modal) modal.style.display = 'none';
    }

    document.getElementById('modalAppel')?.addEventListener('click', function(e) {
        if (e.target === this) fermerModalAppel();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') fermerModalAppel();
    });
</script>
@endpush

@endsection