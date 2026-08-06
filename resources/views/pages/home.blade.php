@extends('layouts.app')

@section('title', 'ImmoPro — Trouvez votre bien idéal')

@section('content')

<!-- ===== HERO SECTION ===== -->
<section style="
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #284b63 0%, #3c6e71 50%, #284b63 100%);
    overflow: hidden;
">
    <!-- Motif décoratif -->
    <div style="
    position: absolute;
    inset: 0;
    background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22><circle cx=%221%22 cy=%221%22 r=%221%22 fill=%22rgba(255,255,255,0.05)%22 /></svg>');
    background-size: 60px 60px;
">
    </div>

    <!-- Cercles décoratifs -->
    <div style="
        position: absolute;
        top: -150px;
        right: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: rgba(255,255,255,0.03);">
    </div>
    <div style="
        position: absolute;
        bottom: -100px;
        left: -50px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.02);">
    </div>

    <div style="position: relative; max-width: 1200px; margin: 0 auto; padding: 2rem; width: 100%;">
        <div style="max-width: 650px;">
            <span style="
                display: inline-block;
                padding: 0.5rem 1.25rem;
                background: rgba(255,255,255,0.1);
                border: 1px solid rgba(255,255,255,0.15);
                border-radius: 50px;
                color: rgba(255,255,255,0.9);
                font-size: 0.85rem;
                font-weight: 500;
                margin-bottom: 1.5rem;
                backdrop-filter: blur(10px);
            ">
                <i class="bi bi-stars"></i> La référence immobilière
            </span>

            <h1 style="
                font-family: 'Playfair Display', serif;
                font-size: clamp(2.5rem, 5vw, 4rem);
                color: var(--white);
                line-height: 1.1;
                margin-bottom: 1.25rem;
            ">
                Trouvez le bien<br>
                <span style="color: #7ec8c8;">de vos rêves</span>
            </h1>

            <p style="
                color: rgba(255,255,255,0.7);
                font-size: 1.1rem;
                margin-bottom: 2.5rem;
                max-width: 480px;
                line-height: 1.7;
            ">
                Explorez notre sélection de biens immobiliers d'exception.
                Maisons, appartements, terrains — trouvez votre bonheur.
            </p>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('biens.index') }}" class="btn" style="
                    background: white;
                    color: var(--primary);
                    padding: 0.85rem 2rem;
                    font-size: 0.95rem;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
                ">
                    <i class="bi bi-search"></i> Explorer les biens
                </a>
                <a href="{{ url('/contact') }}" class="btn" style="
                    background: rgba(255,255,255,0.1);
                    color: white;
                    border: 1px solid rgba(255,255,255,0.2);
                    padding: 0.85rem 2rem;
                    font-size: 0.95rem;
                ">
                    <i class="bi bi-telephone"></i> Nous contacter
                </a>
            </div>

            <!-- Statistiques -->
            <div style="
                display: flex;
                gap: 3rem;
                margin-top: 4rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(255,255,255,0.1);
            ">
                <div>
                    <div style="color: white; font-size: 2rem; font-weight: 800;">150+</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">Biens disponibles</div>
                </div>
                <div>
                    <div style="color: white; font-size: 2rem; font-weight: 800;">98%</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">Clients satisfaits</div>
                </div>
                <div>
                    <div style="color: white; font-size: 2rem; font-weight: 800;">10+</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">Années d'expérience</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SECTION BIENS RÉCENTS ===== -->
<section style="max-width: 1200px; margin: 0 auto; padding: 5rem 2rem;">
    <div style="text-align: center; margin-bottom: 3.5rem;">
        <span style="
            display: inline-block;
            color: var(--teal);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 0.75rem;
        ">Nos dernières offres</span>
        <h2 style="font-size: clamp(1.8rem, 3vw, 2.5rem); color: var(--dark);">
            Biens en vedette
        </h2>
        <p style="color: #777; max-width: 500px; margin: 0.75rem auto 0;">
            Découvrez notre sélection de biens immobiliers choisis avec soin
        </p>
    </div>

    @php
    $biens = \App\Models\Bien::with('photos')->where('statut', 'disponible')->latest()->take(6)->get();
    @endphp

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
                cursor: pointer;
            " onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-lg)'"
            onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">

            <!-- Image placeholder -->
            <div style="
                    height: 220px;
                    background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1), rgba(var(--teal-rgb), 0.1));
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: relative;
                ">
                <i class="bi bi-building" style="font-size: 4rem; color: rgba(var(--primary-rgb), 0.2);"></i>

                <!-- Badge statut -->
                <span style="
                        position: absolute;
                        top: 1rem;
                        left: 1rem;
                        padding: 0.3rem 0.75rem;
                        background: var(--teal);
                        color: white;
                        border-radius: 50px;
                        font-size: 0.75rem;
                        font-weight: 600;
                        text-transform: uppercase;
                    ">{{ ucfirst($bien->type_bien) }}</span>

                <!-- Badge prix -->
                <span style="
                        position: absolute;
                        bottom: 1rem;
                        right: 1rem;
                        padding: 0.4rem 1rem;
                        background: rgba(0,0,0,0.7);
                        color: white;
                        border-radius: 8px;
                        font-size: 0.95rem;
                        font-weight: 700;
                        backdrop-filter: blur(10px);
                    ">{{ $bien->prix_formate }}</span>
            </div>

            <!-- Contenu -->
            <div style="padding: 1.5rem;">
                <h3 style="
                        font-size: 1.15rem;
                        margin-bottom: 0.5rem;
                        color: var(--dark);
                    ">{{ $bien->titre }}</h3>

                <p style="
                        color: #888;
                        font-size: 0.85rem;
                        margin-bottom: 1rem;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    ">{{ $bien->description }}</p>

                <div style="
                        display: flex;
                        align-items: center;
                        gap: 1.25rem;
                        padding-top: 1rem;
                        border-top: 1px solid #f0f0f0;
                        font-size: 0.85rem;
                        color: #666;
                    ">
                    <span><i class="bi bi-door-open"></i> {{ $bien->nombre_pieces }} pièces</span>
                    <span><i class="bi bi-geo-alt"></i> {{ $bien->quartier ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
        @empty
        <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 4rem 2rem;
                color: #999;
            ">
            <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
            Aucun bien disponible pour le moment.
        </div>
        @endforelse
    </div>

    @if($biens->count() > 0)
    <div style="text-align: center; margin-top: 3rem;">
        <a href="{{ route('biens.index') }}" class="btn btn-outline" style="padding: 0.85rem 2.5rem;">
            Voir tous les biens <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    @endif
</section>

<!-- ===== SECTION POURQUOI NOUS ===== -->
<section style="background: var(--white); padding: 5rem 2rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="
                display: inline-block;
                color: var(--teal);
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.15em;
                margin-bottom: 0.75rem;
            ">Nos avantages</span>
            <h2 style="font-size: clamp(1.8rem, 3vw, 2.5rem); color: var(--dark);">
                Pourquoi nous choisir ?
            </h2>
        </div>

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
        ">
            @php
            $avantages = [
            ['icon' => 'bi-shield-check', 'titre' => 'Biens vérifiés', 'desc' => 'Chaque bien est vérifié par notre équipe avant mise en ligne.'],
            ['icon' => 'bi-headset', 'titre' => 'Support 24/7', 'desc' => 'Une équipe dédiée pour répondre à toutes vos questions.'],
            ['icon' => 'bi-cash-stack', 'titre' => 'Meilleurs prix', 'desc' => 'Nous négocions pour vous les meilleurs tarifs du marché.'],
            ];
            @endphp

            @foreach($avantages as $av)
            <div style="
                    text-align: center;
                    padding: 2.5rem 2rem;
                    border-radius: var(--radius);
                    background: var(--light-bg);
                    transition: var(--transition);
                " onmouseenter="this.style.background='var(--primary)'; this.style.color='white'; this.querySelector('.av-icon').style.background='rgba(255,255,255,0.15)'"
                onmouseleave="this.style.background='var(--light-bg)'; this.style.color='var(--dark)'; this.querySelector('.av-icon').style.background='rgba(var(--primary-rgb), 0.08)'">
                <div class="av-icon" style="
                        width: 70px;
                        height: 70px;
                        border-radius: 50%;
                        background: rgba(var(--primary-rgb), 0.08);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 1.25rem;
                        transition: var(--transition);
                    ">
                    <i class="bi {{ $av['icon'] }}" style="font-size: 1.5rem; color: var(--primary);"></i>
                </div>
                <h3 style="font-size: 1.15rem; margin-bottom: 0.75rem; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700;">{{ $av['titre'] }}</h3>
                <p style="font-size: 0.9rem; opacity: 0.8; line-height: 1.7;">{{ $av['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection