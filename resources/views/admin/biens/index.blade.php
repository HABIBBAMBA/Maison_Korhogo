@extends('layouts.app')

@section('title', 'Gestion des biens — Admin')

@section('content')
<section style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
                <i class="bi bi-arrow-left"></i> Administration
            </a>
            <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; margin-top: 0.5rem;">
                <i class="bi bi-building" style="color: var(--teal);"></i> Biens immobiliers
                <span style="font-size: 0.85rem; font-weight: 400; color: #999;">({{ $biens->total() }})</span>
            </h1>
        </div>
        <a href="{{ route('admin.biens.create') }}" class="btn btn-primary" style="font-size: 0.85rem;">
            <i class="bi bi-plus-lg"></i> Nouveau bien
        </a>
    </div>

    {{-- Filtres --}}
    <form method="GET" action="{{ route('admin.biens.index') }}" style="
        background: white; border-radius: 14px; padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06); margin-bottom: 1.5rem;
        display: flex; gap: 1rem; flex-wrap: wrap; align-items: end;
    ">
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.3rem;">Rechercher</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Titre, quartier, adresse..."
                style="width: 100%; padding: 0.65rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
        </div>
        <div>
            <label style="display: block; font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.3rem;">Statut</label>
            <select name="statut" style="padding: 0.65rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                <option value="">Tous</option>
                <option value="disponible" {{ request('statut') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="loue" {{ request('statut') === 'loue' ? 'selected' : '' }}>Loué</option>
                <option value="vendu" {{ request('statut') === 'vendu' ? 'selected' : '' }}>Vendu</option>
                <option value="en_negociation" {{ request('statut') === 'en_negociation' ? 'selected' : '' }}>En négociation</option>
            </select>
        </div>
        <div>
            <label style="display: block; font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.3rem;">Agence</label>
            <select name="id_agence" style="padding: 0.65rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                <option value="">Toutes</option>
                @foreach($agences as $agence)
                <option value="{{ $agence->id }}" {{ request('id_agence') == $agence->id ? 'selected' : '' }}>
                    {{ $agence->nom_agence }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="font-size: 0.85rem;">
            <i class="bi bi-search"></i> Filtrer
        </button>
    </form>

    @if(session('success'))
    <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div style="background: white; border-radius: 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb;">
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Bien</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Type</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Prix</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Statut</th>
                        <th style="text-align: left; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Agence</th>
                        <th style="text-align: right; padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: #999; font-weight: 600;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($biens as $bien)
                    <tr style="border-top: 1px solid #f3f4f6;">
                        <td style="padding: 1rem;">
                            <div style="font-weight: 600;">{{ $bien->titre }}</div>
                            <div style="font-size: 0.8rem; color: #999;">
                                {{ $bien->quartier ?? '—' }}
                                @if($bien->nombre_pieces) · {{ $bien->nombre_pieces }} pcs @endif
                            </div>
                        </td>
                        <td style="padding: 1rem; text-transform: capitalize; font-size: 0.9rem;">{{ $bien->type_bien }}</td>
                        <td style="padding: 1rem; font-weight: 700;">
                            {{ number_format($bien->prix, 0, ',', ' ') }} €
                        </td>
                        <td style="padding: 1rem;">
                            @php
                            $statutColors = [
                            'disponible' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                            'loue' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                            'vendu' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                            'en_negociation' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                            ];
                            $statutLabels = [
                            'disponible' => 'Disponible',
                            'loue' => 'Loué',
                            'vendu' => 'Vendu',
                            'en_negociation' => 'Négociation',
                            ];
                            $sc = $statutColors[$bien->statut] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span style="
                                display: inline-block;
                                padding: 0.2rem 0.6rem;
                                background: {{ $sc['bg'] }};
                                color: {{ $sc['text'] }};
                                border-radius: 50px;
                                font-size: 0.75rem;
                                font-weight: 600;
                            ">{{ $statutLabels[$bien->statut] ?? $bien->statut }}</span>
                        </td>
                        <td style="padding: 1rem; font-size: 0.9rem; color: #666;">
                            {{ $bien->agence->nom_agence ?? '—' }}
                        </td>
                        <td style="padding: 1rem; text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.biens.show', $bien) }}" title="Voir"
                                    style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f3f4f6; color: #666; text-decoration: none; font-size: 0.9rem;">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.biens.edit', $bien) }}" title="Modifier"
                                    style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #dbeafe; color: #1e40af; text-decoration: none; font-size: 0.9rem;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.biens.destroy', $bien) }}" method="POST"
                                    onsubmit="return confirm('Supprimer ce bien ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Supprimer"
                                        style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #fee2e2; color: #991b1b; border: none; cursor: pointer; font-size: 0.9rem;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 3rem; text-align: center; color: #999;">
                            <i class="bi bi-building" style="font-size: 2rem; display: block; margin-bottom: 0.5rem; color: #ddd;"></i>
                            Aucun bien trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1.5rem;">{{ $biens->links() }}</div>

</section>
@endsection