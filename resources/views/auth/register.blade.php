<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription — ImmoPro</title>

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
            --warning: #f59e0b;
            --radius: 14px;
            --radius-sm: 10px;
            --radius-lg: 18px;
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
            flex: 0 0 42%;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 3.5rem;
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
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            border-color: rgba(255, 255, 255, 0.04);
        }

        .left-content {
            position: relative;
            z-index: 2;
            max-width: 440px;
        }

        .left-logo {
            display: flex;
            align-items: center;
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

        .left-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.85rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-full);
            font-size: 0.72rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1.5rem;
        }

        .left-badge svg {
            width: 14px;
            height: 14px;
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

        .left-content>p {
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
        }

        /* Features list */
        .features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .features-list li {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.88rem;
            font-weight: 500;
        }

        .feat-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feat-icon svg {
            width: 16px;
            height: 16px;
            color: var(--gold-light);
        }

        /* Stats row */
        .stats-row {
            display: flex;
            gap: 2rem;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .stat-item .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--white);
            display: block;
        }

        .stat-item .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 0.2rem;
            display: block;
            font-weight: 600;
        }

        /* ═══════════════════════════════════════════
           RIGHT PANEL — FORM
           ═══════════════════════════════════════════ */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 2.5rem;
            padding-top: 2rem;
            overflow-y: auto;
            background: var(--white);
        }

        .form-container {
            width: 100%;
            max-width: 520px;
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

        /* Mobile brand */
        .mobile-brand {
            display: none;
            align-items: center;
            gap: 0.55rem;
            margin-bottom: 1.8rem;
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

        /* Header */
        .form-header {
            margin-bottom: 1.8rem;
        }

        .form-header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.45rem;
            letter-spacing: -0.02em;
        }

        .form-header .subtitle {
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        .form-header .subtitle a {
            color: var(--teal);
            font-weight: 600;
        }

        .form-header .subtitle a:hover {
            color: var(--primary);
        }

        /* Alerts */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.84rem;
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

        /* ═══════════════════════════════════════════
           ROLE SELECTOR
           ═══════════════════════════════════════════ */
        .section-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.55rem;
        }

        .role-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.65rem;
            margin-bottom: 1.5rem;
        }

        .role-option {
            position: relative;
        }

        .role-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .role-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.55rem;
            padding: 1.1rem 0.5rem;
            border: 1.5px solid var(--gray-100);
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            background: var(--bg);
        }

        .role-card:hover {
            border-color: var(--gray-300);
            background: var(--white);
            transform: translateY(-1px);
        }

        .role-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--white);
            border: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .role-icon svg {
            width: 18px;
            height: 18px;
            color: var(--gray-500);
            transition: var(--transition);
        }

        .role-card .role-name {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--gray-700);
            transition: var(--transition);
        }

        .role-card .role-desc {
            font-size: 0.68rem;
            color: var(--gray-500);
            font-weight: 400;
            line-height: 1.3;
            margin-top: -0.2rem;
        }

        .role-option input:checked+.role-card {
            border-color: var(--teal);
            background: rgba(60, 110, 113, 0.04);
            box-shadow: 0 0 0 4px rgba(60, 110, 113, 0.06);
        }

        .role-option input:checked+.role-card .role-icon {
            background: linear-gradient(135deg, var(--primary), var(--teal));
            border-color: transparent;
        }

        .role-option input:checked+.role-card .role-icon svg {
            color: white;
        }

        .role-option input:checked+.role-card .role-name {
            color: var(--teal);
        }

        /* ═══════════════════════════════════════════
           CONDITIONAL FIELDS
           ═══════════════════════════════════════════ */
        .conditional-fields {
            display: none;
            animation: fadeUp 0.35s ease;
        }

        .conditional-fields.active {
            display: block;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ═══════════════════════════════════════════
           FORM ELEMENTS
           ═══════════════════════════════════════════ */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.85rem;
        }

        .form-group {
            margin-bottom: 1.15rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.45rem;
        }

        .form-label .optional {
            color: var(--gray-300);
            font-weight: 400;
            font-size: 0.78rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.9rem;
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
            padding: 0.75rem 1rem 0.75rem 2.65rem;
            border: 1.5px solid var(--gray-100);
            border-radius: var(--radius-sm);
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.88rem;
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

        .form-input.no-icon {
            padding-left: 1rem;
        }

        .form-input.error {
            border-color: var(--danger);
            background: #fffbfb;
        }

        .form-input.error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
        }

        /* Error text */
        .error-text {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin-top: 0.35rem;
            font-size: 0.77rem;
            font-weight: 500;
            color: var(--danger);
        }

        .error-text svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        /* Password toggle */
        .pwd-toggle {
            position: absolute;
            right: 0.65rem;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            color: var(--gray-300);
            transition: var(--transition-fast);
        }

        .pwd-toggle:hover {
            color: var(--gray-700);
            background: var(--gray-100);
        }

        .pwd-toggle svg {
            width: 17px;
            height: 17px;
        }

        /* Password strength */
        .pwd-strength {
            display: flex;
            gap: 4px;
            margin-top: 0.5rem;
        }

        .pwd-strength .bar {
            flex: 1;
            height: 3px;
            border-radius: 3px;
            background: var(--gray-100);
            transition: var(--transition);
        }

        .pwd-strength-text {
            font-size: 0.72rem;
            font-weight: 600;
            margin-top: 0.3rem;
            transition: var(--transition);
        }

        /* ═══════════════════════════════════════════
           TERMS CHECKBOX
           ═══════════════════════════════════════════ */
        .terms-row {
            margin-bottom: 1.5rem;
        }

        .custom-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            cursor: pointer;
            font-size: 0.82rem;
            color: var(--gray-700);
            user-select: none;
            line-height: 1.5;
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
            margin-top: 2px;
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

        .custom-checkbox a {
            color: var(--teal);
            font-weight: 600;
        }

        .custom-checkbox a:hover {
            text-decoration: underline;
        }

        /* ═══════════════════════════════════════════
           SUBMIT BUTTON
           ═══════════════════════════════════════════ */
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
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

        /* Footer text */
        .form-footer {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.75rem;
            color: var(--gray-500);
            line-height: 1.6;
        }

        /* ═══════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .left-panel {
                flex: 0 0 38%;
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
                padding: 1.5rem;
            }

            .mobile-brand {
                display: flex;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .role-selector {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .role-card {
                flex-direction: row;
                padding: 0.85rem 1rem;
                text-align: left;
                gap: 0.75rem;
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
                <svg viewBox="0 0 44 44" fill="none">
                    <rect width="44" height="44" rx="12" fill="rgba(255,255,255,0.1)" />
                    <path d="M12 30V17l10-7 10 7v13" stroke="rgba(255,255,255,0.85)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    <rect x="17" y="22" width="10" height="8" rx="1.5" fill="rgba(255,255,255,0.7)" />
                    <circle cx="22" cy="18.5" r="2.5" fill="rgba(255,255,255,0.4)" />
                </svg>
                <span>Immo<em>Pro</em></span>
            </div>

            <div class="left-badge">
                <svg viewBox="0 0 16 16" fill="none">
                    <path d="M8 1l2 3.5 4 .6-2.9 2.8.7 4L8 10l-3.8 1.9.7-4L2 5.1l4-.6L8 1z" fill="currentColor" />
                </svg>
                Plateforme immobilière n°1
            </div>

            <h1>Créez votre espace <em>professionnel</em></h1>
            <p>Rejoignez des milliers d'utilisateurs qui font confiance à ImmoPro pour gérer leurs biens immobiliers.</p>

            <ul class="features-list">
                <li>
                    <span class="feat-icon">
                        <svg viewBox="0 0 16 16" fill="none">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Recherche avancée avec filtres intelligents
                </li>
                <li>
                    <span class="feat-icon">
                        <svg viewBox="0 0 16 16" fill="none">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Contact direct avec les propriétaires
                </li>
                <li>
                    <span class="feat-icon">
                        <svg viewBox="0 0 16 16" fill="none">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Tableau de bord complet pour vos annonces
                </li>
                <li>
                    <span class="feat-icon">
                        <svg viewBox="0 0 16 16" fill="none">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Alertes personnalisées en temps réel
                </li>
            </ul>

            <div class="stats-row">
                <div class="stat-item">
                    <span class="stat-number">2 500+</span>
                    <span class="stat-label">Biens listés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1 200+</span>
                    <span class="stat-label">Membres actifs</span>
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
                    <rect width="36" height="36" rx="9" fill="url(#mGrad2)" />
                    <path d="M10 26V15l8-5.5 8 5.5v11" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    <rect x="14" y="19.5" width="8" height="6.5" rx="1.5" fill="#fff" opacity=".85" />
                    <circle cx="18" cy="16" r="2" fill="#fff" opacity=".5" />
                    <defs>
                        <linearGradient id="mGrad2" x1="0" y1="0" x2="36" y2="36">
                            <stop stop-color="#284b63" />
                            <stop offset="1" stop-color="#3c6e71" />
                        </linearGradient>
                    </defs>
                </svg>
                <span>Immo<em>Pro</em></span>
            </a>

            <!-- Header -->
            <div class="form-header">
                <h2>Créer un compte</h2>
                <p class="subtitle">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>

            <!-- Alerts -->
            @if (session('message'))
            <div class="alert alert-info">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6" />
                    <path d="M10 9v4M10 7h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6" />
                    <path d="M10 6.5v4M10 13h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                </svg>
                <span>Veuillez corriger les erreurs ci-dessous.</span>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- ═══ ROLE SELECTOR ═══ -->
                <span class="section-label">Type de compte</span>
                <div class="role-selector">
                    <label class="role-option">
                        <input type="radio" name="role" value="client"
                            {{ old('role', 'client') == 'client' ? 'checked' : '' }}
                            onchange="toggleRoleFields()">
                        <div class="role-card">
                            <div class="role-icon">
                                <svg viewBox="0 0 20 20" fill="none">
                                    <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.6" />
                                    <path d="M3.5 17c0-3.6 2.9-6.5 6.5-6.5s6.5 2.9 6.5 6.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </div>
                            <span class="role-name">Client</span>
                            <span class="role-desc">Acheteur / Locataire</span>
                        </div>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="proprietaire"
                            {{ old('role') == 'proprietaire' ? 'checked' : '' }}
                            onchange="toggleRoleFields()">
                        <div class="role-card">
                            <div class="role-icon">
                                <svg viewBox="0 0 20 20" fill="none">
                                    <path d="M10 2L2 8v10h6v-5h4v5h6V8L10 2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                </svg>
                            </div>
                            <span class="role-name">Propriétaire</span>
                            <span class="role-desc">Gérer mes biens</span>
                        </div>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="agence"
                            {{ old('role') == 'agence' ? 'checked' : '' }}
                            onchange="toggleRoleFields()">
                        <div class="role-card">
                            <div class="role-icon">
                                <svg viewBox="0 0 20 20" fill="none">
                                    <rect x="2" y="7" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.6" fill="none" />
                                    <path d="M6 7V5a4 4 0 1 1 8 0v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                    <path d="M2 11h16" stroke="currentColor" stroke-width="1.2" stroke-dasharray="2 2" />
                                    <rect x="8" y="12" width="4" height="6" rx="1" fill="currentColor" opacity=".2" />
                                </svg>
                            </div>
                            <span class="role-name">Agence</span>
                            <span class="role-desc">Espace professionnel</span>
                        </div>
                    </label>
                </div>

                <!-- ═══ PERSON FIELDS ═══ -->
                <div id="person-fields" class="conditional-fields active">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="nom">Nom</label>
                            <div class="input-wrapper">
                                <input type="text" id="nom" name="nom"
                                    class="form-input {{ $errors->has('nom') ? 'error' : '' }}"
                                    placeholder="Votre nom" value="{{ old('nom') }}">
                                <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                    <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.6" />
                                    <path d="M3.5 17c0-3.6 2.9-6.5 6.5-6.5s6.5 2.9 6.5 6.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </div>
                            @error('nom')
                            <div class="error-text">
                                <svg viewBox="0 0 16 16" fill="none">
                                    <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                                    <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="prenom">Prénom</label>
                            <div class="input-wrapper">
                                <input type="text" id="prenom" name="prenom"
                                    class="form-input {{ $errors->has('prenom') ? 'error' : '' }}"
                                    placeholder="Votre prénom" value="{{ old('prenom') }}">
                                <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                    <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.6" />
                                    <path d="M3.5 17c0-3.6 2.9-6.5 6.5-6.5s6.5 2.9 6.5 6.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </div>
                            @error('prenom')
                            <div class="error-text">
                                <svg viewBox="0 0 16 16" fill="none">
                                    <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                                    <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ═══ AGENCE FIELDS ═══ -->
                <div id="agence-fields" class="conditional-fields">
                    <div class="form-group">
                        <label class="form-label" for="nom_agence">Nom de l'agence</label>
                        <div class="input-wrapper">
                            <input type="text" id="nom_agence" name="nom_agence"
                                class="form-input {{ $errors->has('nom_agence') ? 'error' : '' }}"
                                placeholder="Ex: Immobilier Plus" value="{{ old('nom_agence') }}">
                            <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                <rect x="3" y="7" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.6" fill="none" />
                                <path d="M7 7V5a3 3 0 1 1 6 0v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        </div>
                        @error('nom_agence')
                        <div class="error-text">
                            <svg viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                                <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nom_responsable">Nom du responsable</label>
                        <div class="input-wrapper">
                            <input type="text" id="nom_responsable" name="nom_responsable"
                                class="form-input {{ $errors->has('nom_responsable') ? 'error' : '' }}"
                                placeholder="Nom complet" value="{{ old('nom_responsable') }}">
                            <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.6" />
                                <path d="M3.5 17c0-3.6 2.9-6.5 6.5-6.5s6.5 2.9 6.5 6.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        </div>
                        @error('nom_responsable')
                        <div class="error-text">
                            <svg viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                                <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- ═══ TELEPHONE ═══ -->
                <div class="form-group">
                    <label class="form-label" for="telephone">
                        Téléphone
                        <span class="optional">optionnel</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="tel" id="telephone" name="telephone"
                            class="form-input {{ $errors->has('telephone') ? 'error' : '' }}"
                            placeholder="+225 07 00 00 00 00" value="{{ old('telephone') }}">
                        <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                            <rect x="5" y="1" width="10" height="18" rx="2.5" stroke="currentColor" stroke-width="1.6" fill="none" />
                            <circle cx="10" cy="15" r="1" fill="currentColor" />
                        </svg>
                    </div>
                    @error('telephone')
                    <div class="error-text">
                        <svg viewBox="0 0 16 16" fill="none">
                            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4" />
                            <path d="M8 5v3.5M8 10.5h.01" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- ═══ EMAIL ═══ -->
                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email"
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                            placeholder="votreemail@exemple.com" value="{{ old('email') }}">
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

                <!-- ═══ PASSWORD ═══ -->
                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password"
                            class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                            placeholder="Minimum 8 caractères"
                            oninput="checkPasswordStrength(this.value)">
                        <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                            <rect x="4" y="9" width="12" height="8" rx="2.5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M7 9V6.5a3 3 0 1 1 6 0V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            <circle cx="10" cy="13" r="1.2" fill="currentColor" />
                        </svg>
                        <button type="button" class="pwd-toggle" onclick="togglePassword('password', this)" aria-label="Afficher le mot de passe">
                            <svg viewBox="0 0 20 20" fill="none" class="eye-open">
                                <path d="M1.5 10S4.5 4 10 4s8.5 6 8.5 6-3 6-8.5 6S1.5 10 1.5 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <svg viewBox="0 0 20 20" fill="none" class="eye-closed" style="display:none">
                                <path d="M2.5 2.5l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M8.5 7.5a3 3 0 0 0 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M1.5 10S4.5 4 10 4c1.5 0 2.8.4 4 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18.5 10S15.5 16 10 16c-1.5 0-2.8-.4-4-1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="pwd-strength" id="strengthBars">
                        <div class="bar" id="bar1"></div>
                        <div class="bar" id="bar2"></div>
                        <div class="bar" id="bar3"></div>
                        <div class="bar" id="bar4"></div>
                    </div>
                    <div class="pwd-strength-text" id="strengthText"></div>
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

                <!-- ═══ CONFIRM PASSWORD ═══ -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-input"
                            placeholder="Retapez votre mot de passe">
                        <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                            <rect x="4" y="9" width="12" height="8" rx="2.5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M7 9V6.5a3 3 0 1 1 6 0V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            <path d="m8 13 1.5 1.5L12.5 11.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <button type="button" class="pwd-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Afficher">
                            <svg viewBox="0 0 20 20" fill="none" class="eye-open">
                                <path d="M1.5 10S4.5 4 10 4s8.5 6 8.5 6-3 6-8.5 6S1.5 10 1.5 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <svg viewBox="0 0 20 20" fill="none" class="eye-closed" style="display:none">
                                <path d="M2.5 2.5l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M8.5 7.5a3 3 0 0 0 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M1.5 10S4.5 4 10 4c1.5 0 2.8.4 4 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18.5 10S15.5 16 10 16c-1.5 0-2.8-.4-4-1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- ═══ TERMS ═══ -->
                <div class="terms-row">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }}>
                        <span class="check-mark">
                            <svg viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 6l2.5 2.5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        J'accepte les <a href="#">&nbsp;conditions générales d'utilisation</a>&nbsp;et la <a href="#">&nbsp;politique de confidentialité</a>
                    </label>
                </div>

                <!-- ═══ SUBMIT ═══ -->
                <button type="submit" class="btn-submit">
                    <span>Créer mon compte</span>
                    <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                        <path d="M4 10h12M12 6l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>

            <div class="form-footer">
                En créant un compte, vous acceptez nos conditions d'utilisation.
            </div>
        </div>
    </div>

    <script>
        // ═══ TOGGLE ROLE FIELDS ═══
        function toggleRoleFields() {
            const checked = document.querySelector('input[name="role"]:checked');
            if (!checked) return;

            const role = checked.value;
            const personFields = document.getElementById('person-fields');
            const agenceFields = document.getElementById('agence-fields');

            personFields.classList.remove('active');
            agenceFields.classList.remove('active');

            if (role === 'agence') {
                agenceFields.classList.add('active');
            } else {
                personFields.classList.add('active');
            }
        }

        // ═══ TOGGLE PASSWORD VISIBILITY ═══
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');

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

        // ═══ PASSWORD STRENGTH CHECKER ═══
        function checkPasswordStrength(password) {
            let score = 0;
            const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
            const text = document.getElementById('strengthText');

            if (password.length === 0) {
                bars.forEach(b => b.style.background = 'var(--gray-100)');
                text.textContent = '';
                return;
            }

            if (password.length >= 6) score++;
            if (password.length >= 10) score++;
            if (/[A-Z]/.test(password) && /[a-z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            const levels = [{
                    color: '#ef4444',
                    label: 'Faible'
                },
                {
                    color: '#f59e0b',
                    label: 'Moyen'
                },
                {
                    color: '#3c6e71',
                    label: 'Bon'
                },
                {
                    color: '#22c55e',
                    label: 'Excellent'
                }
            ];

            const level = Math.min(score, 4) - 1;
            const activeBars = Math.max(1, Math.min(score, 4));

            bars.forEach((b, i) => {
                if (i < activeBars) {
                    b.style.background = levels[Math.max(0, level)].color;
                } else {
                    b.style.background = 'var(--gray-100)';
                }
            });

            if (level >= 0) {
                text.textContent = levels[Math.max(0, level)].label;
                text.style.color = levels[Math.max(0, level)].color;
            }
        }

        // ═══ ENTRANCE ANIMATION ═══
        document.querySelectorAll('.form-group, .role-selector, .terms-row, .btn-submit').forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(10px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 + i * 60);
        });

        // ═══ DISABLE HIDDEN FIELDS ON SUBMIT ═══
        document.getElementById('registerForm').addEventListener('submit', function() {
            const role = document.querySelector('input[name="role"]:checked')?.value;
            const personInputs = document.getElementById('person-fields').querySelectorAll('input');
            const agenceInputs = document.getElementById('agence-fields').querySelectorAll('input');

            // Réactiver tous d'abord
            personInputs.forEach(i => i.disabled = false);
            agenceInputs.forEach(i => i.disabled = false);

            // Puis désactiver ceux qui sont cachés
            if (role === 'agence') {
                personInputs.forEach(i => i.disabled = true);
            } else {
                agenceInputs.forEach(i => i.disabled = true);
            }
        });
        // Init
        document.addEventListener('DOMContentLoaded', toggleRoleFields);
    </script>

</body>

</html>