@extends('layouts.app')

@section('title', 'Tous nos biens — ImmoPro')

@section('content')

<section style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">

    <!-- En-tête -->
    <div style="margin-bottom: 2.5rem;">
        <h1 style="font-size: clamp(1.8rem, 3vw, 2.5rem); margin-bottom: 0.5rem;">
            Nos biens immobiliers
        </h1>
        <p style="color: #777;">Parcourez l'ensemble de nos biens disponibles</p>
    </div>

    <!-- Filtres -->
    <div style="
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 2.5rem;
        padding: 1.5rem;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    ">
        <a href="{{ route('biens.index') }}"
            class="btn {{ !request('type_bien') ? 'btn-primary' : 'btn-ghost' }}"
            style="font-size: 0.85rem;">
            Tous
        </a>
        <a href="{{ route('biens.index', ['type_bien' => 'maison']) }}"
            class="btn {{ request('type_bien') == 'maison' ? 'btn-primary' : 'btn-ghost' }}"
            style="font-size: 0.85rem;">
            <i class="bi bi-house"></i> Maisons
        </a>
        <a href="{{ route('biens.index', ['type_bien' => 'appartement']) }}"
            class="btn {{ request('type_bien') == 'appartement' ? 'btn-primary' : 'btn-ghost' }}"
            style="font-size: 0.85rem;">
            <i class="bi bi-building"></i> Appartements
        </a>
        <a href="{{ route('biens.index', ['type_bien' => 'terrain']) }}"
            class="btn {{ request('type_bien') == 'terrain' ? 'btn-primary' : 'btn-ghost' }}"
            style="font-size: 0.85rem;">
            <i class="bi bi-geo"></i> Terrains
        </a>
        <a href="{{ route('biens.index', ['type_bien' => 'bureau']) }}"
            class="btn {{ request('type_bien') == 'bureau' ? 'btn-primary' : 'btn-ghost' }}"
            style="font-size: 0.85rem;">
            <i class="bi bi-briefcase"></i> Bureaux
        </a>
        <a href="{{ route('biens.index', ['type_bien' => 'magasin']) }}"
            class="btn {{ request('type_bien') == 'magasin' ? 'btn-primary' : 'btn-ghost' }}"
            style="font-size: 0.85rem;">
            <i class="bi bi-shop"></i> Magasins
        </a>
    </div>

    @php
    $query = \App\Models\Annonce::with('user')
    ->where('statut', 'active');

    if (request('type_bien')) {
    $query->where('type_bien', request('type_bien'));
    }

    $biens = $query->latest()->paginate(9);
    @endphp

    <!-- Liste des biens -->
    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
    ">
        @forelse($biens as $bien)
        <div style="
                background: white;
                border-radius: var(--radius);
                overflow: hidden;
                box-shadow: var(--shadow-sm);
                transition: var(--transition);
            "
            onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-lg)'"
            onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">

            {{-- Image ou placeholder --}}
            <div style="
                    height: 220px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: relative;
                    @if($bien->images && count($bien->images) > 0)
                        background: url('{{ asset('storage/' . $bien->images[0]) }}') center/cover no-repeat;
                    @else
                        background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.08), rgba(var(--teal-rgb), 0.08));
                    @endif
                ">
                @if(!$bien->images || count($bien->images) === 0)
                <i class="bi bi-building" style="font-size: 4rem; color: rgba(var(--primary-rgb), 0.15);"></i>
                @endif

                <span style="
                        position: absolute; top: 1rem; left: 1rem;
                        padding: 0.3rem 0.75rem;
                        background: var(--teal); color: white;
                        border-radius: 50px; font-size: 0.75rem; font-weight: 600;
                    ">{{ ucfirst($bien->type_bien ?? 'Bien') }}</span>

                <span style="
                        position: absolute; bottom: 1rem; right: 1rem;
                        padding: 0.4rem 1rem;
                        background: rgba(0,0,0,0.7); color: white;
                        border-radius: 8px; font-size: 0.95rem; font-weight: 700;
                    ">{{ number_format($bien->prix, 0, ',', ' ') }} FCFA</span>
            </div>

            <div style="padding: 1.5rem;">
                <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem;">{{ $bien->titre }}</h3>
                <p style="color: #888; font-size: 0.85rem; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $bien->description }}
                </p>
                <div style="display: flex; align-items: center; gap: 1.25rem; padding-top: 1rem; border-top: 1px solid #f0f0f0; font-size: 0.85rem; color: #666;">
                    @if($bien->nombre_pieces)
                    <span><i class="bi bi-door-open"></i> {{ $bien->nombre_pieces }} pièces</span>
                    @endif
                    @if($bien->superficie)
                    <span><i class="bi bi-arrows-fullscreen"></i> {{ $bien->superficie }} m²</span>
                    @endif
                    <span><i class="bi bi-geo-alt"></i> {{ $bien->quartier ?? 'N/A' }}</span>
                </div>
                <a href="{{ route('annonces.show', $bien->id) }}" style="
                    display: inline-block; margin-top: 1rem;
                    padding: 0.5rem 1.25rem;
                    background: var(--primary); color: white;
                    border-radius: 8px; font-size: 0.85rem;
                    text-decoration: none;
                ">Voir détails</a>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; color: #999;">
            <i class="bi bi-search" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
            Aucun bien trouvé pour cette catégorie.
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div style="margin-top: 3rem; display: flex; justify-content: center;">
        {{ $biens->appends(request()->query())->links() }}
    </div>

</section>

@endsection