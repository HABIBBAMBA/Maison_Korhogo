@if(session('success'))
<div style="
        padding: 1rem 1.5rem;
        background: #d1fae5;
        color: #065f46;
        border-radius: 12px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        border: 1px solid #a7f3d0;
    ">
    <i class="bi bi-check-circle-fill" style="font-size: 1.1rem;"></i>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="
        padding: 1rem 1.5rem;
        background: #fee2e2;
        color: #991b1b;
        border-radius: 12px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        border: 1px solid #fecaca;
    ">
    <i class="bi bi-exclamation-circle-fill" style="font-size: 1.1rem;"></i>
    {{ session('error') }}
</div>
@endif

@if($errors->any())
<div style="
        padding: 1rem 1.5rem;
        background: #fee2e2;
        color: #991b1b;
        border-radius: 12px;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        border: 1px solid #fecaca;
    ">
    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; font-weight: 600;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        Veuillez corriger les erreurs :
    </div>
    <ul style="margin: 0; padding-left: 1.25rem;">
        @foreach($errors->all() as $error)
        <li style="margin-bottom: 0.25rem;">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif