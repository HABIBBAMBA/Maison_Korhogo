@extends('layouts.app')

@section('title', $agence->nom_agence . ' — Admin')

@section('content')
<section style="max-width: 900px; margin: 0 auto; padding: 3rem 2rem;">

    <a href="{{ route('admin.agences.index') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
        <i class="bi bi-arrow-left"></i> Retour aux agences
    </a>

    <div style="
        background: white; border-radius: 14px; padding: 2.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06); margin-top: 1rem;
    ">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.4rem; font-weight: 800;">
                    {{ $agence->nom_agence }}
                </h1>
                @if($agence->adresse)
                <div style="color: #666; font-size: 0.9rem; margin-top: 0.25rem;">
                    <i class="bi bi-geo-alt" style="color: var(--teal);"></i>
                    {{ $agence->adresse }}
                </div>
                @endif
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('admin.agences.edit', $agence) }}" class="btn btn-primary" style="font-size: 0.85rem;">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <form action="{{ route('admin.agences.destroy', $agence) }}" method="POST"
                    data-confirm="Supprimer « {{ $agence->nom_agence }} » ? Cette opération retirera l'agence et ses accès."
                    data-confirm-title="Supprimer l'agence"
                    data-confirm-btn="Supprimer définitivement"
                    data-confirm-warning="Cette action est irréversible.">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="font-size: 0.85rem; color: #e53935; border-color: #e53935;">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>

        <div style="border-top: 1px solid #f3f4f6; padding-top: 1.5rem; margin-bottom: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Responsable</div>
                    <div style="font-weight: 600;">{{ $agence->nom_responsable }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Téléphone</div>
                    <div style="font-weight: 600;">{{ $agence->telephone ?? '—' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Adresse</div>
                    <div style="font-weight: 600;">{{ $agence->adresse ?? '—' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; margin-bottom: 0.25rem;">Biens</div>
                    <div style="font-weight: 600;">{{ $agence->biens->count() }}</div>
                </div>
            </div>
        </div>

        {{-- Biens de l'agence --}}
        <div style="border-top: 1px solid #f3f4f6; padding-top: 1.5rem;">
            <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">
                Biens de cette agence
            </h3>
            @forelse($agence->biens as $bien)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f9fafb;">
                <div>
                    <div style="font-weight: 600;">{{ $bien->titre }}</div>
                    <div style="font-size: 0.85rem; color: #888;">{{ number_format($bien->prix, 0, ',', ' ') }} FCFA</div>
                </div>
                <a href="{{ route('admin.biens.show', $bien) }}" style="font-size: 0.85rem; color: var(--teal); text-decoration: none;">
                    Voir <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @empty
            <p style="color: #999; padding: 1rem 0;">Aucun bien associé à cette agence.</p>
            @endforelse
        </div>
    </div>

</section>
@endsection
