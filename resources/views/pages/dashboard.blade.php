<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LOCATRIB IMMO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg: #f0f3f6;
            --surface: #ffffff;
            --surface-hover: #f7f9fb;
            --border: rgba(40, 75, 99, 0.1);
            --border-hover: rgba(40, 75, 99, 0.2);

            --primary: #1b3a4f;
            --primary-hover: #132b3a;
            --primary-muted: rgba(27, 58, 79, 0.07);
            --primary-border: rgba(27, 58, 79, 0.18);

            --teal: #2a7d7f;
            --teal-hover: #1f6365;
            --teal-muted: rgba(42, 125, 127, 0.08);
            --teal-border: rgba(42, 125, 127, 0.2);

            --teal-light: #5db8b5;
            --teal-light-muted: rgba(93, 184, 181, 0.12);

            --text-primary: #111827;
            --text-secondary: #374151;
            --text-muted: #6b7280;

            --green: #16a34a;
            --green-muted: rgba(22, 163, 74, 0.08);
            --red: #dc2626;
            --red-muted: rgba(220, 38, 38, 0.08);
            --orange: #d97706;
            --orange-muted: rgba(217, 119, 6, 0.08);
            --blue: #2563eb;
            --blue-muted: rgba(37, 99, 235, 0.08);

            --shadow-sm: 0 1px 3px rgba(40, 75, 99, 0.08);
            --shadow-md: 0 4px 16px rgba(40, 75, 99, 0.1);
            --shadow-lg: 0 12px 40px rgba(40, 75, 99, 0.13);

            --font-display: 'Playfair Display', serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --radius: 16px;
            --radius-sm: 10px;
            --sidebar-w: 272px;
            --nav-h: 68px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text-primary);
            font-family: var(--font-body);
            min-height: 100vh;
        }

        /* ========================================
           TOP NAV
        ======================================== */
        .topnav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-h);
            z-index: 200;
            background: linear-gradient(135deg, var(--primary) 0%, #2a5a6d 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem 0 1.75rem;
            box-shadow: 0 2px 20px rgba(27, 58, 79, 0.25);
        }

        .topnav-left {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.35rem;
            cursor: pointer;
            padding: 0.3rem;
            transition: color 0.2s;
        }

        .sidebar-toggle:hover {
            color: #fff;
        }

        .topnav-brand {
            font-family: var(--font-display);
            font-size: 1.6rem;
            color: #ffffff;
            text-decoration: none;
            font-style: italic;
            font-weight: 700;
            letter-spacing: -0.01em;
            transition: opacity 0.2s;
        }

        .topnav-brand:hover {
            opacity: 0.9;
        }

        /* ===== BOUTON RETOUR ACCUEIL ===== */
        .home-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 1rem;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50px;
            color: #ffffff;
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            transition: all 0.25s;
            backdrop-filter: blur(10px);
        }

        .home-link:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateX(-2px);
        }

        .home-link i {
            font-size: 0.88rem;
        }

        .topnav-right {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .topnav-search {
            position: relative;
        }

        .topnav-search input {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-sm);
            padding: 0.55rem 0.9rem 0.55rem 2.3rem;
            color: #fff;
            font-size: 0.82rem;
            font-family: var(--font-body);
            width: 240px;
            transition: all 0.25s;
            outline: none;
        }

        .topnav-search input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .topnav-search input:focus {
            border-color: rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.18);
            width: 290px;
        }

        .topnav-search i {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.88rem;
        }

        .topnav-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.85);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
            position: relative;
            text-decoration: none;
        }

        .topnav-btn:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.25);
        }

        .topnav-btn .notif-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid var(--primary);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .topnav-user {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.35rem 0.6rem 0.35rem 0.35rem;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
        }

        .topnav-user:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .topnav-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.8rem;
            color: #fff;
            letter-spacing: 0.02em;
        }

        .topnav-user-meta {
            display: flex;
            flex-direction: column;
        }

        .topnav-user-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
        }

        .topnav-user-role {
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.55);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 600;
        }

        .topnav-user .bi-chevron-expand {
            font-size: 0.6rem;
            color: rgba(255, 255, 255, 0.4);
            margin-left: 0.1rem;
        }

        /* User Dropdown */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 0.5rem;
            min-width: 225px;
            display: none;
            z-index: 300;
            box-shadow: var(--shadow-lg);
        }

        .user-dropdown.show {
            display: block;
            animation: ddIn 0.2s ease;
        }

        @keyframes ddIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ud-header {
            padding: 0.8rem 0.7rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 0.3rem;
        }

        .ud-header-name {
            font-weight: 700;
            font-size: 0.88rem;
            color: var(--text-primary);
        }

        .ud-header-email {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .ud-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.6rem 0.75rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 500;
            transition: all 0.12s;
            border: none;
            background: none;
            cursor: pointer;
            width: 100%;
            font-family: var(--font-body);
        }

        .ud-item:hover {
            background: var(--primary-muted);
            color: var(--primary);
        }

        .ud-item i {
            font-size: 0.98rem;
            color: var(--text-muted);
            width: 18px;
            text-align: center;
            transition: color 0.12s;
        }

        .ud-item:hover i {
            color: var(--primary);
        }

        .ud-item.danger {
            color: var(--red);
        }

        .ud-item.danger:hover {
            background: var(--red-muted);
        }

        .ud-item.danger i {
            color: var(--red);
        }

        .ud-divider {
            height: 1px;
            background: var(--border);
            margin: 0.35rem 0;
        }

        /* ========================================
           SIDEBAR
        ======================================== */
        .sidebar {
            position: fixed;
            top: var(--nav-h);
            left: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            z-index: 150;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1.2rem 0.85rem;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--border-hover);
            border-radius: 10px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(17, 24, 39, 0.5);
            z-index: 140;
            backdrop-filter: blur(3px);
        }

        .sidebar-section {
            margin-bottom: 1.4rem;
        }

        .sidebar-label {
            font-size: 0.64rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            padding: 0 0.75rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.75rem;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.86rem;
            font-weight: 500;
            transition: all 0.15s;
            position: relative;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
            transition: color 0.15s;
        }

        .sidebar-link .link-badge {
            margin-left: auto;
            background: var(--teal-muted);
            color: var(--teal);
            font-size: 0.64rem;
            font-weight: 700;
            padding: 0.18rem 0.55rem;
            border-radius: 20px;
            letter-spacing: 0.02em;
        }

        .sidebar-link .link-badge.red {
            background: var(--red-muted);
            color: var(--red);
        }

        .sidebar-link:hover {
            background: var(--primary-muted);
            color: var(--primary);
            font-weight: 600;
        }

        .sidebar-link:hover i {
            color: var(--teal);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(27, 58, 79, 0.1), rgba(42, 125, 127, 0.08));
            color: var(--primary);
            font-weight: 700;
        }

        .sidebar-link.active i {
            color: var(--teal);
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -0.85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 3.5px;
            height: 24px;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(180deg, var(--teal), var(--teal-light));
        }

        /* Sidebar footer */
        .sidebar-footer {
            border-top: 1px solid var(--border);
            padding-top: 1rem;
            margin-top: 0.5rem;
        }

        .sidebar-usage {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 1rem;
            margin: 0 0.15rem;
        }

        .sidebar-usage-label {
            font-size: 0.74rem;
            color: var(--text-muted);
            margin-bottom: 0.6rem;
            display: flex;
            justify-content: space-between;
            font-weight: 500;
        }

        .sidebar-usage-label span {
            color: var(--text-primary);
            font-weight: 800;
        }

        .usage-bar {
            height: 6px;
            background: rgba(40, 75, 99, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        .usage-bar-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--teal), var(--teal-light));
            transition: width 0.6s ease;
        }

        /* ========================================
           MAIN CONTENT
        ======================================== */
        .main {
            margin-left: var(--sidebar-w);
            margin-top: var(--nav-h);
            min-height: calc(100vh - var(--nav-h));
            padding: 2rem 2.25rem;
            position: relative;
            z-index: 1;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-family: var(--font-display);
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.15;
        }

        .page-header h1 em {
            font-style: italic;
            color: var(--teal);
            font-weight: 600;
        }

        .page-header p {
            color: var(--text-muted);
            margin-top: 0.45rem;
            font-size: 0.92rem;
            font-weight: 400;
        }

        .page-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* ===== BUTTONS ===== */
        .btn {
            padding: 0.65rem 1.3rem;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: all 0.25s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            color: #fff;
            box-shadow: 0 3px 12px rgba(42, 125, 127, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 24px rgba(42, 125, 127, 0.35);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--border);
            color: var(--text-secondary);
        }

        .btn-outline:hover {
            border-color: var(--teal);
            color: var(--teal);
            background: var(--teal-muted);
        }

        .btn-sm {
            padding: 0.38rem 0.75rem;
            font-size: 0.76rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.92rem;
        }

        .btn-icon:hover {
            border-color: var(--teal);
            color: var(--teal);
            background: var(--teal-muted);
        }

        .btn-icon.danger:hover {
            border-color: var(--red);
            color: var(--red);
            background: var(--red-muted);
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 0.95rem 1.2rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            opacity: 0;
            animation: fadeUp 0.4s ease forwards;
        }

        .alert-success {
            background: var(--green-muted);
            border: 1.5px solid rgba(22, 163, 74, 0.2);
            color: var(--green);
        }

        .alert-danger {
            background: var(--red-muted);
            border: 1.5px solid rgba(220, 38, 38, 0.2);
            color: var(--red);
        }

        .alert i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.35rem;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeUp 0.5s ease forwards;
            box-shadow: var(--shadow-sm);
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.2s;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
            border-color: var(--teal-border);
        }

        .stat-card-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.85rem;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        .stat-icon.primary {
            background: var(--primary-muted);
            color: var(--primary);
        }

        .stat-icon.teal {
            background: var(--teal-muted);
            color: var(--teal);
        }

        .stat-icon.teal-light {
            background: var(--teal-light-muted);
            color: var(--teal-hover);
        }

        .stat-icon.green {
            background: var(--green-muted);
            color: var(--green);
        }

        .stat-icon.red {
            background: var(--red-muted);
            color: var(--red);
        }

        .stat-icon.orange {
            background: var(--orange-muted);
            color: var(--orange);
        }

        .stat-icon.blue {
            background: var(--blue-muted);
            color: var(--blue);
        }

        .stat-change {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.18rem 0.55rem;
            border-radius: 20px;
            background: var(--green-muted);
            color: var(--green);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1;
            margin-bottom: 0.25rem;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 600;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            opacity: 0;
            animation: fadeUp 0.5s ease forwards;
            animation-delay: 0.25s;
            box-shadow: var(--shadow-sm);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .card-title i {
            color: var(--teal);
            font-size: 1.1rem;
        }

        .card-link {
            color: var(--teal);
            font-size: 0.78rem;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .card-link:hover {
            color: var(--teal-hover);
        }

        /* ===== QUICK ACTIONS ===== */
        .action-row {
            display: flex;
            gap: 0.85rem;
            flex-wrap: wrap;
        }

        .action-card {
            flex: 1;
            min-width: 130px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 1.2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .action-card:hover {
            border-color: var(--teal);
            background: var(--teal-muted);
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .action-card i {
            font-size: 1.5rem;
            color: var(--teal);
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.2s;
        }

        .action-card:hover i {
            color: var(--primary);
            transform: scale(1.1);
        }

        .action-card .action-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .action-card .action-desc {
            font-size: 0.68rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        /* ===== CONTENT GRID ===== */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        /* ===== TABLE ===== */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
        }

        th {
            text-align: left;
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 0.8rem 1rem;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid rgba(40, 75, 99, 0.05);
            color: var(--text-primary);
            font-weight: 450;
        }

        tbody tr {
            transition: background 0.15s;
        }

        tbody tr:hover td {
            background: var(--teal-muted);
        }

        /* Badges */
        .badge {
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .badge-success {
            background: var(--green-muted);
            color: var(--green);
        }

        .badge-warning {
            background: var(--orange-muted);
            color: var(--orange);
        }

        .badge-danger {
            background: var(--red-muted);
            color: var(--red);
        }

        .badge-info {
            background: var(--blue-muted);
            color: var(--blue);
        }

        .badge-teal {
            background: var(--teal-muted);
            color: var(--teal);
        }

        .badge-muted {
            background: rgba(107, 114, 128, 0.1);
            color: var(--text-muted);
        }

        /* ===== ACTIVITY LIST ===== */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            gap: 0.9rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(40, 75, 99, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-top: 0.3rem;
            flex-shrink: 0;
        }

        .activity-dot.primary {
            background: var(--primary);
        }

        .activity-dot.teal {
            background: var(--teal);
        }

        .activity-dot.green {
            background: var(--green);
        }

        .activity-dot.red {
            background: var(--red);
        }

        .activity-dot.orange {
            background: var(--orange);
        }

        .activity-content {
            flex: 1;
            min-width: 0;
        }

        .activity-text {
            font-size: 0.84rem;
            line-height: 1.4;
            color: var(--text-secondary);
        }

        .activity-text strong {
            color: var(--text-primary);
            font-weight: 700;
        }

        .activity-time {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
            font-weight: 500;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .section-label {
            font-size: 0.68rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.7rem;
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-weight: 700;
        }

        .section-label i {
            color: var(--teal);
        }

        /* ===== FOOTER ===== */
        .site-footer {
            margin-left: var(--sidebar-w);
            text-align: center;
            padding: 2rem;
            border-top: 1px solid var(--border);
            position: relative;
            z-index: 1;
        }

        .site-footer .footer-text {
            color: var(--text-muted);
            font-size: 0.78rem;
        }

        .site-footer .footer-text a {
            color: var(--teal);
            text-decoration: none;
            font-family: var(--font-display);
            font-style: italic;
            font-weight: 700;
            transition: color 0.2s;
        }

        .site-footer .footer-text a:hover {
            color: var(--primary);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .topnav-search {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .sidebar-toggle {
                display: block;
            }

            .main {
                margin-left: 0;
                padding: 1.25rem 1rem;
            }

            .site-footer {
                margin-left: 0;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .topnav-user-meta {
                display: none;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .page-header-row {
                flex-direction: column;
            }

            .home-link span {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- ===== TOP NAV ===== -->
    <nav class="topnav">
        <div class="topnav-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <a href="{{ route('home') }}" class="topnav-brand">LocaTribe</a>
            <a href="{{ route('home') }}" class="home-link" title="Retour à l'accueil">
                <i class="bi bi-house-door"></i>
                <span>Retour au site</span>
            </a>
        </div>

        <div class="topnav-right">
            <div class="topnav-search">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Rechercher un bien, un client...">
            </div>

            <a href="{{ route('home') }}" class="topnav-btn" title="Page d'accueil">
                <i class="bi bi-house-gear"></i>
            </a>

            <a href="#" class="topnav-btn" title="Notifications">
                <i class="bi bi-bell"></i>
                <span class="notif-dot"></span>
            </a>

            <a href="" class="topnav-btn" title="Messages">
                <i class="bi bi-chat-dots"></i>
            </a>

            <!-- User Menu -->
            <div class="topnav-user" onclick="toggleUserDropdown(event)">
                <div class="topnav-avatar">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div class="topnav-user-meta">
                    <div class="topnav-user-name">{{ $user->name }}</div>
                    <div class="topnav-user-role">
                        @if($user->estAdmin()) Admin
                        @elseif($user->role === 'agence') Agence
                        @elseif($user->role === 'proprietaire') Propriétaire
                        @else Locataire
                        @endif
                    </div>
                </div>
                <i class="bi bi-chevron-expand"></i>

                <div class="user-dropdown" id="userDropdown">
                    <div class="ud-header">
                        <div class="ud-header-name">{{ $user->name }}</div>
                        <div class="ud-header-email">{{ $user->email ?? '' }}</div>
                    </div>
                    <a href="#" class="ud-item">
                        <i class="bi bi-person"></i> Mon profil
                    </a>
                    <a href="{{ route('dashboard') }}" class="ud-item">
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                    @if($user->estAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="ud-item">
                        <i class="bi bi-shield-lock"></i> Administration
                    </a>
                    @endif
                    <a href="{{ route('home') }}" class="ud-item">
                        <i class="bi bi-house"></i> Page d'accueil
                    </a>
                    <div class="ud-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="ud-item danger">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Overlay mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">

        {{-- ========================================
             MENU : ADMINISTRATEUR
        ======================================== --}}
        @if($user->estAdmin())
        <div class="sidebar-section">
            <div class="sidebar-label">Administration</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Vue d'ensemble
            </a>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Utilisateurs
                <span class="link-badge">{{ $stats['total_users'] ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.agences.index') }}" class="sidebar-link {{ request()->routeIs('admin.agences.*') ? 'active' : '' }}">
                <i class="bi bi-shop"></i> Agences
            </a>
            <a href="{{ route('admin.biens.index') }}" class="sidebar-link {{ request()->routeIs('admin.biens.*') ? 'active' : '' }}">
                <i class="bi bi-building-check"></i> Biens
                <span class="link-badge red">{{ $stats['biens_en_attente'] ?? 0 }}</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="bi bi-receipt"></i> Transactions
            </a>
            <a href="#" class="sidebar-link">
                <i class="bi bi-flag"></i> Signalements
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Analyses</div>
            <a href="#" class="sidebar-link">
                <i class="bi bi-graph-up-arrow"></i> Statistiques
            </a>
            <a href="#" class="sidebar-link">
                <i class="bi bi-file-earmark-bar-graph"></i> Rapports
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Système</div>
            <a href="#" class="sidebar-link">
                <i class="bi bi-gear"></i> Paramètres
            </a>
            <a href="#" class="sidebar-link">
                <i class="bi bi-journal-text"></i> Journaux
            </a>
        </div>
        @endif

        {{-- ========================================
             MENU : AGENCE
        ======================================== --}}
        @if($user->role === 'agence')
        <div class="sidebar-section">
            <div class="sidebar-label">Mon agence</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Vue d'ensemble
            </a>
            <a href="{{ route('annonces.mes-annonces') }}" class="sidebar-link {{ request()->routeIs('annonces.mes-annonces') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Mes biens
                <span class="link-badge">{{ $stats['total_biens'] ?? 0 }}</span>
            </a>
            <a href="{{ route('annonces.create') }}" class="sidebar-link {{ request()->routeIs('annonces.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Ajouter un bien
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Communication</div>
            @if(Route::has('messages.index'))
            <a href="{{ route('messages.index') }}" class="sidebar-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i> Messages
                <span class="link-badge red">{{ $stats['nouveaux_messages'] ?? 0 }}</span>
            </a>
            @endif
            @if(Route::has('rendezvous.index'))
            <a href="{{ route('rendezvous.index') }}" class="sidebar-link {{ request()->routeIs('rendezvous.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Rendez-vous
            </a>
            @endif
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Clients</div>
            <a href="#" class="sidebar-link"><i class="bi bi-person-lines-fill"></i> Prospects</a>
            <a href="#" class="sidebar-link"><i class="bi bi-person-check"></i> Locataires</a>
            <a href="#" class="sidebar-link"><i class="bi bi-coin"></i> Paiements</a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Rapports</div>
            <a href="#" class="sidebar-link"><i class="bi bi-bar-chart-line"></i> Performance</a>
            <a href="#" class="sidebar-link"><i class="bi bi-file-earmark-text"></i> Documents</a>
        </div>
        @endif

        {{-- ========================================
             MENU : PROPRIETAIRE
        ======================================== --}}
        @if($user->role === 'proprietaire')
        <div class="sidebar-section">
            <div class="sidebar-label">Propriétaire</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Vue d'ensemble
            </a>
            <a href="{{ route('annonces.mes-annonces') }}" class="sidebar-link {{ request()->routeIs('annonces.mes-annonces') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Mes propriétés
                <span class="link-badge">{{ $stats['total_biens'] ?? 0 }}</span>
            </a>
            <a href="{{ route('annonces.create') }}" class="sidebar-link {{ request()->routeIs('annonces.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Publier une annonce
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Gestion</div>
            <a href="#" class="sidebar-link {{ request()->routeIs('rendezvous.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Rendez-vous
            </a>
            <a href="#" class="sidebar-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i> Messages
                <span class="link-badge red">{{ $stats['nouveaux_messages'] ?? 0 }}</span>
            </a>
            <a href="#" class="sidebar-link"><i class="bi bi-person-check"></i> Mes locataires</a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Finances</div>
            <a href="#" class="sidebar-link"><i class="bi bi-wallet2"></i> Revenus locatifs</a>
            <a href="#" class="sidebar-link"><i class="bi bi-receipt"></i> Paiements</a>
            <a href="#" class="sidebar-link"><i class="bi bi-file-earmark-text"></i> Baux</a>
        </div>
        @endif

        {{-- ========================================
             MENU : LOCATAIRE
        ======================================== --}}
        @if($user->role === 'client')
        <div class="sidebar-section">
            <div class="sidebar-label">Locataire</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Mon espace
            </a>
            <a href="{{ route('annonces.index') }}" class="sidebar-link {{ request()->routeIs('annonces.index') ? 'active' : '' }}">
                <i class="bi bi-search"></i> Chercher un bien
            </a>
            <a href="#" class="sidebar-link">
                <i class="bi bi-heart"></i> Mes favoris
                <span class="link-badge">{{ $stats['favoris_count'] ?? 0 }}</span>
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Communication</div>
            <a href="#" class="sidebar-link">
                <i class="bi bi-chat-dots"></i> Messages
                <span class="link-badge red">{{ $stats['nouveaux_messages'] ?? 0 }}</span>
            </a>
            @if(Route::has('rendezvous.index'))
            <a href="{{ route('rendezvous.index') }}" class="sidebar-link {{ request()->routeIs('rendezvous.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Mes visites
            </a>
            @endif
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Mon logement</div>
            <a href="#" class="sidebar-link"><i class="bi bi-file-earmark-text"></i> Mon bail</a>
            <a href="#" class="sidebar-link"><i class="bi bi-credit-card"></i> Mes paiements</a>
            <a href="#" class="sidebar-link"><i class="bi bi-tools"></i> Demandes de travaux</a>
        </div>
        @endif

        <!-- Sidebar Nav Accueil -->
        <div class="sidebar-section" style="margin-top: 1rem;">
            <a href="{{ route('home') }}" class="sidebar-link" style="background: var(--teal-muted); border: 1px dashed var(--teal-border); justify-content: center; font-weight: 700; color: var(--teal);">
                <i class="bi bi-house-door"></i> Retour à l'accueil
            </a>
        </div>

        <!-- Footer sidebar -->
        <div class="sidebar-footer">
            <div class="sidebar-usage">
                <div class="sidebar-usage-label">
                    Biens publiés
                    <span>{{ $stats['total_biens'] ?? 0 }} / {{ $stats['max_biens'] ?? 10 }}</span>
                </div>
                <div class="usage-bar">
                    <div class="usage-bar-fill" style="width: {{ min(100, (($stats['total_biens'] ?? 0) / ($stats['max_biens'] ?? 10)) * 100) }}%"></div>
                </div>
            </div>
        </div>
    </aside>


    <!-- ===== MAIN CONTENT ===== -->
    <main class="main">

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-x-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-row">
                <div>
                    <h1>Bienvenue, <em>{{ explode(' ', $user->name)[0] }}</em></h1>
                    <p>
                        @if($user->estAdmin())
                        Gérez la plateforme LocaTribe depuis votre espace administrateur
                        @elseif($user->role === 'agence')
                        Gérez vos biens et suivez l'activité de votre agence
                        @elseif($user->role === 'proprietaire')
                        Suivez vos propriétés et gérez vos locations
                        @else
                        Trouvez votre prochain logement et gérez vos visites
                        @endif
                    </p>
                </div>
                <div style="display: flex; gap: 0.7rem; align-items: center;">
                    @if($user->role !== 'locataire')
                    <a href="{{ route('annonces.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Nouveau bien
                    </a>
                    @else
                    <a href="{{ route('annonces.index') }}" class="btn btn-primary">
                        <i class="bi bi-search"></i> Parcourir les biens
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- ===== STATS ===== -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon teal"><i class="bi bi-building"></i></div>
                    <span class="stat-change">+{{ $stats['biens_publies'] ?? 0 }}</span>
                </div>
                <div class="stat-value">{{ $stats['total_biens'] ?? 0 }}</div>
                <div class="stat-label">
                    @if($user->role === 'locataire') Biens sauvegardés @else Biens publiés @endif
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon primary"><i class="bi bi-chat-dots"></i></div>
                    <span class="stat-change">+{{ $stats['nouveaux_messages'] ?? 0 }}</span>
                </div>
                <div class="stat-value">{{ $stats['total_messages'] ?? 0 }}</div>
                <div class="stat-label">Messages reçus</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon teal-light"><i class="bi bi-calendar-check"></i></div>
                    <span class="stat-change">{{ $stats['rdv_a_venir'] ?? 0 }} à venir</span>
                </div>
                <div class="stat-value">{{ $stats['total_rdv'] ?? 0 }}</div>
                <div class="stat-label">Rendez-vous</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon green"><i class="bi bi-eye"></i></div>
                    <span class="stat-change">+{{ $stats['vues_cette_semaine'] ?? 0 }}%</span>
                </div>
                <div class="stat-value">{{ number_format($stats['total_vues'] ?? 0) }}</div>
                <div class="stat-label">Vues totales</div>
            </div>
        </div>

        <!-- Admin Stats -->
        @if($user->estAdmin() && isset($stats['total_users']))
        <div class="stats-grid" style="margin-top: -0.75rem;">
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon primary"><i class="bi bi-people"></i></div>
                </div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Utilisateurs</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon teal"><i class="bi bi-person-check"></i></div>
                </div>
                <div class="stat-value">{{ $stats['users_actifs'] }}</div>
                <div class="stat-label">Actifs</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon teal-light"><i class="bi bi-shop"></i></div>
                </div>
                <div class="stat-value">{{ $stats['total_agences'] ?? 0 }}</div>
                <div class="stat-label">Agences</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-row">
                    <div class="stat-icon green"><i class="bi bi-graph-up-arrow"></i></div>
                </div>
                <div class="stat-value">{{ $stats['total_transactions'] ?? 0 }}</div>
                <div class="stat-label">Transactions</div>
            </div>
        </div>
        @endif

        <!-- ===== ACTIONS RAPIDES ===== -->
        <div class="card" style="margin-bottom: 1.75rem;">
            <div class="card-header">
                <span class="card-title"><i class="bi bi-lightning-charge-fill"></i> Actions rapides</span>
            </div>
            <div class="action-row">
                @if($user->role === 'locataire')
                <a href="{{ route('annonces.index') }}" class="action-card">
                    <i class="bi bi-search"></i>
                    <div class="action-title">Chercher</div>
                    <div class="action-desc">Trouver un bien</div>
                </a>
                <a href="#" class="action-card">
                    <i class="bi bi-heart"></i>
                    <div class="action-title">Favoris</div>
                    <div class="action-desc">Biens sauvegardés</div>
                </a>
                @else
                <a href="{{ route('annonces.create') }}" class="action-card">
                    <i class="bi bi-plus-circle"></i>
                    <div class="action-title">Nouveau bien</div>
                    <div class="action-desc">Créer une annonce</div>
                </a>
                <a href="{{ route('annonces.mes-annonces') }}" class="action-card">
                    <i class="bi bi-building"></i>
                    <div class="action-title">Mes biens</div>
                    <div class="action-desc">Gérer mes annonces</div>
                </a>
                @endif
                <a href="#" class="action-card">
                    <i class="bi bi-chat-dots"></i>
                    <div class="action-title">Messages</div>
                    <div class="action-desc">Voir les messages</div>
                </a>
                <a href="#" class="action-card">
                    <i class="bi bi-calendar-event"></i>
                    <div class="action-title">
                        @if($user->role === 'locataire') Mes visites @else Rendez-vous @endif
                    </div>
                    <div class="action-desc">Planning</div>
                </a>
                <a href="{{ route('home') }}" class="action-card" style="border-style: dashed; border-color: var(--teal-border);">
                    <i class="bi bi-house-door"></i>
                    <div class="action-title">Accueil</div>
                    <div class="action-desc">Retour au site</div>
                </a>
            </div>
        </div>

        <!-- ===== CONTENT GRID ===== -->
        <div class="content-grid">

            <!-- Activité récente -->
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><i class="bi bi-clock-history"></i> Activité récente</span>
                </div>
                <ul class="activity-list">
                    @forelse($recentActivities ?? [] as $activity)
                    <li class="activity-item">
                        <div class="activity-dot {{ $activity['color'] ?? 'teal' }}"></div>
                        <div class="activity-content">
                            <div class="activity-text">{{ $activity['text'] ?? '' }}</div>
                            <div class="activity-time">{{ $activity['time'] ?? '' }}</div>
                        </div>
                    </li>
                    @empty
                    <li class="activity-item">
                        <div class="activity-dot teal"></div>
                        <div class="activity-content">
                            <div class="activity-text">Aucune activité récente</div>
                            <div class="activity-time">Commencez à explorer</div>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>

            <!-- Messages récents -->
            <div class="card" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <span class="card-title"><i class="bi bi-chat-square-text"></i> Messages récents</span>
                    <a href="#" class="card-link">Tout voir</a>
                </div>
                <ul class="activity-list">
                    @forelse($recentMessages ?? [] as $message)
                    <li class="activity-item">
                        <div class="activity-dot {{ ($message['lu'] ?? false) ? 'teal' : 'orange' }}"></div>
                        <div class="activity-content">
                            <div class="activity-text">
                                <strong>{{ $message['sender'] ?? 'Inconnu' }}</strong>
                                — {{ Str::limit($message['contenu'] ?? '', 55) }}
                            </div>
                            <div class="activity-time">{{ $message['time'] ?? '' }}</div>
                        </div>
                    </li>
                    @empty
                    <li class="activity-item">
                        <div class="activity-dot orange"></div>
                        <div class="activity-content">
                            <div class="activity-text">Aucun message récent</div>
                            <div class="activity-time">Vos messages apparaîtront ici</div>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>

            <!-- Biens récents (sauf locataire) -->
            @if($user->role !== 'locataire')
            <div class="card full-width" style="animation-delay: 0.35s;">
                <div class="card-header">
                    <span class="card-title"><i class="bi bi-building"></i> Vos biens récents</span>
                    <a href="{{ route('annonces.mes-annonces') }}" class="card-link">Tous mes biens</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Bien</th>
                                <th>Type</th>
                                <th>Prix</th>
                                <th>Statut</th>
                                <th>Vues</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBiens ?? [] as $bien)
                            <tr>
                                <td>
                                    <div style="font-weight: 700;">{{ Str::limit($bien['titre'] ?? '', 30) }}</div>
                                    <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $bien['ville'] ?? '' }}</div>
                                </td>
                                <td style="color: var(--text-secondary); font-weight: 500;">{{ ucfirst($bien['type'] ?? '') }}</td>
                                <td style="font-weight: 800; color: var(--primary);">{{ number_format($bien['prix'] ?? 0) }} FCFA</td>
                                <td>
                                    <span class="badge {{ $bien['status_badge'] ?? 'badge-muted' }}">{{ $bien['statut'] ?? 'Brouillon' }}</span>
                                </td>
                                <td style="color: var(--text-secondary); font-weight: 600;">{{ $bien['vues'] ?? 0 }}</td>
                                <td style="color: var(--text-muted); font-size: 0.76rem;">{{ $bien['date'] ?? '' }}</td>
                                <td>
                                    <div style="display: flex; gap: 0.4rem;">
                                        <a href="{{ route('annonces.edit', $bien['id'] ?? 0) }}" class="btn-icon" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('annonces.destroy', $bien['id'] ?? 0) }}" method="POST" onsubmit="return confirm('Supprimer ?')" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon danger" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    <i class="bi bi-building" style="font-size: 2.5rem; display: block; margin-bottom: 0.75rem; opacity: 0.4; color: var(--teal);"></i>
                                    <span style="font-weight: 600;">Aucun bien publié pour le moment</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Prochaines visites (locataire) -->
            @if($user->role === 'locataire')
            <div class="card full-width" style="animation-delay: 0.35s;">
                <div class="card-header">
                    <span class="card-title"><i class="bi bi-calendar-check"></i> Prochaines visites</span>
                    @if(Route::has('rendezvous.index'))
                    <a href="{{ route('rendezvous.index') }}" class="card-link">Voir le planning</a>
                    @endif
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Bien</th>
                                <th>Adresse</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcomingVisits ?? [] as $visit)
                            <tr>
                                <td style="font-weight: 700;">{{ $visit['bien'] ?? '' }}</td>
                                <td style="color: var(--text-secondary);">{{ $visit['adresse'] ?? '' }}</td>
                                <td style="color: var(--text-secondary); font-weight: 500;">{{ $visit['date'] ?? '' }}</td>
                                <td style="color: var(--text-secondary);">{{ $visit['heure'] ?? '' }}</td>
                                <td>
                                    <span class="badge {{ $visit['badge'] ?? 'badge-teal' }}">{{ $visit['statut'] ?? 'Confirmé' }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    <i class="bi bi-calendar-x" style="font-size: 2.5rem; display: block; margin-bottom: 0.75rem; opacity: 0.4; color: var(--teal);"></i>
                                    <span style="font-weight: 600;">Aucune visite planifiée</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-text">
            &copy; {{ date('Y') }}
            <a href="{{ route('home') }}">LocaTribe</a>.
            Tous droits réservés.
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        function toggleUserDropdown(e) {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('show');
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.topnav-user')) {
                document.getElementById('userDropdown').classList.remove('show');
            }
        });
    </script>

</body>

</html>