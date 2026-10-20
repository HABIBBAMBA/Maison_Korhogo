@extends('layouts.app')

@section('title', 'Gestion des agences — Admin')

@section('content')
<section style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
                <i class="bi bi-arrow-left"></i> Administration
            </a>
            <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; margin-top: 0.5rem;">
                <i class="bi bi-shop" style="color: var(--teal);"></i> Agences
                <span style="font-size: 0.85rem; font-weight: 400; color: #999;">({{ $agences->total() }})</span>
            </h1>
        </div>
        <a href="{{ route('admin.agences.create') }}" class="btn btn-primary" style="font-size: 0.85rem;">
            <i class="bi bi-building-add"></i> Nouvelle agence
        </a>
    </div>

    {{-- Recherche --}}
    <form method="GET" action="{{ route('admin.agences.index') }}" style="
        background: white; border-radius: 14px; padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06); margin-bottom: 1.5rem;
        display: flex; gap: 1rem; flex-wrap: wrap; align-items: end;
    ">
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.3rem;">Rechercher</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom agence, responsable, téléphone..."
                style="width: 100%; padding: 0.65rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
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

    @if(session('error'))
    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    {{-- Grille d'agences --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.25rem;">
        @forelse($agences as $agence)
        <div style="
            background: white;
            border-radius: 14px;
            padding: 1.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        ">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.05rem; font-weight: 700; margin-bottom: 0.5rem;">
                        {{ $agence->nom_agence }}
                    </h3>
                    <span style="
                        padding: 0.2rem 0.6rem;
                        background: #dbeafe;
                        color: #1e40af;
                        border-radius: 50px;
                        font-size: 0.75rem;
                        font-weight: 600;
                    ">
                        {{ $agence->biens_count }} bien{{ $agence->biens_count > 1 ? 's' : '' }}
                    </span>
                </div>

                @if($agence->nom_responsable)
                <div style="font-size: 0.85rem; color: #666; margin-bottom: 0.25rem;">
                    <i class="bi bi-person"></i> {{ $agence->nom_responsable }}
                </div>
                @endif

                @if($agence->adresse)
                <div style="font-size: 0.85rem; color: #666; margin-bottom: 0.25rem;">
                    <i class="bi bi-geo-alt" style="color: var(--teal);"></i> {{ $agence->adresse }}
                </div>
                @endif

                @if($agence->telephone)
                <div style="font-size: 0.85rem; color: #666;">
                    <i class="bi bi-telephone"></i> {{ $agence->telephone }}
                </div>
                @endif
            </div>

            <div style="display: flex; gap: 0.5rem; margin-top: 1.25rem; border-top: 1px solid #f3f4f6; padding-top: 1rem;">
                <a href="{{ route('admin.agences.show', $agence) }}" title="Voir"
                    style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f3f4f6; color: #666; text-decoration: none; font-size: 0.9rem;">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('admin.agences.edit', $agence) }}" title="Modifier"
                    style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #dbeafe; color: #1e40af; text-decoration: none; font-size: 0.9rem;">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.agences.destroy', $agence) }}" method="POST"
                    onsubmit="return confirm('Supprimer « {{ $agence->nom_agence }} » ?');">
                    @csrf @method('DELETE')
                    <button type="submit" title="Supprimer"
                        style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #fee2e2; color: #991b1b; border: none; cursor: pointer; font-size: 0.9rem;">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: #999;">
            <i class="bi bi-shop" style="font-size: 2rem; display: block; margin-bottom: 0.5rem; color: #ddd;"></i>
            Aucune agence trouvée
        </div>
        @endforelse
    </div>

    <div style="margin-top: 1.5rem;">{{ $agences->links() }}</div>

</section>
@endsection