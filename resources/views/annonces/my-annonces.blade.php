@extends('layouts.app')

@section('title', 'Mes annonces — ImmoPro')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .my-annonces {
        max-width: 1260px;
        margin: 0 auto;
        padding: 2.5rem 2rem 4rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ─── Header ─── */
    .ma-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2.5rem;
    }

    .ma-header h1 {
        font-size: 1.85rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }

    .ma-header h1 i {
        color: #0d9488;
        font-size: 1.5rem;
    }

    .ma-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #0d9488;
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        width: 28px;
        height: 28px;
        border-radius: 50%;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.4rem;
        background: linear-gradient(135deg, #0d9488, #0f766e);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: inherit;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 3px 12px rgba(13, 148, 136, 0.3);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(13, 148, 136, 0.35);
    }

    /* ─── Grid ─── */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.8rem;
    }

    /* ─── Card ─── */
    .annonce-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        opacity: 0;
        animation: cardUp 0.4s ease forwards;
    }

    .annonce-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.09);
        border-color: #d1d5db;
    }

    .annonce-card:nth-child(1) {
        animation-delay: 0.04s;
    }

    .annonce-card:nth-child(2) {
        animation-delay: 0.08s;
    }

    .annonce-card:nth-child(3) {
        animation-delay: 0.12s;
    }

    .annonce-card:nth-child(4) {
        animation-delay: 0.16s;
    }

    .annonce-card:nth-child(5) {
        animation-delay: 0.2s;
    }

    .annonce-card:nth-child(6) {
        animation-delay: 0.24s;
    }

    @keyframes cardUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ─── Image zone ─── */
    .card-image {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
        background: #f3f4f6;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .annonce-card:hover .card-image img {
        transform: scale(1.06);
    }

    .card-image::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.45), transparent);
        pointer-events: none;
    }

    .img-top {
        position: absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        z-index: 2;
    }

    .pill {
        padding: 0.3rem 0.8rem;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        backdrop-filter: blur(10px);
    }

    .pill-vente {
        background: rgba(109, 40, 217, 0.82);
        color: #fff;
    }

    .pill-location {
        background: rgba(37, 99, 235, 0.82);
        color: #fff;
    }

    .pill-type {
        background: rgba(255, 255, 255, 0.9);
        color: #374151;
        backdrop-filter: blur(10px);
    }

    .img-bottom {
        position: absolute;
        bottom: 14px;
        left: 14px;
        right: 14px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        z-index: 2;
    }

    .img-price {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.35rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    }

    .img-price small {
        font-size: 0.75rem;
        font-weight: 500;
        opacity: 0.85;
    }

    .img-stats {
        display: flex;
        gap: 0.6rem;
    }

    .img-stat {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        padding: 0.3rem 0.65rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 600;
        color: #fff;
    }

    .img-stat i {
        font-size: 0.75rem;
    }

    /* ─── Card body ─── */
    .card-body {
        padding: 1.5rem 1.6rem 1.6rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.15s;
    }

    .card-title a:hover {
        color: #0d9488;
    }

    .card-location {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.88rem;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .card-location i {
        color: #0d9488;
        font-size: 0.85rem;
    }

    .card-desc {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1.2rem;
    }

    .card-bottom {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid #f3f4f6;
    }

    .card-date {
        font-size: 0.82rem;
        color: #9ca3af;
    }

    .card-date i {
        margin-right: 0.2rem;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.28rem 0.7rem;
        border-radius: 8px;
        font-size: 0.74rem;
        font-weight: 700;
    }

    .status-pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-active {
        background: #ecfdf5;
        color: #059669;
    }

    .status-active::before {
        background: #059669;
    }

    .status-vendu {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-vendu::before {
        background: #dc2626;
    }

    .status-loue {
        background: #fffbeb;
        color: #d97706;
    }

    .status-loue::before {
        background: #d97706;
    }

    .status-inactive {
        background: #f3f4f6;
        color: #9ca3af;
    }

    .status-inactive::before {
        background: #9ca3af;
    }

    /* ═══════════════════════════════════════
       ACTIONS — 3 boutons proportionnels
       ═══════════════════════════════════════ */
    .card-actions {
        display: flex;
        border-top: 1px solid #f3f4f6;
    }

    .card-actions>a,
    .card-actions>form {
        flex: 1;
        display: flex;
    }

    .card-actions>a,
    .card-actions>form>button {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.85rem 0;
        border: none;
        background: transparent;
        font-family: inherit;
        font-size: 0.82rem;
        font-weight: 600;
        color: #6b7280;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .card-actions>a:not(:last-child),
    .card-actions>form:not(:last-of-type)>button {
        border-right: 1px solid #f3f4f6;
    }

    .act-see:hover {
        color: #0d9488;
        background: #f0fdfa;
    }

    .act-edit:hover {
        color: #2563eb;
        background: #eff6ff;
    }

    .act-del:hover {
        color: #dc2626;
        background: #fef2f2;
    }

    .card-actions i {
        font-size: 0.92rem;
    }

    /* ─── Empty state ─── */
    .empty-card {
        grid-column: 1 / -1;
        text-align: center;
        padding: 5rem 2rem;
        background: #fff;
        border: 2px dashed #d1d5db;
        border-radius: 16px;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
        border-radius: 50%;
    }

    .empty-icon i {
        font-size: 2.2rem;
        color: #d1d5db;
    }

    .empty-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #374151;
        margin: 0 0 0.5rem;
    }

    .empty-card p {
        color: #9ca3af;
        margin: 0 0 1.8rem;
        font-size: 0.92rem;
    }

    /* ─── Responsive ─── */
    @media (max-width: 768px) {
        .my-annonces {
            padding: 1.5rem 1rem 3rem;
        }

        .ma-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .ma-header h1 {
            font-size: 1.45rem;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }

        .card-image {
            height: 240px;
        }
    }
</style>

<div class="my-annonces">

    <div class="ma-header">
        <h1>
            <i class="bi bi-grid-1x2-fill"></i> Mes annonces
            @if($annonces->total() > 0)
            <span class="ma-count">{{ $annonces->total() }}</span>
            @endif
        </h1>
        <a href="{{ route('annonces.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouvelle annonce
        </a>
    </div>

    <div class="cards-grid">

        @forelse($annonces as $annonce)
        <div class="annonce-card">

            {{-- ═══ Image ═══ --}}
            <div class="card-image">
                <img src="{{ $annonce->premiere_image }}" alt="{{ $annonce->titre }}">

                <div class="img-top">
                    <span class="pill pill-{{ $annonce->type_offre }}">
                        {{ ucfirst($annonce->type_offre) }}
                    </span>
                    <span class="pill pill-type">
                        {{ ucfirst($annonce->type_bien) }}
                    </span>
                </div>

                <div class="img-bottom">
                    <span class="img-price">
                        {{ $annonce->prix_formate }}
                        @if($annonce->type_offre === 'location')
                        <small>/mois</small>
                        @endif
                    </span>
                    <div class="img-stats">
                        @if($annonce->nombre_chambres)
                        <span class="img-stat">
                            <i class="bi bi-door-open"></i> {{ $annonce->nombre_chambres }}
                        </span>
                        @endif
                        @if($annonce->superficie)
                        <span class="img-stat">
                            <i class="bi bi-arrows-fullscreen"></i> {{ $annonce->superficie }} m²
                        </span>
                        @endif
                        @if($annonce->nombre_pieces)
                        <span class="img-stat">
                            <i class="bi bi-grid-3x3"></i> {{ $annonce->nombre_pieces }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ═══ Body ═══ --}}
            <div class="card-body">
                <h3 class="card-title">
                    <a href="{{ route('annonces.show', $annonce) }}">
                        {{ $annonce->titre }}
                    </a>
                </h3>
                <div class="card-location">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $annonce->quartier ? $annonce->quartier . ', ' : '' }}{{ $annonce->ville ?? 'Ville non précisée' }}
                </div>
                @if($annonce->description)
                <p class="card-desc">
                    {{ Str::limit(strip_tags($annonce->description), 120) }}
                </p>
                @endif
                <div class="card-bottom">
                    <span class="card-date">
                        <i class="bi bi-clock"></i> {{ $annonce->created_at->format('d/m/Y') }}
                    </span>
                    <span class="status-pill status-{{ $annonce->statut }}">
                        {{ ucfirst(str_replace('loue', 'loué', $annonce->statut)) }}
                    </span>
                </div>
            </div>

            {{-- ═══ Actions ═══ --}}
            <div class="card-actions">
                <a href="{{ route('annonces.show', $annonce) }}" class="act-see">
                    <i class="bi bi-eye"></i> Voir
                </a>
                <a href="{{ route('annonces.edit', $annonce) }}" class="act-edit">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
                <form action="{{ route('annonces.destroy', $annonce) }}" method="POST"
                    onsubmit="return confirm('Supprimer cette annonce ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="act-del">
                        <i class="bi bi-trash3"></i> Supprimer
                    </button>
                </form>
            </div>

        </div>
        @empty
        <div class="empty-card">
            <div class="empty-icon">
                <i class="bi bi-house-door"></i>
            </div>
            <h3>Aucune annonce pour le moment</h3>
            <p>Commencez par publier votre première annonce immobilière.</p>
            <a href="{{ route('annonces.create') }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> Publier une annonce
            </a>
        </div>
        @endforelse

    </div>

    @if($annonces->hasPages())
    <div style="display:flex;justify-content:center;padding-top:2.5rem;">
        {{ $annonces->links() }}
    </div>
    @endif

</div>
@endsection