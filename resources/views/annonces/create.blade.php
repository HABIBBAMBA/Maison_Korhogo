<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Publier un bien — ImmoPro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.0.3"></script>

    <style>
        :root {
            /* 5 Couleurs Officielles ImmoPro */
            --color-bg-main: #F8F9FA;
            --color-primary: #1B3A5C;
            --color-secondary: #5A6B7B;
            --color-cta: #E8734A;
            --color-cta-hover: #D55F35;
            --color-text-main: #222831;

            --surface-card: #FFFFFF;
            --surface-sunken: #F8F9FA;
            --surface-hover: #F1F4F7;
            --border-subtle: #E8ECF0;
            --border-default: #DCE1E7;
            --border-strong: #BAC3CD;

            --error: #DC2626;
            --error-bg: #FEF2F2;
            --error-border: #FCA5A5;
            --success: #16A34A;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-full: 9999px;

            --shadow-sm: 0 1px 3px rgba(27, 58, 92, 0.05);
            --shadow-md: 0 4px 12px rgba(27, 58, 92, 0.08);
            --shadow-lg: 0 10px 30px rgba(27, 58, 92, 0.12);

            --ease: cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg-main);
            color: var(--color-text-main);
            min-height: 100vh;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* ═══════ NAVBAR ═══════ */
        .navbar {
            background-color: var(--color-primary);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-inner {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0.85rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: #FFFFFF;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }

        .brand-link .logo-mark {
            width: 34px;
            height: 34px;
            background-color: var(--color-cta);
            color: #FFFFFF;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        .brand-link .logo-text span {
            color: var(--color-cta);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.5rem 0.95rem;
            border-radius: var(--radius-full);
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.85);
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: all 0.2s var(--ease);
        }

        .nav-btn:hover {
            background-color: rgba(255, 255, 255, 0.16);
            color: #FFFFFF;
        }

        /* ═══════ HERO BANNER ═══════ */
        .page-hero {
            background-color: var(--color-primary);
            color: #FFFFFF;
            padding: 2.5rem 1.5rem 3.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .page-hero-inner {
            max-width: 860px;
            margin: 0 auto;
        }

        .page-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--color-cta);
            margin-bottom: 0.5rem;
            background-color: rgba(232, 115, 74, 0.15);
            padding: 0.25rem 0.65rem;
            border-radius: var(--radius-full);
        }

        .page-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.35rem);
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.25;
            margin-bottom: 0.5rem;
        }

        .page-hero p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            max-width: 620px;
        }

        /* ═══════ MAIN FORM CONTAINER ═══════ */
        .form-wrapper {
            max-width: 860px;
            margin: -2rem auto 4rem;
            padding: 0 1.5rem;
        }

        .form-card {
            background-color: var(--surface-card);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-lg);
            padding: 1.75rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .form-card-title {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 1.35rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-subtle);
        }

        .form-card-title i {
            font-size: 1.25rem;
            color: var(--color-cta);
        }

        /* ═══════ ALERTES ═══════ */
        .alert-error {
            background-color: var(--error-bg);
            border: 1px solid var(--error-border);
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            color: var(--error);
        }

        .alert-error strong {
            display: block;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .alert-error ul {
            padding-left: 1.2rem;
            font-size: 0.85rem;
        }

        /* ═══════ TOGGLE OFFRE (Location / Court séjour / Vente) ═══════ */
        .offre-segmented {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            background-color: var(--surface-sunken);
            padding: 0.35rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-default);
            margin-bottom: 1.5rem;
        }

        @media (max-width: 720px) {
            .offre-segmented {
                grid-template-columns: 1fr;
            }
        }

        .offre-segmented input[type="radio"] {
            display: none;
        }

        .offre-segmented label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--color-secondary);
            cursor: pointer;
            transition: all 0.2s var(--ease);
            user-select: none;
        }

        .offre-segmented input[type="radio"]:checked + label {
            background-color: var(--color-primary);
            color: #FFFFFF;
            box-shadow: var(--shadow-sm);
        }

        /* ═══════ GRILLE DE SÉLECTION DU TYPE DE BIEN ═══════ */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }

        @media (max-width: 640px) {
            .type-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .type-tile input[type="radio"] {
            display: none;
        }

        .type-tile label {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
            background-color: var(--surface-card);
            border: 1.5px solid var(--border-default);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.2s var(--ease);
            height: 100%;
        }

        .type-tile label:hover {
            border-color: var(--color-secondary);
            background-color: var(--surface-hover);
        }

        .type-tile input[type="radio"]:checked + label {
            border-color: var(--color-primary);
            background-color: var(--surface-sunken);
            box-shadow: 0 0 0 2px var(--color-primary);
        }

        .type-tile .tile-icon {
            font-size: 1.4rem;
            color: var(--color-primary);
            margin-bottom: 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(27, 58, 92, 0.08);
            border-radius: var(--radius-sm);
        }

        .type-tile input[type="radio"]:checked + label .tile-icon {
            background-color: var(--color-primary);
            color: #FFFFFF;
        }

        .type-tile .tile-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--color-text-main);
            margin-bottom: 0.15rem;
        }

        .type-tile .tile-desc {
            font-size: 0.75rem;
            color: var(--color-secondary);
            line-height: 1.35;
        }

        /* ═══════ CHAMPS DU FORMULAIRE ═══════ */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }

        .form-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        @media (max-width: 800px) {
            .form-grid-4 {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .form-grid-2, .form-grid-3, .form-grid-4 {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-text-main);
            margin-bottom: 0.4rem;
        }

        .form-label .req {
            color: var(--error);
            font-weight: 700;
            margin-left: 2px;
        }

        .form-label .hint {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--color-secondary);
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 0.75rem 0.95rem;
            font-family: inherit;
            font-size: 0.92rem;
            color: var(--color-text-main);
            background-color: var(--surface-card);
            border: 1.5px solid var(--border-default);
            border-radius: var(--radius-sm);
            outline: none;
            transition: all 0.2s var(--ease);
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(27, 58, 92, 0.12);
        }

        .form-input.is-invalid, .form-textarea.is-invalid {
            border-color: var(--error);
            background-color: var(--error-bg);
        }

        .field-error {
            display: block;
            margin-top: 0.35rem;
            font-size: 0.78rem;
            color: var(--error);
            font-weight: 600;
        }

        .input-with-affix {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-affix .affix {
            position: absolute;
            right: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--color-secondary);
            background-color: var(--surface-sunken);
            border: 1px solid var(--border-default);
            padding: 0.2rem 0.5rem;
            border-radius: var(--radius-sm);
            pointer-events: none;
        }

        .form-textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        .char-counter {
            text-align: right;
            font-size: 0.75rem;
            color: var(--color-secondary);
            margin-top: 0.3rem;
        }

        /* ═══════ ÉQUIPEMENTS & COMMODITÉS ADAPTATIFS ═══════ */
        .equip-wrapper {
            background-color: var(--surface-sunken);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            padding: 1.25rem;
        }

        .equip-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .equip-badge-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.76rem;
            font-weight: 700;
            background-color: var(--color-primary);
            color: #FFFFFF;
            padding: 0.25rem 0.65rem;
            border-radius: var(--radius-full);
            letter-spacing: 0.02em;
        }

        .equip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 0.6rem;
        }

        .equip-item {
            display: block;
            cursor: pointer;
            user-select: none;
        }

        .equip-item input[type="checkbox"] {
            display: none;
        }

        .equip-box {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 0.85rem;
            background-color: var(--surface-card);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-sm);
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--color-text-main);
            transition: all 0.15s var(--ease);
        }

        .equip-box i {
            font-size: 1.1rem;
            color: var(--color-secondary);
            transition: color 0.15s;
        }

        .equip-item input[type="checkbox"]:checked + .equip-box {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: #FFFFFF;
        }

        .equip-item input[type="checkbox"]:checked + .equip-box i {
            color: var(--color-cta);
        }

        .empty-pieces-notice {
            padding: 1.25rem;
            background-color: var(--surface-sunken);
            border: 1px dashed var(--border-default);
            border-radius: var(--radius-md);
            text-align: center;
            color: var(--color-secondary);
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* ═══════ ZONE UPLOAD PHOTOS ═══════ */
        .upload-dropzone {
            border: 2px dashed var(--border-strong);
            background-color: var(--surface-sunken);
            border-radius: var(--radius-md);
            padding: 2.25rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s var(--ease);
            position: relative;
        }

        .upload-dropzone:hover, .upload-dropzone.dragover {
            border-color: var(--color-cta);
            background-color: rgba(232, 115, 74, 0.04);
        }

        .upload-dropzone input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-dropzone .upload-icon {
            width: 52px;
            height: 52px;
            background-color: var(--surface-card);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-full);
            color: var(--color-cta);
            font-size: 1.6rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
        }

        .upload-dropzone h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--color-text-main);
            margin-bottom: 0.2rem;
        }

        .upload-dropzone p {
            font-size: 0.78rem;
            color: var(--color-secondary);
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .preview-card {
            position: relative;
            aspect-ratio: 4/3;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--border-default);
            background-color: var(--surface-sunken);
            box-shadow: var(--shadow-sm);
        }

        .preview-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-card .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 24px;
            height: 24px;
            background-color: rgba(34, 40, 49, 0.85);
            color: #FFFFFF;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background-color 0.15s;
        }

        .preview-card .remove-btn:hover {
            background-color: var(--error);
        }

        .preview-size-badge {
            position: absolute;
            bottom: 4px;
            left: 4px;
            background-color: rgba(27, 58, 92, 0.88);
            color: #FFFFFF;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.15rem 0.45rem;
            border-radius: var(--radius-sm);
            font-family: 'JetBrains Mono', monospace;
            pointer-events: none;
            letter-spacing: 0.02em;
        }

        /* ═══════ ACTIONS DU FORMULAIRE ═══════ */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-subtle);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.85rem 1.6rem;
            background-color: var(--surface-card);
            border: 1.5px solid var(--border-default);
            border-radius: var(--radius-full);
            color: var(--color-secondary);
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s var(--ease);
        }

        .btn-cancel:hover {
            border-color: var(--border-strong);
            color: var(--color-text-main);
            background-color: var(--surface-hover);
        }

        .btn-publish {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.9rem 2.25rem;
            background-color: var(--color-cta);
            border: 1px solid var(--color-cta);
            border-radius: var(--radius-full);
            color: #FFFFFF;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(232, 115, 74, 0.28);
            transition: all 0.2s var(--ease);
        }

        .btn-publish:hover {
            background-color: var(--color-cta-hover);
            border-color: var(--color-cta-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(232, 115, 74, 0.38);
        }

        .btn-publish:active {
            transform: translateY(1px);
        }

        .btn-publish i {
            font-size: 1.15rem;
        }
    </style>
</head>

<body>

    <!-- ═══════ NAVBAR ═══════ -->
    <header class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="brand-link">
                <span class="logo-mark"><i class="ph ph-buildings"></i></span>
                <span class="logo-text">Immo<span>Pro</span></span>
            </a>
            <nav class="nav-actions">
                <a href="{{ route('dashboard') }}" class="nav-btn">
                    <i class="ph ph-squares-four"></i> Tableau de bord
                </a>
                <a href="{{ route('annonces.mes-annonces') }}" class="nav-btn">
                    <i class="ph ph-list-dashes"></i> Mes annonces
                </a>
            </nav>
        </div>
    </header>

    <!-- ═══════ EN-TÊTE DE PAGE ═══════ -->
    <section class="page-hero">
        <div class="page-hero-inner">
            <span class="page-hero-eyebrow">
                <i class="ph ph-sparkle"></i> Publication Immobilière
            </span>
            <h1>Déposer une annonce</h1>
            <p>Formulaire optimisé : renseignez l'essentiel en quelques instants pour mettre votre bien en ligne à Korhogo et en Côte d'Ivoire.</p>
        </div>
    </section>

    <!-- ═══════ FORMULAIRE SIMPLIFIÉ ═══════ -->
    <main class="form-wrapper">

        @if($errors->any())
        <div class="alert-error" role="alert">
            <strong><i class="ph ph-warning-circle"></i> Veuillez corriger les informations suivantes :</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('annonces.store') }}" enctype="multipart/form-data" id="annonceForm">
            @csrf

            <!-- ── 1. TYPE D'OFFRE & TYPE DE BIEN ── -->
            <div class="form-card">
                <h3 class="form-card-title">
                    <i class="ph ph-tag"></i> 1. Destination et type de bien
                </h3>

                <!-- Segmented Toggle Offre -->
                <div class="offre-segmented" role="radiogroup" aria-label="Type d'offre">
                    <input type="radio" name="type_offre" id="offre_location" value="location" {{ old('type_offre', 'location') === 'location' ? 'checked' : '' }}>
                    <label for="offre_location">
                        <i class="ph ph-key"></i> À Louer (Bail)
                    </label>

                    <input type="radio" name="type_offre" id="offre_court_sejour" value="court_sejour" {{ old('type_offre') === 'court_sejour' ? 'checked' : '' }}>
                    <label for="offre_court_sejour">
                        <i class="ph ph-moon"></i> Court séjour (Résidence / Hôtel / Nuitée)
                    </label>

                    <input type="radio" name="type_offre" id="offre_vente" value="vente" {{ old('type_offre') === 'vente' ? 'checked' : '' }}>
                    <label for="offre_vente">
                        <i class="ph ph-house-line"></i> À Vendre (Vente)
                    </label>
                </div>

                <!-- Types de biens épurés selon la destination -->
                <label class="form-label" style="margin-bottom: 0.35rem;">
                    Sélectionnez la catégorie du bien <span class="req">*</span>
                </label>
                <p id="typeCategoryHint" class="hint" style="margin-bottom: 0.85rem; font-size: 0.82rem; color: var(--color-secondary);">
                    Catégories adaptées à votre type d'offre
                </p>

                <div class="type-grid">
                    @php
                    $typesDisponibles = [
                        'residence_meublee' => [
                            'icon' => 'ph-buildings',
                            'title' => 'Résidence Meublée',
                            'desc' => 'Villas meublées, appartements équipés, studios, nuitées',
                            'offres' => ['court_sejour', 'location']
                        ],
                        'chambre_hotel' => [
                            'icon' => 'ph-bed',
                            'title' => 'Chambre d\'Hôtel',
                            'desc' => 'Hôtels, suites, auberges, chambres de passage',
                            'offres' => ['court_sejour']
                        ],
                        'maison' => [
                            'icon' => 'ph-house-line',
                            'title' => 'Maison / Villa',
                            'desc' => 'Villas, appartements vides, duplex, concessions',
                            'offres' => ['location', 'vente']
                        ],
                        'terrain' => [
                            'icon' => 'ph-map-trifold',
                            'title' => 'Terrain',
                            'desc' => 'Parcelles, lotissements, surfaces à bâtir',
                            'offres' => ['location', 'vente']
                        ],
                        'bureau' => [
                            'icon' => 'ph-briefcase',
                            'title' => 'Bureau',
                            'desc' => 'Bureaux, open spaces, locaux professionnels',
                            'offres' => ['location', 'vente']
                        ],
                        'magasin' => [
                            'icon' => 'ph-storefront',
                            'title' => 'Magasin',
                            'desc' => 'Boutiques, points de vente, commerces',
                            'offres' => ['location', 'vente']
                        ],
                        'entrepot' => [
                            'icon' => 'ph-warehouse',
                            'title' => 'Entrepôt',
                            'desc' => 'Hangars, stockage, logistique, ateliers',
                            'offres' => ['location', 'vente']
                        ],
                        'autre' => [
                            'icon' => 'ph-dots-three',
                            'title' => 'Autre',
                            'desc' => 'Tout autre type d\'espace immobilier',
                            'offres' => ['location', 'vente']
                        ],
                    ];
                    $selectedType = old('type_bien', old('type_offre') === 'court_sejour' ? 'residence_meublee' : 'maison');
                    @endphp

                    @foreach($typesDisponibles as $key => $info)
                    <div class="type-tile" data-type="{{ $key }}" data-offres="{{ implode(',', $info['offres']) }}">
                        <input type="radio" name="type_bien" id="type_{{ $key }}" value="{{ $key }}" {{ $selectedType === $key ? 'checked' : '' }}>
                        <label for="type_{{ $key }}">
                            <span class="tile-icon"><i class="ph {{ $info['icon'] }}"></i></span>
                            <span class="tile-name">{{ $info['title'] }}</span>
                            <span class="tile-desc">{{ $info['desc'] }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('type_bien')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- ── 2. INFORMATIONS PRINCIPALES & PRIX ── -->
            <div class="form-card">
                <h3 class="form-card-title">
                    <i class="ph ph-info"></i> 2. Informations générales & Prix
                </h3>

                <div class="form-group">
                    <label for="titre" class="form-label">
                        <span>Titre de l'annonce <span class="req">*</span></span>
                        <span class="hint">Clair et descriptif</span>
                    </label>
                    <input type="text" name="titre" id="titre" class="form-input @error('titre') is-invalid @enderror"
                        placeholder="Ex : Belle villa 4 pièces avec cour à Korhogo Soba"
                        value="{{ old('titre') }}" required maxlength="255">
                    @error('titre')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="prix" class="form-label">
                            <span>Prix demandé <span class="req">*</span></span>
                            <span class="hint" id="prixHint">Montant en FCFA</span>
                        </label>
                        <div class="input-with-affix">
                            <input type="number" name="prix" id="prix" class="form-input @error('prix') is-invalid @enderror"
                                placeholder="Ex : 250000" value="{{ old('prix') }}" min="0" required>
                            <span class="affix">FCFA</span>
                        </div>
                        @error('prix')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_disponibilite" class="form-label">
                            <span>Date de disponibilité <span class="req">*</span></span>
                            <span class="hint">Immédiate ou future</span>
                        </label>
                        <input type="date" name="date_disponibilite" id="date_disponibilite"
                            class="form-input @error('date_disponibilite') is-invalid @enderror"
                            value="{{ old('date_disponibilite', date('Y-m-d')) }}" required>
                        @error('date_disponibilite')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">
                        <span>Description complète <span class="req">*</span></span>
                        <span class="hint">Minimum 20 caractères</span>
                    </label>
                    <textarea name="description" id="description" class="form-textarea @error('description') is-invalid @enderror"
                        placeholder="Décrivez les atouts majeurs du bien, l'environnement, l'accès, l'état général..."
                        required>{{ old('description') }}</textarea>
                    <div class="char-counter"><span id="descCount">0</span> / 2 000 caractères</div>
                    @error('description')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- ── 3. SUPERFICIE & CARACTÉRISTIQUES ADAPTATIVES ── -->
            <div class="form-card">
                <h3 class="form-card-title">
                    <i class="ph ph-ruler"></i> 3. Superficie & Dimensions
                </h3>

                <div class="form-grid-2" style="margin-bottom: 1.25rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="superficie" class="form-label">
                            <span>Superficie totale <span class="req">*</span></span>
                            <span class="hint">Surface utile ou terrain</span>
                        </label>
                        <div class="input-with-affix">
                            <input type="number" name="superficie" id="superficie" class="form-input @error('superficie') is-invalid @enderror"
                                placeholder="Ex : 250" value="{{ old('superficie') }}" min="1" step="0.1" required>
                            <span class="affix">m²</span>
                        </div>
                        @error('superficie')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: flex-end;">
                        <span style="font-size: 0.8rem; color: var(--color-secondary); line-height: 1.4;">
                            <i class="ph ph-check-circle" style="color: var(--success);"></i> Indiquez la surface certifiée au plan ou mesurée sur le terrain.
                        </span>
                    </div>
                </div>

                <!-- Pièces contextuelles : s'affiche pour Maison / Locaux, masqué pour Terrain -->
                <div id="piecesContainer">
                    <!-- Pour Maison / Résidence / Chambre -->
                    <div id="groupMaisonPieces" class="form-grid-4">
                        <div class="form-group">
                            <label for="nombre_pieces" class="form-label">Nombre de pièces</label>
                            <input type="number" name="nombre_pieces" id="nombre_pieces" class="form-input"
                                placeholder="Ex : 4" value="{{ old('nombre_pieces') }}" min="1">
                        </div>
                        <div class="form-group">
                            <label for="nombre_chambres" class="form-label">Chambres</label>
                            <input type="number" name="nombre_chambres" id="nombre_chambres" class="form-input"
                                placeholder="Ex : 3" value="{{ old('nombre_chambres') }}" min="0">
                        </div>
                        <div class="form-group">
                            <label for="nombre_salles_bain" class="form-label">Salles d'eau / bain</label>
                            <input type="number" name="nombre_salles_bain" id="nombre_salles_bain" class="form-input"
                                placeholder="Ex : 2" value="{{ old('nombre_salles_bain') }}" min="0">
                        </div>
                        <div class="form-group">
                            <label for="capacite_voyageurs" class="form-label">Personne max</label>
                            <input type="number" name="capacite_voyageurs" id="capacite_voyageurs" class="form-input"
                                placeholder="Ex : 2" value="{{ old('capacite_voyageurs') }}" min="1">
                        </div>
                    </div>

                    <!-- Pour Bureau / Magasin / Entrepôt -->
                    <div id="groupProPieces" class="form-grid-2" style="display: none;">
                        <div class="form-group">
                            <label for="nombre_pieces_pro" class="form-label">Nombre de bureaux / espaces</label>
                            <input type="number" id="nombre_pieces_pro" class="form-input"
                                placeholder="Ex : 3 bureaux séparés" min="1">
                        </div>
                        <div class="form-group">
                            <label for="nombre_salles_bain_pro" class="form-label">Sanitaires / Toilettes</label>
                            <input type="number" id="nombre_salles_bain_pro" class="form-input"
                                placeholder="Ex : 1" min="0">
                        </div>
                    </div>

                    <!-- Pour Terrain -->
                    <div id="noticeTerrain" class="empty-pieces-notice" style="display: none;">
                        <i class="ph ph-info"></i>
                        <span>Aucune pièce ou chambre applicable pour une parcelle de terrain.</span>
                    </div>
                </div>
            </div>

            <!-- ── 4. LOCALISATION ── -->
            <div class="form-card">
                <h3 class="form-card-title">
                    <i class="ph ph-map-pin"></i> 4. Localisation du bien
                </h3>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="quartier" class="form-label">
                            <span>Quartier <span class="req">*</span></span>
                            <span class="hint">Sélectionnez ou tapez</span>
                        </label>
                        <input type="text" name="quartier" id="quartier" list="quartiersList" class="form-input @error('quartier') is-invalid @enderror"
                            placeholder="Ex : Soba, Koko, Sinistré, Belle-Ville..."
                            value="{{ old('quartier') }}" required maxlength="255">
                        <datalist id="quartiersList">
                            <option value="Koko"></option>
                            <option value="Soba"></option>
                            <option value="Sinistré"></option>
                            <option value="Belle-Ville"></option>
                            <option value="Petit Paris"></option>
                            <option value="Haoussabougou"></option>
                            <option value="Koko Résidentiel"></option>
                            <option value="Résidentiel 14"></option>
                            <option value="Zone Industrielle"></option>
                            <option value="Téngréla"></option>
                            <option value="Natio-Kobadara"></option>
                            <option value="Air France"></option>
                        </datalist>
                        @error('quartier')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="adresse" class="form-label">
                            <span>Adresse ou repère précis <span class="req">*</span></span>
                            <span class="hint">Facilite la visite</span>
                        </label>
                        <input type="text" name="adresse" id="adresse" class="form-input @error('adresse') is-invalid @enderror"
                            placeholder="Ex : À 100m du grand marché, face à la pharmacie"
                            value="{{ old('adresse') }}" required maxlength="255">
                        @error('adresse')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ── 5. COMMODITÉS & ÉQUIPEMENTS ADAPTATIFS SELON LE TYPE ── -->
            <div class="form-card">
                <h3 class="form-card-title">
                    <i class="ph ph-check-square-offset"></i> 5. Commodités & Équipements
                </h3>

                <div class="equip-wrapper">
                    <div class="equip-header">
                        <span style="font-size: 0.85rem; font-weight: 700; color: var(--color-primary);">
                            Cochez les points forts du bien :
                        </span>
                        <span class="equip-badge-indicator" id="equipBadge">
                            <i class="ph ph-house"></i> Équipements Maison
                        </span>
                    </div>

                    @php
                    $equipementsCatalogue = [
                        'residence_meublee' => [
                            ['wifi', 'ph-wifi-high', 'Internet / WiFi Haut Débit'],
                            ['climatisation', 'ph-snowflake', 'Climatisation intégrale'],
                            ['canal_plus', 'ph-television', 'TV Écran Plat / Canal+'],
                            ['groupe_electrogene', 'ph-lightning', 'Groupe électrogène 24/7'],
                            ['petit_dejeuner', 'ph-coffee', 'Petit-déjeuner inclus / disponible'],
                            ['service_menage', 'ph-broom', 'Ménage quotidien'],
                            ['cuisine_equipee', 'ph-fork-knife', 'Cuisine équipée & ustensiles'],
                            ['refrigerateur', 'ph-refrigerator', 'Réfrigérateur / Minibar'],
                            ['chauffe_eau', 'ph-thermometer-hot', 'Chauffe-eau / Eau chaude'],
                            ['piscine', 'ph-swimming-pool', 'Piscine'],
                            ['parking_securise', 'ph-car', 'Parking fermé & sécurisé'],
                            ['gardien_24_7', 'ph-shield-check', 'Sécurité & Gardien 24h/24'],
                        ],
                        'chambre_hotel' => [
                            ['climatisation', 'ph-snowflake', 'Climatisation'],
                            ['wifi', 'ph-wifi-high', 'WiFi gratuit'],
                            ['canal_plus', 'ph-television', 'Télévision / Canal+'],
                            ['groupe_electrogene', 'ph-lightning', 'Groupe électrogène 24/7'],
                            ['petit_dejeuner', 'ph-coffee', 'Petit-déjeuner inclus'],
                            ['service_menage', 'ph-broom', 'Service de chambre / Ménage'],
                            ['chauffe_eau', 'ph-thermometer-hot', 'Eau chaude'],
                            ['refrigerateur', 'ph-refrigerator', 'Minibar / Frigo'],
                            ['repassage', 'ph-t-shirt', 'Blanchisserie / Repassage'],
                            ['gardien_24_7', 'ph-shield-check', 'Réception & Gardien 24h/24'],
                            ['parking_securise', 'ph-car', 'Parking gardé'],
                        ],
                        'maison' => [
                            ['cuisine_equipee', 'ph-fork-knife', 'Cuisine équipée'],
                            ['climatisation', 'ph-snowflake', 'Climatisation'],
                            ['chauffe_eau', 'ph-thermometer-hot', 'Chauffe-eau'],
                            ['piscine', 'ph-swimming-pool', 'Piscine'],
                            ['jardin', 'ph-tree', 'Jardin / Cour privée'],
                            ['terrasse', 'ph-sun-dim', 'Terrasse / Balcon'],
                            ['garage', 'ph-car', 'Garage / Parking privé'],
                            ['meuble', 'ph-armchair', 'Meublé'],
                            ['gardien', 'ph-shield-check', 'Gardiennage / Sécurité'],
                            ['groupe_electrogene', 'ph-lightning', 'Groupe électrogène'],
                            ['reservoir_eau', 'ph-drop', 'Réservoir d\'eau / Suppresseur'],
                            ['internet', 'ph-wifi-high', 'Internet / WiFi'],
                            ['dressing', 'ph-t-shirt', 'Dressing'],
                            ['buanderie', 'ph-washing-machine', 'Buanderie'],
                        ],
                        'terrain' => [
                            ['titre_foncier', 'ph-certificate', 'Titre Foncier / ACD'],
                            ['borne', 'ph-compass', 'Terrain borné (Plan de bornage)'],
                            ['eau_sodeci', 'ph-drop', 'Viabilisé en eau (SODECI)'],
                            ['electricite_cie', 'ph-lightning', 'Électrifié (CIE)'],
                            ['cloture', 'ph-wall', 'Terrain clôturé'],
                            ['acces_goudron', 'ph-road-horizon', 'Accès voie bitumée'],
                            ['terrain_plat', 'ph-ruler', 'Terrain plat / Décapé'],
                            ['proche_voie_principale', 'ph-navigation-arrow', 'Proche route principale'],
                        ],
                        'bureau' => [
                            ['climatisation', 'ph-snowflake', 'Climatisation'],
                            ['internet', 'ph-wifi-high', 'Fibre optique / Câblage RJ45'],
                            ['salle_reunion', 'ph-presentation', 'Salle de réunion'],
                            ['parking', 'ph-car', 'Parking réservé'],
                            ['groupe_electrogene', 'ph-lightning', 'Groupe électrogène'],
                            ['controle_acces', 'ph-identification-card', 'Contrôle d\'accès / Badge'],
                            ['gardien', 'ph-shield-check', 'Gardiennage 24/7'],
                            ['sanitaires', 'ph-toilet', 'Sanitaires privatifs'],
                            ['ascenseur', 'ph-arrow-fat-lines-up', 'Ascenseur'],
                        ],
                        'magasin' => [
                            ['vitrine', 'ph-storefront', 'Vitrine sur rue passante'],
                            ['rideau_metallique', 'ph-shield-check', 'Rideau métallique électrique'],
                            ['climatisation', 'ph-snowflake', 'Climatisation'],
                            ['compteur_dedie', 'ph-lightning', 'Compteur électrique dédié'],
                            ['point_eau', 'ph-drop', 'Point d\'eau / Sanitaires'],
                            ['reserve', 'ph-archive', 'Arrière-boutique / Réserve'],
                            ['parking', 'ph-car', 'Parking clients facile'],
                            ['videosurveillance', 'ph-video-camera', 'Alarme / Vidéosurveillance'],
                        ],
                        'entrepot' => [
                            ['quai_chargement', 'ph-truck', 'Quai de chargement'],
                            ['acces_poids_lourds', 'ph-arrows-horizontal', 'Accès gros porteurs / Poids lourds'],
                            ['hauteur_plafond', 'ph-arrows-vertical', 'Hauteur sous plafond (> 5m)'],
                            ['sol_renforce', 'ph-stack', 'Dalle béton renforcée'],
                            ['triphase', 'ph-lightning', 'Compteur triphasé / Haute tension'],
                            ['bureau_integre', 'ph-briefcase', 'Bureaux d\'exploitation intégrés'],
                            ['poste_garde', 'ph-shield-check', 'Poste de garde / Guérite'],
                            ['securite_incendie', 'ph-fire', 'Système anti-incendie / RIA'],
                        ],
                        'autre' => [
                            ['eau', 'ph-drop', 'Eau courante'],
                            ['electricite', 'ph-lightning', 'Électricité'],
                            ['acces_facile', 'ph-road-horizon', 'Accès facile'],
                            ['cloture', 'ph-wall', 'Clôturé'],
                            ['gardien', 'ph-shield-check', 'Gardien / Sécurisé'],
                            ['parking', 'ph-car', 'Parking'],
                        ],
                    ];
                    $oldEquipements = old('equipements', []);
                    @endphp

                    @foreach($equipementsCatalogue as $typeKey => $items)
                    <div class="equip-group-panel" id="equip_panel_{{ $typeKey }}" style="{{ $selectedType === $typeKey ? '' : 'display: none;' }}">
                        <div class="equip-grid">
                            @foreach($items as [$keyVal, $iconPh, $labelVal])
                            <label class="equip-item">
                                <input type="checkbox" name="equipements[]" value="{{ $keyVal }}"
                                    {{ in_array($keyVal, $oldEquipements) ? 'checked' : '' }}>
                                <span class="equip-box">
                                    <i class="ph {{ $iconPh }}"></i>
                                    <span>{{ $labelVal }}</span>
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- ── 6. PHOTOS DU BIEN ── -->
            <div class="form-card">
                <h3 class="form-card-title">
                    <i class="ph ph-camera"></i> 6. Photos du bien
                </h3>

                <div class="upload-dropzone" id="uploadZone">
                    <input type="file" name="images[]" id="imageInput" multiple accept="image/*">
                    <div class="upload-icon">
                        <i class="ph ph-cloud-arrow-up"></i>
                    </div>
                    <h4>Glissez vos photos ici ou cliquez pour parcourir</h4>
                    <p>Formats JPG, PNG ou WEBP — Jusqu'à 10 photos (10 Mo max par photo)</p>
                </div>

                <div class="preview-grid" id="previewGrid"></div>
                @error('images')
                <span class="field-error">{{ $message }}</span>
                @enderror
                @error('images.*')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- ── ACTIONS FINALES ── -->
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-cancel">
                    <i class="ph ph-arrow-left"></i> Annuler
                </a>
                <button type="submit" class="btn-publish" id="submitBtn">
                    <i class="ph ph-paper-plane-tilt"></i> Publier mon annonce
                </button>
            </div>
        </form>
    </main>

    <!-- ═══════ SCRIPTS D'INTERACTION ═══════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── 1. Compteur de caractères description ──
            const desc = document.getElementById('description');
            const counter = document.getElementById('descCount');
            if (desc && counter) {
                counter.textContent = desc.value.length;
                desc.addEventListener('input', () => counter.textContent = desc.value.length);
            }

            // ── 1.b. Gestion du type d'offre & filtrage dynamique des types de biens ──
            const offreRadios = document.querySelectorAll('input[name="type_offre"]');
            const prixHint = document.getElementById('prixHint');
            const prixAffix = document.querySelector('.input-with-affix .affix');
            const typeCategoryHint = document.getElementById('typeCategoryHint');

            function handleOffreChange() {
                const checkedOffre = document.querySelector('input[name="type_offre"]:checked');
                if (!checkedOffre) return;
                const offreVal = checkedOffre.value;

                // 1. Textes d'aide du prix & indications
                if (offreVal === 'court_sejour') {
                    if (prixHint) prixHint.textContent = 'Tarif par nuitée en FCFA';
                    if (prixAffix) prixAffix.textContent = 'FCFA / nuit';
                    if (typeCategoryHint) typeCategoryHint.textContent = 'Hébergements disponibles pour court séjour (Résidences meublées & Chambres d\'hôtel) :';
                } else if (offreVal === 'location') {
                    if (prixHint) prixHint.textContent = 'Loyer mensuel en FCFA';
                    if (prixAffix) prixAffix.textContent = 'FCFA / mois';
                    if (typeCategoryHint) typeCategoryHint.textContent = 'Catégories de biens disponibles à la location (bail mensuel) :';
                } else {
                    if (prixHint) prixHint.textContent = 'Prix de vente total en FCFA';
                    if (prixAffix) prixAffix.textContent = 'FCFA';
                    if (typeCategoryHint) typeCategoryHint.textContent = 'Catégories de biens disponibles à la vente :';
                }

                // 2. Filtrage dynamique strict des tuiles selon l'offre
                const typeTiles = document.querySelectorAll('.type-tile');
                let firstVisibleRadio = null;
                let currentCheckedIsVisible = false;

                typeTiles.forEach(tile => {
                    const offresStr = tile.getAttribute('data-offres') || '';
                    const allowedOffres = offresStr.split(',').map(s => s.trim());
                    const radio = tile.querySelector('input[name="type_bien"]');

                    if (allowedOffres.includes(offreVal)) {
                        tile.style.display = '';
                        tile.setAttribute('aria-hidden', 'false');
                        if (!firstVisibleRadio) {
                            firstVisibleRadio = radio;
                        }
                        if (radio && radio.checked) {
                            currentCheckedIsVisible = true;
                        }
                    } else {
                        tile.style.display = 'none';
                        tile.setAttribute('aria-hidden', 'true');
                        if (radio && radio.checked) {
                            radio.checked = false;
                        }
                    }
                });

                // 3. Si le type précédemment coché est désormais masqué, sélectionner automatiquement le premier visible
                if (!currentCheckedIsVisible && firstVisibleRadio) {
                    firstVisibleRadio.checked = true;
                }

                // 4. Mettre à jour l'affichage des caractéristiques et commodités
                if (typeof handleTypeChange === 'function') {
                    handleTypeChange();
                }
            }
            offreRadios.forEach(r => r.addEventListener('change', handleOffreChange));
            handleOffreChange();

            // ── 2. Adaptabilité dynamique par type de bien ──
            const typeRadios = document.querySelectorAll('input[name="type_bien"]');
            const groupMaisonPieces = document.getElementById('groupMaisonPieces');
            const groupProPieces = document.getElementById('groupProPieces');
            const noticeTerrain = document.getElementById('noticeTerrain');
            const equipBadge = document.getElementById('equipBadge');

            const nombrePiecesMaison = document.getElementById('nombre_pieces');
            const nombreSallesBainMaison = document.getElementById('nombre_salles_bain');
            const nombreChambresMaison = document.getElementById('nombre_chambres');

            const nombrePiecesPro = document.getElementById('nombre_pieces_pro');
            const nombreSallesBainPro = document.getElementById('nombre_salles_bain_pro');

            const typeConfig = {
                residence_meublee: {
                    badge: '<i class="ph ph-buildings"></i> Équipements Résidence Meublée',
                    mode: 'maison'
                },
                chambre_hotel: {
                    badge: '<i class="ph ph-bed"></i> Services & Commodités Hôtel',
                    mode: 'maison'
                },
                maison: {
                    badge: '<i class="ph ph-house"></i> Équipements Maison & Résidence',
                    mode: 'maison'
                },
                terrain: {
                    badge: '<i class="ph ph-map-trifold"></i> Commodités Foncières & Viabilisation',
                    mode: 'terrain'
                },
                bureau: {
                    badge: '<i class="ph ph-briefcase"></i> Équipements Bureau & Espaces Pro',
                    mode: 'pro'
                },
                magasin: {
                    badge: '<i class="ph ph-storefront"></i> Équipements Magasin & Commerce',
                    mode: 'pro'
                },
                entrepot: {
                    badge: '<i class="ph ph-warehouse"></i> Équipements Entrepôt & Logistique',
                    mode: 'pro'
                },
                autre: {
                    badge: '<i class="ph ph-dots-three"></i> Commodités Générales',
                    mode: 'maison'
                }
            };

            function handleTypeChange() {
                const checked = document.querySelector('input[name="type_bien"]:checked');
                if (!checked) return;
                const type = checked.value;
                const config = typeConfig[type] || typeConfig['maison'];

                // 2.1 Mettre à jour l'indicateur d'équipements
                if (equipBadge) {
                    equipBadge.innerHTML = config.badge;
                }

                // 2.2 Afficher le panneau d'équipements correspondant
                document.querySelectorAll('.equip-group-panel').forEach(panel => {
                    panel.style.display = 'none';
                });
                const targetPanel = document.getElementById('equip_panel_' + type);
                if (targetPanel) {
                    targetPanel.style.display = 'block';
                }

                // 2.3 Gérer l'affichage des pièces / chambres
                if (config.mode === 'terrain') {
                    groupMaisonPieces.style.display = 'none';
                    groupProPieces.style.display = 'none';
                    noticeTerrain.style.display = 'flex';

                    // Vider les pièces pour terrain
                    if (nombrePiecesMaison) nombrePiecesMaison.value = '';
                    if (nombreChambresMaison) nombreChambresMaison.value = '';
                    if (nombreSallesBainMaison) nombreSallesBainMaison.value = '';
                } else if (config.mode === 'pro') {
                    groupMaisonPieces.style.display = 'none';
                    groupProPieces.style.display = 'grid';
                    noticeTerrain.style.display = 'none';

                    // Synchroniser les valeurs vers les inputs réels du formulaire
                    syncProInputs();
                } else {
                    groupMaisonPieces.style.display = 'grid';
                    groupProPieces.style.display = 'none';
                    noticeTerrain.style.display = 'none';
                }
            }

            function syncProInputs() {
                if (nombrePiecesPro && nombrePiecesMaison) {
                    nombrePiecesMaison.value = nombrePiecesPro.value;
                }
                if (nombreSallesBainPro && nombreSallesBainMaison) {
                    nombreSallesBainMaison.value = nombreSallesBainPro.value;
                }
                if (nombreChambresMaison) {
                    nombreChambresMaison.value = ''; // pas de chambres pour un local pro
                }
            }

            if (nombrePiecesPro) {
                nombrePiecesPro.addEventListener('input', syncProInputs);
            }
            if (nombreSallesBainPro) {
                nombreSallesBainPro.addEventListener('input', syncProInputs);
            }

            typeRadios.forEach(radio => {
                radio.addEventListener('change', handleTypeChange);
            });

            // Initialisation au chargement
            handleTypeChange();

            // ── 3. Gestion native et fluide des photos (jusqu'à 10 Mo par photo) ──
            const imageInput = document.getElementById('imageInput');
            const previewGrid = document.getElementById('previewGrid');
            const uploadZone = document.getElementById('uploadZone');
            const form = document.getElementById('annonceForm');
            let selectedFiles = [];
            const MAX_SIZE_BYTES = 10 * 1024 * 1024; // 10 Mo

            function addFiles(files) {
                const incoming = Array.from(files);

                for (const file of incoming) {
                    if (selectedFiles.length >= 10) {
                        alert('Vous ne pouvez pas ajouter plus de 10 photos au total.');
                        break;
                    }

                    // Vérification type image
                    const isImg = (file.type && file.type.startsWith('image/')) || /\.(jpe?g|png|webp|jfif|avif)$/i.test(file.name);
                    if (!isImg) {
                        alert('Le fichier "' + file.name + '" n\'est pas un format d\'image supporté (JPG, PNG, WEBP, JFIF, AVIF).');
                        continue;
                    }

                    // Vérification taille max 10 Mo
                    if (file.size > MAX_SIZE_BYTES) {
                        const sizeMo = (file.size / (1024 * 1024)).toFixed(1);
                        alert('La photo "' + file.name + '" fait ' + sizeMo + ' Mo et dépasse la limite autorisée de 10 Mo.');
                        continue;
                    }

                    // Éviter les doublons stricts
                    const alreadyExists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                    if (!alreadyExists) {
                        selectedFiles.push(file);
                    }
                }

                syncFilesToInput();
                renderPreviews();
            }

            function syncFilesToInput() {
                if (!imageInput) return;
                try {
                    const dt = new DataTransfer();
                    selectedFiles.forEach(f => dt.items.add(f));
                    imageInput.files = dt.files;
                } catch (e) {
                    console.error('DataTransfer sync error:', e);
                }
            }

            function removeFile(index) {
                selectedFiles.splice(index, 1);
                syncFilesToInput();
                renderPreviews();
            }

            function renderPreviews() {
                if (!previewGrid) return;
                previewGrid.innerHTML = '';

                selectedFiles.forEach((file, index) => {
                    const card = document.createElement('div');
                    card.className = 'preview-card';

                    const img = document.createElement('img');
                    img.alt = 'Aperçu photo ' + (index + 1);
                    img.src = URL.createObjectURL(file);

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'remove-btn';
                    removeBtn.innerHTML = '<i class="ph ph-x"></i>';
                    removeBtn.title = 'Supprimer cette photo';
                    removeBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        e.preventDefault();
                        URL.revokeObjectURL(img.src);
                        removeFile(index);
                    });

                    const sizeBadge = document.createElement('span');
                    sizeBadge.className = 'preview-size-badge';
                    const sizeKo = Math.round(file.size / 1024);
                    sizeBadge.textContent = sizeKo >= 1024 ? (sizeKo / 1024).toFixed(1) + ' Mo' : sizeKo + ' Ko';

                    card.appendChild(img);
                    card.appendChild(removeBtn);
                    card.appendChild(sizeBadge);
                    previewGrid.appendChild(card);
                });
            }

            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        addFiles(this.files);
                    }
                });
            }

            if (uploadZone) {
                uploadZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    uploadZone.classList.add('dragover');
                });
                uploadZone.addEventListener('dragleave', () => {
                    uploadZone.classList.remove('dragover');
                });
                uploadZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    uploadZone.classList.remove('dragover');
                    if (e.dataTransfer && e.dataTransfer.files) {
                        addFiles(e.dataTransfer.files);
                    }
                });
            }

            if (form) {
                form.addEventListener('submit', function() {
                    syncProInputs();
                    syncFilesToInput();
                });
            }
        });
    </script>
</body>

</html>