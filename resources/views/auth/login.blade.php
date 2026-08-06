<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion — ImmoPro</title>

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%23284b63'/%3E%3Cpath d='M8 24V12l8-5.5L24 12v12' stroke='white' stroke-width='2.2' fill='none'/%3E%3Crect x='13' y='17' width='6' height='7' rx='1' fill='white' opacity='.9'/%3E%3Ccircle cx='16' cy='13' r='2' fill='white' opacity='.6'/%3E%3C/svg%3E">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════════
           VARIABLES
           ═══════════════════════════════════════════ */
        :root {
            --primary: #284b63;
            --primary-light: #3a6a8a;
            --primary-dark: #1a3447;
            --primary-rgb: 40, 75, 99;
            --teal: #3c6e71;
            --teal-light: #4f8a8e;
            --teal-rgb: 60, 110, 113;
            --gold: #c9a84c;
            --gold-light: #e4c76e;
            --dark: #1a1a2e;
            --gray-900: #2d2d3f;
            --gray-700: #4a4a5c;
            --gray-500: #7a7a8c;
            --gray-300: #c4c4d0;
            --gray-100: #f0f0f5;
            --white: #ffffff;
            --bg: #f7f8fc;
            --success: #22c55e;
            --danger: #ef4444;
            --radius: 14px;
            --radius-sm: 10px;
            --radius-full: 9999px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ═══════════════════════════════════════════
           RESET
           ═══════════════════════════════════════════ */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--bg);
            color: var(--dark);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        ::selection {
            background: rgba(60, 110, 113, 0.15);
        }

        /* ═══════════════════════════════════════════
           LEFT PANEL — BRANDED
           ═══════════════════════════════════════════ */
        .left-panel {
            flex: 0 0 45%;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            overflow: hidden;
            background: linear-gradient(160deg, #1a3447 0%, #284b63 40%, #3c6e71 100%);
        }

        /* Grain texture */
        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-size: 128px 128px;
            pointer-events: none;
        }

        /* Grid pattern */
        .left-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.05);
            pointer-events: none;
        }

        .deco-circle.c1 {
            width: 500px;
            height: 500px;
            top: -180px;
            right: -120px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.02), transparent 70%);
        }

        .deco-circle.c2 {
            width: 350px;
            height: 350px;
            bottom: -100px;
            left: -80px;
        }

        .deco-circle.c3 {
            width: 180px;
            height: 180px;
            top: 20%;
            left: 10%;
            border-color: rgba(255, 255, 255, 0.04);
        }

        .left-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 420px;
        }

        .left-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            margin-bottom: 3rem;
        }

        .left-logo svg {
            width: 44px;
            height: 44px;
        }

        .left-logo span {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--white);
        }

        .left-logo span em {
            font-style: normal;
            color: var(--gold-light);
        }

        .left-visual {
            width: 90px;
            height: 90px;
            margin: 0 auto 2rem;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floatIcon 6s ease-in-out infinite;
        }

        @keyframes floatIcon {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .left-visual svg {
            width: 40px;
            height: 40px;
        }

        .left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .left-content h1 em {
            font-style: italic;
            color: var(--gold-light);
        }

        .left-content p {
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.95rem;
            line-height: 1.8;
            font-weight: 400;
        }

        /* Stats row */
        .stats-row {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .stat-item {
            text-align: center;
        }

        .stat-item .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
            display: block;
        }

        .stat-item .stat-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 0.25rem;
            display: block;
            font-weight: 600;
        }

        /* ═══════════════════════════════════════════
           RIGHT PANEL — FORM
           ═══════════════════════════════════════════ */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            background: var(--white);
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 440px;
            animation: formEnter 0.6s ease both;
        }

        @keyframes formEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .form-header {
            margin-bottom: 2.2rem;
        }

        .mobile-brand {
            display: none;
            align-items: center;
            gap: 0.55rem;
            margin-bottom: 2rem;
        }

        .mobile-brand svg {
            width: 34px;
            height: 34px;
        }

        .mobile-brand span {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
        }

        .mobile-brand span em {
            font-style: normal;
            color: var(--teal);
        }

        .form-header h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .form-header .subtitle {
            color: var(--gray-500);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .form-header .subtitle a {
            color: var(--teal);
            font-weight: 600;
        }

        .form-header .subtitle a:hover {
            color: var(--primary);
        }

        /* Alert / session messages */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 500;
            line-height: 1.5;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert svg {
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-info {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Social login */
        .social-row {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 1.5px solid var(--gray-100);
            border-radius: var(--radius-sm);
            background: var(--white);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-700);
            transition: var(--transition);
        }

        .social-btn:hover {
            border-color: var(--gray-300);
            background: var(--gray-100);
            transform: translateY(-1px);
        }

        .social-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-100);
        }

        .divider span {
            font-size: 0.78rem;
            color: var(--gray-500);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Form groups */
        .form-group {
            margin-bottom: 1.3rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-label a {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--teal);
        }

        .form-label a:hover {
            color: var(--primary);
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--gray-300);
            transition: var(--transition-fast);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            border: 1.5px solid var(--gray-100);
            border-radius: var(--radius-sm);
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            outline: none;
            transition: var(--transition);
        }

        .form-input::placeholder {
            color: var(--gray-300);
            font-weight: 400;
        }

        .form-input:hover {
            border-color: var(--gray-300);
        }

        .form-input:focus {
            border-color: var(--teal);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(60, 110, 113, 0.08);
        }

        .form-input:focus~.input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--teal);
        }

        .form-input.error {
            border-color: var(--danger);
            background: #fffbfb;
        }

        .form-input.error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
        }

        .error-text {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-top: 0.4rem;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--danger);
        }

        .error-text svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        /* Password toggle */
        .pwd-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: var(--gray-300);
            transition: var(--transition-fast);
        }

        .pwd-toggle:hover {
            color: var(--gray-700);
            background: var(--gray-100);
        }

        .pwd-toggle svg {
            width: 18px;
            height: 18px;
        }

        /* Checkbox row */
        .checkbox-row {
            display: flex;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            cursor: pointer;
            font-size: 0.84rem;
            color: var(--gray-700);
            user-select: none;
        }

        .custom-checkbox input {
            display: none;
        }

        .check-mark {
            width: 18px;
            height: 18px;
            border: 1.5px solid var(--gray-300);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: var(--transition-fast);
        }

        .check-mark svg {
            width: 11px;
            height: 11px;
            opacity: 0;
            transform: scale(0.5);
            transition: var(--transition-fast);
            color: white;
        }

        .custom-checkbox input:checked+.check-mark {
            background: linear-gradient(135deg, var(--primary), var(--teal));
            border-color: var(--primary);
        }

        .custom-checkbox input:checked+.check-mark svg {
            opacity: 1;
            transform: scale(1);
        }

        /* Submit */
        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            border: none;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: var(--white);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(var(--primary-rgb), 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            opacity: 0;
            transition: var(--transition);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(var(--primary-rgb), 0.4);
        }

        .btn-submit:hover::before {
            opacity: 1;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit span,
        .btn-submit svg {
            position: relative;
            z-index: 1;
        }

        .btn-submit svg {
            transition: var(--transition);
        }

        .btn-submit:hover svg {
            transform: translateX(3px);
        }

        /* ═══════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .left-panel {
                flex: 0 0 40%;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                min-height: 100vh;
                padding: 2rem 1.5rem;
            }

            .mobile-brand {
                display: flex;
            }

            .form-header {
                margin-bottom: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .social-row {
                flex-direction: column;
            }

            .form-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- ══════════════════════════════════════════
         LEFT BRANDED PANEL
         ══════════════════════════════════════════ -->
    <div class="left-panel">
        <div class="deco-circle c1"></div>
        <div class="deco-circle c2"></div>
        <div class="deco-circle c3"></div>

        <div class="left-content">
            <div class="left-logo">
                <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="44" height="44" rx="12" fill="rgba(255,255,255,0.1)" />
                    <path d="M12 30V17l10-7 10 7v13" stroke="rgba(255,255,255,0.85)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    <rect x="17" y="22" width="10" height="8" rx="1.5" fill="rgba(255,255,255,0.7)" />
                    <circle cx="22" cy="18.5" r="2.5" fill="rgba(255,255,255,0.4)" />
                </svg>
                <span>Immo<em>Pro</em></span>
            </div>

            <div class="left-visual">
                <svg viewBox="0 0 40 40" fill="none">
                    <rect x="5" y="18" width="30" height="18" rx="3" stroke="rgba(255,255,255,0.7)" stroke-width="2" fill="none" />
                    <path d="M20 4L5 18h30L20 4z" stroke="rgba(255,255,255,0.7)" stroke-width="2" fill="none" stroke-linejoin="round" />
                    <rect x="16" y="26" width="8" height="10" rx="1.5" fill="rgba(255,255,255,0.3)" />
                    <rect x="10" y="22" width="5" height="5" rx="1" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" fill="none" />
                    <rect x="25" y="22" width="5" height="5" rx="1" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" fill="none" />
                </svg>
            </div>

            <h1>Bon retour parmi <em>nous</em></h1>
            <p>Accédez à votre espace personnel, gérez vos biens et suivez vos transactions immobilières en toute simplicité.</p>

            <div class="stats-row">
                <div class="stat-item">
                    <span class="stat-number">2 500+</span>
                    <span class="stat-label">Biens listés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1 200+</span>
                    <span class="stat-label">Clients actifs</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Satisfaction</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         RIGHT FORM PANEL
         ══════════════════════════════════════════ -->
    <div class="right-panel">
        <div class="form-container">

            <!-- Mobile brand -->
            <a href="{{ url('/') }}" class="mobile-brand">
                <svg viewBox="0 0 36 36" fill="none">
                    <rect width="36" height="36" rx="9" fill="url(#mGrad)" />
                    <path d="M10 26V15l8-5.5 8 5.5v11" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    <rect x="14" y="19.5" width="8" height="6.5" rx="1.5" fill="#fff" opacity=".85" />
                    <circle cx="18" cy="16" r="2" fill="#fff" opacity=".5" />
                    <defs>
                        <linearGradient id="mGrad" x1="0" y1="0" x2="36" y2="36">
                            <stop stop-color="#284b63" />
                            <stop offset="1" stop-color="#3c6e71" />
                        </linearGradient>
                    </defs>
                </svg>
                <span>Immo<em>Pro</em></span>
            </a>

            <!-- Header -->
            <div class="form-header">
                <h2>Se connecter</h2>
                <p class="subtitle">Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>
            </div>

            <!-- Session messages -->
            @if (session('message'))
            <div class="alert alert-info">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6" />
                    <path d="M10 9v4M10 7h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6" />
                    <path d="M7 10l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6" />
                    <path d="M10 6.5v4M10 13h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <!-- Social login -->


            <div class="social-row">
                <a href="{{ route('google.redirect') }}" class="social-btn">
                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 18 18">
                            <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z" fill="#4285F4" />
                            <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z" fill="#34A853" />
                            <path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.997 8.997 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z" fill="#FBBC05" />
                            <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 6.29C4.672 4.163 6.656 2.58 9 3.58Z" fill="#EA4335" />
                        </svg>
                        <span>Google</span>
                    </button>
                </a>
                <a href="" class="social-btn">
                    <svg viewBox="0 0 18 18" fill="none">
                        <path d="M15 1H3a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6v-6.5H6.5V10H9V8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2 .1 2.3.1v2.5h-1.6c-1.2 0-1.5.6-1.5 1.5v1.8h2.8l-.4 2.5H13V17h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Z" fill="#1877F2" />
                    </svg>
                    <span>Facebook</span>
                </a>

            </div>

            <!-- Divider -->
            <div class="divider">
                <span>ou avec votre email</span>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                            placeholder="votreemail@exemple.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus>
                        <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                            <rect x="2" y="4" width="16" height="12" rx="2.5" stroke="currentColor" stroke-width="1.6" />
                            <path d="m2.5 5 7 5.5 7-5.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    @error('email')
                    <div class="error-text">
                        <svg viewBox="0 0 16 16" fill="none">
                            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                            <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        Mot de passe
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                        @endif
                    </label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                            placeholder="Votre mot de passe"
                            autocomplete="current-password">
                        <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                            <rect x="4" y="9" width="12" height="8" rx="2.5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M7 9V6.5a3 3 0 1 1 6 0V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            <circle cx="10" cy="13" r="1.2" fill="currentColor" />
                        </svg>
                        <button type="button" class="pwd-toggle" onclick="togglePassword()" aria-label="Afficher le mot de passe">
                            <svg viewBox="0 0 20 20" fill="none" id="eyeOpen">
                                <path d="M1.5 10S4.5 4 10 4s8.5 6 8.5 6-3 6-8.5 6S1.5 10 1.5 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <svg viewBox="0 0 20 20" fill="none" id="eyeClosed" style="display:none">
                                <path d="M2.5 2.5l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M8.5 7.5a3 3 0 0 0 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M1.5 10S4.5 4 10 4c1.5 0 2.8.4 4 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18.5 10S15.5 16 10 16c-1.5 0-2.8-.4-4-1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <div class="error-text">
                        <svg viewBox="0 0 16 16" fill="none">
                            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                            <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Remember me -->
                <div class="checkbox-row">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="remember">
                        <span class="check-mark">
                            <svg viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 6l2.5 2.5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        Se souvenir de moi
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <span>Accéder à mon espace</span>
                    <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                        <path d="M4 10h12M12 6l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }

        // Subtle entrance animation for form groups
        document.querySelectorAll('.form-group, .social-row, .divider, .btn-submit, .checkbox-row').forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(12px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 150 + i * 70);
        });
    </script>

</body>

</html>