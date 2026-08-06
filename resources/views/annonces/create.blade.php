<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Publier un bien - TERRA</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* ===== RESET & VARIABLES ===== */
        :root {
            --primary: #284b63;
            --primary-rgb: 40, 75, 99;
            --teal: #3c6e71;
            --teal-rgb: 60, 110, 113;
            --dark: #353535;
            --gray: #d9d9d9;
            --white: #ffffff;
            --light-bg: #f4f6f8;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
            --radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--light-bg);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            line-height: 1.2;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(217, 217, 217, 0.5);
            padding: 0 2rem;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: var(--transition);
        }

        .navbar.scrolled {
            box-shadow: var(--shadow-md);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .nav-brand .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--teal));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            position: relative;
            padding: 0.25rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--teal);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: var(--teal);
        }

        /* ===== HAMBURGER ===== */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0.5rem;
        }

        .hamburger span {
            width: 24px;
            height: 2px;
            background: var(--dark);
            border-radius: 2px;
            transition: var(--transition);
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            margin-top: 72px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--teal) 100%);
            padding: 2.5rem 2rem 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -5%;
            width: 320px;
            height: 320px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -60%;
            left: -10%;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
        }

        .page-header .header-inner {
            max-width: 960px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .page-header .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.88rem;
            font-weight: 500;
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .page-header .back-link:hover {
            color: #fff;
        }

        .page-header h1 {
            color: #fff;
            font-size: 1.9rem;
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            margin-top: 0.3rem;
        }

        /* ===== FORM CONTAINER ===== */
        .form-container {
            max-width: 960px;
            margin: -1.5rem auto 4rem;
            padding: 0 1rem;
            position: relative;
            z-index: 2;
        }

        /* ===== FORM SECTIONS ===== */
        .form-section {
            background: var(--white);
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(217, 217, 217, 0.4);
            transition: var(--transition);
            opacity: 0;
            transform: translateY(16px);
            animation: fadeUp 0.5s ease forwards;
        }

        .form-section:nth-child(1) {
            animation-delay: 0.00s;
        }

        .form-section:nth-child(2) {
            animation-delay: 0.06s;
        }

        .form-section:nth-child(3) {
            animation-delay: 0.12s;
        }

        .form-section:nth-child(4) {
            animation-delay: 0.18s;
        }

        .form-section:nth-child(5) {
            animation-delay: 0.24s;
        }

        .form-section:nth-child(6) {
            animation-delay: 0.30s;
        }

        .form-section:nth-child(7) {
            animation-delay: 0.36s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--light-bg);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .section-title i {
            color: var(--teal);
            font-size: 1.15rem;
        }

        /* ===== GRID SYSTEM (replaces Bootstrap) ===== */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1.25rem;
        }

        /* ===== FORM FIELDS ===== */
        .field {
            margin-bottom: 1.25rem;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.88rem;
            margin-bottom: 0.45rem;
        }

        .form-label .req {
            color: #c0392b;
            margin-left: 2px;
        }

        .form-control,
        .form-select {
            display: block;
            width: 100%;
            border: 2px solid var(--gray);
            border-radius: var(--radius);
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark);
            background: var(--white);
            transition: var(--transition);
            outline: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(var(--teal-rgb), 0.12);
            background: #fff;
        }

        .form-control::placeholder {
            color: #b0aaa0;
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        /* Input group prix */
        .input-group {
            display: flex;
            align-items: stretch;
        }

        .input-group-text {
            background: var(--primary);
            color: #fff;
            border: 2px solid var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
            border-radius: var(--radius) 0 0 var(--radius);
            padding: 0 0.85rem;
            display: flex;
            align-items: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            white-space: nowrap;
        }

        .input-group .form-control {
            border-left: 0;
            border-radius: 0 var(--radius) var(--radius) 0;
        }

        .input-group .form-control:focus {
            border-color: var(--teal);
            border-left: 0;
        }

        /* ===== TYPE D'OFFRE TOGGLE ===== */
        .offre-toggle {
            display: flex;
            background: var(--light-bg);
            border-radius: 50px;
            padding: 4px;
            gap: 4px;
        }

        .offre-toggle input[type="radio"] {
            display: none;
        }

        .offre-toggle label {
            flex: 1;
            text-align: center;
            padding: 0.7rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.92rem;
            cursor: pointer;
            transition: var(--transition);
            color: #999;
        }

        .offre-toggle input:checked+label {
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: #fff;
            box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.3);
        }

        /* ===== TYPE DE BIEN GRID ===== */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 0.75rem;
        }

        .type-option {
            position: relative;
        }

        .type-option input[type="radio"] {
            display: none;
        }

        .type-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            padding: 1rem 0.5rem;
            background: var(--light-bg);
            border: 2px solid var(--gray);
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .type-option label i {
            font-size: 1.5rem;
            color: #aaa;
            transition: var(--transition);
        }

        .type-option label span {
            font-size: 0.82rem;
            font-weight: 600;
            color: #777;
        }

        .type-option input:checked+label {
            border-color: var(--teal);
            background: rgba(var(--teal-rgb), 0.06);
        }

        .type-option input:checked+label i {
            color: var(--teal);
        }

        .type-option input:checked+label span {
            color: var(--primary);
        }

        .type-option label:hover {
            border-color: var(--teal);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* ===== EQUIPEMENTS ===== */
        .equip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 0.5rem;
        }

        .equip-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 0.8rem;
            background: var(--light-bg);
            border: 1.5px solid var(--gray);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .equip-check:hover {
            border-color: var(--teal);
        }

        .equip-check input[type="checkbox"] {
            accent-color: var(--teal);
            width: 16px;
            height: 16px;
        }

        .equip-check input:checked~span {
            color: var(--primary);
            font-weight: 600;
        }

        .equip-check span {
            font-size: 0.88rem;
            color: #666;
        }

        /* ===== UPLOAD ZONE ===== */
        .upload-zone {
            border: 2px dashed var(--gray);
            border-radius: var(--radius);
            padding: 2.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background: var(--light-bg);
            position: relative;
        }

        .upload-zone:hover {
            border-color: var(--teal);
            background: rgba(var(--teal-rgb), 0.04);
        }

        .upload-zone i {
            font-size: 2.5rem;
            color: #c0b8a8;
            margin-bottom: 0.5rem;
        }

        .upload-zone p {
            margin: 0;
            color: #888;
            font-size: 0.92rem;
        }

        .upload-zone small {
            color: #aaa;
            font-size: 0.8rem;
        }

        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Preview */
        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .preview-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid var(--gray);
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 24px;
            height: 24px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.7rem;
            transition: var(--transition);
        }

        .preview-item .remove-btn:hover {
            background: #c0392b;
        }

        /* ===== ACTIONS BAR ===== */
        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            margin-bottom: 3rem;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: #fff;
            box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.3);
            padding: 0.85rem 2.5rem;
            font-size: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(var(--primary-rgb), 0.4);
            color: #fff;
        }

        .btn-cancel {
            background: var(--white);
            color: var(--dark);
            border: 2px solid var(--gray);
        }

        .btn-cancel:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ===== CHAR COUNTER ===== */
        .char-counter {
            font-size: 0.78rem;
            color: #aaa;
            text-align: right;
            margin-top: 0.2rem;
        }

        /* ===== ALERT ===== */
        .alert-custom {
            border-radius: var(--radius);
            border: none;
            padding: 1rem 1.5rem;
            background: #fdecea;
            color: #721c24;
            margin-bottom: 1.5rem;
        }

        .alert-custom ul {
            padding-left: 1.2rem;
            margin-top: 0.5rem;
            margin-bottom: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .form-section {
                padding: 1.5rem;
            }

            .grid-2,
            .grid-3 {
                grid-template-columns: 1fr;
            }

            .type-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .equip-grid {
                grid-template-columns: 1fr 1fr;
            }

            .upload-zone {
                padding: 1.5rem;
            }

            .actions-bar {
                flex-direction: column-reverse;
                gap: 0.75rem;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 0 1rem;
            }

            .type-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 72px;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
                box-shadow: var(--shadow-lg);
                border-top: 1px solid var(--gray);
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }
        }
    </style>
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar">
        <a href="{{ route('dashboard') }}" class="nav-brand">
            <span class="brand-icon"><i class="bi bi-building"></i></span>
            TERRA
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
            <li><a href="{{ route('annonces.index') }}">Mes annonces</a></li>
            <li><a href="#" class="active">Nouveau bien</a></li>
        </ul>
        <div class="nav-actions">
            <button class="hamburger" id="hamburger"
                onclick="document.getElementById('navLinks').classList.toggle('active')">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- ===== HEADER ===== -->
    <div class="page-header">
        <div class="header-inner">
            <a href="{{ route('dashboard') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Retour au tableau de bord
            </a>
            <h1>Publier un bien</h1>
            <p>Remplissez les informations ci-dessous pour mettre votre bien en ligne</p>
        </div>
    </div>

    <!-- ===== FORM ===== -->
    <div class="form-container">
        <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data" id="bienForm">
            @csrf

            @if($errors->any())
            <div class="alert-custom">
                <i class="bi bi-exclamation-circle" style="margin-right:0.5rem;"></i>
                <strong>Veuillez corriger les erreurs :</strong>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- TYPE D'OFFRE -->
            <div class="form-section">
                <div class="section-title"><i class="bi bi-tag"></i> Type d'offre</div>
                <div class="offre-toggle">
                    <input type="radio" name="type_offre" id="offre_location" value="location"
                        {{ old('type_offre', 'location') === 'location' ? 'checked' : '' }}>
                    <label for="offre_location"><i class="bi bi-key" style="margin-right:0.3rem;"></i> Location</label>
                    <input type="radio" name="type_offre" id="offre_vente" value="vente"
                        {{ old('type_offre') === 'vente' ? 'checked' : '' }}>
                    <label for="offre_vente"><i class="bi bi-house-door" style="margin-right:0.3rem;"></i> Vente</label>
                </div>
            </div>

            <!-- TYPE DE BIEN -->
            <div class="form-section">
                <div class="section-title"><i class="bi bi-building"></i> Type de bien</div>
                <div class="type-grid">
                    @php
                    $types = [
                    'appartement' => ['icon' => 'bi-building', 'label' => 'Appartement'],
                    'maison' => ['icon' => 'bi-house-door', 'label' => 'Maison'],
                    'villa' => ['icon' => 'bi-house-heart', 'label' => 'Villa'],
                    'terrain' => ['icon' => 'bi-map', 'label' => 'Terrain'],
                    'bureau' => ['icon' => 'bi-briefcase', 'label' => 'Bureau'],
                    'commerce' => ['icon' => 'bi-shop', 'label' => 'Commerce'],
                    'chambre' => ['icon' => 'bi-door-open', 'label' => 'Chambre'],
                    'magasin' => ['icon' => 'bi-bag', 'label' => 'Magasin'],
                    'entrepot' => ['icon' => 'bi-box-seam', 'label' => 'Entrepôt'],
                    'autre' => ['icon' => 'bi-three-dots', 'label' => 'Autre'],
                    ];
                    @endphp
                    @foreach($types as $key => $type)
                    <div class="type-option">
                        <input type="radio" name="type_bien" id="type_{{ $key }}" value="{{ $key }}"
                            {{ old('type_bien', 'appartement') === $key ? 'checked' : '' }}>
                        <label for="type_{{ $key }}">
                            <i class="bi {{ $type['icon'] }}"></i>
                            <span>{{ $type['label'] }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- INFORMATIONS -->
            <div class="form-section">
                <div class="section-title"><i class="bi bi-info-circle"></i> Informations</div>

                <div class="field">
                    <label for="titre" class="form-label">Titre de l'annonce <span class="req">*</span></label>
                    <input type="text" name="titre" id="titre" class="form-control"
                        placeholder="Ex: Bel appartement 3 chambres au centre-ville"
                        value="{{ old('titre') }}" required maxlength="255">
                </div>

                <div class="field">
                    <label for="description" class="form-label">Description <span class="req">*</span></label>
                    <textarea name="description" id="description" class="form-control"
                        placeholder="Décrivez votre bien en détail..." required>{{ old('description') }}</textarea>
                    <div class="char-counter"><span id="descCount">0</span>/2000 caractères</div>
                </div>

                <div class="grid-2">
                    <div class="field">
                        <label for="prix" class="form-label">Prix <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">FCFA</span>
                            <input type="number" name="prix" id="prix" class="form-control"
                                placeholder="Ex: 150000" value="{{ old('prix') }}" min="0" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="date_disponibilite" class="form-label">Date de disponibilité</label>
                        <input type="date" name="date_disponibilite" id="date_disponibilite" class="form-control"
                            value="{{ old('date_disponibilite') }}">
                    </div>
                </div>
            </div>

            <!-- CARACTÉRISTIQUES -->
            <div class="form-section">
                <div class="section-title"><i class="bi bi-rulers"></i> Caractéristiques</div>
                <div class="grid-3">
                    <div class="field">
                        <label for="superficie" class="form-label">Superficie (m²) <span class="req">*</span></label>
                        <input type="number" name="superficie" id="superficie" class="form-control"
                            placeholder="Ex: 120" value="{{ old('superficie') }}" min="1" required>
                    </div>
                    <div class="field">
                        <label for="nb_chambres" class="form-label">Chambres</label>
                        <input type="number" name="nb_chambres" id="nb_chambres" class="form-control"
                            value="{{ old('nb_chambres', 0) }}" min="0">
                    </div>
                    <div class="field">
                        <label for="nb_salles_bain" class="form-label">Salles de bain</label>
                        <input type="number" name="nb_salles_bain" id="nb_salles_bain" class="form-control"
                            value="{{ old('nb_salles_bain', 0) }}" min="0">
                    </div>
                </div>
                <div style="max-width: 33%; margin-top: 1.25rem;">
                    <div class="field" style="margin-bottom: 0;">
                        <label for="nb_pieces" class="form-label">Nombre de pièces</label>
                        <input type="number" name="nb_pieces" id="nb_pieces" class="form-control"
                            value="{{ old('nb_pieces', 1) }}" min="1">
                    </div>
                </div>
            </div>

            <!-- LOCALISATION -->
            <div class="form-section">
                <div class="section-title"><i class="bi bi-geo-alt"></i> Localisation</div>
                <div class="grid-2">
                    <div class="field">
                        <label for="quartier" class="form-label">Quartier</label>
                        <input type="text" name="quartier" id="quartier" class="form-control"
                            placeholder="Ex: Riviera 2" value="{{ old('quartier') }}">
                    </div>
                    <div class="field">
                        <label for="adresse" class="form-label">Adresse précise</label>
                        <input type="text" name="adresse" id="adresse" class="form-control"
                            placeholder="Ex: Face à la pharmacie du stade" value="{{ old('adresse') }}">
                    </div>
                </div>
            </div>

            <!-- ÉQUIPEMENTS -->
            <div class="form-section">
                <div class="section-title"><i class="bi bi-gear"></i> Équipements & Commodités</div>
                <div class="equip-grid">
                    @php
                    $equipements = [
                    'cuisine_equipee' => 'Cuisine équipée',
                    'climatisation' => 'Climatisation',
                    'chauffe_eau' => 'Chauffe-eau',
                    'parking' => 'Parking',
                    'garage' => 'Garage',
                    'piscine' => 'Piscine',
                    'jardin' => 'Jardin',
                    'terrasse' => 'Terrasse',
                    'balcon' => 'Balcon',
                    'gardien' => 'Gardien',
                    'videosurveillance' => 'Vidéosurveillance',
                    'porte_blindee' => 'Porte blindée',
                    'meuble' => 'Meublé',
                    'dressing' => 'Dressing',
                    'buanderie' => 'Buanderie',
                    'groupe_electrogene' => 'Groupe électrogène',
                    'reservoir_eau' => 'Réservoir eau',
                    'internet' => 'Internet / WiFi',
                    ];
                    @endphp
                    @foreach($equipements as $key => $label)
                    <label class="equip-check">
                        <input type="checkbox" name="equipements[]" value="{{ $key }}"
                            {{ in_array($key, old('equipements', [])) ? 'checked' : '' }}>
                        <span>{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- PHOTOS -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-camera"></i> Photos
                    <span
                        style="margin-left:auto; font-weight:400; font-size:0.82rem; color:#aaa;">Maximum 10
                        photos</span>
                </div>
                <div class="upload-zone" id="uploadZone">
                    <i class="bi bi-cloud-arrow-up"
                        style="display:block; font-size:2.5rem; color:#c0b8a8; margin-bottom:0.5rem;"></i>
                    <p><strong>Cliquez ou glissez vos photos ici</strong></p>
                    <small>JPG, PNG, WEBP — 5 Mo max par photo</small>
                    <input type="file" name="images[]" id="imageInput" multiple
                        accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="preview-grid" id="previewGrid"></div>
            </div>

            <!-- ACTIONS -->
            <div class="actions-bar">
                <a href="{{ route('dashboard') }}" class="btn-action btn-cancel">
                    <i class="bi bi-x-lg"></i> Annuler
                </a>
                <button type="submit" class="btn-action btn-submit">
                    <i class="bi bi-check-lg"></i> Publier le bien
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Navbar scroll
            window.addEventListener('scroll', () => {
                document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 10);
            });

            // Compteur caractères
            const desc = document.getElementById('description');
            const counter = document.getElementById('descCount');
            if (desc && counter) {
                counter.textContent = desc.value.length;
                desc.addEventListener('input', () => {
                    counter.textContent = desc.value.length;
                });
            }

            // Upload preview
            const input = document.getElementById('imageInput');
            const grid = document.getElementById('previewGrid');
            let files = [];

            if (input) {
                input.addEventListener('change', function(e) {
                    handleFiles(e.target.files);
                });
            }

            function handleFiles(newFiles) {
                for (let f of newFiles) {
                    if (files.length >= 10) break;
                    if (!f.type.match('image.*')) continue;
                    files.push(f);
                }
                renderPreviews();
            }

            function renderPreviews() {
                grid.innerHTML = '';
                files.forEach((f, i) => {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(f);
                    img.onload = () => URL.revokeObjectURL(img.src);
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'remove-btn';
                    btn.innerHTML = '<i class="bi bi-x"></i>';
                    btn.onclick = () => {
                        files.splice(i, 1);
                        renderPreviews();
                    };
                    div.appendChild(img);
                    div.appendChild(btn);
                    grid.appendChild(div);
                });
                const dt = new DataTransfer();
                files.forEach(f => dt.items.add(f));
                input.files = dt.files;
            }

            // Drag & drop
            const zone = document.getElementById('uploadZone');
            if (zone) {
                zone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    zone.style.borderColor = 'var(--teal)';
                });
                zone.addEventListener('dragleave', () => {
                    zone.style.borderColor = 'var(--gray)';
                });
                zone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    zone.style.borderColor = 'var(--gray)';
                    handleFiles(e.dataTransfer.files);
                });
            }
        });
    </script>

</body>

</html>