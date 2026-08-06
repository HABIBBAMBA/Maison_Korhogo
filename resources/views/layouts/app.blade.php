<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ImmoPro — Immobilier')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
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

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.5rem;
            border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: var(--white);
            box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(var(--primary-rgb), 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: var(--white);
        }

        .btn-ghost {
            background: transparent;
            color: var(--dark);
        }

        .btn-ghost:hover {
            background: rgba(var(--teal-rgb), 0.08);
        }

        /* ===== MOBILE MENU ===== */
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

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-top: 72px;
            min-height: calc(100vh - 72px);
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--dark);
            color: rgba(255, 255, 255, 0.7);
            padding: 4rem 2rem 2rem;
            margin-top: 5rem;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
        }

        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
        }

        .footer-desc {
            font-size: 0.9rem;
            line-height: 1.8;
        }

        .footer-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--white);
            margin-bottom: 1.25rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .footer-links a {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .footer-links a:hover {
            color: var(--white);
            padding-left: 0.25rem;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 3rem auto 0;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.6);
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--teal);
            border-color: var(--teal);
            color: white;
        }

        /* ===== RESPONSIVE ===== */
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

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 0 1rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar">
        <a href="{{ url('/') }}" class="nav-brand">
            <span class="brand-icon"><i class="bi bi-building"></i></span>
            ImmoPro
        </a>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{ url('/') }}" class="active">Accueil</a></li>
            <li><a href="{{ route('biens.index') }}">Biens</a></li>
            <li><a href="{{ url('/about') }}">À propos</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>

        <div class="nav-actions">
            @auth
            <!-- Menu déconnecté = Utilisateur connecté -->
            <div style="position: relative;" id="userMenu">
                <button onclick="toggleUserMenu()" style="
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 0.75rem 0.4rem 0.4rem;
                border: 2px solid var(--gray);
                border-radius: 50px;
                background: white;
                cursor: pointer;
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.85rem;
                font-weight: 600;
                color: var(--dark);
                transition: all 0.3s ease;
            ">
                    <span style="
                    width: 32px; height: 32px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, var(--primary), var(--teal));
                    color: white;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 0.8rem;
                ">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    {{ Str::limit(auth()->user()->email, 15) }}
                    <i class="bi bi-chevron-down" style="font-size: 0.7rem;"></i>
                </button>

                <div id="dropdownMenu" style="
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                right: 0;
                background: white;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.15);
                min-width: 200px;
                padding: 0.5rem;
                z-index: 999;
                border: 1px solid #f0f0f0;
            ">
                    <a href="{{ route('dashboard') }}" style="
                    display: flex; align-items: center; gap: 0.75rem;
                    padding: 0.7rem 1rem; border-radius: 8px;
                    font-size: 0.85rem; color: var(--dark);
                " onmouseenter="this.style.background='#f8f8f8'" onmouseleave="this.style.background='transparent'">
                        <i class="bi bi-speedometer2" style="color: var(--teal);"></i> Dashboard
                    </a>
                    <div style="height: 1px; background: #f0f0f0; margin: 0.25rem 0;"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="
                        display: flex; align-items: center; gap: 0.75rem;
                        padding: 0.7rem 1rem; border-radius: 8px;
                        font-size: 0.85rem; color: #e74c3c;
                        width: 100%; border: none; background: none;
                        cursor: pointer; font-family: inherit;
                    " onmouseenter="this.style.background='#fef2f2'" onmouseleave="this.style.background='transparent'">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-ghost">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
            @endauth

            <button class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- ===== CONTENU PRINCIPAL ===== -->
    <main class="main-content">
        @if(session('success'))
        <div style="max-width: 1200px; margin: 1rem auto; padding: 1rem 1.5rem; background: #d4edda; color: #155724; border-radius: var(--radius); font-size: 0.9rem;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="max-width: 1200px; margin: 1rem auto; padding: 1rem 1.5rem; background: #f8d7da; color: #721c24; border-radius: var(--radius); font-size: 0.9rem;">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">ImmoPro</div>
                <p class="footer-desc">
                    Votre partenaire de confiance pour trouver le bien immobilier
                    idéal. Nous vous accompagnons dans chaque étape de votre projet.
                </p>
            </div>
            <div>
                <h4 class="footer-title">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="{{ route('biens.index') }}">Nos biens</a></li>
                    <li><a href="{{ url('/about') }}">À propos</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Services</h4>
                <ul class="footer-links">
                    <li><a href="#">Achat</a></li>
                    <li><a href="#">Location</a></li>
                    <li><a href="#">Vente</a></li>
                    <li><a href="#">Estimation</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Contact</h4>
                <ul class="footer-links">
                    <li><i class="bi bi-geo-alt"></i> Abidjan, Côte d'Ivoire</li>
                    <li><i class="bi bi-telephone"></i> +225 07 00 00 00 00</li>
                    <li><i class="bi bi-envelope"></i> contact@immopro.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} ImmoPro. Tous droits réservés.</p>
            <div class="social-links">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Menu hamburger mobile
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        // Navbar au scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    <script>
        // Menu utilisateur dropdown
        function toggleUserMenu() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        // Fermer le menu si on clique ailleurs
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('dropdownMenu');
            const userMenu = document.getElementById('userMenu');
            if (menu && userMenu && !userMenu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    </script>

    @stack('scripts')
</body>

</html>