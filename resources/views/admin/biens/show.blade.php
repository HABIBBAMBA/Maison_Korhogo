@extends('layouts.app')

@section('title', $bien->titre . ' — Fiche Admin')

@section('content')
<section style="max-width: 1000px; margin: 0 auto; padding: 2.5rem 1.5rem;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <a href="{{ route('admin.biens.index') }}" style="font-size: 0.85rem; color: #5A6B7B; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; font-weight: 500;">
            <i class="bi bi-arrow-left"></i> Retour à la liste des biens
        </a>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('annonces.show', $bien->id) }}" target="_blank" class="btn btn-outline" style="font-size: 0.85rem; color: #1B3A5C; border: 1px solid #DCE1E7; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="bi bi-box-arrow-up-right"></i> Voir l'annonce publique
            </a>
            <a href="{{ route('admin.biens.edit', $bien->id) }}" class="btn btn-primary" style="font-size: 0.85rem; background: #1B3A5C; color: white; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <form action="{{ route('admin.biens.destroy', $bien->id) }}" method="POST"
                data-confirm="Confirmer la suppression définitive de ce bien « {{ $bien->titre }} » ?"
                data-confirm-title="Supprimer le bien"
                data-confirm-btn="Supprimer définitivement"
                data-confirm-warning="Cette opération est irréversible et retirera ce bien des registres de la plateforme."
                style="margin: 0; display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline" style="font-size: 0.85rem; color: #991B1B; border: 1px solid #FCA5A5; background: #FDF2F2; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <i class="bi bi-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </div>

    <div style="
        background: white; border-radius: 14px; padding: 2.25rem;
        border: 1px solid #E8ECF0; box-shadow: 0 1px 3px rgba(34,40,49,0.04);
    ">
        {{-- En-tête titre & badges --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1px solid #F0F3F6; padding-bottom: 1.5rem;">
            <div>
                <div style="font-size: 0.78rem; color: #7C8D9E; font-family: 'JetBrains Mono', monospace; margin-bottom: 0.25rem;">
                    Référence : #{{ $bien->id }}
                </div>
                <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; color: #1B3A5C; margin: 0 0 0.6rem 0;">
                    {{ $bien->titre }}
                </h1>
                <div style="display: flex; gap: 0.6rem; align-items: center; flex-wrap: wrap;">
                    @php
                    $statut = $bien->statut ?? 'active';
                    $statutBadge = match($statut) {
                        'active', 'disponible' => [
                            'label' => 'En ligne (Actif)',
                            'bg' => '#EBF8F2',
                            'text' => '#196C45',
                            'border' => '#A3E3C1',
                        ],
                        'loue' => [
                            'label' => 'Loué',
                            'bg' => '#EFF6FF',
                            'text' => '#1E40AF',
                            'border' => '#BFDBFE',
                        ],
                        'vendu' => [
                            'label' => 'Vendu',
                            'bg' => '#FDF2F2',
                            'text' => '#991B1B',
                            'border' => '#FCA5A5',
                        ],
                        default => [
                            'label' => 'Inactif / Négociation',
                            'bg' => '#FFFBEB',
                            'text' => '#92400E',
                            'border' => '#FCD34D',
                        ],
                    };
                    @endphp
                    <span style="
                        padding: 0.25rem 0.75rem;
                        background: {{ $statutBadge['bg'] }};
                        color: {{ $statutBadge['text'] }};
                        border: 1px solid {{ $statutBadge['border'] }};
                        border-radius: 50px;
                        font-size: 0.78rem;
                        font-weight: 700;
                    ">{{ $statutBadge['label'] }}</span>

                    <span style="padding: 0.25rem 0.75rem; background: #F0F3F6; border: 1px solid #DCE1E7; border-radius: 50px; font-size: 0.78rem; font-weight: 700; color: #1B3A5C; text-transform: capitalize;">
                        {{ $bien->type_bien ?? 'Bien' }}
                    </span>

                    @if(($bien->type_offre ?? 'vente') === 'location')
                    <span style="padding: 0.25rem 0.75rem; background: #FFF4EE; border: 1px solid #FFD8C7; border-radius: 50px; font-size: 0.78rem; font-weight: 700; color: #E8734A; text-transform: uppercase;">
                        Location
                    </span>
                    @else
                    <span style="padding: 0.25rem 0.75rem; background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 50px; font-size: 0.78rem; font-weight: 700; color: #1E40AF; text-transform: uppercase;">
                        Vente
                    </span>
                    @endif

                    @if(isset($bien->vues))
                    <span style="font-size: 0.78rem; color: #7C8D9E; font-family: 'JetBrains Mono', monospace; margin-left: 0.5rem;">
                        <i class="bi bi-eye"></i> {{ $bien->vues }} vue(s)
                    </span>
                    @endif
                </div>
            </div>

            {{-- Prix en FCFA --}}
            <div style="text-align: right;">
                <div style="font-size: 0.75rem; text-transform: uppercase; color: #7C8D9E; font-weight: 700;">Prix fixé</div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #1B3A5C; font-family: 'JetBrains Mono', monospace;">
                    {{ number_format($bien->prix, 0, ',', ' ') }} FCFA
                </div>
                @if(($bien->type_offre ?? '') === 'location')
                <div style="font-size: 0.75rem; color: #7C8D9E;">par mois</div>
                @endif
            </div>
        </div>

        {{-- Galerie de photos --}}
        @php
        $photosList = [];
        if (!empty($bien->images) && is_array($bien->images)) {
            $photosList = $bien->images;
        } elseif (isset($bien->photos) && $bien->photos->count() > 0) {
            $photosList = $bien->photos->pluck('photo')->toArray();
        }
        @endphp

        <div style="margin-bottom: 2rem;">
            <div style="font-size: 0.75rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; margin-bottom: 0.75rem; letter-spacing: 0.5px;">
                Photos du bien ({{ count($photosList) }})
            </div>
            @if(count($photosList) > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.85rem;">
                @foreach($photosList as $photo)
                <div style="aspect-ratio: 4/3; border-radius: 10px; overflow: hidden; border: 1px solid #E8ECF0; background: #F8F9FA;">
                    <img src="{{ asset('storage/' . $photo) }}" alt="Photo du bien" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @endforeach
            </div>
            @else
            <div style="
                padding: 3rem 1.5rem; border-radius: 12px; background: #F8F9FA;
                border: 1px dashed #DCE1E7; text-align: center; color: #7C8D9E;
            ">
                <i class="bi bi-camera" style="font-size: 2.2rem; color: #BAC3CD; display: block; margin-bottom: 0.5rem;"></i>
                <div style="font-weight: 600; font-size: 0.9rem;">Aucune photo transmise</div>
                <div style="font-size: 0.8rem;">Ce bien ne dispose pas encore de photographies téléversées.</div>
            </div>
            @endif
        </div>

        {{-- Description --}}
        @if($bien->description)
        <div style="border-top: 1px solid #F0F3F6; padding-top: 1.5rem; margin-bottom: 1.75rem;">
            <div style="font-size: 0.75rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; margin-bottom: 0.6rem; letter-spacing: 0.5px;">Description détaillée</div>
            <p style="color: #222831; line-height: 1.7; font-size: 0.95rem; white-space: pre-line;">{{ $bien->description }}</p>
        </div>
        @endif

        {{-- Caractéristiques techniques & localisation --}}
        <div style="border-top: 1px solid #F0F3F6; padding-top: 1.5rem; margin-bottom: 1.75rem;">
            <div style="font-size: 0.75rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; margin-bottom: 1rem; letter-spacing: 0.5px;">Caractéristiques & Localisation</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 1.25rem;">
                <div style="background: #F8F9FA; padding: 0.85rem 1rem; border-radius: 8px; border: 1px solid #E8ECF0;">
                    <div style="font-size: 0.72rem; text-transform: uppercase; color: #7C8D9E; font-weight: 600; margin-bottom: 0.2rem;">Superficie</div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1B3A5C; font-family: 'JetBrains Mono', monospace;">
                        {{ $bien->superficie ? number_format($bien->superficie, 0, ',', ' ') . ' m²' : '—' }}
                    </div>
                </div>

                <div style="background: #F8F9FA; padding: 0.85rem 1rem; border-radius: 8px; border: 1px solid #E8ECF0;">
                    <div style="font-size: 0.72rem; text-transform: uppercase; color: #7C8D9E; font-weight: 600; margin-bottom: 0.2rem;">Pièces</div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1B3A5C;">{{ $bien->nombre_pieces ?? '—' }}</div>
                </div>

                <div style="background: #F8F9FA; padding: 0.85rem 1rem; border-radius: 8px; border: 1px solid #E8ECF0;">
                    <div style="font-size: 0.72rem; text-transform: uppercase; color: #7C8D9E; font-weight: 600; margin-bottom: 0.2rem;">Chambres</div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1B3A5C;">{{ $bien->nombre_chambres ?? '—' }}</div>
                </div>

                <div style="background: #F8F9FA; padding: 0.85rem 1rem; border-radius: 8px; border: 1px solid #E8ECF0;">
                    <div style="font-size: 0.72rem; text-transform: uppercase; color: #7C8D9E; font-weight: 600; margin-bottom: 0.2rem;">Salles de bain</div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1B3A5C;">{{ $bien->nombre_salles_bain ?? '—' }}</div>
                </div>

                <div style="background: #F8F9FA; padding: 0.85rem 1rem; border-radius: 8px; border: 1px solid #E8ECF0;">
                    <div style="font-size: 0.72rem; text-transform: uppercase; color: #7C8D9E; font-weight: 600; margin-bottom: 0.2rem;">Quartier</div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1B3A5C;">{{ $bien->quartier ?? 'Korhogo' }}</div>
                </div>

                <div style="background: #F8F9FA; padding: 0.85rem 1rem; border-radius: 8px; border: 1px solid #E8ECF0;">
                    <div style="font-size: 0.72rem; text-transform: uppercase; color: #7C8D9E; font-weight: 600; margin-bottom: 0.2rem;">Adresse</div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1B3A5C;">{{ $bien->adresse ?? '—' }}</div>
                </div>
            </div>
        </div>

        {{-- Informations sur le vendeur / auteur --}}
        <div style="border-top: 1px solid #F0F3F6; padding-top: 1.5rem;">
            <div style="font-size: 0.75rem; text-transform: uppercase; color: #5A6B7B; font-weight: 700; margin-bottom: 0.85rem; letter-spacing: 0.5px;">Propriétaire / Auteur de la publication</div>
            <div style="display: flex; align-items: center; gap: 1rem; background: #F8F9FA; padding: 1.25rem; border-radius: 10px; border: 1px solid #E8ECF0;">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #1B3A5C; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 800;">
                    @php
                    $uName = $bien->user->name ?? $bien->proprietaire->nom ?? $bien->agence->nom_agence ?? 'Admin';
                    @endphp
                    {{ strtoupper(substr($uName, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight: 800; font-size: 1rem; color: #1B3A5C;">{{ $uName }}</div>
                    <div style="font-size: 0.82rem; color: #5A6B7B; margin-top: 0.15rem;">
                        @if($bien->user)
                        <span>Rôle : <strong>{{ ucfirst($bien->user->role) }}</strong></span>
                        <span style="color: #BAC3CD;">·</span>
                        <span>Email : <strong>{{ $bien->user->email }}</strong></span>
                        @if($bien->user->agence)
                        <span style="color: #BAC3CD;">·</span>
                        <span>Agence : <strong>{{ $bien->user->agence->nom_agence }}</strong></span>
                        @endif
                        @elseif(isset($bien->agence) && $bien->agence)
                        <span>Agence certifiée : <strong>{{ $bien->agence->nom_agence }}</strong></span>
                        @elseif(isset($bien->proprietaire) && $bien->proprietaire)
                        <span>Propriétaire : <strong>{{ $bien->proprietaire->nom }} {{ $bien->proprietaire->prenom ?? '' }}</strong></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@endsection