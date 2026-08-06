<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Publier un bien — ImmoPro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.0.3"></script>

    <style>
        :root {
            --navy: #1a2332;
            --navy-deep: #111827;
            --navy-rgb: 26, 35, 50;
            --teal: #2c6e6e;
            --teal-rgb: 44, 110, 110;
            --teal-light: #3a8f8f;
            --teal-muted: #e8f0f0;
            --gold: #c4a265;
            --gold-rgb: 196, 162, 101;
            --gold-light: #e8d5b0;
            --cream: #faf8f5;
            --white: #ffffff;
            --w50: #f7f5f2;
            --w100: #ece8e3;
            --w200: #dbd5cd;
            --w300: #c4bcb2;
            --w400: #a09890;
            --w500: #7a7470;
            --w600: #5a5550;
            --w700: #3a3632;
            --text: #1a1714;
            --text-2: #4a4540;
            --text-m: #8a8580;
            --error: #c0392b;
            --error-bg: #fef2f1;
            --r-sm: 8px;
            --r: 12px;
            --r-lg: 16px;
            --r-full: 999px;
            --sh-sm: 0 2px 8px rgba(26, 23, 20, .06);
            --sh-md: 0 4px 16px rgba(26, 23, 20, .08);
            --sh-lg: 0 8px 32px rgba(26, 23, 20, .10);
            --ease: cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--cream);
            color: var(--text);
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        ::selection {
            background: rgba(var(--teal-rgb), .15);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
        }

        h1,
        h2,
        h3 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 600;
            line-height: 1.2;
        }

        /* ═══ NAVBAR ═══ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 72px;
            padding: 0 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(250, 248, 245, .85);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-bottom: 1px solid rgba(219, 213, 205, .5);
            transition: all .3s var(--ease);
        }

        .navbar.scrolled {
            box-shadow: 0 1px 12px rgba(26, 23, 20, .06);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            text-decoration: none;
            color: var(--navy);
        }

        .nav-brand .brand-mark {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--navy), var(--teal));
            border-radius: 10px;
            display: grid;
            place-items: center;
            color: white;
            font-size: 1.1rem;
        }

        .nav-brand .brand-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: .08em;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: .5rem;
            list-style: none;
        }

        .nav-links a {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem 1rem;
            font-size: .88rem;
            font-weight: 500;
            color: var(--w600);
            text-decoration: none;
            border-radius: var(--r);
            transition: all .15s ease;
        }

        .nav-links a:hover {
            color: var(--teal);
            background: var(--teal-muted);
        }

        .nav-links a.active {
            color: var(--teal);
            background: var(--teal-muted);
            font-weight: 600;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: .5rem;
            border-radius: var(--r-sm);
            transition: all .15s ease;
        }

        .hamburger:hover {
            background: var(--w100);
        }

        .hamburger span {
            width: 20px;
            height: 2px;
            background: var(--w600);
            border-radius: 2px;
            transition: all .3s var(--ease);
        }

        /* ═══ HERO ═══ */
        .page-hero {
            margin-top: 72px;
            background: linear-gradient(145deg, var(--navy-deep) 0%, var(--navy) 40%, #0a6372 100%);
            padding: 3.5rem 2rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(var(--navy-rgb), .15) 50%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(var(--gold-rgb), .08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 40%;
            opacity: .03;
            background-image: repeating-linear-gradient(45deg, transparent, transparent 20px, white 20px, white 21px);
        }

        .hero-inner {
            max-width: 960px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: rgba(255, 255, 255, .5);
            font-size: .85rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 1.25rem;
            transition: all .3s var(--ease);
        }

        .back-link:hover {
            color: rgba(255, 255, 255, .9);
        }

        .hero-inner h1 {
            font-size: 2.4rem;
            color: white;
            margin-bottom: .4rem;
        }

        .hero-inner .hero-sub {
            color: rgba(255, 255, 255, .45);
            font-size: 1rem;
        }

        /* ═══ FORM ═══ */
        .form-wrapper {
            max-width: 960px;
            margin: -2rem auto 5rem;
            padding: 0 1.25rem;
            position: relative;
            z-index: 2;
        }

        .form-card {
            background: var(--white);
            border-radius: var(--r-lg);
            padding: 2rem 2.25rem;
            margin-bottom: 1.25rem;
            box-shadow: var(--sh-sm);
            border: 1px solid rgba(219, 213, 205, .5);
            position: relative;
            transition: box-shadow .3s var(--ease);
            opacity: 0;
            transform: translateY(20px);
            animation: cardIn .6s var(--ease) forwards;
        }

        .form-card:hover {
            box-shadow: var(--sh-md);
        }

        .form-card:nth-child(2) {
            animation-delay: .06s;
        }

        .form-card:nth-child(3) {
            animation-delay: .12s;
        }

        .form-card:nth-child(4) {
            animation-delay: .18s;
        }

        .form-card:nth-child(5) {
            animation-delay: .24s;
        }

        .form-card:nth-child(6) {
            animation-delay: .30s;
        }

        .form-card:nth-child(7) {
            animation-delay: .36s;
        }

        .form-card:nth-child(8) {
            animation-delay: .42s;
        }

        @keyframes cardIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 1.5rem;
            left: 0;
            width: 3px;
            height: calc(100% - 3rem);
            background: linear-gradient(180deg, var(--teal), var(--gold));
            border-radius: 0 3px 3px 0;
            opacity: .45;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--w100);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(var(--teal-rgb), .08), rgba(var(--teal-rgb), .04));
            border-radius: var(--r);
            display: grid;
            place-items: center;
            color: var(--teal);
            font-size: 1.15rem;
        }

        .card-title-text {
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--navy);
        }

        .card-badge {
            margin-left: auto;
            font-size: .78rem;
            color: var(--text-m);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            background: var(--w50);
            padding: .3rem .7rem;
            border-radius: var(--r-full);
            transition: opacity .2s ease;
        }

        /* ═══ FORM CONTROLS ═══ */
        .field {
            margin-bottom: 1.25rem;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: var(--text-2);
            margin-bottom: .5rem;
        }

        .form-label .req {
            color: var(--error);
            margin-left: 2px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            display: block;
            width: 100%;
            padding: .75rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .92rem;
            color: var(--text);
            background: var(--w50);
            border: 1.5px solid var(--w200);
            border-radius: var(--r);
            outline: none;
            transition: all .3s var(--ease);
        }

        .form-input:hover,
        .form-textarea:hover,
        .form-select:hover {
            border-color: var(--w300);
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            border-color: var(--teal);
            background: white;
            box-shadow: 0 0 0 3px rgba(var(--teal-rgb), .08);
        }

        .form-input::placeholder {
            color: var(--w400);
        }

        .form-textarea {
            min-height: 130px;
            resize: vertical;
            line-height: 1.6;
        }

        .input-group {
            display: flex;
            align-items: stretch;
        }

        .input-prefix {
            display: flex;
            align-items: center;
            padding: 0 1rem;
            background: var(--navy);
            color: var(--gold-light);
            font-weight: 700;
            font-size: .82rem;
            letter-spacing: .04em;
            border-radius: var(--r) 0 0 var(--r);
            border: 1.5px solid var(--navy);
            white-space: nowrap;
        }

        .input-group .form-input {
            border-radius: 0 var(--r) var(--r) 0;
            border-left: none;
        }

        .input-group .form-input:focus {
            border-color: var(--teal);
        }

        .char-counter {
            text-align: right;
            font-size: .78rem;
            color: var(--w400);
            margin-top: .3rem;
        }

        /* ═══ GRIDS ═══ */
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

        /* ═══ OFFRE TOGGLE ═══ */
        .offre-toggle {
            display: flex;
            background: var(--w50);
            border-radius: var(--r-full);
            padding: 5px;
            gap: 5px;
            border: 1.5px solid var(--w200);
        }

        .offre-toggle input[type="radio"] {
            display: none;
        }

        .offre-toggle label {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .75rem 1.5rem;
            border-radius: var(--r-full);
            font-weight: 600;
            font-size: .92rem;
            cursor: pointer;
            color: var(--w500);
            transition: all .3s var(--ease);
        }

        .offre-toggle label i {
            font-size: 1.1rem;
        }

        .offre-toggle input:checked+label {
            background: linear-gradient(135deg, var(--navy), var(--teal));
            color: white;
            box-shadow: 0 4px 16px rgba(var(--navy-rgb), .25);
        }

        /* ═══ TYPE GRID ═══ */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: .75rem;
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
            gap: .5rem;
            padding: 1.1rem .5rem;
            background: var(--w50);
            border: 1.5px solid var(--w200);
            border-radius: var(--r);
            cursor: pointer;
            transition: all .3s var(--ease);
            text-align: center;
        }

        .type-option label i {
            font-size: 1.6rem;
            color: var(--w400);
            transition: all .3s var(--ease);
        }

        .type-option label span {
            font-size: .78rem;
            font-weight: 600;
            color: var(--w500);
            transition: all .3s var(--ease);
        }

        .type-option label:hover {
            border-color: var(--w300);
            transform: translateY(-3px);
            box-shadow: var(--sh-md);
        }

        .type-option input:checked+label {
            border-color: var(--teal);
            background: rgba(var(--teal-rgb), .04);
        }

        .type-option input:checked+label i {
            color: var(--teal);
        }

        .type-option input:checked+label span {
            color: var(--teal);
            font-weight: 700;
        }

        /* ═══ CARAC PANELS ═══ */
        .carac-panel {
            display: none;
        }

        .carac-panel.active {
            display: block;
            animation: panelIn .35s ease forwards;
        }

        @keyframes panelIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ═══ EQUIP ═══ */
        .equip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: .5rem;
        }

        .equip-check {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .65rem .85rem;
            background: var(--w50);
            border: 1.5px solid var(--w200);
            border-radius: var(--r-full);
            cursor: pointer;
            transition: all .3s var(--ease);
            user-select: none;
        }

        .equip-check:hover {
            border-color: var(--w300);
            background: var(--white);
        }

        .equip-check input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid var(--w300);
            border-radius: 5px;
            flex-shrink: 0;
            position: relative;
            transition: all .2s var(--ease);
            cursor: pointer;
        }

        .equip-check input[type="checkbox"]:checked {
            background: var(--teal);
            border-color: var(--teal);
        }

        .equip-check input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            top: 1px;
            left: 5px;
            width: 5px;
            height: 9px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .equip-check input:checked~span {
            color: var(--teal);
            font-weight: 600;
        }

        .equip-check span {
            font-size: .85rem;
            color: var(--w600);
            transition: all .2s var(--ease);
        }

        /* ═══ UPLOAD ═══ */
        .upload-zone {
            border: 2px dashed var(--w200);
            border-radius: var(--r-lg);
            padding: 3rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all .3s var(--ease);
            background: var(--w50);
            position: relative;
        }

        .upload-zone:hover {
            border-color: var(--teal);
            background: rgba(var(--teal-rgb), .02);
        }

        .upload-zone.dragover {
            border-color: var(--teal);
            background: rgba(var(--teal-rgb), .04);
            transform: scale(1.005);
        }

        .upload-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, rgba(var(--teal-rgb), .08), rgba(var(--gold-rgb), .06));
            border-radius: var(--r-lg);
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            color: var(--teal);
        }

        .upload-title {
            font-weight: 600;
            font-size: .95rem;
            color: var(--text-2);
            margin-bottom: .3rem;
        }

        .upload-hint {
            font-size: .82rem;
            color: var(--w400);
        }

        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: .75rem;
            margin-top: 1rem;
        }

        .preview-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: var(--r);
            overflow: hidden;
            border: 2px solid var(--w200);
            transition: all .3s var(--ease);
        }

        .preview-item:hover {
            border-color: var(--teal);
            transform: scale(1.03);
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 24px;
            height: 24px;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(4px);
            color: white;
            border: none;
            border-radius: 50%;
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: .75rem;
            opacity: 0;
            transform: scale(.8);
            transition: all .3s var(--ease);
        }

        .preview-item:hover .remove-btn {
            opacity: 1;
            transform: scale(1);
        }

        .preview-item .remove-btn:hover {
            background: var(--error);
        }

        /* ═══ ACTIONS ═══ */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            margin-bottom: 3rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .85rem 2rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .92rem;
            font-weight: 600;
            border-radius: var(--r-full);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all .3s var(--ease);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--navy), var(--teal));
            color: white;
            padding: .9rem 2.5rem;
            font-size: .95rem;
            box-shadow: 0 4px 20px rgba(var(--navy-rgb), .25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(var(--navy-rgb), .35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary i {
            font-size: 1.05rem;
        }

        .btn-ghost {
            background: transparent;
            color: var(--w500);
            border: 1.5px solid var(--w200);
        }

        .btn-ghost:hover {
            border-color: var(--w400);
            color: var(--text);
            background: var(--w50);
        }

        .alert-box {
            background: var(--error-bg);
            border: 1px solid rgba(192, 57, 43, .15);
            border-radius: var(--r-lg);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
            animation: cardIn .4s ease forwards;
        }

        .alert-header {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-weight: 700;
            color: var(--error);
            font-size: .9rem;
            margin-bottom: .5rem;
        }

        .alert-box ul {
            padding-left: 1.5rem;
            margin: 0;
        }

        .alert-box ul li {
            color: #8b3a33;
            font-size: .85rem;
            line-height: 1.6;
        }

        /* ═══ RESPONSIVE ═══ */
        @media(max-width:992px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 72px;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                padding: 1.5rem 2rem;
                gap: .25rem;
                box-shadow: var(--sh-lg);
                border-top: 1px solid var(--w100);
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            .type-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media(max-width:768px) {
            .navbar {
                padding: 0 1.25rem;
            }

            .page-hero {
                padding: 2.5rem 1.25rem 3rem;
            }

            .hero-inner h1 {
                font-size: 1.8rem;
            }

            .form-card {
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
                padding: 2rem 1.5rem;
            }

            .form-actions {
                flex-direction: column-reverse;
                gap: .75rem;
            }

            .btn {
                width: 100%;
            }
        }

        @media(max-width:480px) {
            .type-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .equip-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- ═══════ NAVBAR ═══════ -->
    <nav class="navbar" id="navbar">
        <a href="{{ route('dashboard') }}" class="nav-brand">
            <span class="brand-mark"><i class="ph ph-buildings"></i></span>
            <span class="brand-text">ImmoPro</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('dashboard') }}"><i class="ph ph-squares-four" style="font-size:1rem"></i> Tableau de bord</a></li>
            <li><a href="{{ route('annonces.index') }}"><i class="ph ph-list-checks" style="font-size:1rem"></i> Mes annonces</a></li>
            <li><a href="#" class="active"><i class="ph ph-plus-circle" style="font-size:1rem"></i> Nouveau bien</a></li>
        </ul>
        <button class="hamburger" onclick="document.getElementById('navLinks').classList.toggle('active')">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <!-- ═══════ HERO ═══════ -->
    <header class="page-hero">
        <div class="hero-pattern"></div>
        <div class="hero-inner">
            <a href="{{ route('dashboard') }}" class="back-link"><i class="ph ph-arrow-left"></i> Retour au tableau de bord</a>
            <h1>Publier un bien</h1>
            <p class="hero-sub">Remplissez les informations ci-dessous pour mettre votre bien en ligne</p>
        </div>
    </header>

    <!-- ═══════ FORM ═══════ -->
    <div class="form-wrapper">
        <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data" id="bienForm">
            @csrf

            @if($errors->any())
            <div class="alert-box">
                <div class="alert-header"><i class="ph ph-warning-circle"></i> Veuillez corriger les erreurs</div>
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif

            <!-- ═══ TYPE D'OFFRE ═══ -->
            <div class="form-card">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-tag"></i></div>
                    <span class="card-title-text">Type d'offre</span>
                </div>
                <div class="offre-toggle">
                    <input type="radio" name="type_offre" id="offre_location" value="location" {{ old('type_offre','location')==='location'?'checked':'' }}>
                    <label for="offre_location"><i class="ph ph-key"></i> Location</label>
                    <input type="radio" name="type_offre" id="offre_vente" value="vente" {{ old('type_offre')==='vente'?'checked':'' }}>
                    <label for="offre_vente"><i class="ph ph-house-line"></i> Vente</label>
                </div>
            </div>

            <!-- ═══ TYPE DE BIEN ═══ -->
            <div class="form-card">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-buildings"></i></div>
                    <span class="card-title-text">Type de bien</span>
                </div>
                <div class="type-grid">
                    @php
                    $types = [
                    'appartement'=>['ph-buildings','Appartement'],
                    'maison'=>['ph-house-line','Maison'],
                    'villa'=>['ph-house','Villa'],
                    'terrain'=>['ph-map-trifold','Terrain'],
                    'bureau'=>['ph-briefcase','Bureau'],
                    'commerce'=>['ph-storefront','Commerce'],
                    'chambre'=>['ph-door-open','Chambre'],
                    'magasin'=>['ph-shopping-bag','Magasin'],
                    'entrepot'=>['ph-warehouse','Entrepôt'],
                    'autre'=>['ph-dots-three','Autre'],
                    ];
                    @endphp
                    @foreach($types as $key => [$icon,$label])
                    <div class="type-option">
                        <input type="radio" name="type_bien" id="type_{{ $key }}" value="{{ $key }}" {{ old('type_bien','appartement')===$key?'checked':'' }}>
                        <label for="type_{{ $key }}"><i class="ph {{ $icon }}"></i><span>{{ $label }}</span></label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- ═══ INFORMATIONS ═══ -->
            <div class="form-card">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-info"></i></div>
                    <span class="card-title-text">Informations</span>
                </div>
                <div class="field">
                    <label for="titre" class="form-label">Titre de l'annonce <span class="req">*</span></label>
                    <input type="text" name="titre" id="titre" class="form-input" placeholder="Ex : Bel appartement 3 chambres au centre-ville" value="{{ old('titre') }}" required maxlength="255">
                </div>
                <div class="field">
                    <label for="description" class="form-label">Description <span class="req">*</span></label>
                    <textarea name="description" id="description" class="form-textarea" placeholder="Décrivez votre bien en détail..." required>{{ old('description') }}</textarea>
                    <div class="char-counter"><span id="descCount">0</span> / 2 000 caractères</div>
                </div>
                <div class="grid-2">
                    <div class="field">
                        <label for="prix" class="form-label">Prix <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-prefix">FCFA</span>
                            <input type="number" name="prix" id="prix" class="form-input" placeholder="Ex : 150 000" value="{{ old('prix') }}" min="0" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="date_disponibilite" class="form-label">Date de disponibilité</label>
                        <input type="date" name="date_disponibilite" id="date_disponibilite" class="form-input" value="{{ old('date_disponibilite') }}">
                    </div>
                </div>
            </div>

            <!-- ═══════════════════════════════════════
                 CARACTÉRISTIQUES (DYNAMIQUE)
                 ═══════════════════════════════════════ -->
            <div class="form-card" id="caracCard">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-ruler"></i></div>
                    <span class="card-title-text">Caractéristiques</span>
                    <span class="card-badge" id="caracBadge">
                        <i class="ph ph-buildings"></i> Appartement
                    </span>
                </div>

                <!-- ───── APPARTEMENT ───── -->
                <div class="carac-panel" data-type="appartement">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 120" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Étage</label>
                            <input type="number" name="etage" class="form-input" placeholder="Ex : 3" value="{{ old('etage') }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Total étages</label>
                            <input type="number" name="nb_etages_total" class="form-input" placeholder="Ex : 5" value="{{ old('nb_etages_total') }}" min="1">
                        </div>
                    </div>
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Pièces</label>
                            <input type="number" name="nb_pieces" class="form-input" value="{{ old('nb_pieces',1) }}" min="1">
                        </div>
                        <div class="field">
                            <label class="form-label">Chambres</label>
                            <input type="number" name="nb_chambres" class="form-input" value="{{ old('nb_chambres',0) }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Salles de bain</label>
                            <input type="number" name="nb_salles_bain" class="form-input" value="{{ old('nb_salles_bain',0) }}" min="0">
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Ascenseur</label>
                            <select name="ascenseur" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('ascenseur')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('ascenseur')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Balcon</label>
                            <select name="balcon_select" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('balcon_select')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('balcon_select')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ───── MAISON ───── -->
                <div class="carac-panel" data-type="maison">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 200" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Superficie terrain (m²)</label>
                            <input type="number" name="superficie_terrain" class="form-input" placeholder="Ex : 500" value="{{ old('superficie_terrain') }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Nombre de niveaux</label>
                            <input type="number" name="nb_niveaux" class="form-input" placeholder="Ex : 2" value="{{ old('nb_niveaux') }}" min="1">
                        </div>
                    </div>
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Pièces</label>
                            <input type="number" name="nb_pieces" class="form-input" value="{{ old('nb_pieces',1) }}" min="1">
                        </div>
                        <div class="field">
                            <label class="form-label">Chambres</label>
                            <input type="number" name="nb_chambres" class="form-input" value="{{ old('nb_chambres',0) }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Salles de bain</label>
                            <input type="number" name="nb_salles_bain" class="form-input" value="{{ old('nb_salles_bain',0) }}" min="0">
                        </div>
                    </div>
                </div>

                <!-- ───── VILLA ───── -->
                <div class="carac-panel" data-type="villa">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 350" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Superficie terrain (m²)</label>
                            <input type="number" name="superficie_terrain" class="form-input" placeholder="Ex : 800" value="{{ old('superficie_terrain') }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Nombre de niveaux</label>
                            <input type="number" name="nb_niveaux" class="form-input" placeholder="Ex : 2" value="{{ old('nb_niveaux') }}" min="1">
                        </div>
                    </div>
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Pièces</label>
                            <input type="number" name="nb_pieces" class="form-input" value="{{ old('nb_pieces',1) }}" min="1">
                        </div>
                        <div class="field">
                            <label class="form-label">Chambres</label>
                            <input type="number" name="nb_chambres" class="form-input" value="{{ old('nb_chambres',0) }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Salles de bain</label>
                            <input type="number" name="nb_salles_bain" class="form-input" value="{{ old('nb_salles_bain',0) }}" min="0">
                        </div>
                    </div>
                </div>

                <!-- ───── TERRAIN ───── -->
                <div class="carac-panel" data-type="terrain">
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 500" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Type de terrain</label>
                            <select name="type_terrain" class="form-select">
                                <option value="">— Sélectionner —</option>
                                <option value="constructible" {{ old('type_terrain')==='constructible'?'selected':'' }}>Constructible</option>
                                <option value="agricole" {{ old('type_terrain')==='agricole'?'selected':'' }}>Agricole</option>
                                <option value="forestier" {{ old('type_terrain')==='forestier'?'selected':'' }}>Forestier</option>
                                <option value="industriel" {{ old('type_terrain')==='industriel'?'selected':'' }}>Industriel</option>
                                <option value="commercial" {{ old('type_terrain')==='commercial'?'selected':'' }}>Commercial</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Viabilisé</label>
                            <select name="viabilise" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('viabilise')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('viabilise')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Clôturé</label>
                            <select name="cloture" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('cloture')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('cloture')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ───── BUREAU ───── -->
                <div class="carac-panel" data-type="bureau">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 80" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Étage</label>
                            <input type="number" name="etage" class="form-input" placeholder="Ex : 2" value="{{ old('etage') }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Nombre de bureaux</label>
                            <input type="number" name="nb_bureaux" class="form-input" placeholder="Ex : 4" value="{{ old('nb_bureaux') }}" min="0">
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Salles de réunion</label>
                            <input type="number" name="salles_reunion" class="form-input" placeholder="Ex : 1" value="{{ old('salles_reunion') }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Places de parking</label>
                            <input type="number" name="nb_parking" class="form-input" placeholder="Ex : 3" value="{{ old('nb_parking') }}" min="0">
                        </div>
                    </div>
                </div>

                <!-- ───── COMMERCE ───── -->
                <div class="carac-panel" data-type="commerce">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 100" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Étage</label>
                            <input type="number" name="etage" class="form-input" placeholder="Ex : 0" value="{{ old('etage') }}" min="0">
                        </div>
                        <div class="field">
                            <label class="form-label">Places de parking</label>
                            <input type="number" name="nb_parking" class="form-input" placeholder="Ex : 2" value="{{ old('nb_parking') }}" min="0">
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Vitrine sur rue</label>
                            <select name="vitrine" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('vitrine')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('vitrine')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Pièces</label>
                            <input type="number" name="nb_pieces" class="form-input" value="{{ old('nb_pieces',1) }}" min="1">
                        </div>
                    </div>
                </div>

                <!-- ───── CHAMBRE ───── -->
                <div class="carac-panel" data-type="chambre">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 18" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Type de chambre</label>
                            <select name="type_chambre" class="form-select">
                                <option value="">— Sélectionner —</option>
                                <option value="simple" {{ old('type_chambre')==='simple'?'selected':'' }}>Simple</option>
                                <option value="double" {{ old('type_chambre')==='double'?'selected':'' }}>Double</option>
                                <option value="suite" {{ old('type_chambre')==='suite'?'selected':'' }}>Suite</option>
                                <option value="chambre_salon" {{ old('type_chambre')==='chambre_salon'?'selected':'' }}>Chambre salon</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Salle de bain privative</label>
                            <select name="salle_bain_privee" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('salle_bain_privee')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('salle_bain_privee')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ───── MAGASIN ───── -->
                <div class="carac-panel" data-type="magasin">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 60" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Vitrine sur rue</label>
                            <select name="vitrine" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('vitrine')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('vitrine')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Places de parking</label>
                            <input type="number" name="nb_parking" class="form-input" placeholder="Ex : 2" value="{{ old('nb_parking') }}" min="0">
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Quai de chargement</label>
                            <select name="quai_chargement" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('quai_chargement')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('quai_chargement')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Étage</label>
                            <input type="number" name="etage" class="form-input" placeholder="Ex : 0" value="{{ old('etage') }}" min="0">
                        </div>
                    </div>
                </div>

                <!-- ───── ENTREPÔT ───── -->
                <div class="carac-panel" data-type="entrepot">
                    <div class="grid-3">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 500" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Hauteur sous plafond (m)</label>
                            <input type="number" name="hauteur_plafond" class="form-input" placeholder="Ex : 6" value="{{ old('hauteur_plafond') }}" min="0" step="0.1">
                        </div>
                        <div class="field">
                            <label class="form-label">Accès poids lourds</label>
                            <select name="acces_poids_lourds" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('acces_poids_lourds')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('acces_poids_lourds')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Quai de chargement</label>
                            <select name="quai_chargement" class="form-select">
                                <option value="">—</option>
                                <option value="1" {{ old('quai_chargement')==='1'?'selected':'' }}>Oui</option>
                                <option value="0" {{ old('quai_chargement')==='0'?'selected':'' }}>Non</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Places de parking</label>
                            <input type="number" name="nb_parking" class="form-input" placeholder="Ex : 5" value="{{ old('nb_parking') }}" min="0">
                        </div>
                    </div>
                </div>

                <!-- ───── AUTRE ───── -->
                <div class="carac-panel" data-type="autre">
                    <div class="grid-2">
                        <div class="field">
                            <label class="form-label">Superficie (m²) <span class="req">*</span></label>
                            <input type="number" name="superficie" class="form-input" placeholder="Ex : 100" value="{{ old('superficie') }}" min="1" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Pièces</label>
                            <input type="number" name="nb_pieces" class="form-input" value="{{ old('nb_pieces',1) }}" min="1">
                        </div>
                    </div>
                    <div class="field">
                        <label class="form-label">Caractéristiques supplémentaires</label>
                        <textarea name="caracteristiques_autre" class="form-textarea" style="min-height:80px" placeholder="Décrivez les caractéristiques spécifiques de ce bien...">{{ old('caracteristiques_autre') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- ═══ LOCALISATION ═══ -->
            <div class="form-card">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-map-pin"></i></div>
                    <span class="card-title-text">Localisation</span>
                </div>
                <div class="grid-2">
                    <div class="field">
                        <label for="quartier" class="form-label">Quartier</label>
                        <input type="text" name="quartier" id="quartier" class="form-input" placeholder="Ex : Riviera 2" value="{{ old('quartier') }}">
                    </div>
                    <div class="field">
                        <label for="adresse" class="form-label">Adresse précise</label>
                        <input type="text" name="adresse" id="adresse" class="form-input" placeholder="Ex : Face à la pharmacie du stade" value="{{ old('adresse') }}">
                    </div>
                </div>
            </div>

            <!-- ═══ ÉQUIPEMENTS ═══ -->
            <div class="form-card">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-gear-six"></i></div>
                    <span class="card-title-text">Équipements & Commodités</span>
                </div>
                <div class="equip-grid">
                    @php
                    $equipements = [
                    'cuisine_equipee'=>'Cuisine équipée','climatisation'=>'Climatisation','chauffe_eau'=>'Chauffe-eau',
                    'parking'=>'Parking','garage'=>'Garage','piscine'=>'Piscine','jardin'=>'Jardin',
                    'terrasse'=>'Terrasse','balcon'=>'Balcon','gardien'=>'Gardien',
                    'videosurveillance'=>'Vidéosurveillance','porte_blindee'=>'Porte blindée',
                    'meuble'=>'Meublé','dressing'=>'Dressing','buanderie'=>'Buanderie',
                    'groupe_electrogene'=>'Groupe électrogène','reservoir_eau'=>'Réservoir eau','internet'=>'Internet / WiFi',
                    ];
                    @endphp
                    @foreach($equipements as $key => $label)
                    <label class="equip-check">
                        <input type="checkbox" name="equipements[]" value="{{ $key }}" {{ in_array($key,old('equipements',[]))?'checked':'' }}>
                        <span>{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- ═══ PHOTOS ═══ -->
            <div class="form-card">
                <div class="card-header">
                    <div class="card-icon"><i class="ph ph-camera"></i></div>
                    <span class="card-title-text">Photos</span>
                    <span class="card-badge">Maximum 10 photos</span>
                </div>
                <div class="upload-zone" id="uploadZone">
                    <div class="upload-icon"><i class="ph ph-cloud-arrow-up"></i></div>
                    <p class="upload-title">Cliquez ou glissez vos photos ici</p>
                    <p class="upload-hint">JPG, PNG, WEBP — 5 Mo max par photo</p>
                    <input type="file" name="images[]" id="imageInput" multiple accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="preview-grid" id="previewGrid"></div>
            </div>

            <!-- ═══ ACTIONS ═══ -->
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn btn-ghost"><i class="ph ph-x"></i> Annuler</a>
                <button type="submit" class="btn btn-primary"><i class="ph ph-paper-plane-tilt"></i> Publier le bien</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Navbar scroll ──
            window.addEventListener('scroll', () => {
                document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 10);
            });

            // ── Compteur caractères ──
            const desc = document.getElementById('description');
            const counter = document.getElementById('descCount');
            if (desc && counter) {
                counter.textContent = desc.value.length;
                desc.addEventListener('input', () => counter.textContent = desc.value.length);
            }

            // ═══════════════════════════════════════
            //  DYNAMIC CHARACTERISTICS PANELS
            // ═══════════════════════════════════════
            const typeLabels = {
                appartement: 'Appartement',
                maison: 'Maison',
                villa: 'Villa',
                terrain: 'Terrain',
                bureau: 'Bureau',
                commerce: 'Commerce',
                chambre: 'Chambre',
                magasin: 'Magasin',
                entrepot: 'Entrepôt',
                autre: 'Autre'
            };
            const typeIcons = {
                appartement: 'buildings',
                maison: 'house-line',
                villa: 'house',
                terrain: 'map-trifold',
                bureau: 'briefcase',
                commerce: 'storefront',
                chambre: 'door-open',
                magasin: 'shopping-bag',
                entrepot: 'warehouse',
                autre: 'dots-three'
            };

            function updateCaracteristiques() {
                const selected = document.querySelector('input[name="type_bien"]:checked');
                if (!selected) return;
                const type = selected.value;

                // Toggle panels
                document.querySelectorAll('.carac-panel').forEach(p => {
                    const isActive = p.dataset.type === type;
                    p.classList.toggle('active', isActive);
                    // Disable inputs in hidden panels so they don't interfere with validation
                    p.querySelectorAll('input, select, textarea').forEach(el => {
                        if (!isActive) {
                            el.setAttribute('data-was-required', el.required ? '1' : '0');
                            el.removeAttribute('required');
                        } else {
                            if (el.getAttribute('data-was-required') === '1') {
                                el.setAttribute('required', '');
                            }
                        }
                    });
                });

                // Update badge with animation
                const badge = document.getElementById('caracBadge');
                badge.style.opacity = '0';
                setTimeout(() => {
                    badge.innerHTML = '<i class="ph ph-' + typeIcons[type] + '"></i> ' + typeLabels[type];
                    badge.style.opacity = '1';
                }, 150);
            }

            // Initialize on load
            updateCaracteristiques();

            // Listen for type changes
            document.querySelectorAll('input[name="type_bien"]').forEach(radio => {
                radio.addEventListener('change', updateCaracteristiques);
            });

            // ── Upload preview ──
            const input = document.getElementById('imageInput');
            const grid = document.getElementById('previewGrid');
            let files = [];

            if (input) input.addEventListener('change', e => handleFiles(e.target.files));

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
                    btn.innerHTML = '<i class="ph ph-x"></i>';
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

            // ── Drag & drop ──
            const zone = document.getElementById('uploadZone');
            if (zone) {
                zone.addEventListener('dragover', e => {
                    e.preventDefault();
                    zone.classList.add('dragover');
                });
                zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
                zone.addEventListener('drop', e => {
                    e.preventDefault();
                    zone.classList.remove('dragover');
                    handleFiles(e.dataTransfer.files);
                });
            }
        });
    </script>
</body>

</html>