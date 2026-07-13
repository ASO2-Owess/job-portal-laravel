<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JobConnect')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-base: #F6F7FF;
            --bg-surface: rgba(255, 255, 255, 0.9);
            --bg-surface-hover: #FFFFFF;
            --text-primary: #111827;
            --text-secondary: #697386;
            --border-subtle: #E4E8F2;

            --accent-company-1: #4F46E5;
            --accent-company-2: #7C3AED;
            --accent-candidate-1: #F97316;
            --accent-candidate-2: #FB923C;

            --status-success: #10B981;
            --status-pending: #F59E0B;
            --status-danger: #EF4444;
        }

        body {
            background:
                radial-gradient(circle at 6% 12%, rgba(79, 70, 229, 0.13), transparent 28%),
                radial-gradient(circle at 90% 16%, rgba(249, 115, 22, 0.11), transparent 24%),
                linear-gradient(135deg, #f8f9ff 0%, #eef1ff 48%, #fff7f0 100%);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        h1, h2, h3, h4, .display-font {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
        }

        .navbar-dark-custom {
            background-color: rgba(255, 255, 255, 0.86);
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
            backdrop-filter: blur(18px);
            box-shadow: 0 14px 40px rgba(79, 70, 229, 0.08);
        }

        .navbar-brand {
            color: var(--text-primary);
        }

        .card-surface {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            box-shadow: 0 22px 60px rgba(79, 70, 229, 0.12);
            backdrop-filter: blur(18px);
        }

        .card-surface:hover {
            background-color: var(--bg-surface-hover);
            border-color: rgba(79, 70, 229, 0.22);
            transition: all 0.2s ease;
        }

        .page-hero {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 18px;
            padding: clamp(24px, 5vw, 48px);
            box-shadow: 0 24px 70px rgba(79, 70, 229, 0.14);
            position: relative;
            overflow: hidden;
        }

        .page-hero::after {
            content: "";
            position: absolute;
            right: clamp(18px, 5vw, 64px);
            top: 28px;
            width: 150px;
            height: 120px;
            border-radius: 28px;
            background: linear-gradient(145deg, rgba(79, 70, 229, 0.17), rgba(249, 115, 22, 0.08));
            box-shadow: inset 0 0 0 1px rgba(79, 70, 229, 0.12), 0 18px 34px rgba(79, 70, 229, 0.13);
        }

        .page-hero > * {
            position: relative;
            z-index: 1;
        }

        .soft-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            color: var(--accent-company-1);
            background: rgba(79, 70, 229, 0.09);
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .soft-card {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 14px;
            box-shadow: 0 14px 36px rgba(15, 23, 42, 0.08);
        }

        .avatar-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            color: #fff;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-company-1), var(--accent-company-2));
            box-shadow: 0 12px 28px rgba(79, 70, 229, 0.25);
        }

        .image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            min-height: 140px;
            color: var(--accent-company-1);
            background:
                linear-gradient(145deg, rgba(79, 70, 229, 0.11), rgba(249, 115, 22, 0.08)),
                #ffffff;
            border: 1px dashed rgba(79, 70, 229, 0.24);
            border-radius: 16px;
        }

        .image-placeholder svg {
            width: 34px;
            height: 34px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
        }

        .image-placeholder span {
            color: var(--text-secondary);
            font-size: 0.82rem;
            font-weight: 600;
        }

        .btn-company {
            background: linear-gradient(135deg, var(--accent-company-1), var(--accent-company-2));
            color: #fff;
            border: none;
            font-weight: 500;
        }
        .btn-company:hover { color: #fff; opacity: 0.9; }

        .btn-candidate {
            background: linear-gradient(135deg, var(--accent-candidate-1), var(--accent-candidate-2));
            color: #fff;
            border: none;
            font-weight: 500;
        }
        .btn-candidate:hover { color: #fff; opacity: 0.9; }

        .text-secondary-custom { color: var(--text-secondary); }

        /* Badge-pilule avec point de statut (signature visuelle) */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
        }
        .status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        .status-pill.success { color: var(--status-success); }
        .status-pill.success::before { background-color: var(--status-success); box-shadow: 0 0 0 0 var(--status-success); animation: pulse 2s infinite; }
        .status-pill.pending { color: var(--status-pending); }
        .status-pill.pending::before { background-color: var(--status-pending); box-shadow: 0 0 0 0 var(--status-pending); animation: pulse 2s infinite; }
        .status-pill.danger { color: var(--status-danger); }
        .status-pill.danger::before { background-color: var(--status-danger); }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255,255,255,0.3); }
            70% { box-shadow: 0 0 0 6px rgba(255,255,255,0); }
            100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
        }

        .form-control, .form-select {
            background-color: #ffffff;
            border-color: var(--border-subtle);
            color: var(--text-primary);
            border-radius: 12px;
            min-height: 46px;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            color: var(--text-primary);
            border-color: var(--accent-company-1);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }
        .form-control::placeholder { color: var(--text-secondary); }

        textarea.form-control {
            min-height: 150px;
        }

        .btn-outline-light {
            color: #374151;
            background: #ffffff;
            border-color: #d8deea;
        }

        .btn-outline-light:hover {
            color: #111827;
            background: #f8fafc;
            border-color: #bfc8da;
        }
    </style>

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark-custom">
        <div class="container">
            <a class="navbar-brand display-font" href="{{ url('/') }}">JobConnect</a>
            <div class="d-flex gap-2 align-items-center">
                @auth('company')
                    <span class="text-secondary-custom small">{{ auth('company')->user()->company_name }}</span>
                    <a href="{{ route('company.profile.edit') }}" class="btn btn-outline-light btn-sm">Mon profil</a>
                    <a href="{{ route('company.dashboard') }}" class="btn btn-company btn-sm">Dashboard</a>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Déconnexion</button>
                    </form>
                @else
                    @auth('candidate')
                        <span class="text-secondary-custom small">{{ auth('candidate')->user()->full_name }}</span>
                        <a href="{{ route('candidate.profile.edit') }}" class="btn btn-outline-light btn-sm">Mon profil</a>
                        <a href="{{ route('candidate.dashboard') }}" class="btn btn-candidate btn-sm">Dashboard</a>
                        <form method="POST" action="{{ route('candidate.logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('company.login') }}" class="btn btn-company btn-sm">Espace Entreprise</a>
                        <a href="{{ route('candidate.login') }}" class="btn btn-candidate btn-sm">Espace Candidat</a>
                    @endauth
                @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
