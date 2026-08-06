@extends('layouts.app')

@section('title', 'Tableau de bord — ImmoPro')

@section('content')

<section style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">

    <!-- En-tête de bienvenue -->
    <div style="
        background: linear-gradient(135deg, var(--primary), var(--teal));
        border-radius: 16px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
    ">
        <!-- Décoration -->
        <div style="
            position: absolute; top: -50px; right: -30px;
            width: 200px; height: 200px; border-radius: 50%;
            background: rgba(255,255,255,0.05);
        "></div>

        <div style="position: relative; z-index: 1;">
            <span style="
                display: inline-block;
                padding: 0.3rem 0.75rem;
                background: rgba(255,255,255,0.15);
                border-radius: 50px;
                font-size: 0.8rem;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 0.75rem;
            ">
                @if($user->role === 'admin')
                <i class="bi bi-shield-check"></i> Administrateur
                @elseif($user->role === 'agence')
                <i class="bi bi-building"></i> Agence immobilière
                @elseif($user->role === 'proprietaire')
                <i class="bi bi-key"></i> Propriétaire
                @else
                <i class="bi bi-person"></i> Client
                @endif
            </span>

            <h1 style="font-size: 1.8rem; margin-bottom: 0.5rem;">
                @if($user->role === 'agence' && $user->agence)
                Bonjour, {{ $user->agence->nom_agence }}
                @elseif(in_array($user->role, ['client', 'proprietaire']) && $user->{$user->role})
                Bonjour, {{ $user->{$user->role}->prenom }}
                @else
                Bonjour, Admin
                @endif
            </h1>

            <p style="color: rgba(255,255,255,0.7); font-size: 0.95rem;">
                {{ now()->format('l d F Y') }}
            </p>
        </div>
    </div>

    <!-- Statistiques selon le rôle -->
    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    ">
        @if($user->estAdmin())
        <!-- Stats Admin -->
        @php
        $totalUsers = \App\Models\User::count();
        $totalBiens = \App\Models\Bien::count();
        $totalAgences = \App\Models\Agence::count();
        $totalContacts = \App\Models\Contact::count();
        @endphp

        @php
        $stats = [
        ['icon' => 'bi-people-fill', 'label' => 'Utilisateurs', 'value' => $totalUsers, 'color' => '#284b63'],
        ['icon' => 'bi-building-fill', 'label' => 'Biens', 'value' => $totalBiens, 'color' => '#3c6e71'],
        ['icon' => 'bi-shop', 'label' => 'Agences', 'value' => $totalAgences, 'color' => '#e67e22'],
        ['icon' => 'bi-chat-dots-fill', 'label' => 'Contacts', 'value' => $totalContacts, 'color' => '#8e44ad'],
        ];
        @endphp

        @elseif($user->estAgence())
        @php
        $mesBiens = $user->agence ? $user->agence->biens()->count() : 0;
        $disponibles = $user->agence ? $user->agence->biens()->where('statut', 'disponible')->count() : 0;
        $stats = [
        ['icon' => 'bi-building', 'label' => 'Mes biens', 'value' => $mesBiens, 'color' => '#284b63'],
        ['icon' => 'bi-check-circle', 'label' => 'Disponibles', 'value' => $disponibles, 'color' => '#27ae60'],
        ];
        @endphp

        @elseif($user->estProprietaire())
        @php
        $mesBiens = $user->proprietaire ? $user->proprietaire->biens()->count() : 0;
        $stats = [
        ['icon' => 'bi-key', 'label' => 'Mes propriétés', 'value' => $mesBiens, 'color' => '#284b63'],
        ];
        @endphp

        @else
        @php
        $stats = [
        ['icon' => 'bi-heart', 'label' => 'Favoris', 'value' => 0, 'color' => '#e74c3c'],
        ['icon' => 'bi-chat', 'label' => 'Demandes', 'value' => 0, 'color' => '#284b63'],
        ];
        @endphp
        @endif

        @foreach($stats as $stat)
        <div style="
                background: white;
                border-radius: 14px;
                padding: 1.75rem;
                display: flex;
                align-items: center;
                gap: 1.25rem;
                box-shadow: 0 1px 3px rgba(0,0,0,0.06);
                transition: all 0.3s ease;
            " onmouseenter="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
            onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.06)'">

            <div style="
                    width: 56px; height: 56px;
                    border-radius: 14px;
                    background: {{ $stat['color'] }}10;
                    display: flex;
                     align-items: center; 
                     justify-content: center;
                    flex-shrink: 0;">
                <i class="bi {{ $stat['icon'] }}" style="font-size: 1.4rem; color: {{ $stat['color'] }};"></i>
            </div>
            <div>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--dark); line-height: 1;">
                    {{ $stat['value'] }}
                </div>
                <div style="font-size: 0.85rem; color: #888; margin-top: 0.25rem;">
                    {{ $stat['label'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Actions rapides -->
    <div style="margin-bottom: 2.5rem;">
        <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">
            Actions rapides
        </h3>
        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
            <a href="{{ route('biens.index') }}" class="btn btn-outline" style="font-size: 0.85rem;">
                <i class="bi bi-eye"></i> Voir les biens
            </a>
            @if(in_array($user->role, ['admin', 'agence', 'proprietaire']))
            <a href="{{ route('annonces.create') }}" class="btn btn-primary" style="font-size: 0.85rem;">
                <i class="bi bi-plus-lg"></i> Ajouter un bien
            </a>
            @endif
            @if($user->estAdmin())
            <a href="#" class="btn btn-ghost" style="font-size: 0.85rem; border: 2px solid var(--gray);">
                <i class="bi bi-people"></i> Gérer les utilisateurs
            </a>
            @endif
        </div>
    </div>

    <!-- Informations du compte -->
    <div style="
        background: white;
        border-radius: 14px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    ">
        <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem;">
            <i class="bi bi-person-gear" style="color: var(--teal);"></i> Mon profil
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div>
                <div style="font-size: 0.8rem; color: #999; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Email</div>
                <div style="font-weight: 600;">{{ $user->email }}</div>
            </div>
            <div>
                <div style="font-size: 0.8rem; color: #999; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Rôle</div>
                <div style="font-weight: 600; text-transform: capitalize;">{{ $user->role }}</div>
            </div>
            <div>
                <div style="font-size: 0.8rem; color: #999; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Membre depuis</div>
                <div style="font-weight: 600;">{{ $user->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>

</section>

@endsection