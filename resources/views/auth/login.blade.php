<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Connexion à votre espace ImmoPro — Plateforme immobilière de référence à Korhogo et en Côte d'Ivoire.">
    <title>Connexion — ImmoPro</title>

    <!-- Favicon SVG solide (Zéro Dégradé) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%231B3A5C'/%3E%3Cpath d='M8 23V12.5L16 6.5l8 6V23' stroke='white' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3Crect x='13' y='16' width='6' height='7' rx='1' fill='%235A6B7B'/%3E%3Ccircle cx='16' cy='12' r='2' fill='%23E8734A'/%3E%3C/svg%3E">

    <!-- Typographie Modulaire : Plus Jakarta Sans (Corps/UI), Playfair Display (Titres/Éditorial), JetBrains Mono (Données tabulaires) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  TOKENS SÉMANTIQUES & SURFACES MATÉRIELLES — STANDARD SKILL_DESIGN   ║
           ║  POLITIQUE STRICTE ZÉRO DÉGRADÉ (NO-GRADIENT MANDATE)                ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        :root {
            /* Surfaces physiques solides (4 étages de luminance) */
            --surface-sunken: #F8F9FA;
            --surface-base: #FFFFFF;
            --surface-raised: #FFFFFF;
            --surface-overlay: #FFFFFF;

            /* Matériaux sombres solides (Architecture Bleu Marine) */
            --surface-dark-sunken: #0E1F32;
            --surface-dark-base: #1B3A5C;
            --surface-dark-raised: #244C78;
            --surface-dark-card: #152E4A;

            /* Bordures structurelles Hairline (1px solide) */
            --border-subtle: #E8ECF0;
            --border-default: #DCE1E7;
            --border-strong: #BAC3CD;
            --border-dark: #2B527E;
            --border-dark-subtle: #1F3F64;

            /* Typographie & Contraste matériel */
            --text-primary: #182230;
            --text-secondary: #475467;
            --text-muted: #667085;
            --text-inverse: #F8F9FA;
            --text-inverse-muted: #B4C4D4;

            /* Accents & Identité Visuelle solide */
            --primary: #1B3A5C;
            --primary-hover: #132A43;
            --secondary: #5A6B7B;
            --secondary-hover: #475562;
            --accent-cta: #E8734A;
            --accent-cta-hover: #D55F35;
            --accent-cta-active: #BF5129;

            /* États Sémantiques solides */
            --status-success-bg: #EBF8F2;
            --status-success-text: #196C45;
            --status-success-border: #A3E3C1;

            --status-danger-bg: #FEF3F2;
            --status-danger-text: #B42318;
            --status-danger-border: #FECDCA;

            --status-info-bg: #EFF6FF;
            --status-info-text: #1E40AF;
            --status-info-border: #BFDBFE;

            /* Ombres Physiques Multicouches (sans diffusion artificielle) */
            --shadow-raised:
                0 1px 2px -1px rgba(24, 34, 48, 0.06),
                0 1px 3px 0 rgba(24, 34, 48, 0.04);
            --shadow-card:
                0 2px 4px -1px rgba(24, 34, 48, 0.05),
                0 8px 18px -3px rgba(24, 34, 48, 0.07);
            --shadow-overlay:
                0 6px 12px -2px rgba(24, 34, 48, 0.06),
                0 16px 32px -4px rgba(24, 34, 48, 0.1);

            /* Rayons de courbure concentriques */
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --radius-full: 9999px;

            /* Timing physique calibré (Spring ease-out-expo) */
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
            --duration-fast: 140ms;
            --duration-normal: 220ms;
        }

        /* ═══════════════════════════════════════════
           RESET & GLOBALS
           ═══════════════════════════════════════════ */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 0.9375rem;
            line-height: 1.5;
            color: var(--text-primary);
            background-color: var(--surface-sunken);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: color var(--duration-fast) var(--ease-out), opacity var(--duration-fast) var(--ease-out);
        }

        button, input {
            font-family: inherit;
            color: inherit;
        }

        .tabular-nums {
            font-variant-numeric: tabular-nums;
            font-family: 'JetBrains Mono', 'Plus Jakarta Sans', monospace;
        }

        /* ═══════════════════════════════════════════
           LAYOUT PRINCIPAL : SPLIT VIEW
           ═══════════════════════════════════════════ */
        .auth-split-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ── Panneau Gauche : Showcase Architectural ── */
        .auth-showcase-panel {
            flex: 0 0 45%;
            position: relative;
            background-color: var(--surface-dark-base);
            border-inline-end: 1px solid var(--border-dark);
            color: var(--text-inverse);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: clamp(2rem, 4vw, 3.5rem);
            overflow: hidden;
        }

        /* Arrière-plan architectural géométrique solide (Zéro Dégradé) */
        .showcase-grid-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-size: 32px 32px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='none'%3E%3Cpath d='M32 0v32M0 32h32' stroke='%23FFFFFF' stroke-width='1' opacity='0.08'/%3E%3C/svg%3E");
        }

        .showcase-header {
            position: relative;
            z-index: 2;
        }

        .showcase-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-monogram {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-md);
            background-color: var(--surface-dark-raised);
            border: 1px solid var(--border-dark);
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.15), var(--shadow-raised);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .brand-title-group {
            display: flex;
            flex-direction: column;
        }

        .brand-logo-text {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.625rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: #FFFFFF;
            line-height: 1.1;
        }

        .brand-logo-text em {
            font-style: normal;
            color: var(--accent-cta);
        }

        .brand-subtitle-tag {
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-inverse-muted);
            margin-top: 0.2rem;
        }

        /* Contenu central du showcase */
        .showcase-body {
            position: relative;
            z-index: 2;
            margin-block: 2.5rem;
            max-width: 480px;
        }

        .showcase-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 0.875rem;
            background-color: var(--surface-dark-card);
            border: 1px solid var(--border-dark);
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-inverse-muted);
            letter-spacing: 0.04em;
            margin-bottom: 1.5rem;
        }

        .showcase-pill i {
            color: var(--accent-cta);
        }

        .showcase-heading {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(2rem, 3vw, 2.625rem);
            font-weight: 700;
            line-height: 1.2;
            color: #FFFFFF;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .showcase-heading em {
            font-style: italic;
            color: var(--accent-cta);
        }

        .showcase-description {
            font-size: 0.9375rem;
            line-height: 1.65;
            color: var(--text-inverse-muted);
            margin-bottom: 2rem;
        }

        /* Carte d'illustration architecturale vectorielle (Zéro Dégradé) */
        .showcase-blueprint-card {
            background-color: var(--surface-dark-card);
            border: 1px solid var(--border-dark);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.08), var(--shadow-raised);
            margin-bottom: 2rem;
        }

        .blueprint-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.75rem;
            color: var(--text-inverse-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .blueprint-header .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            color: #4ADE80;
        }

        .blueprint-header .live-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #4ADE80;
        }

        .blueprint-wireframe {
            width: 100%;
            height: 110px;
            border: 1px dashed var(--border-dark);
            border-radius: var(--radius-sm);
            background-color: var(--surface-dark-sunken);
            padding: 0.75rem;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 0.5rem;
            position: relative;
        }

        .blueprint-room {
            border: 1px solid var(--border-dark);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem;
            font-size: 0.6875rem;
            color: var(--text-inverse-muted);
            background-color: var(--surface-dark-card);
        }

        .blueprint-room.master {
            grid-row: span 2;
        }

        .blueprint-room-tag {
            font-weight: 600;
            color: #FFFFFF;
        }

        /* Métriques tabulaires certifiées */
        .showcase-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-dark-subtle);
        }

        .showcase-stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.625rem;
            font-weight: 700;
            color: #FFFFFF;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-inverse-muted);
            font-weight: 500;
            margin-top: 0.25rem;
        }

        /* Pied du showcase */
        .showcase-footer {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-inverse-muted);
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-dark-subtle);
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .security-badge i {
            color: #4ADE80;
        }

        /* ── Panneau Droit : Formulaire Interactif ── */
        .auth-form-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: var(--surface-sunken);
            padding: clamp(1.5rem, 4vw, 3.5rem);
            position: relative;
        }

        .auth-top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 460px;
            margin-inline: auto;
            margin-bottom: 1.5rem;
        }

        .nav-back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-secondary);
            padding: 0.5rem 0.875rem;
            border-radius: var(--radius-sm);
            background-color: var(--surface-base);
            border: 1px solid var(--border-default);
            box-shadow: var(--shadow-raised);
            transition: background-color var(--duration-fast) var(--ease-out), border-color var(--duration-fast) var(--ease-out), transform var(--duration-fast) var(--ease-out);
        }

        .nav-back-link:hover {
            color: var(--text-primary);
            border-color: var(--border-strong);
            transform: translateY(-1px);
        }

        .nav-back-link:active {
            transform: translateY(1px);
        }

        .nav-back-link:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px var(--surface-sunken), 0 0 0 4px var(--primary);
        }

        .auth-card-container {
            width: 100%;
            max-width: 460px;
            margin-inline: auto;
            background-color: var(--surface-base);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: clamp(1.75rem, 3.5vw, 2.5rem);
            position: relative;
        }

        /* Marque mobile visible uniquement sur petits écrans */
        .mobile-brand-header {
            display: none;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-subtle);
        }

        .mobile-brand-header .brand-monogram {
            width: 38px;
            height: 38px;
            font-size: 1.1rem;
            background-color: var(--surface-dark-base);
        }

        .mobile-brand-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .mobile-brand-title em {
            font-style: normal;
            color: var(--accent-cta);
        }

        .form-headline-group {
            margin-bottom: 1.75rem;
        }

        .form-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(1.5rem, 2.5vw, 1.875rem);
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 0.375rem;
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .form-subtitle a {
            color: var(--primary);
            font-weight: 600;
            border-bottom: 1px solid transparent;
        }

        .form-subtitle a:hover {
            color: var(--accent-cta);
            border-bottom-color: var(--accent-cta);
        }

        /* ── Alertes & Notifications d'état ── */
        .alert-box {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.8125rem;
            line-height: 1.45;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
        }

        .alert-box i {
            font-size: 1rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-box.info {
            background-color: var(--status-info-bg);
            border-color: var(--status-info-border);
            color: var(--status-info-text);
        }

        .alert-box.success {
            background-color: var(--status-success-bg);
            border-color: var(--status-success-border);
            color: var(--status-success-text);
        }

        .alert-box.error {
            background-color: var(--status-danger-bg);
            border-color: var(--status-danger-border);
            color: var(--status-danger-text);
        }

        /* ── Bouton Social (Google OAuth) ── */
        .social-auth-action {
            margin-bottom: 1.5rem;
        }

        .btn-social {
            width: 100%;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            background-color: var(--surface-base);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: var(--shadow-raised);
            cursor: pointer;
            transition: background-color var(--duration-fast) var(--ease-out),
                        border-color var(--duration-fast) var(--ease-out),
                        transform var(--duration-fast) var(--ease-out),
                        box-shadow var(--duration-fast) var(--ease-out);
        }

        .btn-social:hover {
            background-color: var(--surface-sunken);
            border-color: var(--border-strong);
            transform: translateY(-1px);
            box-shadow: var(--shadow-card);
        }

        .btn-social:active {
            transform: translateY(1px);
            background-color: var(--border-subtle);
        }

        .btn-social:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px var(--primary);
        }

        .btn-social svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Séparateur horizontal 1px solide */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--border-default);
        }

        .auth-divider span {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
        }

        /* ── Composants de Formulaire & 8 États ── */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .field-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.4375rem;
        }

        .field-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-primary);
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .field-label .required-mark {
            color: var(--status-danger-text);
        }

        .forgot-link {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .forgot-link:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .input-control-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-lead-icon {
            position: absolute;
            inset-inline-start: 0.875rem;
            width: 18px;
            height: 18px;
            color: var(--text-muted);
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: color var(--duration-fast) var(--ease-out);
        }

        .form-input-text {
            width: 100%;
            height: 44px; /* Zone tactile 44px conforme accessibilité mobile */
            padding-inline-start: 2.625rem;
            padding-inline-end: 2.625rem;
            font-size: 1rem; /* 16px strict pour prévenir l'auto-zoom iOS */
            line-height: 1.5;
            color: var(--text-primary);
            background-color: var(--surface-base);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-sm);
            box-shadow: inset 0 1px 1px 0 rgba(24, 34, 48, 0.03);
            transition: border-color var(--duration-fast) var(--ease-out),
                        box-shadow var(--duration-fast) var(--ease-out),
                        background-color var(--duration-fast) var(--ease-out);
        }

        @media (min-width: 768px) {
            .form-input-text {
                font-size: 0.875rem;
            }
        }

        .form-input-text::placeholder {
            color: var(--text-muted);
            opacity: 0.85;
            font-weight: 400;
        }

        /* 8 États de l'Input */
        .form-input-text:hover {
            border-color: var(--border-strong);
        }

        .form-input-text:focus {
            outline: none;
            border-color: var(--primary);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px rgba(27, 58, 92, 0.18);
        }

        .form-input-text:focus + .input-lead-icon,
        .input-control-wrapper:focus-within .input-lead-icon {
            color: var(--primary);
        }

        .form-input-text.has-error {
            border-color: var(--status-danger-border);
            background-color: var(--status-danger-bg);
            color: var(--status-danger-text);
        }

        .form-input-text.has-error:focus {
            border-color: var(--status-danger-text);
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px rgba(180, 35, 24, 0.15);
        }

        .form-input-text:disabled {
            background-color: var(--surface-sunken);
            border-color: var(--border-subtle);
            color: var(--text-muted);
            cursor: not-allowed;
            opacity: 0.55;
        }

        /* Bouton toggle mot de passe */
        .btn-toggle-password {
            position: absolute;
            inset-inline-end: 0.5rem;
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: color var(--duration-fast) var(--ease-out), background-color var(--duration-fast) var(--ease-out);
        }

        .btn-toggle-password:hover {
            color: var(--text-primary);
            background-color: var(--surface-sunken);
        }

        .btn-toggle-password:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px var(--primary);
        }

        /* Message d'erreur sous champ */
        .field-error-message {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-top: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--status-danger-text);
        }

        .field-error-message i {
            font-size: 0.8125rem;
            flex-shrink: 0;
        }

        /* ── Checkbox personnalisée (Zéro Dégradé) ── */
        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-block: 1.25rem 1.5rem;
        }

        .custom-checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            cursor: pointer;
            user-select: none;
            font-size: 0.8125rem;
            color: var(--text-secondary);
        }

        .custom-checkbox-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .checkbox-box {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1.5px solid var(--border-strong);
            background-color: var(--surface-base);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background-color var(--duration-fast) var(--ease-out),
                        border-color var(--duration-fast) var(--ease-out),
                        box-shadow var(--duration-fast) var(--ease-out);
        }

        .checkbox-box i {
            color: #FFFFFF;
            font-size: 0.6875rem;
            opacity: 0;
            transform: scale(0.6);
            transition: opacity var(--duration-fast) var(--ease-out), transform var(--duration-fast) var(--ease-out);
        }

        .custom-checkbox-input:checked + .checkbox-box {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .custom-checkbox-input:checked + .checkbox-box i {
            opacity: 1;
            transform: scale(1);
        }

        .custom-checkbox-input:focus-visible + .checkbox-box {
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px var(--primary);
        }

        /* ── Bouton Primaire CTA (Zéro Dégradé) ── */
        .btn-submit-cta {
            width: 100%;
            height: 48px;
            border: 1px solid var(--accent-cta);
            border-radius: var(--radius-sm);
            background-color: var(--accent-cta);
            color: #FFFFFF;
            font-size: 0.9375rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.25), var(--shadow-raised);
            transition: background-color var(--duration-fast) var(--ease-out),
                        border-color var(--duration-fast) var(--ease-out),
                        transform var(--duration-fast) var(--ease-out),
                        box-shadow var(--duration-fast) var(--ease-out);
            position: relative;
        }

        .btn-submit-cta:hover {
            background-color: var(--accent-cta-hover);
            border-color: var(--accent-cta-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-card);
        }

        .btn-submit-cta:active {
            transform: translateY(1px);
            background-color: var(--accent-cta-active);
            border-color: var(--accent-cta-active);
            box-shadow: inset 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        }

        .btn-submit-cta:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px var(--accent-cta);
        }

        .btn-submit-cta i {
            font-size: 1.1rem;
            transition: transform var(--duration-fast) var(--ease-out);
        }

        .btn-submit-cta:hover i {
            transform: translateX(3px);
        }

        /* État de chargement (Loading State) */
        .btn-submit-cta.is-loading {
            pointer-events: none;
            opacity: 0.88;
        }

        .btn-submit-cta .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #FFFFFF;
            border-radius: 50%;
            animation: spin 600ms linear infinite;
        }

        .btn-submit-cta.is-loading .spinner {
            display: inline-block;
        }

        .btn-submit-cta.is-loading .btn-text,
        .btn-submit-cta.is-loading i {
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ── Pied de carte & Réassurance ── */
        .card-reassurance-footer {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border-subtle);
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .card-reassurance-footer i {
            color: var(--secondary);
        }

        .auth-footer-simple {
            max-width: 460px;
            margin-inline: auto;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .auth-footer-simple a:hover {
            color: var(--text-primary);
        }

        /* ═══════════════════════════════════════════
           RESPONSIVE DESIGN (2X SPATIAL GRID)
           ═══════════════════════════════════════════ */
        @media (max-width: 991px) {
            .auth-showcase-panel {
                display: none;
            }

            .auth-form-panel {
                padding: 1.5rem 1rem 2.5rem;
                justify-content: flex-start;
            }

            .mobile-brand-header {
                display: flex;
            }

            .auth-top-nav {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 480px) {
            .auth-card-container {
                padding: 1.25rem;
                border-radius: var(--radius-md);
            }

            .form-title {
                font-size: 1.375rem;
            }

            .btn-submit-cta {
                height: 44px;
                font-size: 0.875rem;
            }
        }

        /* Respect strict de la préférence cinétique (a11y) */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>

    <div class="auth-split-wrapper">

        <!-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  PANNEAU GAUCHE : SHOWCASE ARCHITECTURAL IMMOPRO (ZÉRO DÉGRADÉ)    ║
             ╚══════════════════════════════════════════════════════════════════════╝ -->
        <aside class="auth-showcase-panel" aria-label="Présentation ImmoPro">
            <div class="showcase-grid-overlay" aria-hidden="true"></div>

            <!-- En-tête de marque -->
            <div class="showcase-header">
                <a href="{{ route('home') }}" class="showcase-brand" title="Retour à l'accueil ImmoPro">
                    <div class="brand-monogram" aria-hidden="true">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="brand-title-group">
                        <span class="brand-logo-text">Immo<em>Pro</em></span>
                        <span class="brand-subtitle-tag">Côte d'Ivoire • Korhogo</span>
                    </div>
                </a>
            </div>

            <!-- Corps éditorial & Carte vectorielle -->
            <div class="showcase-body">
                <div class="showcase-pill">
                    <i class="bi bi-shield-check"></i>
                    <span>Espace Membre Sécurisé</span>
                </div>

                <h1 class="showcase-heading">
                    L'immobilier de prestige en toute <em>confiance</em>.
                </h1>

                <p class="showcase-description">
                    Accédez instantanément à vos annonces, vos requêtes de visites, vos contacts acheteurs et vos dossiers certifiés sur le portail de référence.
                </p>

                <!-- Carte d'illustration architecturale solide -->
                <div class="showcase-blueprint-card" aria-hidden="true">
                    <div class="blueprint-header">
                        <span>Plan type • Villa Standing Korhogo</span>
                        <span class="live-badge">Certifié</span>
                    </div>
                    <div class="blueprint-wireframe">
                        <div class="blueprint-room master">
                            <span class="blueprint-room-tag">Suite Parentale</span>
                            <span class="tabular-nums">28 m²</span>
                        </div>
                        <div class="blueprint-room">
                            <span class="blueprint-room-tag">Séjour</span>
                            <span class="tabular-nums">42 m²</span>
                        </div>
                        <div class="blueprint-room">
                            <span class="blueprint-room-tag">Terrasse</span>
                            <span class="tabular-nums">16 m²</span>
                        </div>
                    </div>
                </div>

                <!-- Statistiques tabulaires vérifiées -->
                <div class="showcase-stats-grid">
                    <div class="showcase-stat-item">
                        <span class="stat-value tabular-nums">2 500+</span>
                        <span class="stat-label">Biens répertoriés</span>
                    </div>
                    <div class="showcase-stat-item">
                        <span class="stat-value tabular-nums">1 200+</span>
                        <span class="stat-label">Propriétaires & Pros</span>
                    </div>
                    <div class="showcase-stat-item">
                        <span class="stat-value tabular-nums">99.2%</span>
                        <span class="stat-label">Transactions fiables</span>
                    </div>
                </div>
            </div>

            <!-- Pied de page du showcase -->
            <div class="showcase-footer">
                <span class="security-badge">
                    <i class="bi bi-check-circle-fill"></i>
                    Chiffrement SSL 256-bit • Données hébergées en sécurité
                </span>
                <span class="tabular-nums">v13.8</span>
            </div>
        </aside>

        <!-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  PANNEAU DROIT : FORMULAIRE DE CONNEXION (8 ÉTATS STANDARD SENIOR) ║
             ╚══════════════════════════════════════════════════════════════════════╝ -->
        <main class="auth-form-panel">

            <!-- Navigation supérieure discrète -->
            <div class="auth-top-nav">
                <a href="{{ route('home') }}" class="nav-back-link" title="Retourner à la page d'accueil">
                    <i class="bi bi-arrow-left"></i>
                    <span>Retour au site</span>
                </a>

                <span class="form-subtitle">
                    Pas de compte ?
                    <a href="{{ route('register') }}" class="fw-semibold">S'inscrire</a>
                </span>
            </div>

            <!-- Carte principale du formulaire -->
            <div class="auth-card-container">

                <!-- Header de marque sur Mobile uniquement -->
                <div class="mobile-brand-header">
                    <div class="brand-monogram" aria-hidden="true">
                        <i class="bi bi-building"></i>
                    </div>
                    <div>
                        <div class="mobile-brand-title">Immo<em>Pro</em></div>
                        <div style="font-size: 0.6875rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.08em;">Portail Immobilier Officiel</div>
                    </div>
                </div>

                <!-- Titre & sous-titre de la vue -->
                <div class="form-headline-group">
                    <h2 class="form-title">Bon retour parmi nous</h2>
                    <p class="form-subtitle">
                        Renseignez vos identifiants pour accéder à votre espace de gestion.
                    </p>
                </div>

                <!-- Alertes de session / messages -->
                @if (session('message'))
                    <div class="alert-box info" role="status">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert-box success" role="status">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-box error" role="alert" id="form-error-alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Connexion avec Google OAuth -->
                <div class="social-auth-action">
                    <a href="{{ route('google.redirect') }}" class="btn-social" id="btnGoogleAuth" title="Se connecter rapidement avec votre compte Google">
                        <svg viewBox="0 0 18 18" aria-hidden="true">
                            <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z" fill="#4285F4" />
                            <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z" fill="#34A853" />
                            <path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.997 8.997 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z" fill="#FBBC05" />
                            <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 6.29C4.672 4.163 6.656 2.58 9 3.58Z" fill="#EA4335" />
                        </svg>
                        <span>Continuer avec Google</span>
                    </a>
                </div>

                <!-- Séparateur solide 1px -->
                <div class="auth-divider" aria-hidden="true">
                    <span>ou par email</span>
                </div>

                <!-- Formulaire principal POST /login -->
                <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                    @csrf

                    <!-- Champ 1 : Adresse Email -->
                    <div class="form-group">
                        <div class="field-label-row">
                            <label for="email" class="field-label">
                                <span>Adresse email</span>
                                <span class="required-mark" aria-hidden="true">*</span>
                            </label>
                        </div>

                        <div class="input-control-wrapper">
                            <span class="input-lead-icon" aria-hidden="true">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-input-text {{ $errors->has('email') ? 'has-error' : '' }}"
                                placeholder="exemple@domaine.ci"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                aria-required="true"
                                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                @if ($errors->has('email')) aria-describedby="email-error" @endif>
                        </div>

                        @error('email')
                            <div class="field-error-message" id="email-error" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Champ 2 : Mot de passe -->
                    <div class="form-group">
                        <div class="field-label-row">
                            <label for="password" class="field-label">
                                <span>Mot de passe</span>
                                <span class="required-mark" aria-hidden="true">*</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <div class="input-control-wrapper">
                            <span class="input-lead-icon" aria-hidden="true">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input-text {{ $errors->has('password') ? 'has-error' : '' }}"
                                placeholder="••••••••••••"
                                required
                                autocomplete="current-password"
                                aria-required="true"
                                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                @if ($errors->has('password')) aria-describedby="password-error" @endif>

                            <button
                                type="button"
                                class="btn-toggle-password"
                                id="btnTogglePassword"
                                aria-label="Afficher ou masquer le mot de passe"
                                aria-pressed="false">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>

                        @error('password')
                            <div class="field-error-message" id="password-error" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Options : Se souvenir de moi -->
                    <div class="checkbox-container">
                        <label class="custom-checkbox-label">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="custom-checkbox-input"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkbox-box" aria-hidden="true">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span>Se souvenir de moi pendant 30 jours</span>
                        </label>
                    </div>

                    <!-- Bouton de Soumission Principal -->
                    <button type="submit" class="btn-submit-cta" id="btnSubmitLogin">
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="btn-text">Accéder à mon espace</span>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <!-- Réassurance de bas de carte -->
                <div class="card-reassurance-footer">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Connexion chiffrée SSL • Vos informations personnelles sont protégées</span>
                </div>
            </div>

            <!-- Footer discret & légal -->
            <footer class="auth-footer-simple">
                <span>&copy; {{ date('Y') }} ImmoPro Côte d'Ivoire</span>
                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="{{ route('contact') }}">Assistance</a>
                </div>
            </footer>
        </main>
    </div>

    <!-- ═══════════════════════════════════════════
         INTERACTIONS PHYSIQUES & MICRO-ANIMATIONS (JS VANILLA)
         ═══════════════════════════════════════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('btnTogglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const loginForm = document.getElementById('loginForm');
            const btnSubmit = document.getElementById('btnSubmitLogin');

            // 1. Bascule d'affichage du mot de passe
            if (togglePasswordBtn && passwordInput && eyeIcon) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePasswordBtn.setAttribute('aria-pressed', isPassword ? 'true' : 'false');

                    if (isPassword) {
                        eyeIcon.classList.remove('bi-eye');
                        eyeIcon.classList.add('bi-eye-slash');
                        togglePasswordBtn.setAttribute('title', 'Masquer le mot de passe');
                    } else {
                        eyeIcon.classList.remove('bi-eye-slash');
                        eyeIcon.classList.add('bi-eye');
                        togglePasswordBtn.setAttribute('title', 'Afficher le mot de passe');
                    }
                });
            }

            // 2. État de chargement physique à la soumission
            if (loginForm && btnSubmit) {
                loginForm.addEventListener('submit', (e) => {
                    // Si le formulaire est déjà en cours d'envoi, bloquer le double clic
                    if (btnSubmit.classList.contains('is-loading')) {
                        e.preventDefault();
                        return;
                    }

                    // Validation basique côté client pour rétroaction immédiate
                    const email = document.getElementById('email');
                    if (email && (!email.value || !email.validity.valid)) {
                        email.focus();
                        return;
                    }

                    if (passwordInput && !passwordInput.value) {
                        passwordInput.focus();
                        return;
                    }

                    btnSubmit.classList.add('is-loading');
                    btnSubmit.setAttribute('aria-busy', 'true');
                });
            }
        });
    </script>
</body>

</html>