@extends('layouts.app')

@section('title', 'ImmoPro — Trouvez votre bien idéal')

@section('content')

<!-- ===== HERO SECTION ===== -->
@php
    $heroImages = $heroPhotos->isNotEmpty()
        ? $heroPhotos
        : $annoncesRecentes
            ->flatMap(fn ($annonce) => $annonce->images ?? [])
            ->filter(fn ($image) => is_string($image) && $image !== '')
            ->unique()
            ->take(5)
            ->map(fn ($image) => asset('storage/' . $image))
            ->values();
@endphp

<section data-hero-carousel style="
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #284b63 0%, #3c6e71 50%, #284b63 100%);
    overflow: hidden;
">
    <div class="hero-carousel__slides" aria-hidden="true">
        @foreach($heroImages as $image)
        <img
            src="{{ $image }}"
            class="hero-carousel__slide{{ $loop->first ? ' is-active' : '' }}"
            alt=""
            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
            fetchpriority="{{ $loop->first ? 'high' : 'auto' }}">
        @endforeach
    </div>
    <div class="hero-carousel__overlay" aria-hidden="true" style="
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(20, 42, 58, 0.9) 0%, rgba(40, 75, 99, 0.72) 55%, rgba(40, 75, 99, 0.42) 100%);
    "></div>

    <div style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; padding: 2rem; width: 100%;">
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
                color: white;
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

            <!-- Statistiques dynamiques depuis la route -->
            <div style="
                display: flex;
                gap: 3rem;
                margin-top: 4rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(255,255,255,0.1);
            ">
                <div>
                    <div style="color: white; font-size: 2rem; font-weight: 800;">{{ $stats['total'] }}</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">Biens disponibles</div>
                </div>
                <div>
                    <div style="color: white; font-size: 2rem; font-weight: 800;">{{ $stats['vente'] }}</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">En vente</div>
                </div>
                <div>
                    <div style="color: white; font-size: 2rem; font-weight: 800;">{{ $stats['location'] }}</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">En location</div>
                </div>
            </div>
        </div>
    </div>

    @if($heroImages->count() > 1)
    <div
        class="hero-carousel__controls"
        role="group"
        aria-label="Navigation du carrousel"
        style="position: absolute; right: max(2rem, calc((100vw - 1200px) / 2 + 2rem)); bottom: 2rem; z-index: 3; display: flex; align-items: center; gap: 0.75rem;">
        <button
            type="button"
            data-carousel-previous
            aria-label="Diapositive précédente"
            style="width: 2.75rem; height: 2.75rem; border: 1px solid rgba(255,255,255,0.55); border-radius: 50%; background: rgba(0,0,0,0.2); color: white; cursor: pointer;">
            <i class="bi bi-chevron-left" aria-hidden="true"></i>
        </button>
        @foreach($heroImages as $index => $image)
            <button
                type="button"
                class="hero-carousel__dot{{ $loop->first ? ' is-active' : '' }}"
                data-carousel-dot="{{ $index }}"
                aria-label="Afficher la diapositive {{ $index + 1 }}"
                aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
            </button>
        @endforeach
        <button
            type="button"
            data-carousel-next
            aria-label="Diapositive suivante"
            style="width: 2.75rem; height: 2.75rem; border: 1px solid rgba(255,255,255,0.55); border-radius: 50%; background: rgba(0,0,0,0.2); color: white; cursor: pointer;">
            <i class="bi bi-chevron-right" aria-hidden="true"></i>
        </button>
    </div>
    @endif
</section>

@push('styles')
<style>
    .hero-carousel__slides {
        position: absolute;
        inset: 0;
    }

    .hero-carousel__slide {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 800ms ease;
    }

    .hero-carousel__slide.is-active {
        opacity: 1;
    }

    .hero-carousel__overlay {
        z-index: 1;
    }

    .hero-carousel__dot {
        width: 0.65rem;
        height: 0.65rem;
        padding: 0;
        border: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.55);
        cursor: pointer;
        transition: all 300ms ease;
    }

    .hero-carousel__dot.is-active {
        width: 1.5rem;
        background: white;
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-carousel__slide,
        .hero-carousel__dot {
            transition: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('[data-hero-carousel]').forEach((carousel) => {
        const slides = Array.from(carousel.querySelectorAll('.hero-carousel__slide'));
        const dots = Array.from(carousel.querySelectorAll('[data-carousel-dot]'));
        const previousButton = carousel.querySelector('[data-carousel-previous]');
        const nextButton = carousel.querySelector('[data-carousel-next]');

        if (slides.length < 2 || !previousButton || !nextButton) {
            return;
        }

        let activeIndex = 0;

        const showSlide = (index) => {
            activeIndex = (index + slides.length) % slides.length;

            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === activeIndex);
            });

            dots.forEach((dot, dotIndex) => {
                const isActive = dotIndex === activeIndex;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-pressed', String(isActive));
            });
        };

        previousButton.addEventListener('click', () => showSlide(activeIndex - 1));
        nextButton.addEventListener('click', () => showSlide(activeIndex + 1));

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showSlide(index));
        });

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            window.setInterval(() => showSlide(activeIndex + 1), 6000);
        }
    });
</script>
@endpush

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

    {{-- $annoncesRecentes est envoyée par la route dans web.php --}}

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
    ">
        @forelse($annoncesRecentes as $annonce)
        <div style="
                background: white;
                border-radius: var(--radius);
                overflow: hidden;
                box-shadow: var(--shadow-sm);
                transition: var(--transition);
                cursor: pointer;
            "
            onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-lg)'"
            onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">

            <!-- Image ou placeholder -->
            <div style="
                    height: 220px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: relative;
                    @if($annonce->images && count($annonce->images) > 0)
                        background: url('{{ asset('storage/' . $annonce->images[0]) }}') center/cover no-repeat;
                    @else
                        background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1), rgba(var(--teal-rgb), 0.1));
                    @endif
                ">
                @if(!$annonce->images || count($annonce->images) === 0)
                <i class="bi bi-building" style="font-size: 4rem; color: rgba(var(--primary-rgb), 0.2);"></i>
                @endif

                <span style="
                        position: absolute; top: 1rem; left: 1rem;
                        padding: 0.3rem 0.75rem;
                        background: var(--teal); color: white;
                        border-radius: 50px; font-size: 0.75rem; font-weight: 600;
                        text-transform: uppercase;
                    ">{{ ucfirst($annonce->type_bien ?? 'Bien') }}</span>

                <span style="
                        position: absolute; bottom: 1rem; right: 1rem;
                        padding: 0.4rem 1rem;
                        background: rgba(0,0,0,0.7); color: white;
                        border-radius: 8px; font-size: 0.95rem; font-weight: 700;
                        backdrop-filter: blur(10px);
                    ">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</span>
            </div>

            <div style="padding: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; color: var(--dark);">
                    {{ $annonce->titre }}
                </h3>
                <p style="
                    color: #888; font-size: 0.85rem; margin-bottom: 1rem;
                    display: -webkit-box; -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical; overflow: hidden;
                ">{{ $annonce->description }}</p>
                <div style="
                    display: flex; align-items: center; gap: 1.25rem;
                    padding-top: 1rem; border-top: 1px solid #f0f0f0;
                    font-size: 0.85rem; color: #666;
                ">
                    @if($annonce->nombre_pieces)
                    <span><i class="bi bi-door-open"></i> {{ $annonce->nombre_pieces }} pièces</span>
                    @endif
                    @if($annonce->superficie)
                    <span><i class="bi bi-arrows-fullscreen"></i> {{ $annonce->superficie }} m²</span>
                    @endif
                    <span><i class="bi bi-geo-alt"></i> {{ $annonce->quartier ?? 'N/A' }}</span>
                </div>
                <a href="{{ route('annonces.show', $annonce->id) }}" style="
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
            <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
            Aucun bien disponible pour le moment.
        </div>
        @endforelse
    </div>

    @if($annoncesRecentes->count() > 0)
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
                "
                onmouseenter="this.style.background='var(--primary)'; this.style.color='white'; this.querySelector('.av-icon').style.background='rgba(255,255,255,0.15)'"
                onmouseleave="this.style.background='var(--light-bg)'; this.style.color='var(--dark)'; this.querySelector('.av-icon').style.background='rgba(var(--primary-rgb), 0.08)'">
                <div class="av-icon" style="
                        width: 70px; height: 70px;
                        border-radius: 50%;
                        background: rgba(var(--primary-rgb), 0.08);
                        display: flex; align-items: center; justify-content: center;
                        margin: 0 auto 1.25rem;
                        transition: var(--transition);
                    ">
                    <i class="bi {{ $av['icon'] }}" style="font-size: 1.5rem; color: var(--primary);"></i>
                </div>
                <h3 style="font-size: 1.15rem; margin-bottom: 0.75rem; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700;">
                    {{ $av['titre'] }}
                </h3>
                <p style="font-size: 0.9rem; opacity: 0.8; line-height: 1.7;">{{ $av['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection