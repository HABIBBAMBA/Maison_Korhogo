<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="ImmoPro — Votre partenaire immobilier de confiance">
    <title>@yield('title', 'ImmoPro — Immobilier')</title>

    <!-- Favicon SVG inline -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%23284b63'/%3E%3Cpath d='M8 24V12l8-5.5L24 12v12' stroke='white' stroke-width='2.2' fill='none'/%3E%3Crect x='13' y='17' width='6' height='7' rx='1' fill='white' opacity='.9'/%3E%3Ccircle cx='16' cy='13' r='2' fill='white' opacity='.6'/%3E%3C/svg%3E">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ╔══════════════════════════════════════════════╗
           ║  VARIABLES & RESET                          ║
           ╚══════════════════════════════════════════════╝ */
        :root {
            --primary: #284b63;
            --primary-light: #3a6a8a;
            --primary-dark: #1a3447;
            --primary-rgb: 40, 75, 99;
            --teal: #3c6e71;
            --teal-light: #4f8a8e;
            --teal-rgb: 60, 110, 113;
            --accent: #d4a853;
            --dark: #1a1a2e;
            --gray-900: #2d2d3f;
            --gray-700: #4a4a5c;
            --gray-500: #7a7a8c;
            --gray-300: #b8b8c8;
            --gray-100: #efeff4;
            --white: #ffffff;
            --light-bg: #f7f8fb;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
            --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12), 0 4px 12px rgba(0, 0, 0, 0.06);
            --shadow-xl: 0 20px 60px rgba(0, 0, 0, 0.15);
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-full: 9999px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            --nav-height: 76px;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--light-bg);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            line-height: 1.25;
            color: var(--dark);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        img {
            max-width: 100%;
            height: auto;
        }

        ::selection {
            background: rgba(60, 110, 113, 0.15);
            color: var(--primary-dark);
        }

        :focus-visible {
            outline: 2px solid var(--teal);
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ╔══════════════════════════════════════════════╗
           ║  NAVBAR                                     ║
           ╚══════════════════════════════════════════════╝ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: var(--nav-height);
            padding: 0 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            transition: var(--transition);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.06), var(--shadow-sm);
        }

        /* Logo */
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .nav-brand .logo-mark {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .nav-brand:hover .logo-mark {
            transform: scale(1.05);
        }

        .nav-brand .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.02em;
        }

        .nav-brand .logo-text span {
            color: var(--teal);
        }

        /* Navigation links */
        .nav-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            list-style: none;
            padding: 0.25rem;
            background: rgba(0, 0, 0, 0.02);
            border-radius: var(--radius-full);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .nav-links li a {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            font-size: 0.87rem;
            font-weight: 600;
            color: var(--gray-700);
            border-radius: var(--radius-full);
            position: relative;
            transition: var(--transition-fast);
        }

        .nav-links li a .nav-icon {
            font-size: 0.95rem;
            opacity: 0.6;
            transition: var(--transition-fast);
        }

        .nav-links li a:hover {
            color: var(--primary);
            background: rgba(var(--primary-rgb), 0.06);
        }

        .nav-links li a:hover .nav-icon {
            opacity: 1;
        }

        .nav-links li a.active {
            color: var(--white);
            background: linear-gradient(135deg, var(--primary), var(--teal));
            box-shadow: 0 2px 10px rgba(var(--primary-rgb), 0.3);
        }

        .nav-links li a.active .nav-icon {
            opacity: 1;
        }

        /* Nav actions (right side) */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-shrink: 0;
        }

        /* ╔══════════════════════════════════════════════╗
           ║  BUTTONS                                    ║
           ╚══════════════════════════════════════════════╝ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1.4rem;
            border-radius: var(--radius-full);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
            line-height: 1.4;
        }

        .btn-sm {
            padding: 0.45rem 1rem;
            font-size: 0.8rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: var(--white);
            box-shadow: 0 2px 12px rgba(var(--primary-rgb), 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(var(--primary-rgb), 0.35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn:focus-visible {
            outline: 2px solid var(--teal);
            outline-offset: 2px;
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid rgba(var(--primary-rgb), 0.2);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            background: rgba(var(--primary-rgb), 0.04);
        }

        .btn-ghost {
            background: transparent;
            color: var(--gray-700);
            padding: 0.55rem 1rem;
        }

        .btn-ghost:hover {
            color: var(--primary);
            background: rgba(var(--primary-rgb), 0.05);
        }

        .btn-icon {
            width: 38px;
            height: 38px;
            padding: 0;
            border-radius: 10px;
            font-size: 1.05rem;
        }

        /* ╔══════════════════════════════════════════════╗
           ║  USER MENU DROPDOWN                         ║
           ╚══════════════════════════════════════════════╝ */
        .user-menu-wrapper {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.7rem 0.3rem 0.3rem;
            border: 1.5px solid var(--gray-100);
            border-radius: var(--radius-full);
            background: var(--white);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--dark);
            transition: var(--transition);
        }

        .user-trigger:hover {
            border-color: var(--gray-300);
            box-shadow: var(--shadow-sm);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            flex-shrink: 0;
            position: relative;
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            bottom: -1px;
            right: -1px;
            width: 10px;
            height: 10px;
            background: var(--success);
            border: 2px solid var(--white);
            border-radius: 50%;
        }

        .user-trigger .chevron {
            font-size: 0.65rem;
            color: var(--gray-500);
            transition: var(--transition-fast);
        }

        .user-menu-wrapper.open .chevron {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 240px;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 0.5rem;
            z-index: 999;
            animation: dropIn 0.2s ease;
        }

        .dropdown-menu.show {
            display: block;
        }

        @keyframes dropIn {
            from {
                opacity: 0;
                transform: translateY(-8px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dropdown-header {
            padding: 0.75rem 0.8rem;
            border-bottom: 1px solid var(--gray-100);
            margin-bottom: 0.3rem;
        }

        .dropdown-header .name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dark);
            display: block;
        }

        .dropdown-header .email {
            font-size: 0.75rem;
            color: var(--gray-500);
            display: block;
            margin-top: 0.1rem;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.6rem 0.8rem;
            border-radius: var(--radius-sm);
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--gray-700);
            transition: var(--transition-fast);
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            font-family: inherit;
            text-align: left;
        }

        .dropdown-item:hover {
            background: var(--gray-100);
            color: var(--dark);
        }

        .dropdown-item i {
            font-size: 1rem;
            width: 18px;
            text-align: center;
            opacity: 0.65;
        }

        .dropdown-item.danger {
            color: var(--danger);
        }

        .dropdown-item.danger:hover {
            background: #fef2f2;
        }

        .dropdown-item.danger i {
            opacity: 1;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--gray-100);
            margin: 0.3rem 0;
        }

        /* ╔══════════════════════════════════════════════╗
           ║  MOBILE HAMBURGER                           ║
           ╚══════════════════════════════════════════════╝ */
        .hamburger {
            display: none;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            background: var(--gray-100);
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .hamburger:hover {
            background: var(--gray-300);
        }

        .hamburger svg {
            width: 20px;
            height: 20px;
            stroke: var(--dark);
            stroke-width: 2;
            stroke-linecap: round;
        }

        /* ╔══════════════════════════════════════════════╗
           ║  FLASH MESSAGES                             ║
           ╚══════════════════════════════════════════════╝ */
        .flash-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2.5rem 0;
        }

        .flash-msg {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1.25rem;
            border-radius: var(--radius);
            font-size: 0.88rem;
            font-weight: 500;
            animation: slideDown 0.4s ease;
            margin-bottom: 0.5rem;
        }

        .flash-msg i {
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .flash-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .flash-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ╔══════════════════════════════════════════════╗
           ║  MAIN CONTENT                               ║
           ╚══════════════════════════════════════════════╝ */
        .main-content {
            margin-top: var(--nav-height);
            min-height: calc(100vh - var(--nav-height));
        }

        /* ╔══════════════════════════════════════════════╗
           ║  FOOTER                                     ║
           ╚══════════════════════════════════════════════╝ */
        .site-footer {
            background: var(--dark);
            color: rgba(255, 255, 255, 0.65);
            margin-top: 5rem;
            position: relative;
            overflow: hidden;
        }

        .site-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(60, 110, 113, 0.4), transparent);
        }

        .footer-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2.5rem 3rem;
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1.2fr;
            gap: 3rem;
        }

        .footer-brand-col .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.2rem;
        }

        .footer-brand-col .footer-logo svg {
            width: 36px;
            height: 36px;
        }

        .footer-brand-col .footer-logo span {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--white);
        }

        .footer-brand-col .footer-logo span em {
            font-style: normal;
            color: var(--teal-light);
        }

        .footer-brand-col p {
            font-size: 0.88rem;
            line-height: 1.8;
            max-width: 300px;
        }

        .footer-socials {
            display: flex;
            gap: 0.6rem;
            margin-top: 1.5rem;
        }

        .footer-socials a {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1rem;
            transition: var(--transition);
        }

        .footer-socials a:hover {
            background: var(--teal);
            border-color: var(--teal);
            color: var(--white);
            transform: translateY(-2px);
        }

        .footer-col-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--white);
            margin-bottom: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .footer-col-title::before {
            content: '';
            width: 16px;
            height: 2px;
            background: var(--teal);
            border-radius: 2px;
        }

        .footer-link-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
        }

        .footer-link-list a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.87rem;
            color: rgba(255, 255, 255, 0.55);
            transition: var(--transition);
        }

        .footer-link-list a::before {
            content: '';
            width: 0;
            height: 1.5px;
            background: var(--teal-light);
            border-radius: 2px;
            transition: var(--transition);
        }

        .footer-link-list a:hover {
            color: var(--white);
            padding-left: 0.3rem;
        }

        .footer-link-list a:hover::before {
            width: 10px;
        }

        .footer-contact-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .footer-contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            font-size: 0.87rem;
        }

        .footer-contact-list .fc-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }

        .footer-contact-list .fc-icon svg {
            width: 14px;
            height: 14px;
        }

        .footer-contact-list strong {
            display: block;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 600;
            font-size: 0.82rem;
        }

        .footer-contact-list span {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.45);
        }

        /* Footer bottom */
        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem 2.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.35);
        }

        .footer-bottom-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.78rem;
        }

        .footer-bottom-links a:hover {
            color: rgba(255, 255, 255, 0.7);
        }

        /* ╔══════════════════════════════════════════════╗
           ║  RESPONSIVE                                 ║
           ╚══════════════════════════════════════════════╝ */
        @media (max-width: 992px) {
            .navbar {
                padding: 0 1.5rem;
            }

            .nav-center {
                position: fixed;
                top: var(--nav-height);
                left: 0;
                right: 0;
                transform: none;
                background: var(--white);
                border-bottom: 1px solid var(--gray-100);
                box-shadow: var(--shadow-lg);
                display: none;
                padding: 1rem;
                animation: slideDown 0.25s ease;
            }

            .nav-center.open {
                display: block;
            }

            .nav-links {
                flex-direction: column;
                gap: 0.25rem;
                background: transparent;
                border: none;
                padding: 0;
                border-radius: var(--radius);
            }

            .nav-links li a {
                padding: 0.75rem 1rem;
                border-radius: var(--radius-sm);
                font-size: 0.92rem;
            }

            .nav-links li a.active {
                background: rgba(var(--primary-rgb), 0.06);
                color: var(--primary);
            }

            .hamburger {
                display: flex;
            }

            .footer-main {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 1rem;
            }

            .flash-container {
                padding: 1rem 1rem 0;
            }

            .footer-main {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 3rem 1.5rem 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 0.8rem;
                text-align: center;
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-brand .logo-text {
                font-size: 1.2rem;
            }

            .user-trigger .user-name {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ╔══════════════════════════════════════════════╗
         ║  NAVBAR                                     ║
         ╚══════════════════════════════════════════════╝ -->
    <nav class="navbar" id="navbar">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="nav-brand">
            <div class="logo-mark">
                <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="10" fill="url(#logo-grad)" />
                    <path d="M10 28V16l10-7 10 7v12" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    <rect x="15" y="21" width="10" height="7" rx="1.5" fill="#fff" opacity=".9" />
                    <circle cx="20" cy="17" r="2.5" fill="#fff" opacity=".5" />
                    <defs>
                        <linearGradient id="logo-grad" x1="0" y1="0" x2="40" y2="40">
                            <stop stop-color="#284b63" />
                            <stop offset="1" stop-color="#3c6e71" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <span class="logo-text">Immo<span>Pro</span></span>
        </a>

        {{-- Nav center (pill style) --}}
        <div class="nav-center" id="navCenter">
            <ul class="nav-links" id="navLinks">
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 20 20" fill="none" width="16" height="16">
                            <path d="M3 10.5 10 4l7 6.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.5 9v7a1 1 0 0 0 1 1h3v-4h3v4h3a1 1 0 0 0 1-1V9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('biens.index') }}" class="{{ request()->routeIs('biens.*') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 20 20" fill="none" width="16" height="16">
                            <rect x="2" y="6" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.8" />
                            <path d="M6 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="1.8" />
                            <path d="M2 11h16" stroke="currentColor" stroke-width="1.8" />
                        </svg>
                        Biens
                    </a>
                </li>
                <li>
                    <a href="{{ route('apropos') }}" class="{{ request()->routeIs('apropos') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 20 20" fill="none" width="16" height="16">
                            <circle cx="10" cy="10" r="7.5" stroke="currentColor" stroke-width="1.8" />
                            <path d="M10 6.5v.01M10 9v5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        À propos
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 20 20" fill="none" width="16" height="16">
                            <path d="M3 5h14a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" />
                            <path d="m1 7 7.5 5L17 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Contact
                    </a>
                </li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="nav-actions">
            @auth
            <div class="user-menu-wrapper" id="userMenu">
                <button class="user-trigger" onclick="toggleUserMenu()">
                    <span class="user-avatar">
                        <svg viewBox="0 0 16 16" fill="none" width="14" height="14">
                            <circle cx="8" cy="6" r="3" stroke="#fff" stroke-width="1.8" />
                            <path d="M2.5 14.5c0-3 2.5-5 5.5-5s5.5 2 5.5 5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="user-name">{{ Str::limit(auth()->user()->email, 15) }}</span>
                    <svg class="chevron" viewBox="0 0 12 12" width="12" height="12" fill="none">
                        <path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div class="dropdown-menu" id="dropdownMenu">
                    <div class="dropdown-header">
                        <span class="name">{{ auth()->user()->name ?? 'Utilisateur' }}</span>
                        <span class="email">{{ auth()->user()->email }}</span>
                    </div>
                    <a href="{{ route('dashboard') }}" class="dropdown-item">
                        <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                            <rect x="1" y="1" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.6" />
                            <rect x="11" y="1" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.6" />
                            <rect x="1" y="11" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.6" />
                            <rect x="11" y="11" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="#" class="dropdown-item">
                        <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                            <circle cx="9" cy="6" r="3.5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M2 16.5c0-3.5 3-6 7-6s7 2.5 7 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                        Mon profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item danger">
                            <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                                <path d="M6 16H3.5A1.5 1.5 0 0 1 2 14.5v-11A1.5 1.5 0 0 1 3.5 2H6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                <path d="m12 13 4-4-4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 9h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                <svg viewBox="0 0 16 16" width="14" height="14" fill="none">
                    <path d="M8 2v12M2 8h12" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                </svg>
                Inscription
            </a>
            @endauth

            <button class="hamburger" id="hamburger" onclick="toggleMobileMenu()" aria-label="Menu">
                <svg viewBox="0 0 20 20" id="hamburgerIcon">
                    <line x1="3" y1="5" x2="17" y2="5" />
                    <line x1="3" y1="10" x2="17" y2="10" />
                    <line x1="3" y1="15" x2="17" y2="15" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- ╔══════════════════════════════════════════════╗
         ║  MAIN                                       ║
         ╚══════════════════════════════════════════════╝ -->
    <main class="main-content">
        @if(session('success'))
        <div class="flash-container">
            <div class="flash-msg flash-success">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.8" />
                    <path d="M7 10l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="flash-container">
            <div class="flash-msg flash-error">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none">
                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.8" />
                    <path d="M10 6.5v4M10 13h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                {{ session('error') }}
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- ╔══════════════════════════════════════════════╗
         ║  FOOTER                                     ║
         ╚══════════════════════════════════════════════╝ -->
    <footer class="site-footer">
        <div class="footer-main">
            {{-- Colonne marque --}}
            <div class="footer-brand-col">
                <div class="footer-logo">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="10" fill="rgba(255,255,255,0.08)" />
                        <path d="M10 28V16l10-7 10 7v12" stroke="rgba(255,255,255,0.7)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <rect x="15" y="21" width="10" height="7" rx="1.5" fill="rgba(255,255,255,0.5)" />
                        <circle cx="20" cy="17" r="2.5" fill="rgba(255,255,255,0.3)" />
                    </svg>
                    <span>Immo<em>Pro</em></span>
                </div>
                <p>
                    Votre partenaire de confiance pour trouver le bien immobilier
                    idéal en Afrique. Nous vous accompagnons dans chaque étape de votre projet.
                </p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook">
                        <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                            <path d="M10.5 3h1.5V0h-2a4 4 0 0 0-4 4v3H4.5v3.5H6.5V18h3v-7.5h2L12 7H9.5V4a1 1 0 0 1 1-1Z" fill="currentColor" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter">
                        <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                            <path d="M13.544 6.59c.01.144.01.288.01.432 0 4.404-3.354 9.48-9.48 9.48a9.43 9.43 0 0 1-5.12-1.494 6.72 6.72 0 0 0 4.932-1.386 3.354 3.354 0 0 1-3.132-2.322c.522.078 1.02.054 1.47-.066A3.351 3.351 0 0 1 .678 8.09v-.042c.45.252.966.402 1.506.42A3.35 3.35 0 0 1 1.254 5.6a3.354 3.354 0 0 0 1.518.42A3.351 3.351 0 0 1 2.31 3.06 9.498 9.498 0 0 0 7.086 4.8a3.352 3.352 0 0 1 5.73-3.054 6.69 6.69 0 0 0 2.13-.81 3.354 3.354 0 0 1-1.472 1.848A6.69 6.69 0 0 0 15.996 2a6.822 6.822 0 0 1-1.638 1.692A6.694 6.694 0 0 0 16.5 2.826a6.846 6.846 0 0 1-2.956 3.764Z" fill="currentColor" transform="translate(0 1)" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                            <rect x="1.5" y="1.5" width="15" height="15" rx="4.5" stroke="currentColor" stroke-width="1.6" />
                            <circle cx="9" cy="9" r="3.5" stroke="currentColor" stroke-width="1.6" />
                            <circle cx="13.2" cy="4.8" r="1" fill="currentColor" />
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <svg viewBox="0 0 18 18" width="16" height="16" fill="none">
                            <path d="M4.5 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM1 6h3.5v11H1V6Zm6.5 0H11v1.5h.05c.5-.95 1.7-1.95 3.5-1.95 3.75 0 4.45 2.45 4.45 5.65V17H15.5v-5.4c0-1.3-.02-2.95-1.8-2.95-1.8 0-2.07 1.4-2.07 2.85V17H8.1V6H7.5Z" fill="currentColor" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Navigation --}}
            <div>
                <h4 class="footer-col-title">Navigation</h4>
                <ul class="footer-link-list">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="{{ route('biens.index') }}">Nos biens</a></li>
                    <li><a href="{{ route('apropos') }}">À propos</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="footer-col-title">Services</h4>
                <ul class="footer-link-list">
                    <li><a href="#">Achat</a></li>
                    <li><a href="#">Location</a></li>
                    <li><a href="#">Vente</a></li>
                    <li><a href="#">Estimation</a></li>
                    <li><a href="#">Gestion locative</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="footer-col-title">Contact</h4>
                <ul class="footer-contact-list">
                    <li>
                        <span class="fc-icon">
                            <svg viewBox="0 0 16 16" width="14" height="14" fill="none">
                                <path d="M8 1.5a4.5 4.5 0 0 0-4.5 4.5c0 4 4.5 8.5 4.5 8.5s4.5-4.5 4.5-8.5A4.5 4.5 0 0 0 8 1.5Z" stroke="#5eead4" stroke-width="1.4" />
                                <circle cx="8" cy="6" r="1.5" stroke="#5eead4" stroke-width="1.4" />
                            </svg>
                        </span>
                        <div>
                            <strong>Adresse</strong><br>
                            <span>Abidjan, Côte d'Ivoire</span>
                        </div>
                    </li>
                    <li>
                        <span class="fc-icon">
                            <svg viewBox="0 0 16 16" width="14" height="14" fill="none">
                                <path d="M14.5 11.3v1.8a1.2 1.2 0 0 1-1.3 1.2 11.9 11.9 0 0 1-5.2-1.8 11.7 11.7 0 0 1-3.6-3.6A11.9 11.9 0 0 1 2.6 3.7 1.2 1.2 0 0 1 3.8 2.4h1.8A1.2 1.2 0 0 1 6.8 3.4a7.7 7.7 0 0 0 .4 1.7 1.2 1.2 0 0 1-.3 1.3l-.8.8a9.6 9.6 0 0 0 3.6 3.6l.8-.8a1.2 1.2 0 0 1 1.3-.3 7.7 7.7 0 0 0 1.7.4 1.2 1.2 0 0 1 1 1.2Z" stroke="#5eead4" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <strong>Téléphone</strong><br>
                            <span>+225 07 00 00 00 00</span>
                        </div>
                    </li>
                    <li>
                        <span class="fc-icon">
                            <svg viewBox="0 0 16 16" width="14" height="14" fill="none">
                                <rect x="1" y="3" width="14" height="10" rx="2" stroke="#5eead4" stroke-width="1.4" />
                                <path d="m1 5 7 4.5L15 5" stroke="#5eead4" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <strong>Email</strong><br>
                            <span>contact@immopro.com</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} ImmoPro. Tous droits réservés.</p>
            <div class="footer-bottom-links">
                <a href="#">Mentions légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">CGU</a>
            </div>
        </div>
    </footer>

    <!-- ╔══════════════════════════════════════════════╗
         ║  SCRIPTS                                    ║
         ╚══════════════════════════════════════════════╝ -->
    <script>
        // --- Navbar scroll effect ---
        const navbar = document.getElementById('navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, {
            passive: true
        });

        // --- Mobile menu ---
        function toggleMobileMenu() {
            const navCenter = document.getElementById('navCenter');
            navCenter.classList.toggle('open');
        }

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('navCenter').classList.remove('open');
            });
        });

        // --- User dropdown ---
        function toggleUserMenu() {
            const wrapper = document.getElementById('userMenu');
            const menu = document.getElementById('dropdownMenu');
            wrapper.classList.toggle('open');
            menu.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const wrapper = document.getElementById('userMenu');
            const menu = document.getElementById('dropdownMenu');
            if (wrapper && menu && !wrapper.contains(e.target)) {
                wrapper.classList.remove('open');
                menu.classList.remove('show');
            }
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.getElementById('navCenter')?.classList.remove('open');
                const wrapper = document.getElementById('userMenu');
                const menu = document.getElementById('dropdownMenu');
                if (wrapper) wrapper.classList.remove('open');
                if (menu) menu.classList.remove('show');
            }
        });

        // --- Auto-dismiss flash messages ---
        document.querySelectorAll('.flash-msg').forEach(msg => {
            setTimeout(() => {
                msg.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                setTimeout(() => msg.remove(), 400);
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>

</html>