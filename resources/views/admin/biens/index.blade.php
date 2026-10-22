@extends('layouts.app')

@section('title', 'Gestion des biens immobiliers — Admin')

@section('content')
<section style="max-width: 1180px; margin: 0 auto; padding: 2rem 1.25rem;">

    {{-- En-tête de page épuré --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <a href="{{ route('dashboard') }}" style="font-size: 0.82rem; color: #5A6B7B; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; font-weight: 500;">
                <i class="bi bi-arrow-left"></i> Administration
            </a>
            <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.45rem; font-weight: 800; color: #1B3A5C; margin: 0.35rem 0 0 0; display: flex; align-items: center; gap: 0.5rem;">
                <span>Biens & Annonces</span>
                <span style="font-size: 0.8rem; font-weight: 600; color: #5A6B7B; background: #E8ECF0; padding: 0.15rem 0.55rem; border-radius: 50px;">{{ $biens->total() }}</span>
            </h1>
        </div>
        <div style="display: flex; gap: 0.6rem;">
            <a href="{{ route('annonces.create') }}" class="btn btn-brand" style="font-size: 0.84rem; background: #E8734A; color: white; padding: 0.55rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="bi bi-plus-lg"></i> Déposer une annonce
            </a>
            <a href="{{ route('admin.biens.create') }}" class="btn btn-outline" style="font-size: 0.84rem; color: #1B3A5C; border: 1px solid #DCE1E7; background: white; padding: 0.55rem 0.9rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="bi bi-plus-circle"></i> Nouveau bien
            </a>
        </div>
    </div>

    {{-- Synthèse rapide en barre compacte --}}
    @if(isset($stats))
    <div style="display: flex; gap: 1.5rem; background: white; border: 1px solid #E8ECF0; border-radius: 10px; padding: 0.85rem 1.25rem; margin-bottom: 1.25rem; flex-wrap: wrap; align-items: center; box-shadow: 0 1px 2px rgba(34,40,49,0.03);">
        <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #5A6B7B;">
            <span style="font-weight: 700; color: #1B3A5C; font-family: 'JetBrains Mono', monospace; font-size: 1rem;">{{ $stats['total'] }}</span>
            <span>biens au total</span>
        </div>
        <span style="color: #DCE1E7;">|</span>
        <div style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.85rem; color: #196C45;">
            <span style="width: 7px; height: 7px; border-radius: 50%; background: #10B981;"></span>
            <span style="font-weight: 700; font-family: 'JetBrains Mono', monospace;">{{ $stats['active'] }}</span>
            <span>en ligne</span>
        </div>
        <span style="color: #DCE1E7;">|</span>
        <div style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.85rem; color: #1E40AF;">
            <span style="width: 7px; height: 7px; border-radius: 50%; background: #3B82F6;"></span>
            <span style="font-weight: 700; font-family: 'JetBrains Mono', monospace;">{{ $stats['vente'] }}</span>
            <span>en vente</span>
        </div>
        <span style="color: #DCE1E7;">|</span>
        <div style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.85rem; color: #E8734A;">
            <span style="width: 7px; height: 7px; border-radius: 50%; background: #E8734A;"></span>
            <span style="font-weight: 700; font-family: 'JetBrains Mono', monospace;">{{ $stats['location'] }}</span>
            <span>en location</span>
        </div>
    </div>
    @endif

    {{-- Filtre compact et discret --}}
    <form method="GET" action="{{ route('admin.biens.index') }}" style="
        background: white; border-radius: 10px; padding: 0.85rem 1rem;
        border: 1px solid #E8ECF0; margin-bottom: 1.25rem;
        display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;
        box-shadow: 0 1px 2px rgba(34,40,49,0.03);
    ">
        <div style="flex: 2; min-width: 200px; position: relative;">
            <i class="bi bi-search" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #7C8D9E; font-size: 0.85rem;"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par titre, quartier, adresse, auteur..."
                style="width: 100%; padding: 0.55rem 0.75rem 0.55rem 2.1rem; border: 1px solid #DCE1E7; border-radius: 6px; font-size: 0.85rem; outline: none; background: #F8F9FA;">
        </div>

        <div style="min-width: 130px;">
            <select name="type_bien" style="width: 100%; padding: 0.55rem 0.75rem; border: 1px solid #DCE1E7; border-radius: 6px; font-size: 0.85rem; outline: none; background: white;">
                <option value="">Tous les types</option>
                <option value="maison" {{ request('type_bien') === 'maison' ? 'selected' : '' }}>Maison / Villa</option>
                <option value="appartement" {{ request('type_bien') === 'appartement' ? 'selected' : '' }}>Appartement</option>
                <option value="terrain" {{ request('type_bien') === 'terrain' ? 'selected' : '' }}>Terrain</option>
                <option value="bureau" {{ request('type_bien') === 'bureau' ? 'selected' : '' }}>Bureau</option>
                <option value="magasin" {{ request('type_bien') === 'magasin' ? 'selected' : '' }}>Commerce / Magasin</option>
                <option value="entrepot" {{ request('type_bien') === 'entrepot' ? 'selected' : '' }}>Entrepôt</option>
            </select>
        </div>

        <div style="min-width: 110px;">
            <select name="type_offre" style="width: 100%; padding: 0.55rem 0.75rem; border: 1px solid #DCE1E7; border-radius: 6px; font-size: 0.85rem; outline: none; background: white;">
                <option value="">Offre</option>
                <option value="vente" {{ request('type_offre') === 'vente' ? 'selected' : '' }}>Vente</option>
                <option value="location" {{ request('type_offre') === 'location' ? 'selected' : '' }}>Location</option>
            </select>
        </div>

        <div style="min-width: 120px;">
            <select name="statut" style="width: 100%; padding: 0.55rem 0.75rem; border: 1px solid #DCE1E7; border-radius: 6px; font-size: 0.85rem; outline: none; background: white;">
                <option value="">Statut</option>
                <option value="active" {{ in_array(request('statut'), ['active', 'disponible']) ? 'selected' : '' }}>En ligne</option>
                <option value="loue" {{ request('statut') === 'loue' ? 'selected' : '' }}>Loué</option>
                <option value="vendu" {{ request('statut') === 'vendu' ? 'selected' : '' }}>Vendu</option>
                <option value="inactive" {{ in_array(request('statut'), ['inactive', 'en_negociation']) ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        <div style="display: flex; gap: 0.4rem;">
            <button type="submit" style="padding: 0.55rem 0.95rem; font-size: 0.84rem; background: #1B3A5C; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                Filtrer
            </button>
            @if(request()->hasAny(['search', 'type_bien', 'type_offre', 'statut', 'id_agence']))
            <a href="{{ route('admin.biens.index') }}" style="padding: 0.55rem 0.75rem; font-size: 0.84rem; color: #5A6B7B; border: 1px solid #DCE1E7; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center;" title="Effacer les filtres">
                <i class="bi bi-x-lg"></i>
            </a>
            @endif
        </div>
    </form>

    {{-- Messages de confirmation --}}
    @if(session('success'))
    <div style="background: #EBF8F2; color: #196C45; border: 1px solid #A3E3C1; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem; display: flex; align-items: center; gap: 0.5rem;">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Tableau épuré et sobre --}}
    <div style="background: white; border-radius: 10px; border: 1px solid #E8ECF0; box-shadow: 0 1px 3px rgba(34,40,49,0.04); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #F8F9FA; border-bottom: 1px solid #E8ECF0;">
                    <th style="padding: 0.75rem 1rem; font-size: 0.72rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; letter-spacing: 0.5px;">Bien</th>
                    <th style="padding: 0.75rem 1rem; font-size: 0.72rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; letter-spacing: 0.5px;">Prix & Offre</th>
                    <th style="padding: 0.75rem 1rem; font-size: 0.72rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; letter-spacing: 0.5px;">Publié par</th>
                    <th style="padding: 0.75rem 1rem; font-size: 0.72rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; letter-spacing: 0.5px;">Statut</th>
                    <th style="padding: 0.75rem 1rem; font-size: 0.72rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; letter-spacing: 0.5px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($biens as $bien)
                @php
                    // Miniature
                    $imageUrl = null;
                    if (!empty($bien->images) && is_array($bien->images) && count($bien->images) > 0) {
                        $imageUrl = asset('storage/' . $bien->images[0]);
                    } elseif (isset($bien->photos) && $bien->photos->count() > 0) {
                        $imageUrl = asset('storage/' . $bien->photos->first()->photo);
                    }

                    // Auteur
                    $authorName = $bien->user->name ?? $bien->proprietaire->nom ?? $bien->agence->nom_agence ?? 'Admin';
                    $authorRole = ucfirst($bien->user->role ?? 'client');

                    // Statut épuré (dot minimaliste)
                    $statut = $bien->statut ?? 'active';
                    $dot = match($statut) {
                        'active', 'disponible' => ['color' => '#10B981', 'label' => 'En ligne', 'textColor' => '#196C45'],
                        'loue' => ['color' => '#3B82F6', 'label' => 'Loué', 'textColor' => '#1E40AF'],
                        'vendu' => ['color' => '#EF4444', 'label' => 'Vendu', 'textColor' => '#991B1B'],
                        default => ['color' => '#9CA3AF', 'label' => 'Inactif', 'textColor' => '#5A6B7B'],
                    };

                    $isLocation = ($bien->type_offre ?? '') === 'location';
                @endphp
                <tr style="border-top: 1px solid #F0F3F6; transition: background 0.12s ease;" onmouseover="this.style.background='#FBFBFB';" onmouseout="this.style.background='white';">
                    {{-- 1. Bien & Miniature --}}
                    <td style="padding: 0.85rem 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 44px; height: 44px; border-radius: 6px; overflow: hidden; background: #F8F9FA; border: 1px solid #E8ECF0; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                @if($imageUrl)
                                <img src="{{ $imageUrl }}" alt="{{ $bien->titre }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                <i class="bi bi-building" style="font-size: 1.1rem; color: #BAC3CD;"></i>
                                @endif
                            </div>
                            <div style="min-width: 0;">
                                <a href="{{ route('admin.biens.show', $bien->id) }}" style="font-weight: 700; color: #1B3A5C; text-decoration: none; font-size: 0.9rem; display: block;" title="{{ $bien->titre }}">
                                    {{ Str::limit($bien->titre, 36) }}
                                </a>
                                <div style="font-size: 0.75rem; color: #5A6B7B; margin-top: 0.15rem;">
                                    <span>{{ $bien->quartier ?? 'Korhogo' }}</span>
                                    <span style="color: #DCE1E7;">·</span>
                                    <span style="text-transform: capitalize;">{{ $bien->type_bien ?? 'Bien' }}</span>
                                    @if($bien->superficie)
                                    <span style="color: #DCE1E7;">·</span>
                                    <span style="font-family: 'JetBrains Mono', monospace;">{{ number_format($bien->superficie, 0, ',', ' ') }} m²</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- 2. Prix & Type d'offre --}}
                    <td style="padding: 0.85rem 1rem;">
                        <div style="font-family: 'JetBrains Mono', monospace; font-weight: 800; font-size: 0.9rem; color: #1B3A5C;">
                            {{ number_format($bien->prix, 0, ',', ' ') }} FCFA
                        </div>
                        <div style="font-size: 0.72rem; color: {{ $isLocation ? '#E8734A' : '#1E40AF' }}; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; margin-top: 0.1rem;">
                            {{ $isLocation ? 'Location / mois' : 'Vente' }}
                        </div>
                    </td>

                    {{-- 3. Publié par --}}
                    <td style="padding: 0.85rem 1rem;">
                        <div style="font-weight: 600; font-size: 0.84rem; color: #222831;">{{ Str::limit($authorName, 22) }}</div>
                        <div style="font-size: 0.72rem; color: #7C8D9E; margin-top: 0.1rem;">
                            {{ $authorRole }} · {{ $bien->created_at ? $bien->created_at->format('d/m/Y') : '—' }}
                        </div>
                    </td>

                    {{-- 4. Statut (Dot épuré) --}}
                    <td style="padding: 0.85rem 1rem;">
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.82rem; font-weight: 600; color: {{ $dot['textColor'] }};">
                            <span style="width: 7px; height: 7px; border-radius: 50%; background: {{ $dot['color'] }}; flex-shrink: 0;"></span>
                            <span>{{ $dot['label'] }}</span>
                        </div>
                    </td>

                    {{-- 5. Actions --}}
                    <td style="padding: 0.85rem 1rem; text-align: right;">
                        <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end;">
                            {{-- Aperçu public --}}
                            <a href="{{ route('annonces.show', $bien->id) }}" target="_blank" title="Voir l'annonce publique"
                                style="width: 30px; height: 30px; border-radius: 6px; background: #F8F9FA; color: #5A6B7B; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 0.85rem; border: 1px solid #E8ECF0;">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>

                            {{-- Fiche admin --}}
                            <a href="{{ route('admin.biens.show', $bien->id) }}" title="Détails"
                                style="width: 30px; height: 30px; border-radius: 6px; background: #F8F9FA; color: #1B3A5C; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 0.85rem; border: 1px solid #E8ECF0;">
                                <i class="bi bi-eye"></i>
                            </a>

                            {{-- Modifier --}}
                            <a href="{{ route('admin.biens.edit', $bien->id) }}" title="Modifier"
                                style="width: 30px; height: 30px; border-radius: 6px; background: #EFF6FF; color: #1E40AF; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 0.85rem; border: 1px solid #BFDBFE;">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- Supprimer --}}
                            <form action="{{ route('admin.biens.destroy', $bien->id) }}" method="POST"
                                data-confirm="Êtes-vous sûr de vouloir supprimer définitivement le bien « {{ $bien->titre }} » ?"
                                data-confirm-title="Supprimer le bien"
                                data-confirm-btn="Supprimer le bien"
                                data-confirm-warning="Le bien sera supprimé de la base de données et n'apparaîtra plus dans les catalogues."
                                style="margin: 0; display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Supprimer"
                                    style="width: 30px; height: 30px; border-radius: 6px; background: #FDF2F2; color: #991B1B; border: 1px solid #FCA5A5; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 3rem 1rem; text-align: center; color: #7C8D9E;">
                        <i class="bi bi-building-x" style="font-size: 2rem; color: #BAC3CD; display: block; margin-bottom: 0.5rem;"></i>
                        <div style="font-weight: 700; color: #1B3A5C; font-size: 0.95rem;">Aucun bien trouvé</div>
                        <div style="font-size: 0.8rem; color: #5A6B7B; margin-top: 0.2rem;">Modifiez vos critères de recherche ou réinitialisez les filtres.</div>
                        @if(request()->hasAny(['search', 'type_bien', 'type_offre', 'statut']))
                        <a href="{{ route('admin.biens.index') }}" style="display: inline-block; margin-top: 0.75rem; font-size: 0.82rem; color: #1B3A5C; text-decoration: underline; font-weight: 600;">
                            Réinitialiser les filtres
                        </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination discrète --}}
    <div style="margin-top: 1.25rem;">
        {{ $biens->links() }}
    </div>

</section>
@endsection