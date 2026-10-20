@extends('layouts.app')

@section('title', 'Nouvel utilisateur — Admin')

@section('content')
<section style="max-width: 700px; margin: 0 auto; padding: 3rem 2rem;">

    <a href="{{ route('admin.users.index') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
        <i class="bi bi-arrow-left"></i> Retour aux utilisateurs
    </a>

    <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 1rem 0 2rem;">
        <i class="bi bi-person-plus" style="color: var(--teal);"></i> Nouvel utilisateur
    </h1>

    @if($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" style="
        background: white;
        border-radius: 14px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    ">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Nom complet *
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Email *
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Mot de passe *
                </label>
                <input type="password" name="password" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Confirmer *
                </label>
                <input type="password" name="password_confirmation" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Rôle *
                </label>
                <select name="role" id="role-select" required
                    onchange="document.getElementById('agence-field').style.display = this.value === 'agence' ? 'block' : 'none';"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div id="agence-field" style="display: {{ old('role') === 'agence' ? 'block' : 'none' }};">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 0.4rem;">
                    Agence
                </label>
                <select name="agence_id"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; outline: none; background: white;">
                    <option value="">— Choisir une agence —</option>
                    @foreach($agences as $agence)
                    <option value="{{ $agence->id }}" {{ old('agence_id') == $agence->id ? 'selected' : '' }}>
                        {{ $agence->nom_agence }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="font-size: 0.9rem;">
                Annuler
            </a>
            <button type="submit" class="btn btn-primary" style="font-size: 0.9rem;">
                <i class="bi bi-check-lg"></i> Créer l'utilisateur
            </button>
        </div>
    </form>

</section>
@endsection