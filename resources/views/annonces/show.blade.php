@extends('layouts.app')

@section('content')

<style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
    }

    .detail-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .detail-nav a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--teal);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .detail-nav a:hover {
        color: var(--primary);
    }

    .detail-statut {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(var(--teal-rgb), 0.1);
        color: var(--teal);
    }

    .detail-statut.indisponible {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    /* CARROUSEL */
    .carousel-section {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #000;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .carousel-track {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .carousel-track::-webkit-scrollbar {
        display: none;
    }

    .carousel-slide {
        min-width: 100%;
        scroll-snap-align: start;
        position: relative;
    }

    .carousel-slide img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
    }

    .carousel-counter {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        backdrop-filter: blur(10px);
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 1.1rem;
        cursor: pointer;
        color: var(--dark);
        z-index: 2;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .carousel-btn:hover {
        background: var(--primary);
        color: #fff;
    }

    .carousel-btn.prev {
        left: 1rem;
    }

    .carousel-btn.next {
        right: 1rem;
    }

    /* GRID PRINCIPAL */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 2rem;
        align-items: start;
    }

    /* COLONNE GAUCHE */
    .detail-main {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .detail-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.2;
    }

    .detail-localisation {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--gray-500);
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .detail-prix-badge {
        display: inline-block;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--teal);
        background: rgba(var(--teal-rgb), 0.08);
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        width: fit-content;
    }

    /* STATS */
    .stats-bar {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: var(--white);
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: 1px solid var(--gray-100);
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary), var(--teal));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .stat-value {
        font-weight: 700;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .stat-label {
        font-size: 0.7rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* SECTIONS */
    .detail-section {
        background: var(--white);
        border-radius: 14px;
        padding: 1.5rem;
        border: 1px solid var(--gray-100);
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-description {
        color: var(--gray-700);
        line-height: 1.7;
        font-size: 0.95rem;
        white-space: pre-wrap;
    }

    /* EQUIPEMENTS */
    .equipements-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .equipement-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.9rem;
        background: rgba(var(--teal-rgb), 0.06);
        border: 1px solid rgba(var(--teal-rgb), 0.15);
        border-radius: 8px;
        font-size: 0.8rem;
        color: var(--teal);
        font-weight: 500;
    }

    .equipement-tag .check {
        color: var(--teal);
        font-weight: 700;
    }

    /* COLONNE DROITE */
    .sidebar {
        position: sticky;
        top: 90px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .sidebar-card {
        background: var(--white);
        border-radius: 14px;
        padding: 1.5rem;
        border: 1px solid var(--gray-100);
    }

    .owner-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .owner-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--teal));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .owner-name {
        font-weight: 700;
        color: var(--dark);
    }

    .owner-role {
        font-size: 0.75rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* BOUTONS */
    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.85rem 1.25rem;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-appeler {
        background: linear-gradient(135deg, var(--primary), var(--teal));
        color: #fff;
    }

    .btn-appeler:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 80, 22, 0.35);
        color: #fff;
    }

    .btn-whatsapp {
        background: #25d366;
        color: #fff;
    }

    .btn-whatsapp:hover {
        background: #1da851;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.35);
        color: #fff;
    }

    .btn-message {
        background: var(--white);
        color: var(--teal);
        border: 2px solid #d4ddc8;
    }

    .btn-message:hover {
        border-color: var(--teal);
        background: #f5f5f0;
        transform: translateY(-2px);
        color: var(--teal);
    }

    .sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    /* MODAL APPEL */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: var(--white);
        border-radius: 16px;
        padding: 2rem;
        max-width: 380px;
        width: 90%;
        text-align: center;
        animation: modalIn 0.25s ease;
    }

    @keyframes modalIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .modal-phone {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--dark);
        margin: 1rem 0;
        letter-spacing: 2px;
    }

    .modal-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }

    .modal-actions .btn-action {
        font-size: 0.85rem;
    }

    .modal-fermer {
        background: none;
        border: none;
        color: var(--gray-500);
        cursor: pointer;
        font-size: 0.85rem;
        margin-top: 0.75rem;
    }

    .modal-fermer:hover {
        color: var(--dark);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .sidebar {
            position: static;
        }

        .carousel-slide img {
            height: 260px;
        }

        .detail-title {
            font-size: 1.35rem;
        }
    }
</style>

<div class="detail-container">

    {{-- NAV --}}
    <div class="detail-nav">
        <a href="{{ route('annonces.index') }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 5l-7 7 7 7" />
            </svg>
            Retour aux annonces
        </a>
        <span class="detail-statut {{ $annonce->statut !== 'disponible' ? 'indisponible' : '' }}">
            {{ $annonce->statut ?? 'Disponible' }}
        </span>
    </div>

    {{-- CARROUSEL --}}
    @php
    $images = [];
    if ($annonce->images) {
    $decoded = is_string($annonce->images) ? json_decode($annonce->images, true) : $annonce->images;
    if (is_array($decoded)) {
    $images = $decoded;
    }
    }
    @endphp

    @if(count($images) > 0)
    <div class="carousel-section">
        <div class="carousel-track" id="carouselTrack">
            @foreach($images as $index => $image)
            <div class="carousel-slide">
                <img src="{{ asset('storage/' . $image) }}" alt="{{ $annonce->titre }} - {{ $index + 1 }}" loading="lazy">
            </div>
            @endforeach
        </div>

        @if(count($images) > 1)
        <button class="carousel-btn prev" onclick="moveCarousel(-1)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M15 18l-6-6 6-6" />
            </svg>
        </button>
        <button class="carousel-btn next" onclick="moveCarousel(1)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M9 18l6-6-6-6" />
            </svg>
        </button>
        <div class="carousel-counter" id="carouselCounter">1 / {{ count($images) }}</div>
        @endif
    </div>
    @endif

    {{-- GRID --}}
    <div class="detail-grid">

        {{-- COLONNE GAUCHE --}}
        <div class="detail-main">

            {{-- TITRE --}}
            <div>
                <h1 class="detail-title">{{ $annonce->titre }}</h1>
                <div class="detail-localisation">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    {{ $annonce->quartier ?? $annonce->adresse ?? '' }}
                </div>
            </div>

            {{-- PRIX --}}
            <div class="detail-prix-badge">
                {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
                @if($annonce->type_offre === 'location')
                <span style="font-size:0.85rem;font-weight:400;color:var(--gray-500)"> / mois</span>
                @endif
            </div>

            {{-- STATS --}}
            <div class="stats-bar">
                @if($annonce->superficie)
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">{{ $annonce->superficie }} m2</div>
                        <div class="stat-label">Superficie</div>
                    </div>
                </div>
                @endif
                @if($annonce->nombre_pieces)
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" />
                            <rect x="14" y="3" width="7" height="7" />
                            <rect x="3" y="14" width="7" height="7" />
                            <rect x="14" y="14" width="7" height="7" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">{{ $annonce->nombre_pieces }}</div>
                        <div class="stat-label">Pieces</div>
                    </div>
                </div>
                @endif
                @if($annonce->nombre_chambres)
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 4v16" />
                            <path d="M2 8h18a2 2 0 0 1 2 2v10" />
                            <path d="M2 17h20" />
                            <path d="M6 8v9" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">{{ $annonce->nombre_chambres }}</div>
                        <div class="stat-label">Chambres</div>
                    </div>
                </div>
                @endif
                @if($annonce->nombre_salles_bain)
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3a1 1 0 0 1 1-1z" />
                            <path d="M6 12V5a2 2 0 0 1 2-2h3v2.25" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">{{ $annonce->nombre_salles_bain }}</div>
                        <div class="stat-label">Salle(s) de bain</div>
                    </div>
                </div>
                @endif
            </div>

            {{-- DESCRIPTION --}}
            @if($annonce->description)
            <div class="detail-section">
                <h2 class="section-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <path d="M14 2v6h6" />
                        <path d="M16 13H8" />
                        <path d="M16 17H8" />
                        <path d="M10 9H8" />
                    </svg>
                    Description
                </h2>
                <div class="detail-description">{{ $annonce->description }}</div>
            </div>
            @endif

            {{-- EQUIPEMENTS --}}
            @if($annonce->equipements)
            @php
            $equips = is_string($annonce->equipements) ? json_decode($annonce->equipements, true) : $annonce->equipements;
            @endphp
            @if(is_array($equips) && count($equips) > 0)
            <div class="detail-section">
                <h2 class="section-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                        <rect x="9" y="3" width="6" height="4" rx="2" />
                        <path d="M9 14l2 2 4-4" />
                    </svg>
                    Equipements
                </h2>
                <div class="equipements-grid">
                    @foreach($equips as $equip)
                    <span class="equipement-tag">
                        <!-- <span class="check">OK</span> -->
                        {{ is_string($equip) ? $equip : ($equip['nom'] ?? '') }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
            @endif

        </div>

        {{-- COLONNE DROITE --}}
        <div class="sidebar">
            <div class="sidebar-card">

                {{-- PROPRIETAIRE / AGENCE --}}
                <div class="owner-info">
                    <div class="owner-avatar">
                        {{ substr($annonce->user->proprietaire->nom ?? $annonce->user->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <div class="owner-name">
                            @if($annonce->user->proprietaire ?? false)
                            {{ $annonce->user->proprietaire->prenom }} {{ $annonce->user->proprietaire->nom }}
                            @elseif($annonce->user->agence ?? false)
                            {{ $annonce->user->agence->nom_agence ?? $annonce->user->name }}
                            @else
                            {{ $annonce->user->name }}
                            @endif
                        </div>
                        <div class="owner-role">
                            {{ ucfirst($annonce->user->role ?? 'Proprietaire') }}
                        </div>
                    </div>
                </div>

                @php
                $telephone = $annonce->user->proprietaire->telephone ?? $annonce->user->agence->telephone ?? null;
                @endphp

                <div class="sidebar-actions">

                    {{-- APPELER --}}
                    @if($telephone)
                    <button class="btn-action btn-appeler" onclick="ouvrirModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        Appeler
                    </button>

                    {{-- WHATSAPP --}}
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $telephone) }}" target="_blank" class="btn-action btn-whatsapp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        WhatsApp
                    </a>
                    @endif

                    {{-- MESSAGE INTERNE --}}
                    <a href="{{ route('contacts.create', $annonce) }}" class="btn-action btn-message">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        Envoyer un message
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- MODAL APPEL --}}
@if($telephone)
<div class="modal-overlay" id="modalAppel">
    <div class="modal-content">
        <div style="font-size:1.5rem;margin-bottom:0.5rem;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
        </div>
        <p style="color:var(--gray-500);font-size:0.85rem;">Numero de telephone</p>
        <div class="modal-phone">{{ $telephone }}</div>
        <div class="modal-actions">
            <a href="tel:{{ $telephone }}" class="btn-action btn-appeler" style="flex:1;">
                Appeler maintenant
            </a>
            <button class="btn-action btn-message" style="flex:1;" onclick="fermerModal()">
                Annuler
            </button>
        </div>
    </div>
</div>
@endif

<script>
    // CARROUSEL
    let currentSlide = 0;
    const track = document.getElementById('carouselTrack');

    function moveCarousel(dir) {
        if (!track) return;
        const slides = track.querySelectorAll('.carousel-slide');
        currentSlide = Math.max(0, Math.min(currentSlide + dir, slides.length - 1));
        track.scrollTo({
            left: currentSlide * track.offsetWidth,
            behavior: 'smooth'
        });
        const counter = document.getElementById('carouselCounter');
        if (counter) counter.textContent = (currentSlide + 1) + ' / ' + slides.length;
    }

    // MODAL
    function ouvrirModal() {
        document.getElementById('modalAppel').classList.add('active');
    }

    function fermerModal() {
        document.getElementById('modalAppel').classList.remove('active');
    }

    document.getElementById('modalAppel')?.addEventListener('click', function(e) {
        if (e.target === this) fermerModal();
    });
</script>

@endsection