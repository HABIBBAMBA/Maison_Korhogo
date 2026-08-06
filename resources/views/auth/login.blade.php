<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion — ImmoPro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #284b63;
            --teal: #3c6e71;
            --dark: #353535;
            --gray: #d9d9d9;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #3c6e71 0%, #284b63 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"><circle cx="1" cy="1" r="1" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: 60px 60px;
        }

        .left-panel .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
        }

        .left-panel .circle-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
        }

        .left-panel .circle-2 {
            width: 250px;
            height: 250px;
            bottom: -50px;
            left: -50px;
        }

        .left-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 400px;
        }

        .left-content .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: white;
            margin-bottom: 0.75rem;
        }

        .left-content p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            line-height: 1.8;
        }

        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--white);
        }

        .form-container {
            width: 100%;
            max-width: 420px;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header .brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .form-header h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #888;
            font-size: 0.9rem;
        }

        .form-header p a {
            color: var(--teal);
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid var(--gray);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--dark);
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(60, 110, 113, 0.1);
        }

        .form-input.error {
            border-color: #e74c3c;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .checkbox-row label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            cursor: pointer;
        }

        .checkbox-row a {
            color: var(--teal);
            font-weight: 500;
        }

        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            border: none;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--primary), var(--teal));
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 75, 99, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(40, 75, 99, 0.4);
        }

        @media (max-width: 992px) {
            .left-panel {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- PANNEAU GAUCHE -->
    <div class="left-panel">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="left-content">
            <div class="icon-circle">
                <i class="bi bi-box-arrow-in-right"></i>
            </div>
            <h1>Bon retour !</h1>
            <p>Connectez-vous pour accéder à votre espace personnel et gérer vos biens immobiliers.</p>
        </div>
    </div>

    <!-- PANNEAU DROIT -->
    <div class="right-panel">
        <div class="form-container">
            <div class="form-header">
                <a href="{{ url('/') }}" class="brand">
                    <i class="bi bi-building"></i> ImmoPro
                </a>
                <h2>Se connecter</h2>
                <p>Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>
            </div>

            @include('components.alerts')

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="votreemail@exemple.com" value="{{ old('email') }}" autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                        placeholder="Votre mot de passe">
                </div>

                <div class="checkbox-row">
                    <label>
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                </div>

                <button type="submit" class="btn-submit">
                    Connexion <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

</body>

</html>