@extends('layouts.app')

@section('title', $user->name . ' — Admin')

@section('content')
<section style="max-width: 800px; margin: 0 auto; padding: 3rem 2rem;">

    <a href="{{ route('admin.users.index') }}" style="font-size: 0.85rem; color: #888; text-decoration: none;">
        <i class="bi bi-arrow-left"></i> Retour aux utilisateurs
    </a>

    <div style="
        background: white;
        border-radius: 14px;
        padding: 2.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        margin-top: 1rem;
    ">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1.25rem;">
                <div style="
                    width: 64px; height: 64px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, var(--primary), var(--teal));
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: 700;
                    font-size: 1.5rem;
                ">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.4rem; font-weight: 800;">
                        {{ $user->name }}
                    </h1>
                    <div style="color: #888; font-size: 0.9rem;">{{ $user->email }}</div>
                </div>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary" style="font-size: 0.85rem;">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                @if($user->id !== auth()->id())
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                    onsubmit="return confirm('Supprimer {{ $user->name }} ? Cette action est irréversible.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="font-size: 0.85rem; color: #e53935; border-color: #e53935;">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div style="border-top: 1px solid #f3f4f6; margin-top: 2rem; padding-top: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Rôle</div>
                    @php
                    $roleColors = [
                    'admin' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                    'agence' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                    'proprietaire' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                    'client' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                    ];
                    $colors = $roleColors[$user->role] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                    @endphp
                    <span style="
                        display: inline-block;
                        padding: 0.3rem 0.75rem;
                        background: {{ $colors['bg'] }};
                        color: {{ $colors['text'] }};
                        border-radius: 50px;
                        font-size: 0.85rem;
                        font-weight: 600;
                        text-transform: capitalize;
                    ">{{ $user->role }}</span>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Provider</div>
                    <div style="font-weight: 600; text-transform: capitalize;">
                        {{ $user->auth_provider ?? 'local' }}
                    </div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Inscrit le</div>
                    <div style="font-weight: 600;">{{ $user->created_at->format('d/m/Y à H:i') }}</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; color: #999; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Dernière mise à jour</div>
                    <div style="font-weight: 600;">{{ $user->updated_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection