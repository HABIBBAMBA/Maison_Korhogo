<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="ImmoPro — Plateforme immobilière de référence en Côte d'Ivoire. Achat, vente et location de maisons, terrains et appartements à Korhogo et sur tout le territoire.">
    <title>@yield('title', 'ImmoPro — Immobilier de Référence')</title>

    <!-- Favicon SVG inline solide (Zéro Dégradé) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%231d2b36'/%3E%3Cpath d='M8 23V12.5L16 6.5l8 6V23' stroke='white' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3Crect x='13' y='16' width='6' height='7' rx='1' fill='%232d6b70'/%3E%3Ccircle cx='16' cy='12' r='2' fill='%23d4a853'/%3E%3C/svg%3E">

    <!-- Typographie Modulaire : Plus Jakarta Sans (Corps) + Playfair Display (Titres) + JetBrains Mono (Données numériques tabulaires) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  SYSTÈME DE TOKENS SÉMANTIQUES & SURFACES MATÉRIELLES                ║
           ║  PALETTE OFFICIELLE IMMOPRO (ZÉRO DÉGRADÉ)                           ║
           ║  • Fond principal : Blanc cassé (#F8F9FA)                            ║
           ║  • Couleur principale : Bleu marine (#1B3A5C)                        ║
           ║  • Couleur secondaire : Gris ardoise (#5A6B7B)                       ║
           ║  • Accent / CTA : Orange chaud (#E8734A)                             ║
           ║  • Texte principal : Anthracite (#222831)                            ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        :root {
            /* 1. Palette Maîtresse Calibrée */
            --color-bg-main:       #F8F9FA; /* Fond principal : Blanc cassé */
            --color-primary:       #1B3A5C; /* Couleur principale : Bleu marine */
            --color-primary-hover: #132A43;
            --color-primary-light: #244C78;
            --color-secondary:     #5A6B7B; /* Couleur secondaire : Gris ardoise */
            --color-secondary-hover:#475562;
            --color-cta:           #E8734A; /* Accent / CTA : Orange chaud */
            --color-cta-hover:     #D55F35;
            --color-cta-active:    #BF5129;
            --color-text-main:     #222831; /* Texte principal : Anthracite */

            /* 2. Surfaces physiques solides - Étage de luminance */
            --surface-sunken:  #F8F9FA; /* Fond principal : Blanc cassé pour mettre en valeur les photos */
            --surface-base:    #FFFFFF; /* Surface blanche solide */
            --surface-raised:  #FFFFFF; /* Cartes, panneaux, formulaires */
            --surface-overlay: #FFFFFF; /* Modales, popovers, dropdowns */

            /* 3. Matériaux sombres solides (Architecture Bleu Marine) */
            --surface-dark-sunken: #0E1F32; /* Bleu marine nocturne */
            --surface-dark-base:   #1B3A5C; /* Bleu marine officiel */
            --surface-dark-raised: #244C78; /* Bleu marine rehaussé */

            /* 4. Bordures Hairline (1px solide, nettes) */
            --border-subtle:   #E8ECF0;
            --border-default:  #DCE1E7;
            --border-strong:   #BAC3CD;
            --border-dark:     #2B527E;

            /* 5. Hiérarchie Typographique */
            --text-primary:       #222831; /* Anthracite : Titres et paragraphes */
            --text-secondary:     #5A6B7B; /* Gris ardoise : Textes secondaires, icônes */
            --text-muted:         #7C8D9E; /* Légendes douces et métadonnées */
            --text-inverse:       #F8F9FA; /* Texte blanc cassé sur fond bleu marine */
            --text-inverse-muted: #B4C4D4;

            /* 6. Accents & Identité Visuelle (Zéro Dégradé) */
            --accent-primary:       #1B3A5C; /* Bleu marine */
            --accent-primary-hover: #132A43;
            --accent-brand:         #1B3A5C; /* Bleu marine */
            --accent-brand-hover:   #132A43;
            --accent-secondary:     #5A6B7B; /* Gris ardoise */
            --accent-cta:           #E8734A; /* Orange chaud CTA */
            --accent-cta-hover:     #D55F35;
            --accent-warm:          #E8734A; /* Orange chaud */

            /* 7. États Sémantiques */
            --status-success-bg:     #EBF8F2;
            --status-success-text:   #196C45;
            --status-success-border: #A3E3C1;

            --status-danger-bg:      #FDF2F2;
            --status-danger-text:    #991B1B;
            --status-danger-border:  #FCA5A5;

            --status-warning-bg:     #FFFBEB;
            --status-warning-text:   #92400E;
            --status-warning-border: #FCD34D;

            --status-info-bg:        #EFF6FF;
            --status-info-text:      #1E40AF;
            --status-info-border:    #BFDBFE;

            /* 8. Ombres Physiques Multicouches (calibrées sur l'anthracite #222831) */
            --shadow-raised:
                0 1px 2px -1px rgba(34, 40, 49, 0.05),
                0 1px 3px 0 rgba(34, 40, 49, 0.04);
            --shadow-card:
                0 1px 3px 0 rgba(34, 40, 49, 0.04),
                0 6px 16px -2px rgba(34, 40, 49, 0.06);
            --shadow-overlay:
                0 4px 6px -2px rgba(34, 40, 49, 0.05),
                0 16px 32px -4px rgba(34, 40, 49, 0.10);

            /* 9. Grille Spatiale 2x & Rayons Concentriques */
            --radius-xs: 4px;
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 18px;
            --radius-full: 9999px;

            /* 10. Physique d'Animation (60/120fps) */
            --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
            --duration-fast: 140ms;
            --duration-base: 220ms;

            --nav-height: 72px;

            /* Compatibilité tokens historiques */
            --primary: var(--color-primary);
            --teal: var(--color-secondary);
            --accent: var(--color-cta);
            --dark: var(--color-text-main);
            --light-bg: var(--color-bg-main);
            --white: #ffffff;
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  RESET & BASE TYPOGRAPHIQUE                                          ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            background-color: var(--surface-sunken);
            color: var(--text-primary);
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 0.9375rem; /* 15px */
            line-height: 1.55;
            background-color: var(--surface-sunken);
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Typographie Modulaire */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            line-height: 1.2;
            color: var(--text-primary);
            letter-spacing: -0.015em;
        }

        /* Données numériques tabulaires strictes (skill_design) */
        .tabular-nums,
        .price-tag,
        .kpi-value,
        .stat-value,
        .badge-numeric,
        .phone-number,
        .spec-number,
        time,
        table td {
            font-variant-numeric: tabular-nums;
            font-feature-settings: "tnum" 1;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: color var(--duration-fast) var(--ease-out-expo),
                        background-color var(--duration-fast) var(--ease-out-expo);
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        ::selection {
            background-color: rgba(232, 115, 74, 0.2);
            color: var(--text-primary);
        }

        :focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px var(--surface-base), 0 0 0 4px var(--accent-cta);
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  NAVBAR ARCHITECTURALE (SOLIDE, SANS DÉGRADÉ)                        ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .navbar {
            position: fixed;
            top: 0;
            inset-inline-start: 0;
            inset-inline-end: 0;
            z-index: 1000;
            height: var(--nav-height);
            padding-inline: clamp(1rem, 4vw, 2.5rem);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: oklch(0.998 0.001 255 / 0.94);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-subtle);
            box-shadow: var(--shadow-raised);
            transition: background-color var(--duration-base) var(--ease-out-expo),
                        box-shadow var(--duration-base) var(--ease-out-expo);
        }

        .navbar.scrolled {
            background-color: var(--surface-overlay);
            box-shadow: var(--shadow-card);
        }

        /* Monogramme & Marque */
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            flex-shrink: 0;
            user-select: none;
        }

        .nav-brand .logo-mark {
            width: 40px;
            height: 40px;
            background-color: var(--accent-primary);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-dark);
            box-shadow: inset 0 1px 0 0 oklch(1 0 0 / 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform var(--duration-fast) var(--ease-out-expo);
        }

        .nav-brand:hover .logo-mark {
            transform: scale(1.03);
        }

        .nav-brand:active .logo-mark {
            transform: scale(0.97);
        }

        .nav-brand .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .nav-brand .logo-text span {
            color: var(--accent-cta);
        }

        .nav-brand .logo-badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 2px 6px;
            background-color: var(--surface-sunken);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-xs);
            color: var(--text-muted);
            margin-inline-start: 4px;
        }

        /* Centre de navigation (Pilule solide) */
        .nav-center {
            position: absolute;
            inset-inline-start: 50%;
            transform: translateX(-50%);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            padding: 0.25rem;
            background-color: var(--surface-sunken);
            border-radius: var(--radius-full);
            border: 1px solid var(--border-subtle);
        }

        .nav-links li a {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            padding-block: 0.45rem;
            padding-inline: 0.95rem;
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--text-secondary);
            border-radius: var(--radius-full);
            transition: background-color var(--duration-fast) var(--ease-out-expo),
                        color var(--duration-fast) var(--ease-out-expo),
                        transform var(--duration-fast) var(--ease-out-expo);
        }

        .nav-links li a:hover {
            color: var(--text-primary);
            background-color: oklch(0 0 0 / 0.04);
        }

        .nav-links li a:active {
            transform: scale(0.98);
        }

        /* État actif : Solide ardoise, bordure 1px, zéro dégradé */
        .nav-links li a.active {
            color: var(--surface-raised);
            background-color: var(--accent-primary);
            box-shadow: inset 0 1px 0 0 oklch(1 0 0 / 0.12),
                        0 1px 2px 0 oklch(0 0 0 / 0.1);
        }

        .nav-links li a .nav-icon {
            font-size: 0.9rem;
            opacity: 0.75;
        }

        .nav-links li a.active .nav-icon {
            opacity: 1;
            color: var(--accent-warm);
        }

        /* Actions de navigation (droite) */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-shrink: 0;
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  SYSTÈME DE BOUTONS HAUT DE GAMME (8 ÉTATS D'INTERACTION)            ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding-block: 0.55rem;
            padding-inline: 1.15rem;
            border-radius: var(--radius-sm);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1.35;
            white-space: nowrap;
            cursor: pointer;
            border: 1px solid transparent;
            user-select: none;
            transition: background-color var(--duration-fast) var(--ease-out-expo),
                        border-color var(--duration-fast) var(--ease-out-expo),
                        color var(--duration-fast) var(--ease-out-expo),
                        transform var(--duration-fast) var(--ease-out-expo),
                        box-shadow var(--duration-fast) var(--ease-out-expo);
        }

        .btn-sm {
            padding-block: 0.4rem;
            padding-inline: 0.85rem;
            font-size: 0.8rem;
        }

        .btn-lg {
            padding-block: 0.75rem;
            padding-inline: 1.6rem;
            font-size: 0.95rem;
            border-radius: var(--radius-md);
        }

        /* Primaire Solide : Bleu marine (#1B3A5C) */
        .btn-primary {
            background-color: var(--accent-primary);
            color: #ffffff;
            border-color: var(--accent-primary);
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.16),
                        var(--shadow-raised);
        }

        .btn-primary:hover {
            background-color: var(--accent-primary-hover);
            border-color: var(--accent-primary-hover);
            color: #ffffff;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.2),
                        var(--shadow-card);
        }

        .btn-primary:active {
            transform: translateY(1px);
            background-color: #0E1F32;
        }

        /* Accent / CTA Solide : Orange chaud (#E8734A) */
        .btn-cta,
        .btn-brand,
        .btn-accent {
            background-color: var(--accent-cta);
            color: #ffffff;
            border-color: var(--accent-cta);
            font-weight: 700;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.25),
                        var(--shadow-raised);
        }

        .btn-cta:hover,
        .btn-brand:hover,
        .btn-accent:hover {
            background-color: var(--accent-cta-hover);
            border-color: var(--accent-cta-hover);
            color: #ffffff;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.3),
                        var(--shadow-card);
        }

        .btn-cta:active,
        .btn-brand:active,
        .btn-accent:active {
            transform: translateY(1px);
            background-color: var(--color-cta-active);
        }

        /* Secondaire : Gris ardoise (#5A6B7B) sur surface blanche */
        .btn-secondary {
            background-color: var(--surface-raised);
            color: var(--color-secondary);
            border-color: var(--border-default);
            box-shadow: var(--shadow-raised);
        }

        .btn-secondary:hover {
            background-color: var(--surface-sunken);
            border-color: var(--color-secondary);
            color: var(--color-text-main);
        }

        .btn-secondary:active {
            transform: translateY(1px);
        }

        /* Bouton Fantôme (Ghost) */
        .btn-ghost {
            background-color: transparent;
            color: var(--text-secondary);
            border-color: transparent;
        }

        .btn-ghost:hover {
            background-color: oklch(0 0 0 / 0.05);
            color: var(--text-primary);
        }

        .btn-ghost:active {
            transform: translateY(1px);
        }

        /* Bouton Inversé (Sur surface sombre) */
        .btn-inverse {
            background-color: var(--surface-raised);
            color: var(--text-primary);
            border-color: var(--surface-raised);
            box-shadow: var(--shadow-card);
        }

        .btn-inverse:hover {
            background-color: var(--surface-sunken);
        }

        .btn-inverse-outline {
            background-color: transparent;
            color: var(--text-inverse);
            border-color: var(--border-dark);
        }

        .btn-inverse-outline:hover {
            background-color: oklch(1 0 0 / 0.08);
            border-color: var(--text-inverse-muted);
        }

        .btn:disabled, .btn[aria-disabled="true"] {
            opacity: 0.45;
            cursor: not-allowed;
            pointer-events: none;
            box-shadow: none;
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  MENU UTILISATEUR & DROPDOWN DÉCLARATIF                              ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .user-menu-wrapper {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            padding-block: 0.3rem;
            padding-inline: 0.65rem 0.35rem;
            border: 1px solid var(--border-default);
            border-radius: var(--radius-full);
            background-color: var(--surface-raised);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-primary);
            transition: border-color var(--duration-fast) var(--ease-out-expo),
                        box-shadow var(--duration-fast) var(--ease-out-expo),
                        transform var(--duration-fast) var(--ease-out-expo);
        }

        .user-trigger:hover {
            border-color: var(--border-strong);
            box-shadow: var(--shadow-raised);
        }

        .user-trigger:active {
            transform: translateY(1px);
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--accent-brand);
            color: var(--surface-raised);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
            border: 1px solid oklch(1 0 0 / 0.2);
            position: relative;
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            bottom: -1px;
            right: -1px;
            width: 8px;
            height: 8px;
            background-color: oklch(0.62 0.17 145);
            border: 1.5px solid var(--surface-raised);
            border-radius: 50%;
        }

        .user-trigger .chevron {
            font-size: 0.7rem;
            color: var(--text-muted);
            transition: transform var(--duration-fast) var(--ease-out-expo);
        }

        .user-menu-wrapper.open .chevron {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            inset-inline-end: 0;
            min-width: 240px;
            background-color: var(--surface-overlay);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-default);
            box-shadow: var(--shadow-overlay);
            padding: 0.35rem;
            z-index: 999;
            animation: menuDrop 150ms var(--ease-out-expo);
        }

        .dropdown-menu.show {
            display: block;
        }

        @keyframes menuDrop {
            from {
                opacity: 0;
                transform: translateY(-6px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dropdown-header {
            padding: 0.65rem 0.75rem;
            border-bottom: 1px solid var(--border-subtle);
            margin-bottom: 0.25rem;
        }

        .dropdown-header .name {
            font-size: 0.84rem;
            font-weight: 700;
            color: var(--text-primary);
            display: block;
        }

        .dropdown-header .email {
            font-size: 0.74rem;
            color: var(--text-muted);
            display: block;
            margin-top: 2px;
            word-break: break-all;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 0.75rem;
            border-radius: var(--radius-xs);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: background-color var(--duration-fast) var(--ease-out-expo),
                        color var(--duration-fast) var(--ease-out-expo);
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            text-align: start;
        }

        .dropdown-item:hover {
            background-color: var(--surface-sunken);
            color: var(--text-primary);
        }

        .dropdown-item i {
            font-size: 0.95rem;
            opacity: 0.75;
        }

        .dropdown-item.danger {
            color: var(--status-danger-text);
        }

        .dropdown-item.danger:hover {
            background-color: var(--status-danger-bg);
            color: var(--status-danger-text);
        }

        .dropdown-divider {
            height: 1px;
            background-color: var(--border-subtle);
            margin: 0.25rem 0;
        }

        /* Hamburger mobile */
        .hamburger {
            display: none;
            width: 38px;
            height: 38px;
            align-items: center;
            justify-content: center;
            background-color: var(--surface-raised);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-sm);
            cursor: pointer;
            color: var(--text-primary);
            transition: background-color var(--duration-fast) var(--ease-out-expo);
        }

        .hamburger:hover {
            background-color: var(--surface-sunken);
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  MESSAGES FLASH (SOLIDES, ACCESSIBLES, ZÉRO DÉGRADÉ)                 ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .flash-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-inline: clamp(1rem, 4vw, 2.5rem);
            padding-top: 1rem;
            width: 100%;
        }

        .flash-msg {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1.15rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            box-shadow: var(--shadow-raised);
            margin-bottom: 0.5rem;
            animation: flashSlide 200ms var(--ease-out-expo);
        }

        .flash-success {
            background-color: var(--status-success-bg);
            color: var(--status-success-text);
            border: 1px solid var(--status-success-border);
        }

        .flash-error {
            background-color: var(--status-danger-bg);
            color: var(--status-danger-text);
            border: 1px solid var(--status-danger-border);
        }

        @keyframes flashSlide {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  CONTENU PRINCIPAL                                                   ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .main-content {
            margin-top: var(--nav-height);
            flex: 1 0 auto;
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  FOOTER MATÉRIEL SOLIDE (ZÉRO DÉGRADÉ)                               ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .site-footer {
            background-color: var(--surface-dark-sunken);
            color: var(--text-inverse-muted);
            border-top: 1px solid var(--border-dark);
            margin-top: auto;
            position: relative;
        }

        .footer-main {
            max-width: 1240px;
            margin: 0 auto;
            padding: 4.5rem clamp(1rem, 4vw, 2.5rem) 3rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.3fr;
            gap: 3rem;
        }

        .footer-brand-col .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .footer-brand-col .footer-logo-mark {
            width: 36px;
            height: 36px;
            background-color: var(--surface-dark-raised);
            border: 1px solid var(--border-dark);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-inverse);
        }

        .footer-brand-col .footer-logo span {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-inverse);
            letter-spacing: -0.02em;
        }

        .footer-brand-col .footer-logo span em {
            font-style: normal;
            color: var(--accent-warm);
        }

        .footer-brand-col p {
            font-size: 0.88rem;
            line-height: 1.75;
            max-width: 340px;
            color: var(--text-inverse-muted);
        }

        .footer-socials {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .footer-socials a {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            background-color: var(--surface-dark-base);
            border: 1px solid var(--border-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-inverse-muted);
            font-size: 0.95rem;
            transition: background-color var(--duration-fast) var(--ease-out-expo),
                        color var(--duration-fast) var(--ease-out-expo),
                        transform var(--duration-fast) var(--ease-out-expo);
        }

        .footer-socials a:hover {
            background-color: var(--accent-brand);
            border-color: var(--accent-brand);
            color: var(--surface-raised);
            transform: translateY(-2px);
        }

        .footer-col-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--text-inverse);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-col-title::before {
            content: '';
            width: 12px;
            height: 2px;
            background-color: var(--accent-brand);
            border-radius: 1px;
        }

        .footer-link-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .footer-link-list a {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.875rem;
            color: var(--text-inverse-muted);
            transition: color var(--duration-fast) var(--ease-out-expo),
                        transform var(--duration-fast) var(--ease-out-expo);
        }

        .footer-link-list a:hover {
            color: var(--text-inverse);
            transform: translateX(3px);
        }

        .footer-contact-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .footer-contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.875rem;
        }

        .footer-contact-list .fc-icon {
            width: 28px;
            height: 28px;
            border-radius: var(--radius-xs);
            background-color: var(--surface-dark-base);
            border: 1px solid var(--border-dark);
            color: var(--accent-warm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-contact-list strong {
            display: block;
            color: var(--text-inverse);
            font-weight: 600;
            font-size: 0.82rem;
        }

        .footer-contact-list span {
            font-size: 0.82rem;
            color: var(--text-inverse-muted);
        }

        .footer-bottom {
            max-width: 1240px;
            margin: 0 auto;
            padding: 1.5rem clamp(1rem, 4vw, 2.5rem);
            border-top: 1px solid var(--border-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: oklch(0.60 0.01 250);
        }

        .footer-bottom-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-bottom-links a {
            color: oklch(0.60 0.01 250);
            transition: color var(--duration-fast) var(--ease-out-expo);
        }

        .footer-bottom-links a:hover {
            color: var(--text-inverse);
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  RESPONSIVE ET ADAPTATIVITÉ MOBILE                                   ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        @media (max-width: 992px) {
            .nav-center {
                position: fixed;
                top: var(--nav-height);
                inset-inline-start: 0;
                inset-inline-end: 0;
                transform: none;
                background-color: var(--surface-overlay);
                border-bottom: 1px solid var(--border-default);
                box-shadow: var(--shadow-overlay);
                display: none;
                padding: 1rem;
            }

            .nav-center.open {
                display: block;
                animation: mobileSlide 180ms var(--ease-out-expo);
            }

            @keyframes mobileSlide {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .nav-links {
                flex-direction: column;
                gap: 0.35rem;
                background-color: transparent;
                border: none;
                padding: 0;
            }

            .nav-links li a {
                padding: 0.75rem 1rem;
                border-radius: var(--radius-sm);
                font-size: 0.95rem;
                min-height: 44px; /* Touch target minimum */
            }

            .nav-links li a.active {
                background-color: var(--surface-sunken);
                color: var(--text-primary);
                border: 1px solid var(--border-subtle);
                box-shadow: none;
            }

            .hamburger {
                display: flex;
            }

            .footer-main {
                grid-template-columns: 1fr 1fr;
                gap: 2.5rem;
            }
        }

        @media (max-width: 640px) {
            .footer-main {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding-block: 3rem 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }

            .user-trigger .user-name {
                display: none;
            }
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  BOUTON DANGER (ACCESSIBLE, SOLIDE, ZÉRO DÉGRADÉ)                    ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .btn-danger,
        .btn-danger-solid {
            background-color: #DC2626;
            color: #FFFFFF;
            border-color: #DC2626;
            font-weight: 700;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.2), var(--shadow-raised);
        }

        .btn-danger:hover,
        .btn-danger-solid:hover {
            background-color: #B91C1C;
            border-color: #B91C1C;
            color: #FFFFFF;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.25), var(--shadow-card);
        }

        .btn-danger:active,
        .btn-danger-solid:active {
            transform: translateY(1px);
            background-color: #991B1B;
            border-color: #991B1B;
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  MODALE DE CONFIRMATION HAUT DE GAMME (SKILL_DESIGN)                 ║
           ║  Zéro Dégradé • Flou d'Arrière-Plan • Focus Piégé • Accessibilité   ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .confirm-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            background-color: rgba(14, 31, 50, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity var(--duration-base) var(--ease-out-expo),
                        visibility var(--duration-base) var(--ease-out-expo);
        }

        .confirm-modal-backdrop.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .confirm-modal-card {
            position: relative;
            background-color: var(--surface-overlay);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 45px -10px rgba(14, 31, 50, 0.28),
                        0 8px 18px -4px rgba(14, 31, 50, 0.12);
            width: 100%;
            max-width: 440px;
            padding: 1.75rem;
            overflow: hidden;
            transform: scale(0.95) translateY(-8px);
            transition: transform var(--duration-base) var(--ease-out-expo);
        }

        .confirm-modal-backdrop.active .confirm-modal-card {
            transform: scale(1) translateY(0);
        }

        .confirm-modal-close {
            position: absolute;
            top: 1rem;
            inset-inline-end: 1rem;
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            border: 1px solid transparent;
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            transition: background-color var(--duration-fast) var(--ease-out-expo),
                        color var(--duration-fast) var(--ease-out-expo),
                        border-color var(--duration-fast) var(--ease-out-expo);
        }

        .confirm-modal-close:hover {
            background-color: var(--surface-sunken);
            color: var(--text-primary);
            border-color: var(--border-subtle);
        }

        .confirm-modal-icon-badge {
            width: 52px;
            height: 52px;
            border-radius: var(--radius-md);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            font-size: 1.45rem;
            flex-shrink: 0;
        }

        .confirm-modal-icon-badge.danger {
            background-color: #FEE2E2;
            border: 1px solid #FCA5A5;
            color: #DC2626;
        }

        .confirm-modal-icon-badge.warning {
            background-color: #FFFBEB;
            border: 1px solid #FCD34D;
            color: #D97706;
        }

        .confirm-modal-header h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.015em;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .confirm-modal-message {
            font-size: 0.9rem;
            line-height: 1.55;
            color: var(--text-secondary);
            margin: 0;
        }

        .confirm-modal-warning-box {
            margin-top: 1rem;
            padding: 0.75rem 0.9rem;
            border-radius: var(--radius-sm);
            background-color: var(--surface-sunken);
            border: 1px solid var(--border-subtle);
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            line-height: 1.45;
        }

        .confirm-modal-warning-box i {
            color: #DC2626;
            font-size: 0.95rem;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .confirm-modal-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border-subtle);
        }

        .confirm-modal-actions .btn {
            min-height: 42px;
            font-size: 0.875rem;
            padding-inline: 1.25rem;
        }

        @media (max-width: 480px) {
            .confirm-modal-card {
                padding: 1.35rem;
            }
            .confirm-modal-actions {
                flex-direction: column-reverse;
                gap: 0.5rem;
            }
            .confirm-modal-actions .btn {
                width: 100%;
            }
        }

        /* ╔══════════════════════════════════════════════════════════════════════╗
           ║  PAGINATION HAUT DE GAMME (SKILL_DESIGN, ZÉRO DÉGRADÉ)               ║
           ╚══════════════════════════════════════════════════════════════════════╝ */
        .immopro-pagination {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            width: 100%;
            margin-block: 2.5rem 1rem;
        }

        @media (min-width: 640px) {
            .immopro-pagination {
                flex-direction: row;
            }
        }

        .immopro-pagination-summary {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .immopro-pagination-summary .tabular-nums {
            color: var(--text-primary);
            font-weight: 700;
        }

        .immopro-pagination-list {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            list-style: none;
            padding: 0.25rem;
            margin: 0;
            background-color: var(--surface-raised);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-raised);
        }

        .immopro-pagination-list .page-item {
            display: inline-flex;
        }

        .immopro-pagination-list .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding-inline: 0.65rem;
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            background-color: transparent;
            border: 1px solid transparent;
            text-decoration: none;
            user-select: none;
            transition: background-color var(--duration-fast) var(--ease-out-expo),
                        color var(--duration-fast) var(--ease-out-expo),
                        border-color var(--duration-fast) var(--ease-out-expo),
                        transform var(--duration-fast) var(--ease-out-expo);
        }

        .immopro-pagination-list .page-link:hover {
            background-color: var(--surface-sunken);
            color: var(--text-primary);
            border-color: var(--border-subtle);
        }

        .immopro-pagination-list .page-link:active {
            transform: scale(0.96);
        }

        .immopro-pagination-list .page-item.active .page-link {
            background-color: var(--accent-primary);
            color: #FFFFFF;
            border-color: var(--accent-primary);
            font-weight: 700;
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.15), var(--shadow-raised);
        }

        .immopro-pagination-list .page-item.disabled .page-link {
            opacity: 0.35;
            cursor: not-allowed;
            pointer-events: none;
        }

        .immopro-pagination-list .page-link.dots {
            min-width: 28px;
            letter-spacing: 0.1em;
            color: var(--text-muted);
        }

        /* Neutralisation stricte de tout SVG non contraint */
        nav[role="navigation"] svg {
            width: 1.15rem !important;
            height: 1.15rem !important;
            max-width: 20px !important;
            max-height: 20px !important;
            display: inline-block !important;
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  NAVBAR PRINCIPALE (ZÉRO DÉGRADÉ, SOLIDE & PRÉCISE)                  ║
         ╚══════════════════════════════════════════════════════════════════════╝ -->
    <nav class="navbar" id="navbar" aria-label="Navigation principale">
        {{-- Logo Monogramme solide --}}
        <a href="{{ url('/') }}" class="nav-brand" title="ImmoPro — Accueil">
            <div class="logo-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke="#ffffff" />
                    <polyline points="9 22 9 12 15 12 15 22" stroke="var(--accent-warm)" stroke-width="2.2" />
                </svg>
            </div>
            <div style="display: flex; align-items: baseline; gap: 0.35rem;">
                <span class="logo-text">Immo<span>Pro</span></span>
                <span class="logo-badge">CI</span>
            </div>
        </a>

        {{-- Navigation centrale en pilule matérielle --}}
        <div class="nav-center" id="navCenter">
            <ul class="nav-links" id="navLinks" role="menubar">
                <li role="none">
                    <a href="{{ url('/') }}" role="menuitem" class="{{ request()->is('/') ? 'active' : '' }}">
                        <i class="bi bi-house nav-icon" aria-hidden="true"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li role="none">
                    <a href="{{ route('annonces.index') }}" role="menuitem" class="{{ request()->routeIs('annonces.*') && !request()->routeIs('annonces.create') ? 'active' : '' }}">
                        <i class="bi bi-buildings nav-icon" aria-hidden="true"></i>
                        <span>Annonces</span>
                    </a>
                </li>
                <li role="none">
                    <a href="{{ route('biens.index') }}" role="menuitem" class="{{ request()->routeIs('biens.*') ? 'active' : '' }}">
                        <i class="bi bi-grid nav-icon" aria-hidden="true"></i>
                        <span>Catalogue</span>
                    </a>
                </li>
                <li role="none">
                    <a href="{{ route('apropos') }}" role="menuitem" class="{{ request()->routeIs('apropos') ? 'active' : '' }}">
                        <i class="bi bi-info-circle nav-icon" aria-hidden="true"></i>
                        <span>À propos</span>
                    </a>
                </li>
                <li role="none">
                    <a href="{{ route('contact') }}" role="menuitem" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        <i class="bi bi-chat-square-text nav-icon" aria-hidden="true"></i>
                        <span>Contact</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Actions et profil utilisateur --}}
        <div class="nav-actions">
            @auth
            @if(auth()->user()->peutPublierAnnonce())
            <a href="{{ route('annonces.create') }}" class="btn btn-brand btn-sm" style="display: inline-flex;">
                <i class="bi bi-plus-lg" aria-hidden="true"></i>
                <span style="font-weight: 700;">Publier</span>
            </a>
            @endif

            <div class="user-menu-wrapper" id="userMenu">
                <button type="button" class="user-trigger" onclick="toggleUserMenu()" aria-haspopup="menu" aria-expanded="false" aria-label="Menu du compte">
                    <span class="user-avatar" aria-hidden="true">
                        {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email, 0, 1)) }}
                    </span>
                    <span class="user-name">{{ Str::limit(auth()->user()->name ?? auth()->user()->email, 14) }}</span>
                    <i class="bi bi-chevron-down chevron" aria-hidden="true"></i>
                </button>

                <div class="dropdown-menu" id="dropdownMenu" role="menu">
                    <div class="dropdown-header">
                        <span class="name">{{ auth()->user()->name ?? 'Mon Compte' }}</span>
                        <span class="email tabular-nums">{{ auth()->user()->email }}</span>
                    </div>

                    <a href="{{ route('dashboard') }}" class="dropdown-item" role="menuitem">
                        <i class="bi bi-speedometer2" aria-hidden="true"></i>
                        <span>Tableau de bord</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="dropdown-item" role="menuitem">
                        <i class="bi bi-person-gear" aria-hidden="true"></i>
                        <span>Mon profil</span>
                    </a>

                    @if(auth()->user()->peutPublierAnnonce())
                    <a href="{{ route('annonces.mes-annonces') }}" class="dropdown-item" role="menuitem">
                        <i class="bi bi-collection" aria-hidden="true"></i>
                        <span>Mes annonces</span>
                    </a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item" role="menuitem">
                        <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        <span>Administration</span>
                    </a>
                    @endif

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item danger" role="menuitem">
                            <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">
                Connexion
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus" aria-hidden="true"></i>
                <span>Inscription</span>
            </a>
            @endauth

            <button type="button" class="hamburger" id="hamburger" onclick="toggleMobileMenu()" aria-label="Menu navigation mobile">
                <i class="bi bi-list" style="font-size: 1.3rem;"></i>
            </button>
        </div>
    </nav>

    <!-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  MESSAGES FLASH DU SYSTÈME                                           ║
         ╚══════════════════════════════════════════════════════════════════════╝ -->
    <main class="main-content">
        @if(session('success'))
        <div class="flash-container">
            <div class="flash-msg flash-success" role="alert">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="flash-container">
            <div class="flash-msg flash-error" role="alert">
                <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  FOOTER MATÉRIEL SOLIDE                                              ║
         ╚══════════════════════════════════════════════════════════════════════╝ -->
    <footer class="site-footer">
        <div class="footer-main">
            {{-- Colonne 1 : Marque & Présentation --}}
            <div class="footer-brand-col">
                <div class="footer-logo">
                    <div class="footer-logo-mark" aria-hidden="true">
                        <i class="bi bi-house-door-fill" style="font-size: 1.1rem; color: var(--accent-warm);"></i>
                    </div>
                    <span>Immo<em>Pro</em></span>
                </div>
                <p>
                    Plateforme technologique immobilière de référence en Côte d'Ivoire.
                    Nous connectons acquéreurs, locataires, propriétaires et agences certifiées
                    autour d'une expérience transparente et rigoureuse.
                </p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Colonne 2 : Navigation rapide --}}
            <div>
                <h4 class="footer-col-title">Navigation</h4>
                <ul class="footer-link-list">
                    <li><a href="{{ url('/') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Accueil</a></li>
                    <li><a href="{{ route('annonces.index') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Toutes les annonces</a></li>
                    <li><a href="{{ route('biens.index') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Catalogue des biens</a></li>
                    <li><a href="{{ route('apropos') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> À propos de nous</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Nous contacter</a></li>
                </ul>
            </div>

            {{-- Colonne 3 : Types de transactions --}}
            <div>
                <h4 class="footer-col-title">Immobilier</h4>
                <ul class="footer-link-list">
                    <li><a href="{{ route('annonces.index', ['type_offre' => 'vente']) }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Biens en vente</a></li>
                    <li><a href="{{ route('annonces.index', ['type_offre' => 'location']) }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Locations meublées</a></li>
                    <li><a href="{{ route('annonces.index', ['type_bien' => 'terrain']) }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Terrains & Lots</a></li>
                    <li><a href="{{ route('annonces.index', ['type_bien' => 'villa']) }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Villas d'exception</a></li>
                    @auth
                        @if(auth()->user()->peutPublierAnnonce())
                        <li><a href="{{ route('annonces.create') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Déposer une annonce</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('annonces.create') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Déposer une annonce</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Colonne 4 : Coordonnées réelles à Korhogo & Abidjan --}}
            <div>
                <h4 class="footer-col-title">Contact</h4>
                <ul class="footer-contact-list">
                    <li>
                        <span class="fc-icon" aria-hidden="true"><i class="bi bi-geo-alt"></i></span>
                        <div>
                            <strong>Korhogo & Abidjan</strong>
                            <span>Quartier Résidentiel, Korhogo, Côte d'Ivoire</span>
                        </div>
                    </li>
                    <li>
                        <span class="fc-icon" aria-hidden="true"><i class="bi bi-telephone"></i></span>
                        <div>
                            <strong>Téléphone direct</strong>
                            <span class="tabular-nums">+225 07 00 00 00 00</span>
                        </div>
                    </li>
                    <li>
                        <span class="fc-icon" aria-hidden="true"><i class="bi bi-envelope"></i></span>
                        <div>
                            <strong>Support client</strong>
                            <span>contact@immopro-ci.com</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <span class="tabular-nums">{{ date('Y') }}</span> ImmoPro CI — Architecture & Conception Haut de Gamme. Tous droits réservés.</p>
            <div class="footer-bottom-links">
                <a href="#">Confidentialité</a>
                <a href="#">Conditions Générales</a>
                <a href="#">Mentions Légales</a>
            </div>
        </div>
    </footer>

    <!-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  MODALE DE CONFIRMATION GLOBALE HAUT DE GAMME (SKILL_DESIGN)         ║
         ╚══════════════════════════════════════════════════════════════════════╝ -->
    <div id="confirmModalBackdrop" class="confirm-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="confirmModalTitle" aria-describedby="confirmModalMessage" tabindex="-1">
        <div class="confirm-modal-card" id="confirmModalCard" role="document">
            <button type="button" class="confirm-modal-close" onclick="window.closeConfirmModal()" aria-label="Fermer la boîte de dialogue">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </button>
            <div class="confirm-modal-icon-badge danger" id="confirmModalBadge">
                <i class="bi bi-trash3-fill" id="confirmModalIcon" aria-hidden="true"></i>
            </div>
            <div class="confirm-modal-header">
                <h3 id="confirmModalTitle">Confirmer la suppression</h3>
                <p id="confirmModalMessage" class="confirm-modal-message">Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.</p>
            </div>
            <div class="confirm-modal-warning-box" id="confirmModalWarning">
                <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                <span>Cette opération entraînera la suppression définitive des données associées.</span>
            </div>
            <div class="confirm-modal-actions">
                <button type="button" class="btn btn-secondary" id="confirmModalCancelBtn" onclick="window.closeConfirmModal()">
                    Annuler
                </button>
                <button type="button" class="btn btn-danger-solid" id="confirmModalConfirmBtn">
                    <i class="bi bi-trash3" id="confirmModalBtnIcon" aria-hidden="true"></i>
                    <span id="confirmModalBtnLabel">Supprimer</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════════════════════════════════════════════╗
         ║  LOGIQUE D'INTERACTION FLUIDE (60/120FPS)                            ║
         ╚══════════════════════════════════════════════════════════════════════╝ -->
    <script>
        // Effet de défilement sur la Navbar avec seuil précis
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 8) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, { passive: true });

        // Menu Mobile (Drawer déclenchable)
        function toggleMobileMenu() {
            const navCenter = document.getElementById('navCenter');
            const isOpen = navCenter.classList.toggle('open');
            document.getElementById('hamburger')?.setAttribute('aria-expanded', String(isOpen));
        }

        // Fermeture automatique au clic sur un lien mobile
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('navCenter')?.classList.remove('open');
            });
        });

        // Menu déroulant Utilisateur
        function toggleUserMenu() {
            const wrapper = document.getElementById('userMenu');
            const menu = document.getElementById('dropdownMenu');
            if (!wrapper || !menu) return;
            const isOpen = wrapper.classList.toggle('open');
            menu.classList.toggle('show');
            wrapper.querySelector('.user-trigger')?.setAttribute('aria-expanded', String(isOpen));
        }

        // Fermeture au clic extérieur
        document.addEventListener('click', (e) => {
            const wrapper = document.getElementById('userMenu');
            const menu = document.getElementById('dropdownMenu');
            if (wrapper && menu && !wrapper.contains(e.target)) {
                wrapper.classList.remove('open');
                menu.classList.remove('show');
                wrapper.querySelector('.user-trigger')?.setAttribute('aria-expanded', 'false');
            }
        });

        // Fermeture via touche Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const confirmModal = document.getElementById('confirmModalBackdrop');
                if (confirmModal && confirmModal.classList.contains('active')) {
                    window.closeConfirmModal();
                    return;
                }
                document.getElementById('navCenter')?.classList.remove('open');
                const wrapper = document.getElementById('userMenu');
                const menu = document.getElementById('dropdownMenu');
                if (wrapper && menu) {
                    wrapper.classList.remove('open');
                    menu.classList.remove('show');
                    wrapper.querySelector('.user-trigger')?.setAttribute('aria-expanded', 'false');
                }
            }
        });

        // Effacement progressif fluide des messages flash
        document.querySelectorAll('.flash-msg').forEach(msg => {
            setTimeout(() => {
                msg.style.transition = 'opacity 180ms ease, transform 180ms ease';
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-6px)';
                setTimeout(() => msg.remove(), 200);
            }, 4500);
        });

        // ╔══════════════════════════════════════════════════════════════════════╗
        // ║  GESTIONNAIRE MODALE DE CONFIRMATION HAUT DE GAMME                   ║
        // ╚══════════════════════════════════════════════════════════════════════╝
        let activeConfirmAction = null;
        let activeConfirmTrigger = null;

        window.openConfirmModal = function(options = {}) {
            const {
                title = 'Confirmer la suppression',
                message = 'Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.',
                confirmText = 'Supprimer',
                cancelText = 'Annuler',
                danger = true,
                warning = 'Cette opération entraînera la suppression définitive des données associées.',
                icon = danger ? 'bi-trash3-fill' : 'bi-exclamation-circle-fill',
                onConfirm = () => {}
            } = options;

            const backdrop = document.getElementById('confirmModalBackdrop');
            const titleEl = document.getElementById('confirmModalTitle');
            const msgEl = document.getElementById('confirmModalMessage');
            const confirmBtn = document.getElementById('confirmModalConfirmBtn');
            const cancelBtn = document.getElementById('confirmModalCancelBtn');
            const btnLabel = document.getElementById('confirmModalBtnLabel');
            const btnIcon = document.getElementById('confirmModalBtnIcon');
            const badge = document.getElementById('confirmModalBadge');
            const iconEl = document.getElementById('confirmModalIcon');
            const warningBox = document.getElementById('confirmModalWarning');

            if (!backdrop) return;

            activeConfirmAction = onConfirm;
            activeConfirmTrigger = document.activeElement;

            if (titleEl) titleEl.textContent = title;
            if (msgEl) msgEl.textContent = message;
            if (btnLabel) btnLabel.textContent = confirmText;
            if (cancelBtn) cancelBtn.textContent = cancelText;

            if (warningBox) {
                if (warning) {
                    const spanEl = warningBox.querySelector('span');
                    if (spanEl) spanEl.textContent = warning;
                    warningBox.style.display = 'flex';
                } else {
                    warningBox.style.display = 'none';
                }
            }

            if (iconEl) {
                iconEl.className = 'bi ' + icon;
            }

            if (danger) {
                if (badge) badge.className = 'confirm-modal-icon-badge danger';
                if (confirmBtn) confirmBtn.className = 'btn btn-danger-solid';
                if (btnIcon) {
                    btnIcon.style.display = 'inline-block';
                    btnIcon.className = 'bi bi-trash3';
                }
            } else {
                if (badge) badge.className = 'confirm-modal-icon-badge warning';
                if (confirmBtn) confirmBtn.className = 'btn btn-primary';
                if (btnIcon) btnIcon.style.display = 'none';
            }

            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Accessibilité & Sécurité : focus prioritaire sur Annuler pour prévenir les fausses manipulations
            setTimeout(() => {
                cancelBtn?.focus();
            }, 50);
        };

        window.closeConfirmModal = function() {
            const backdrop = document.getElementById('confirmModalBackdrop');
            if (backdrop) {
                backdrop.classList.remove('active');
                document.body.style.overflow = '';
            }
            activeConfirmAction = null;
            if (activeConfirmTrigger && typeof activeConfirmTrigger.focus === 'function') {
                activeConfirmTrigger.focus();
            }
        };

        // Bouton de confirmation du dialogue
        document.getElementById('confirmModalConfirmBtn')?.addEventListener('click', () => {
            if (typeof activeConfirmAction === 'function') {
                const action = activeConfirmAction;
                window.closeConfirmModal();
                action();
            } else {
                window.closeConfirmModal();
            }
        });

        // Fermeture au clic sur le backdrop
        document.getElementById('confirmModalBackdrop')?.addEventListener('click', (e) => {
            if (e.target.id === 'confirmModalBackdrop') {
                window.closeConfirmModal();
            }
        });

        // Interception globale des soumissions de formulaire avec data-confirm
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (form && form.matches('form[data-confirm]')) {
                if (form.dataset.confirmed === 'true') {
                    form.removeAttribute('data-confirmed');
                    return true;
                }
                e.preventDefault();
                window.openConfirmModal({
                    title: form.dataset.confirmTitle || 'Confirmer la suppression',
                    message: form.dataset.confirm,
                    confirmText: form.dataset.confirmBtn || 'Supprimer',
                    cancelText: form.dataset.confirmCancel || 'Annuler',
                    warning: form.dataset.confirmWarning !== undefined ? form.dataset.confirmWarning : 'Cette opération entraînera la suppression définitive des données associées.',
                    danger: form.dataset.confirmDanger !== 'false',
                    icon: form.dataset.confirmIcon || (form.dataset.confirmDanger === 'false' ? 'bi-exclamation-circle-fill' : 'bi-trash3-fill'),
                    onConfirm: () => {
                        form.dataset.confirmed = 'true';
                        form.submit();
                    }
                });
            }
        });

        // Mise à niveau transparente et automatique des formulaires / boutons avec confirm() natif
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
                const onsubmitAttr = form.getAttribute('onsubmit');
                const match = onsubmitAttr.match(/confirm\(['"]([^'"]+)['"]\)/);
                if (match && match[1]) {
                    const msg = match[1];
                    form.removeAttribute('onsubmit');
                    if (!form.dataset.confirm) form.dataset.confirm = msg;
                    if (!form.dataset.confirmTitle) form.dataset.confirmTitle = 'Confirmer la suppression';
                }
            });

            document.querySelectorAll('button[onclick*="confirm"], a[onclick*="confirm"]').forEach(btn => {
                const form = btn.closest('form');
                const onclickAttr = btn.getAttribute('onclick');
                const match = onclickAttr.match(/confirm\(['"]([^'"]+)['"]\)/);
                if (match && match[1] && form) {
                    btn.removeAttribute('onclick');
                    if (!form.dataset.confirm) form.dataset.confirm = match[1];
                    if (!form.dataset.confirmTitle) form.dataset.confirmTitle = 'Confirmer l\'action';
                    if (match[1].toLowerCase().includes('refuser')) {
                        form.dataset.confirmDanger = 'false';
                        form.dataset.confirmBtn = 'Confirmer le refus';
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>