@extends('layouts.app')

@section('title', $bien->titre . ' — Admin')

@section('content')
<section style="max-width: 900px; margin: 0 auto; padding: 3rem 2rem;">

    <a href="{{ route('admin.biens.index') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
        <i class="bi bi-arrow-left"></i> Retour aux biens
    </a>

    <div style="
        background: white; border-radius: 14px; padding: 2.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06); margin-top: 1rem;
    ">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.4rem; font-weight: 800;">
                    {{ $bien->titre }}
                </h1>
                <div style="display: flex; gap: 1rem; margin-top: 0.5rem; flex-wrap: wrap;">
                    @php
                    $statutColors = [
                    'disponible' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                    'loue' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                    'vendu' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                    'en_negociation' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                    ];
                    $statutLabels = [
                    'disponible' => 'Disponible', 'loue' => 'Loué',
                    'vendu' => 'Vendu', 'en_negociation' => 'Négociation',
                    ];
                    $sc = $statutColors[$bien->statut] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                    @endphp
                    <span style="
                        padding: 0.3rem 0.75rem;
                        background: {{ $sc['bg'] }};
                        color: {{ $sc['text'] }};
                        border-radius: 50px;
                        font-size: 0.8rem;
                        font-weight: 600;
                    ">{{ $statutLabels[$bien->statut] ?? $bien->statut }}</span>
                    <span style="padding: 0.3rem 0.75rem; background: #f3f4f6; border-radius: 50px; font-size: 0.8rem; font-weight: 600; text-transform: capitalize;">
                        {{ $bien->type_bien }}
                    </span>
                </div>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('admin.biens.edit', $bien) }}" class="btn btn-primary" style="font-size: 0.85rem;">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <form action="{{ route('admin.biens.destroy', $bien) }}" method="POST"
                    onsubmit="return confirm('Supprimer ce bien ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="font-size: 0.85rem; color: #e53935; border-color: #e53935;">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>

        <div style="font-size: 2rem; font-weight: 800; color: var(--teal); margin-bottom: 1.5rem;">
            {{ number_format($bien->prix, 0, ',', ' ') }} €
        </div>

        {{-- Photos --}}
        @if($bien->photos->count() > 0)
        <div style="border-top: 1px solid #f3f4f6; padding-top: 1.5rem; margin-bottom: 1.5rem;">
            <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.75rem;">Photos</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 0.75rem;">
                @foreach($bien->photos as $photo)
                <div style="aspect-ratio: 1; border-radius: 10px; overflow: hidden; border: 2px solid #f3f4f6;">
                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="Photo du bien" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div style="border-top: 1px solid #f3f4f6; padding-top: 1.5rem; margin-bottom: 1.5rem;">
            <div style="
                aspect-ratio: 16/9; max-height: 300px; border-radius: 12px;
                background: linear-gradient(135deg, rgba(44, 110, 110, 0.08), rgba(196, 162, 101, 0.06));
                display: flex; align-items: center; justify-content: center;
            ">
                <i class="bi bi-building" style="font-size: 4rem; color: rgba(44, 110, 110, 0.15);"></i>
            </div>
        </div>
        @endif

        @if($bien->description)
        <div style="border-top: 1px solid #f3f4f6; padding-top: 1.5rem; margin-bottom: 1.5rem;">
            <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.5rem;">Description</div>
            <p style="color: #555; line-height: 1.7;">{{ $bien->description }}</p>
        </div>
        @endif

        <div style="border-top: 1px solid #f3f4f6; padding-top: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem;">
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Pièces</div>
                    <div style="font-weight: 600;">{{ $bien->nombre_pieces ?? '—' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Quartier</div>
                    <div style="font-weight: 600;">{{ $bien->quartier ?? '—' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Adresse</div>
                    <div style="font-weight: 600;">{{ $bien->adresse ?? '—' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Agence</div>
                    <div style="font-weight: 600;">{{ $bien->agence->nom_agence ?? '—' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Propriétaire</div>
                    <div style="font-weight: 600;">{{ $bien->proprietaire ? $bien->proprietaire->nom . ' ' . ($bien->proprietaire->prenom ?? '') : '—' }}</div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection