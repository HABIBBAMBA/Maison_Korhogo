{{-- resources/views/annonces/show.blade.php --}}
@extends('layouts.app')

@section('title', $annonce->titre . ' — ImmoPro')

@section('content')
<div class="page-container">

    {{-- Fil d'Ariane --}}
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('annonces.index') }}" style="color:var(--teal);font-size:0.88rem;font-weight:500;">
            <i class="bi bi-arrow-left"></i> Retour aux annonces
        </a>
    </div>

    {{-- Galerie --}}
    @if($annonce->images && count($annonce->images) > 0)
    <div class="show-gallery">
        <img src="{{ asset('storage/' . $annonce->images[0]) }}" alt="{{ $annonce->titre }}">
    </div>
    @if(count($annonce->images) > 1)
    <div style="display:flex;gap:0.75rem;margin-top:0.75rem;overflow-x:auto;">
        @foreach($annonce->images as $img)
        <img src="{{ asset('storage/' . $img) }}"
            style="width:100px;height:75px;object-fit:cover;border-radius:8px;cursor:pointer;"
            alt="Photo supplémentaire">
        @endforeach
    </div>
    @endif
    @else
    <div class="show-gallery" style="display:flex;align-items:center;justify-content:center;">
        <i class="bi bi-image" style="font-size:4rem;color:#ccc;"></i>
    </div>
    @endif

    {{-- Contenu --}}
    <div class="show-content">
        {{-- Colonne principale --}}
        <div class="show-main">
            <div style="display:flex;gap:0.5rem;margin-bottom:1rem;">
                <span class="badge badge-{{ $annonce->categorie }}">
                    {{ ucfirst($annonce->categorie) }}
                </span>
                <span class="badge badge-type">
                    {{ ucfirst($annonce->type) }}
                </span>
            </div>

            <div class="show-price">{{ $annonce->prix_formate }}</div>
            <h1 class="show-title">{{ $annonce->titre }}</h1>
            <div class="show-location">
                <i class="bi bi-geo-alt-fill"></i>
                {{ $annonce->adresse ? $annonce->adresse . ', ' : '' }}
                {{ $annonce->quartier ? $annonce->quartier . ', ' : '' }}
                {{ $annonce->ville ?? '' }}
            </div>

            <div class="show-specs">
                @if($annonce->superficie)
                <div class="show-spec">
                    <div class="value">{{ number_format($annonce->superficie, 0, ',', '.') }} m²</div>
                    <div class="label">Superficie</div>
                </div>
                @endif
                @if($annonce->nombre_pieces)
                <div class="show-spec">
                    <div class="value">{{ $annonce->nombre_pieces }}</div>
                    <div class="label">Pièces</div>
                </div>
                @endif
                @if($annonce->nombre_chambres)
                <div class="show-spec">
                    <div class="value">{{ $annonce->nombre_chambres }}</div>
                    <div class="label">Chambres</div>
                </div>
                @endif
                @if($annonce->nombre_salles_bain)
                <div class="show-spec">
                    <div class="value">{{ $annonce->nombre_salles_bain }}</div>
                    <div class="label">Salle de bain</div>
                </div>
                @endif
            </div>

            <h3 style="font-size:1rem;font-weight:700;margin-bottom:0.75rem;">Description</h3>
            <p style="color:#555;line-height:1.8;white-space:pre-line;">{{ $annonce->description }}</p>
        </div>

        {{-- Sidebar --}}
        <div class="show-sidebar">
            {{-- Contact --}}
            <div class="sidebar-card">
                <h3 style="font-size:0.95rem;font-weight:700;margin-bottom:1rem;">
                    <i class="bi bi-person-circle" style="color:var(--teal)"></i> Annonceur
                </h3>
                <p style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">
                    {{ $annonce->user->name }}
                </p>
                <p style="font-size:0.85rem;color:#888;">
                    Membre depuis {{ $annonce->user->created_at->format('Y') }}
                </p>
                @if($annonce->user->telephone)
                <a href="tel:{{ $annonce->user->telephone }}"
                    class="btn btn-primary btn-sm" style="width:100%;justify-content:center;margin-top:1rem;">
                    <i class="bi bi-telephone-fill"></i> Appeler
                </a>
                @endif
            </div>

            {{-- Actions propriétaire --}}
            @auth
            @if(Auth::id() === $annonce->id_user)
            <div class="sidebar-card">
                <h3 style="font-size:0.95rem;font-weight:700;margin-bottom:1rem;">
                    <i class="bi bi-gear" style="color:var(--teal)"></i> Gérer
                </h3>
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    <a href="{{ route('annonces.edit', $annonce) }}" class="btn btn-secondary btn-sm" style="justify-content:center;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('annonces.destroy', $annonce) }}" method="POST"
                        onsubmit="return confirm('Supprimer cette annonce ? Cette action est irréversible.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="width:100%;justify-content:center;">
                            <i class="bi bi-trash3"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @endauth
        </div>
    </div>

    {{-- Annonces similaires --}}
    @if($similaires->count() > 0)
    <div style="margin-top:3rem;">
        <h2 style="font-size:1.3rem;font-weight:800;margin-bottom:1.25rem;">
            Biens similaires
        </h2>
        <div class="annonces-grid">
            @foreach($similaires as $sim)
            <a href="{{ route('annonces.show', $sim) }}" class="annonce-card">
                <div class="card-image">
                    <img src="{{ $sim->premiere_image }}" alt="{{ $sim->titre }}">
                    <div class="card-badges">
                        <span class="badge badge-{{ $sim->categorie }}">{{ ucfirst($sim->categorie) }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-price">{{ $sim->prix_formate }}</div>
                    <div class="card-title">{{ $sim->titre }}</div>
                    <div class="card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ $sim->ville ?? '' }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection