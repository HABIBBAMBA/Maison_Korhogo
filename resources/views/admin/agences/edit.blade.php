@extends('layouts.app')

@section('title', 'Modifier agence — Admin')

@section('content')
<section style="max-width: 700px; margin: 0 auto; padding: 3rem 2rem;">

    <a href="{{ route('admin.agences.index') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
        <i class="bi bi-arrow-left"></i> Retour aux agences
    </a>

    <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 1rem 0 2rem;">
        <i class="bi bi-pencil" style="color: var(--teal);"></i> Modifier {{ $agence->nom_agence }}
    </h1>

    @if($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.agences.update', $agence) }}" method="POST" style="
        background: white; border-radius: 14px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    ">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Nom de l'agence *
                </label>
                <input type="text" name="nom_agence" value="{{ old('nom_agence', $agence->nom_agence) }}" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Nom du responsable *
                </label>
                <input type="text" name="nom_responsable" value="{{ old('nom_responsable', $agence->nom_responsable) }}" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $agence->telephone) }}"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">Adresse</label>
                <input type="text" name="adresse" value="{{ old('adresse', $agence->adresse) }}"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.agences.index') }}" class="btn btn-outline" style="font-size: 0.9rem;">Annuler</a>
            <button type="submit" class="btn btn-primary" style="font-size: 0.9rem;">
                <i class="bi bi-check-lg"></i> Enregistrer
            </button>
        </div>
    </form>

</section>
@endsection
