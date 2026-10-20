@extends('layouts.app')

@section('content')
<style>
    /* ═══════════════════════════════════
   DASHBOARD CONTACTS TABLE
   ═══════════════════════════════════ */
    .dashboard-contacts {
        max-width: 1100px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .contacts-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .contacts-table th {
        text-align: left;
        padding: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #6b7280;
    }

    .contacts-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: top;
    }

    .msg-cell {
        max-width: 200px;
    }

    .btn-delete {
        background: none;
        border: 1px solid #ef4444;
        color: #ef4444;
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: #fff;
    }

    .empty-state {
        text-align: center;
        color: #9ca3af;
        padding: 3rem 0;
        font-size: 1.1rem;
    }

    .alert-success {
        background: #ecfdf5;
        color: #065f46;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .alert-error {
        background: #fef2f2;
        color: #991b1b;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .contacts-table {
            font-size: 0.8rem;
        }
    }
</style>
<section class="dashboard-contacts">
    <div class="container">
        <h1>Messages reçus</h1>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($contacts->isEmpty())
        <p class="empty-state">Aucun message reçu pour le moment.</p>
        @else
        <div class="table-wrap">
            <table class="contacts-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Bien</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->nom }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->telephone }}</td>
                        <td>
                            @if($contact->bien)
                            <a href="{{ route('admin.biens.show', $contact->bien->id) }}">
                                {{ $contact->bien->titre ?? '—' }}
                            </a>
                            @else
                            —
                            @endif
                        </td>
                        <td class="msg-cell">{{ Str::limit($contact->message, 80) }}</td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('contacts.destroy', $contact) }}"
                                method="POST"
                                onsubmit="return confirm('Supprimer ce message ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $contacts->links() }}
        @endif
    </div>
</section>
@endsection