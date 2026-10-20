@extends('layouts.app')

@section('title', 'Gestion des utilisateurs — Admin')

@section('content')
<section style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">

    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
                <i class="bi bi-arrow-left"></i> Administration
            </a>
            <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; margin-top: 0.5rem;">
                <i class="bi bi-people" style="color: var(--teal);"></i> Utilisateurs
                <span style="font-size: 0.85rem; font-weight: 400; color: #999;">({{ $users->total() }})</span>
            </h1>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="font-size: 0.85rem;">
            <i class="bi bi-person-plus"></i> Nouvel utilisateur
        </a>
    </div>

    {{-- Filtres et recherche --}}
    <form method="GET" action="{{ route('admin.users.index') }}" style="
        background: white;
        border-radius: 14px;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        margin-bottom: 1.5rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: end;
    ">
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.3rem;">
                Rechercher
            </label>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Nom ou email..."
                style="width: 100%; padding: 0.65rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
        </div>
        <div>
            <label style="display: block; font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.3rem;">
                Rôle
            </label>
            <select name="role" style="padding: 0.65rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                <option value="">Tous</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="agence" {{ request('role') === 'agence' ? 'selected' : '' }}>Agence</option>
                <option value="proprietaire" {{ request('role') === 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
                <option value="client" {{ request('role') === 'client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="font-size: 0.85rem;">
            <i class="bi bi-search"></i> Filtrer
        </button>
    </form>

    {{-- Messages --}}
    @if(session('success'))
    <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    {{-- Table --}}
    <div style="
        background: white;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        overflow: hidden;
    ">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb;">
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Utilisateur</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Email</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Rôle</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Inscrit le</th>
                        <th style="text-align: right; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr style="border-top: 1px solid #f3f4f6;">
                        <td style="padding: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="
                                    width: 40px; height: 40px;
                                    border-radius: 50%;
                                    background: linear-gradient(135deg, var(--primary), var(--teal));
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    font-weight: 700;
                                    font-size: 0.85rem;
                                    flex-shrink: 0;
                                ">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; font-size: 0.95rem;">{{ $user->name }}</div>
                                    @if($user->agence)
                                    <div style="font-size: 0.8rem; color: #999;">
                                        <i class="bi bi-building"></i> {{ $user->agence->nom_agence }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="padding: 1rem; color: #666; font-size: 0.9rem;">{{ $user->email }}</td>
                        <td style="padding: 1rem;">
                            @php
                            $roleColors = [
                            'admin' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                            'agence' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                            'proprietaire' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                            'client' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                            ];
                            $colors = $roleColors[$user->role] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span style="
                                display: inline-block;
                                padding: 0.25rem 0.7rem;
                                background: {{ $colors['bg'] }};
                                color: {{ $colors['text'] }};
                                border-radius: 50px;
                                font-size: 0.8rem;
                                font-weight: 600;
                                text-transform: capitalize;
                            ">{{ $user->role }}</span>
                        </td>
                        <td style="padding: 1rem; color: #999; font-size: 0.85rem;">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td style="padding: 1rem; text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.users.show', $user) }}" title="Voir"
                                    style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f3f4f6; color: #666; text-decoration: none; font-size: 0.9rem;">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" title="Modifier"
                                    style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #dbeafe; color: #1e40af; text-decoration: none; font-size: 0.9rem;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('Supprimer {{ $user->name }} ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Supprimer"
                                        style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #fee2e2; color: #991b1b; border: none; cursor: pointer; font-size: 0.9rem;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 3rem; text-align: center; color: #999;">
                            <i class="bi bi-people" style="font-size: 2rem; display: block; margin-bottom: 0.5rem; color: #ddd;"></i>
                            Aucun utilisateur trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 1.5rem;">
        {{ $users->links() }}
    </div>

</section>
@endsection