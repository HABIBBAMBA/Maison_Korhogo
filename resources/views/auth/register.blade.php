<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Créer un compte sur ImmoPro — Plateforme immobilière de référence en Côte d'Ivoire. Inscription rapide pour clients, propriétaires et agences.">
    <title>Inscription — ImmoPro</title>

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

            --status-warning-bg: #FFFBEB;
            --status-warning-text: #92400E;
            --status-warning-border: #FCD34D;

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
            min-height: 100%;
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
            flex: 0 0 42%;
            position: relative;
            background-color: var(--surface-dark-base);
            border-inline-end: 1px solid var(--border-dark);
            color: var(--text-inverse);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: clamp(2rem, 3.5vw, 3.5rem);
            overflow: hidden;
        }

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

        /* Contenu du showcase */
        .showcase-body {
            position: relative;
            z-index: 2;
            margin-block: 2rem;
            max-width: 460px;
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
            margin-bottom: 1.25rem;
        }

        .showcase-pill i {
            color: var(--accent-cta);
        }

        .showcase-heading {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(2rem, 2.75vw, 2.5rem);
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

        /* Cartes d'avantages par profil */
        .role-benefits-stack {
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            margin-bottom: 2rem;
        }

        .benefit-item-card {
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
            padding: 1rem;
            background-color: var(--surface-dark-card);
            border: 1px solid var(--border-dark);
            border-radius: var(--radius-md);
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.05);
        }

        .benefit-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            background-color: var(--surface-dark-raised);
            border: 1px solid var(--border-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-cta);
            font-size: 1rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .benefit-info {
            display: flex;
            flex-direction: column;
        }

        .benefit-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 0.2rem;
        }

        .benefit-text {
            font-size: 0.8125rem;
            line-height: 1.45;
            color: var(--text-inverse-muted);
        }

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

        /* ── Panneau Droit : Formulaire d'inscription ── */
        .auth-form-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: var(--surface-sunken);
            padding: clamp(1.5rem, 3.5vw, 3.5rem);
            position: relative;
        }

        .auth-top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 560px;
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
            max-width: 560px;
            margin-inline: auto;
            background-color: var(--surface-base);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: clamp(1.75rem, 3.5vw, 2.5rem);
            position: relative;
        }

        /* Marque mobile */
        .mobile-brand-header {
            display: none;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
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

        /* Alertes */
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

        .alert-box.error {
            background-color: var(--status-danger-bg);
            border-color: var(--status-danger-border);
            color: var(--status-danger-text);
        }

        /* ── SÉLECTEUR DE RÔLE : CARTES SEGMENTÉES (ZÉRO DÉGRADÉ) ── */
        .role-selection-section {
            margin-bottom: 1.75rem;
        }

        .role-section-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-secondary);
            margin-bottom: 0.625rem;
        }

        .role-grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.625rem;
        }

        .role-card-option {
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .role-radio-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .role-surface-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1rem 0.625rem;
            background-color: var(--surface-sunken);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-raised);
            transition: background-color var(--duration-fast) var(--ease-out),
                        border-color var(--duration-fast) var(--ease-out),
                        transform var(--duration-fast) var(--ease-out),
                        box-shadow var(--duration-fast) var(--ease-out);
            position: relative;
            min-height: 104px;
            justify-content: center;
        }

        .role-card-option:hover .role-surface-card {
            border-color: var(--border-strong);
            background-color: #FFFFFF;
            transform: translateY(-1px);
        }

        .role-radio-input:checked + .role-surface-card {
            background-color: #FFFFFF;
            border-color: var(--primary);
            box-shadow: 0 0 0 1px var(--primary), var(--shadow-card);
        }

        .role-radio-input:focus-visible + .role-surface-card {
            outline: none;
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px var(--primary);
        }

        .role-card-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: var(--primary);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.625rem;
            opacity: 0;
            transform: scale(0.5);
            transition: opacity var(--duration-fast) var(--ease-out), transform var(--duration-fast) var(--ease-out);
        }

        .role-radio-input:checked + .role-surface-card .role-card-badge {
            opacity: 1;
            transform: scale(1);
        }

        .role-card-icon {
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            background-color: var(--border-subtle);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
            transition: background-color var(--duration-fast) var(--ease-out), color var(--duration-fast) var(--ease-out);
        }

        .role-radio-input:checked + .role-surface-card .role-card-icon {
            background-color: var(--surface-dark-base);
            color: #FFFFFF;
        }

        .role-card-name {
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .role-card-desc {
            font-size: 0.6875rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
            line-height: 1.2;
        }

        /* ── CHAMPS CONDITIONNELS (ANIMATION HARDWARE) ── */
        .conditional-block {
            display: none;
            opacity: 0;
            transform: translateY(6px);
            transition: opacity var(--duration-fast) var(--ease-out), transform var(--duration-fast) var(--ease-out);
        }

        .conditional-block.is-active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* ── GRILLE DE FORMULAIRE ── */
        .form-grid-2cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 540px) {
            .form-grid-2cols {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

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

        .field-tag-optional {
            font-size: 0.6875rem;
            font-weight: 500;
            color: var(--text-muted);
            padding: 0.125rem 0.375rem;
            background-color: var(--surface-sunken);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-sm);
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
            height: 44px;
            padding-inline-start: 2.625rem;
            padding-inline-end: 2.625rem;
            font-size: 1rem;
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

        /* ── INDICATEUR DE FORCE DU MOT DE PASSE (4 SEGMENTS SOLIDES, ZÉRO DÉGRADÉ) ── */
        .password-strength-container {
            margin-top: 0.5rem;
        }

        .strength-bars-track {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4px;
            height: 4px;
            margin-bottom: 0.375rem;
        }

        .strength-bar-unit {
            height: 100%;
            border-radius: 2px;
            background-color: var(--border-default);
            transition: background-color var(--duration-fast) var(--ease-out);
        }

        .strength-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.6875rem;
            color: var(--text-muted);
        }

        .strength-label-text {
            font-weight: 600;
        }

        /* Indicateur de concordance de mot de passe */
        .password-match-badge {
            display: none;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.6875rem;
            font-weight: 600;
            color: var(--status-success-text);
            margin-top: 0.375rem;
        }

        .password-match-badge.is-visible {
            display: inline-flex;
        }

        .password-match-badge.is-mismatch {
            color: var(--status-danger-text);
        }

        /* ── CONDITIONS D'UTILISATION (CHECKBOX) ── */
        .terms-agreement-row {
            margin-block: 1.25rem 1.5rem;
        }

        .custom-checkbox-label {
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
            cursor: pointer;
            user-select: none;
            font-size: 0.8125rem;
            line-height: 1.45;
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
            margin-top: 1px;
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

        .terms-links a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .terms-links a:hover {
            color: var(--accent-cta);
        }

        /* ── BOUTON CTA DE SOUMISSION ── */
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

        /* ── PIED DE CARTE & LIENS ── */
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
            max-width: 560px;
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

            .role-grid-container {
                gap: 0.375rem;
            }

            .role-surface-card {
                padding: 0.75rem 0.375rem;
                min-height: 96px;
            }

            .role-card-icon {
                width: 30px;
                height: 30px;
                font-size: 1rem;
                margin-bottom: 0.35rem;
            }

            .role-card-name {
                font-size: 0.75rem;
            }

            .role-card-desc {
                font-size: 0.625rem;
            }

            .form-title {
                font-size: 1.375rem;
            }

            .btn-submit-cta {
                height: 44px;
                font-size: 0.875rem;
            }
        }

        /* Accessibilité cinétique */
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
             ║  PANNEAU GAUCHE : SHOWCASE DE MARQUE IMMOPRO (ZÉRO DÉGRADÉ)        ║
             ╚══════════════════════════════════════════════════════════════════════╝ -->
        <aside class="auth-showcase-panel" aria-label="Présentation ImmoPro">
            <div class="showcase-grid-overlay" aria-hidden="true"></div>

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

            <div class="showcase-body">
                <div class="showcase-pill">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Rejoignez l'Écosystème ImmoPro</span>
                </div>

                <h1 class="showcase-heading">
                    Trouvez, louez ou confiez vos biens en toute <em>clarté</em>.
                </h1>

                <p class="showcase-description">
                    Une seule inscription pour profiter du premier réseau immobilier certifié à Korhogo et sur l'ensemble du territoire ivoirien.
                </p>

                <!-- Pile d'avantages ciblés par profil -->
                <div class="role-benefits-stack" aria-hidden="true">
                    <div class="benefit-item-card">
                        <div class="benefit-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="benefit-info">
                            <span class="benefit-title">Particuliers & Locataires</span>
                            <span class="benefit-text">Parcourez des biens vérifiés avec géolocalisation et photos réelles sans intermédiaire opaque.</span>
                        </div>
                    </div>

                    <div class="benefit-item-card">
                        <div class="benefit-icon">
                            <i class="bi bi-houses"></i>
                        </div>
                        <div class="benefit-info">
                            <span class="benefit-title">Propriétaires Bailleurs</span>
                            <span class="benefit-text">Publiez vos annonces en quelques minutes et mettez directement en relation vos offres avec des locataires solvables.</span>
                        </div>
                    </div>

                    <div class="benefit-item-card">
                        <div class="benefit-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="benefit-info">
                            <span class="benefit-title">Agences Immobilières</span>
                            <span class="benefit-text">Gérez un portefeuille complet d'annonces, valorisez votre marque et pilotez vos rendez-vous prospects.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="showcase-footer">
                <span class="security-badge">
                    <i class="bi bi-check-circle-fill"></i>
                    Inscription 100% gratuite • Zéro frais cachés
                </span>
                <span class="tabular-nums">ImmoPro Côte d'Ivoire</span>
            </div>
        </aside>

        <!-- ╔══════════════════════════════════════════════════════════════════════╗
             ║  PANNEAU DROIT : FORMULAIRE D'INSCRIPTION ULTRA-PRÉCIS             ║
             ╚══════════════════════════════════════════════════════════════════════╝ -->
        <main class="auth-form-panel">

            <!-- Navigation supérieure -->
            <div class="auth-top-nav">
                <a href="{{ route('home') }}" class="nav-back-link" title="Retourner à la page d'accueil">
                    <i class="bi bi-arrow-left"></i>
                    <span>Retour au site</span>
                </a>

                <span class="form-subtitle">
                    Déjà membre ?
                    <a href="{{ route('login') }}" class="fw-semibold">Se connecter</a>
                </span>
            </div>

            <!-- Carte principale -->
            <div class="auth-card-container">

                <!-- Header mobile -->
                <div class="mobile-brand-header">
                    <div class="brand-monogram" aria-hidden="true">
                        <i class="bi bi-building"></i>
                    </div>
                    <div>
                        <div class="mobile-brand-title">Immo<em>Pro</em></div>
                        <div style="font-size: 0.6875rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.08em;">Création de Compte</div>
                    </div>
                </div>

                <!-- En-tête formulaire -->
                <div class="form-headline-group">
                    <h2 class="form-title">Créer votre compte</h2>
                    <p class="form-subtitle">
                        Sélectionnez votre profil pour adapter votre expérience ImmoPro.
                    </p>
                </div>

                <!-- Alertes de session ou erreurs -->
                @if (session('message'))
                    <div class="alert-box info" role="status">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-box error" role="alert" id="register-errors-alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>Veuillez vérifier les informations renseignées ci-dessous.</span>
                    </div>
                @endif

                <!-- Formulaire POST /register -->
                <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                    @csrf

                    <!-- ═══ 1. SÉLECTEUR DE TYPE DE COMPTE (ROLE) ═══ -->
                    <div class="role-selection-section">
                        <label class="role-section-label" id="role-radiogroup-label">
                            Choisissez votre profil <span style="color: var(--status-danger-text);">*</span>
                        </label>

                        <div class="role-grid-container" role="radiogroup" aria-labelledby="role-radiogroup-label">
                            <!-- Option Client -->
                            <label class="role-card-option">
                                <input
                                    type="radio"
                                    name="role"
                                    value="client"
                                    class="role-radio-input"
                                    {{ old('role', 'client') === 'client' ? 'checked' : '' }}
                                    aria-label="Profil Client : Acheteur ou Locataire">
                                <div class="role-surface-card">
                                    <div class="role-card-badge" aria-hidden="true"><i class="bi bi-check-lg"></i></div>
                                    <div class="role-card-icon" aria-hidden="true"><i class="bi bi-person"></i></div>
                                    <span class="role-card-name">Client</span>
                                    <span class="role-card-desc">Acheteur / Locataire</span>
                                </div>
                            </label>

                            <!-- Option Propriétaire -->
                            <label class="role-card-option">
                                <input
                                    type="radio"
                                    name="role"
                                    value="proprietaire"
                                    class="role-radio-input"
                                    {{ old('role') === 'proprietaire' ? 'checked' : '' }}
                                    aria-label="Profil Propriétaire : Gérer et louer mes biens">
                                <div class="role-surface-card">
                                    <div class="role-card-badge" aria-hidden="true"><i class="bi bi-check-lg"></i></div>
                                    <div class="role-card-icon" aria-hidden="true"><i class="bi bi-key"></i></div>
                                    <span class="role-card-name">Propriétaire</span>
                                    <span class="role-card-desc">Bailleur / Vendeur</span>
                                </div>
                            </label>

                            <!-- Option Agence -->
                            <label class="role-card-option">
                                <input
                                    type="radio"
                                    name="role"
                                    value="agence"
                                    class="role-radio-input"
                                    {{ old('role') === 'agence' ? 'checked' : '' }}
                                    aria-label="Profil Agence : Cabinet ou Agence immobilière">
                                <div class="role-surface-card">
                                    <div class="role-card-badge" aria-hidden="true"><i class="bi bi-check-lg"></i></div>
                                    <div class="role-card-icon" aria-hidden="true"><i class="bi bi-briefcase"></i></div>
                                    <span class="role-card-name">Agence</span>
                                    <span class="role-card-desc">Professionnel</span>
                                </div>
                            </label>
                        </div>

                        @error('role')
                            <div class="field-error-message" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- ═══ 2. CHAMPS PARTICULIER (Client / Propriétaire) ═══ -->
                    <div id="person-fields" class="conditional-block is-active">
                        <div class="form-grid-2cols">
                            <div class="form-group">
                                <div class="field-label-row">
                                    <label for="nom" class="field-label">
                                        <span>Nom</span>
                                        <span class="required-mark" aria-hidden="true">*</span>
                                    </label>
                                </div>
                                <div class="input-control-wrapper">
                                    <span class="input-lead-icon" aria-hidden="true">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="nom"
                                        name="nom"
                                        class="form-input-text {{ $errors->has('nom') ? 'has-error' : '' }}"
                                        placeholder="Kouassi"
                                        value="{{ old('nom') }}"
                                        autocomplete="family-name">
                                </div>
                                @error('nom')
                                    <div class="field-error-message" role="alert">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="field-label-row">
                                    <label for="prenom" class="field-label">
                                        <span>Prénom</span>
                                        <span class="required-mark" aria-hidden="true">*</span>
                                    </label>
                                </div>
                                <div class="input-control-wrapper">
                                    <span class="input-lead-icon" aria-hidden="true">
                                        <i class="bi bi-person-badge"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="prenom"
                                        name="prenom"
                                        class="form-input-text {{ $errors->has('prenom') ? 'has-error' : '' }}"
                                        placeholder="Jean-Marc"
                                        value="{{ old('prenom') }}"
                                        autocomplete="given-name">
                                </div>
                                @error('prenom')
                                    <div class="field-error-message" role="alert">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ═══ 3. CHAMPS PROFESSIONNELS (Agence Immobilière) ═══ -->
                    <div id="agence-fields" class="conditional-block">
                        <div class="form-group">
                            <div class="field-label-row">
                                <label for="nom_agence" class="field-label">
                                    <span>Nom de l'agence</span>
                                    <span class="required-mark" aria-hidden="true">*</span>
                                </label>
                            </div>
                            <div class="input-control-wrapper">
                                <span class="input-lead-icon" aria-hidden="true">
                                    <i class="bi bi-building"></i>
                                </span>
                                <input
                                    type="text"
                                    id="nom_agence"
                                    name="nom_agence"
                                    class="form-input-text {{ $errors->has('nom_agence') ? 'has-error' : '' }}"
                                    placeholder="Ex: Ivoire Prestige Immobilier"
                                    value="{{ old('nom_agence') }}">
                            </div>
                            @error('nom_agence')
                                <div class="field-error-message" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="field-label-row">
                                <label for="nom_responsable" class="field-label">
                                    <span>Nom du responsable</span>
                                    <span class="required-mark" aria-hidden="true">*</span>
                                </label>
                            </div>
                            <div class="input-control-wrapper">
                                <span class="input-lead-icon" aria-hidden="true">
                                    <i class="bi bi-person-vcard"></i>
                                </span>
                                <input
                                    type="text"
                                    id="nom_responsable"
                                    name="nom_responsable"
                                    class="form-input-text {{ $errors->has('nom_responsable') ? 'has-error' : '' }}"
                                    placeholder="Nom complet du gérant"
                                    value="{{ old('nom_responsable') }}">
                            </div>
                            @error('nom_responsable')
                                <div class="field-error-message" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- ═══ 4. TÉLÉPHONE (OPTIONNEL) ═══ -->
                    <div class="form-group">
                        <div class="field-label-row">
                            <label for="telephone" class="field-label">
                                <span>Numéro de téléphone</span>
                            </label>
                            <span class="field-tag-optional">optionnel</span>
                        </div>
                        <div class="input-control-wrapper">
                            <span class="input-lead-icon" aria-hidden="true">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <input
                                type="tel"
                                id="telephone"
                                name="telephone"
                                class="form-input-text {{ $errors->has('telephone') ? 'has-error' : '' }} tabular-nums"
                                placeholder="+225 07 00 00 00 00"
                                value="{{ old('telephone') }}"
                                autocomplete="tel">
                        </div>
                        @error('telephone')
                            <div class="field-error-message" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- ═══ 5. ADRESSE EMAIL ═══ -->
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
                                placeholder="votreemail@domaine.ci"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email">
                        </div>
                        @error('email')
                            <div class="field-error-message" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- ═══ 6. MOT DE PASSE & FORCE (ZÉRO DÉGRADÉ) ═══ -->
                    <div class="form-group">
                        <div class="field-label-row">
                            <label for="password" class="field-label">
                                <span>Mot de passe</span>
                                <span class="required-mark" aria-hidden="true">*</span>
                            </label>
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
                                placeholder="Minimum 8 caractères"
                                required
                                autocomplete="new-password">

                            <button
                                type="button"
                                class="btn-toggle-password"
                                id="btnTogglePassword"
                                aria-label="Afficher ou masquer le mot de passe"
                                aria-pressed="false">
                                <i class="bi bi-eye" id="eyeIconMain"></i>
                            </button>
                        </div>

                        <!-- Barres segmentées solides (Zéro Dégradé) -->
                        <div class="password-strength-container" aria-live="polite">
                            <div class="strength-bars-track">
                                <div class="strength-bar-unit" id="strengthBar1"></div>
                                <div class="strength-bar-unit" id="strengthBar2"></div>
                                <div class="strength-bar-unit" id="strengthBar3"></div>
                                <div class="strength-bar-unit" id="strengthBar4"></div>
                            </div>
                            <div class="strength-meta-row">
                                <span id="strengthTextLabel">Sécurité : Non renseigné</span>
                                <span>8 car. min, 1 chiffre</span>
                            </div>
                        </div>

                        @error('password')
                            <div class="field-error-message" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- ═══ 7. CONFIRMATION DU MOT DE PASSE ═══ -->
                    <div class="form-group">
                        <div class="field-label-row">
                            <label for="password_confirmation" class="field-label">
                                <span>Confirmez le mot de passe</span>
                                <span class="required-mark" aria-hidden="true">*</span>
                            </label>
                        </div>
                        <div class="input-control-wrapper">
                            <span class="input-lead-icon" aria-hidden="true">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-input-text"
                                placeholder="Retapez votre mot de passe"
                                required
                                autocomplete="new-password">

                            <button
                                type="button"
                                class="btn-toggle-password"
                                id="btnToggleConfirmPassword"
                                aria-label="Afficher ou masquer la confirmation du mot de passe"
                                aria-pressed="false">
                                <i class="bi bi-eye" id="eyeIconConfirm"></i>
                            </button>
                        </div>

                        <!-- Badge de vérification de concordance instantané -->
                        <div class="password-match-badge" id="passwordMatchBadge" aria-live="polite">
                            <i class="bi bi-check-circle-fill"></i>
                            <span id="passwordMatchText">Les mots de passe correspondent</span>
                        </div>
                    </div>

                    <!-- ═══ 8. ACCEPTATION DES CONDITIONS ═══ -->
                    <div class="terms-agreement-row">
                        <label class="custom-checkbox-label">
                            <input
                                type="checkbox"
                                name="terms"
                                id="terms"
                                class="custom-checkbox-input"
                                {{ old('terms') ? 'checked' : '' }}
                                required>
                            <span class="checkbox-box" aria-hidden="true">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span class="terms-links">
                                J'accepte les <a href="{{ route('home') }}" target="_blank">conditions générales</a> et la <a href="{{ route('home') }}" target="_blank">politique de confidentialité</a> d'ImmoPro.
                            </span>
                        </label>
                    </div>

                    <!-- Bouton de Soumission Principal -->
                    <button type="submit" class="btn-submit-cta" id="btnSubmitRegister">
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="btn-text">Finaliser mon inscription</span>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <!-- Réassurance de bas de carte -->
                <div class="card-reassurance-footer">
                    <i class="bi bi-shield-check"></i>
                    <span>Plateforme conforme à la réglementation ivoirienne de protection des données (ARTCI)</span>
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
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const personFields = document.getElementById('person-fields');
            const agenceFields = document.getElementById('agence-fields');
            const registerForm = document.getElementById('registerForm');
            const btnSubmit = document.getElementById('btnSubmitRegister');

            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const matchBadge = document.getElementById('passwordMatchBadge');
            const matchText = document.getElementById('passwordMatchText');

            const togglePasswordBtn = document.getElementById('btnTogglePassword');
            const eyeIconMain = document.getElementById('eyeIconMain');
            const toggleConfirmBtn = document.getElementById('btnToggleConfirmPassword');
            const eyeIconConfirm = document.getElementById('eyeIconConfirm');

            const strengthBars = [
                document.getElementById('strengthBar1'),
                document.getElementById('strengthBar2'),
                document.getElementById('strengthBar3'),
                document.getElementById('strengthBar4')
            ];
            const strengthLabel = document.getElementById('strengthTextLabel');

            // 1. Gestion dynamique du sélecteur de rôle
            function updateRoleFields(role) {
                if (role === 'agence') {
                    personFields.classList.remove('is-active');
                    agenceFields.classList.add('is-active');

                    // Désactiver les champs de personne pour éviter d'envoyer des valeurs parasites
                    personFields.querySelectorAll('input').forEach(i => i.disabled = true);
                    agenceFields.querySelectorAll('input').forEach(i => i.disabled = false);
                } else {
                    agenceFields.classList.remove('is-active');
                    personFields.classList.add('is-active');

                    agenceFields.querySelectorAll('input').forEach(i => i.disabled = true);
                    personFields.querySelectorAll('input').forEach(i => i.disabled = false);
                }
            }

            roleRadios.forEach(radio => {
                radio.addEventListener('change', (e) => {
                    updateRoleFields(e.target.value);
                });
            });

            // Initialiser selon le bouton radio actuellement sélectionné
            const initialRole = document.querySelector('input[name="role"]:checked')?.value || 'client';
            updateRoleFields(initialRole);

            // 2. Bascule d'affichage du mot de passe principal
            if (togglePasswordBtn && passwordInput && eyeIconMain) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePasswordBtn.setAttribute('aria-pressed', isPassword ? 'true' : 'false');

                    if (isPassword) {
                        eyeIconMain.classList.remove('bi-eye');
                        eyeIconMain.classList.add('bi-eye-slash');
                        togglePasswordBtn.setAttribute('title', 'Masquer le mot de passe');
                    } else {
                        eyeIconMain.classList.remove('bi-eye-slash');
                        eyeIconMain.classList.add('bi-eye');
                        togglePasswordBtn.setAttribute('title', 'Afficher le mot de passe');
                    }
                });
            }

            // 3. Bascule d'affichage de la confirmation du mot de passe
            if (toggleConfirmBtn && confirmInput && eyeIconConfirm) {
                toggleConfirmBtn.addEventListener('click', () => {
                    const isPassword = confirmInput.getAttribute('type') === 'password';
                    confirmInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleConfirmBtn.setAttribute('aria-pressed', isPassword ? 'true' : 'false');

                    if (isPassword) {
                        eyeIconConfirm.classList.remove('bi-eye');
                        eyeIconConfirm.classList.add('bi-eye-slash');
                        toggleConfirmBtn.setAttribute('title', 'Masquer le mot de passe');
                    } else {
                        eyeIconConfirm.classList.remove('bi-eye-slash');
                        eyeIconConfirm.classList.add('bi-eye');
                        toggleConfirmBtn.setAttribute('title', 'Afficher le mot de passe');
                    }
                });
            }

            // 4. Calculateur de force du mot de passe (Zéro Dégradé - Couleurs solides)
            function evaluatePasswordStrength(pass) {
                if (!pass || pass.length === 0) {
                    strengthBars.forEach(b => b.style.backgroundColor = 'var(--border-default)');
                    strengthLabel.textContent = 'Sécurité : Non renseigné';
                    strengthLabel.style.color = 'var(--text-muted)';
                    return;
                }

                let score = 0;
                if (pass.length >= 8) score++;
                if (pass.length >= 11) score++;
                if (/[A-Z]/.test(pass) && /[a-z]/.test(pass)) score++;
                if (/[0-9]/.test(pass) || /[^A-Za-z0-9]/.test(pass)) score++;

                const levels = [
                    { label: 'Sécurité : Très faible', color: '#B42318' },
                    { label: 'Sécurité : Faible',      color: '#E8734A' },
                    { label: 'Sécurité : Moyenne',     color: '#5A6B7B' },
                    { label: 'Sécurité : Robuste',     color: '#196C45' }
                ];

                const currentLevel = levels[Math.max(0, score - 1)];

                strengthBars.forEach((bar, index) => {
                    if (index < score) {
                        bar.style.backgroundColor = currentLevel.color;
                    } else {
                        bar.style.backgroundColor = 'var(--border-default)';
                    }
                });

                strengthLabel.textContent = currentLevel.label;
                strengthLabel.style.color = currentLevel.color;
            }

            if (passwordInput) {
                passwordInput.addEventListener('input', (e) => {
                    evaluatePasswordStrength(e.target.value);
                    checkPasswordMatch();
                });
            }

            // 5. Comparateur instantané de concordance du mot de passe
            function checkPasswordMatch() {
                if (!confirmInput || !matchBadge) return;

                const passVal = passwordInput ? passwordInput.value : '';
                const confirmVal = confirmInput.value;

                if (!confirmVal) {
                    matchBadge.classList.remove('is-visible', 'is-mismatch');
                    return;
                }

                matchBadge.classList.add('is-visible');

                if (passVal === confirmVal) {
                    matchBadge.classList.remove('is-mismatch');
                    matchText.textContent = 'Les mots de passe correspondent parfaitement';
                    matchBadge.querySelector('i').className = 'bi bi-check-circle-fill';
                } else {
                    matchBadge.classList.add('is-mismatch');
                    matchText.textContent = 'Les deux mots de passe ne sont pas identiques';
                    matchBadge.querySelector('i').className = 'bi bi-x-circle-fill';
                }
            }

            if (confirmInput) {
                confirmInput.addEventListener('input', checkPasswordMatch);
            }

            // 6. Gestionnaire de soumission sécurisé
            if (registerForm && btnSubmit) {
                registerForm.addEventListener('submit', (e) => {
                    if (btnSubmit.classList.contains('is-loading')) {
                        e.preventDefault();
                        return;
                    }

                    // S'assurer que les champs masqués sont bien désactivés avant soumission
                    const currentRole = document.querySelector('input[name="role"]:checked')?.value || 'client';
                    if (currentRole === 'agence') {
                        personFields.querySelectorAll('input').forEach(i => i.disabled = true);
                        agenceFields.querySelectorAll('input').forEach(i => i.disabled = false);
                    } else {
                        agenceFields.querySelectorAll('input').forEach(i => i.disabled = true);
                        personFields.querySelectorAll('input').forEach(i => i.disabled = false);
                    }

                    btnSubmit.classList.add('is-loading');
                    btnSubmit.setAttribute('aria-busy', 'true');
                });
            }
        });
    </script>
</body>

</html>