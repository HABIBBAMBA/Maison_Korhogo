<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription — ImmoPro</title>
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
            --light-bg: #f4f6f8;
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

        /* ===== PANNEAU GAUCHE (visuel) ===== */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #284b63 0%, #3c6e71 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
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

        .left-content {
            position: relative;
            z-index: 1;
            max-width: 450px;
        }

        .left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .left-content p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.05rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
        }

        .features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .features-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
        }

        .features-list li i {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        /* ===== PANNEAU DROIT (formulaire) ===== */
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
            max-width: 480px;
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
            text-decoration: none;
        }

        .form-header .brand i {
            font-size: 1.1rem;
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

        /* ===== FORMULAIRE ===== */
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
            background: var(--white);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(60, 110, 113, 0.1);
        }

        .form-input::placeholder {
            color: #bbb;
        }

        .form-input.error {
            border-color: #e74c3c;
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1);
        }

        .field-error {
            display: block;
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 0.35rem;
        }

        /* ===== SÉLECTION DU RÔLE ===== */
        .role-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
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
            gap: 0.5rem;
            padding: 1.25rem 0.5rem;
            border: 2px solid var(--gray);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .role-card i {
            font-size: 1.5rem;
            color: #999;
            transition: all 0.3s ease;
        }

        .role-card span {
            font-size: 0.8rem;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
        }

        .role-option input:checked+.role-card {
            border-color: var(--teal);
            background: rgba(60, 110, 113, 0.05);
        }

        .role-option input:checked+.role-card i {
            color: var(--teal);
        }

        .role-option input:checked+.role-card span {
            color: var(--teal);
        }

        /* ===== CHAMPS CONDITIONNELS ===== */
        .conditional-fields {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .conditional-fields.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== BOUTON ===== */
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .left-panel {
                display: none;
            }

            body {
                background: var(--white);
            }
        }

        @media (max-width: 576px) {
            .right-panel {
                padding: 1.5rem;
            }

            .role-selector {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- PANNEAU GAUCHE -->
    <div class="left-panel">
        <div class="left-content">
            <h1>Rejoignez ImmoPro</h1>
            <p>Créez votre compte et accédez à des milliers de biens immobiliers.</p>
            <ul class="features-list">
                <li><i class="bi bi-check-lg"></i> Recherche avancée de biens</li>
                <li><i class="bi bi-check-lg"></i> Contact direct avec les propriétaires</li>
                <li><i class="bi bi-check-lg"></i> Gestion de vos annonces</li>
                <li><i class="bi bi-check-lg"></i> Alertes personnalisées</li>
            </ul>
        </div>
    </div>

    <!-- PANNEAU DROIT (formulaire) -->
    <div class="right-panel">
        <div class="form-container">
            <div class="form-header">
                <a href="{{ url('/') }}" class="brand">
                    <i class="bi bi-building"></i> ImmoPro
                </a>
                <h2>Créer un compte</h2>
                <p>Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>

            @include('components.alerts')

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Sélection du rôle -->
                <label class="form-label">Type de compte</label>
                <div class="role-selector">
                    <label class="role-option">
                        <input type="radio" name="role" value="client"
                            {{ old('role', 'client') == 'client' ? 'checked' : '' }}
                            onchange="toggleRoleFields()">
                        <div class="role-card">
                            <i class="bi bi-person"></i>
                            <span>Client</span>
                        </div>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="proprietaire"
                            {{ old('role') == 'proprietaire' ? 'checked' : '' }}
                            onchange="toggleRoleFields()">
                        <div class="role-card">
                            <i class="bi bi-key"></i>
                            <span>Propriétaire</span>
                        </div>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="agence"
                            {{ old('role') == 'agence' ? 'checked' : '' }}
                            onchange="toggleRoleFields()">
                        <div class="role-card">
                            <i class="bi bi-building"></i>
                            <span>Agence</span>
                        </div>
                    </label>
                </div>

                <!-- Champs Client / Propriétaire -->
                <div id="person-fields" class="conditional-fields active">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom"
                                class="form-input {{ $errors->has('nom') ? 'error' : '' }}"
                                placeholder="Votre nom" value="{{ old('nom') }}">
                            @error('nom')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom"
                                class="form-input {{ $errors->has('prenom') ? 'error' : '' }}"
                                placeholder="Votre prénom" value="{{ old('prenom') }}">
                            @error('prenom')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Champ Agence -->
                <div id="agence-fields" class="conditional-fields">
                    <div class="form-group">
                        <label class="form-label">Nom de l'agence</label>
                        <input type="text" name="nom_agence"
                            class="form-input {{ $errors->has('nom_agence') ? 'error' : '' }}"
                            placeholder="Ex: Immobilier Plus" value="{{ old('nom_agence') }}">
                        @error('nom_agence')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nom du responsable</label>
                        <input type="text" name="nom_responsable"
                            class="form-input {{ $errors->has('nom_responsable') ? 'error' : '' }}"
                            placeholder="Nom du responsable" value="{{ old('nom_responsable') }}">
                        @error('nom_responsable')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Téléphone -->
                <div class="form-group">
                    <label class="form-label">Téléphone <span style="color: #bbb; font-weight: 400;">(optionnel)</span></label>
                    <input type="text" name="telephone" class="form-input"
                        placeholder="+225 07 00 00 00 00" value="{{ old('telephone') }}">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email"
                        class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="votreemail@exemple.com" value="{{ old('email') }}">
                    @error('email')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password"
                        class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                        placeholder="Minimum 8 caractères">
                    @error('password')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmation -->
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-input"
                        placeholder="Retapez votre mot de passe">
                </div>

                <!-- Bouton -->
                <button type="submit" class="btn-submit" style="margin-top: 0.5rem;">
                    Créer mon compte <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
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

        // Exécuter AU CHARGEMENT de la page (corrige le bug de rechargement)
        document.addEventListener('DOMContentLoaded', function() {
            toggleRoleFields();
        });
    </script>
</body>

</html>