@extends('layouts.app')

@section('title', 'Dashboard Admin — ImmoPro')

@push('styles')
<style>
    /* ============================
       STATS GRID
    ============================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: var(--white);
        border: 1px solid var(--gray-100);
        border-radius: var(--radius);
        padding: 1.35rem;
        transition: var(--transition);
        opacity: 0;
        animation: fadeUp 0.5s ease forwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stat-card:nth-child(4) { animation-delay: 0.2s; }

    .stat-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .stat-card-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.85rem;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .stat-icon.teal  { background: rgba(var(--teal-rgb), 0.08); color: var(--teal); }
    .stat-icon.green { background: rgba(16, 185, 129, 0.08); color: #10b981; }
    .stat-icon.blue  { background: rgba(59, 130, 246, 0.08); color: #3b82f6; }

    .stat-change {
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        background: rgba(16, 185, 129, 0.08);
        color: #10b981;
    }

    .stat-value {
        font-size: 1.85rem;
        font-weight: 800;
        letter-spacing: -0.03em;
        line-height: 1;
        margin-bottom: 0.25rem;
        color: var(--dark);
    }

    .stat-label {
        font-size: 0.72rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 600;
    }

    /* ============================
       ACTION CARDS
    ============================ */
    .action-row {
        display: flex;
        gap: 0.65rem;
        flex-wrap: wrap;
    }

    .action-card {
        flex: 1;
        min-width: 130px;
        background: var(--light-bg);
        border: 1.5px solid transparent;
        border-radius: var(--radius-sm);
        padding: 1.15rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: block;
    }

    .action-card:hover {
        border-color: var(--teal);
        background: rgba(var(--teal-rgb), 0.04);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .action-card i {
        font-size: 1.4rem;
        color: var(--teal);
        display: block;
        margin-bottom: 0.45rem;
    }

    .action-card .action-title {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--dark);
    }

    .action-card .action-desc {
        font-size: 0.68rem;
        color: var(--gray-500);
        margin-top: 0.15rem;
    }

    .section-label {
        font-size: 0.68rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 700;
        margin-bottom: 0.65rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .section-label i {
        color: var(--teal);
        font-size: 0.75rem;
    }

    /* ============================
       CARD
    ============================ */
    .dash-card {
        background: var(--white);
        border: 1px solid var(--gray-100);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        opacity: 0;
        animation: fadeUp 0.5s ease forwards;
        animation-delay: 0.25s;
    }

    .dash-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .dash-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dash-card-title i {
        color: var(--teal);
        font-size: 1.05rem;
    }

    .dash-card-link {
        color: var(--teal);
        font-size: 0.78rem;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .dash-card-link:hover {
        color: var(--primary);
    }

    /* ============================
       TABLE
    ============================ */
    .dash-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .dash-table th {
        text-align: left;
        color: var(--gray-500);
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.8rem 1rem;
        border-bottom: 2px solid var(--gray-100);
    }

    .dash-table td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid var(--gray-100);
        color: var(--gray-700);
    }

    .dash-table tbody tr:hover td {
        background: var(--light-bg);
    }

    .badge {
        display: inline-block;
        padding: 0.22rem 0.6rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .badge-success { background: rgba(16, 185, 129, 0.08); color: #10b981; }
    .badge-warning { background: rgba(245, 158, 11, 0.08); color: #f59e0b; }
    .badge-danger  { background: rgba(239, 68, 68, 0.08); color: #ef4444; }
    .badge-muted   { background: rgba(136, 136, 136, 0.1); color: var(--gray-500); }

    /* ============================
       ANIMATIONS
    ============================ */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (prefers-reduced-motion: reduce) {
        .stat-card, .dash-card { animation: none; opacity: 1; }
    }

    /* ============================
       RESPONSIVE
    ============================ */
    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .action-row { flex-direction: column; }
        .action-card { min-width: 100%; }
    }

    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    {{-- Flash Messages --}}
    @if(session('success'))
    <div style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15); color: #10b981; padding: 0.9rem 1.15rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem; font-size: 0.85rem; display: flex; align-items: center; gap: 0.65rem;">
        <i class="bi bi-check-circle-fill" style="font-size: 1.15rem;"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.15); color: #ef4444; padding: 0.9rem 1.15rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem; font-size: 0.85rem; display: flex; align-items: center; gap: 0.65rem;">
        <i class="bi bi-x-circle-fill" style="font-size: 1.15rem;"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Page Header --}}
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 600; color: var(--dark); line-height: 1.2;">
                    Bienvenue, <em style="color: var(--teal);">{{ explode(' ', $user->name)[0] }}</em>
                </h1>
                <p style="color: var(--gray-500); margin-top: 0.3rem; font-size: 0.9rem;">
                    Voici un aperçu de votre activité immobilière
                </p>
            </div>
            <a href="{{ route('annonces.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nouveau bien
            </a>
        </div>
    </div>

    {{-- ===== STATS ===== --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-row">
                <div class="stat-icon green"><i class="bi bi-building"></i></div>
                @if($stats['biens_publies'] > 0)
                <span class="stat-change">+{{ $stats['biens_publies'] }}</span>
                @endif
            </div>
            <div class="stat-value">{{ $stats['total_biens'] }}</div>
            <div class="stat-label">Biens publiés</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-row">
                <div class="stat-icon teal"><i class="bi bi-chat-dots"></i></div>
                @if($stats['nouveaux_messages'] > 0)
                <span class="stat-change">+{{ $stats['nouveaux_messages'] }}</span>
                @endif
            </div>
            <div class="stat-value">{{ $stats['total_messages'] }}</div>
            <div class="stat-label">Messages reçus</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-row">
                <div class="stat-icon teal"><i class="bi bi-people"></i></div>
            </div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Utilisateurs</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-row">
                <div class="stat-icon blue"><i class="bi bi-shop"></i></div>
            </div>
            <div class="stat-value">{{ $stats['total_agences'] }}</div>
            <div class="stat-label">Agences</div>
        </div>
    </div>

    {{-- ===== ACTIONS RAPIDES ===== --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span class="dash-card-title"><i class="bi bi-lightning-charge-fill"></i> Actions rapides</span>
        </div>
        <div class="action-row">
            <a href="{{ route('annonces.create') }}" class="action-card">
                <i class="bi bi-plus-circle"></i>
                <div class="action-title">Nouveau bien</div>
                <div class="action-desc">Créer une annonce</div>
            </a>
            <a href="{{ route('annonces.mes-annonces') }}" class="action-card">
                <i class="bi bi-building"></i>
                <div class="action-title">Mes biens</div>
                <div class="action-desc">Gérer mes annonces</div>
            </a>
            <a href="{{ route('admin.users.index') }}" class="action-card">
                <i class="bi bi-people"></i>
                <div class="action-title">Utilisateurs</div>
                <div class="action-desc">Gérer les comptes</div>
            </a>
            <a href="{{ route('admin.agences.index') }}" class="action-card">
                <i class="bi bi-shop"></i>
                <div class="action-title">Agences</div>
                <div class="action-desc">Gérer les agences</div>
            </a>
            <a href="{{ route('admin.biens.index') }}" class="action-card">
                <i class="bi bi-building-check"></i>
                <div class="action-title">Biens</div>
                <div class="action-desc">Modérer les annonces</div>
            </a>
        </div>
    </div>

    {{-- ===== TABLEAU BIENS RÉCENTS ===== --}}
    <div class="dash-card" style="animation-delay: 0.35s;">
        <div class="dash-card-header">
            <span class="dash-card-title"><i class="bi bi-building"></i> Biens récents</span>
            <a href="{{ route('admin.biens.index') }}" class="dash-card-link">Tous les biens <i class="bi bi-arrow-right"></i></a>
        </div>
        @if($recentBiens->count() > 0)
        <div style="overflow-x: auto;">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Bien</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBiens as $bien)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--dark);">{{ Str::limit($bien['titre'], 30) }}</div>
                            <div style="font-size: 0.72rem; color: var(--gray-500);">{{ $bien['quartier'] ?? '—' }}</div>
                        </td>
                        <td style="text-transform: capitalize;">{{ $bien['type_bien'] ?? '—' }}</td>
                        <td style="font-weight: 700; color: var(--primary);">{{ number_format($bien['prix'], 0, ',', ' ') }} FCFA</td>
                        <td>
                            @php
                            $badgeClass = match($bien['statut'] ?? '') {
                                'disponible' => 'badge-success',
                                'loue' => 'badge-warning',
                                'vendu' => 'badge-danger',
                                default => 'badge-muted',
                            };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($bien['statut'] ?? 'N/A') }}</span>
                        </td>
                        <td style="color: var(--gray-500); font-size: 0.78rem;">{{ $bien['created_at']->format('d/m/Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.35rem;">
                                <a href="{{ route('admin.biens.show', $bien['id']) }}" class="btn btn-sm btn-outline" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.biens.edit', $bien['id']) }}" class="btn btn-sm btn-outline" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div style="text-align: center; padding: 3rem; color: var(--gray-500);">
            <i class="bi bi-building" style="font-size: 2rem; display: block; margin-bottom: 0.5rem; opacity: 0.3;"></i>
            Aucun bien publié pour le moment
        </div>
        @endif
    </div>

@endsection
