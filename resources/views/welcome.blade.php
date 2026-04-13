<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-tertiary: #94a3b8;
            --border: #e2e8f0;
            --shadow: rgba(0, 0, 0, 0.05);
            --shadow-hover: rgba(99, 102, 241, 0.15);
            --gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        [data-theme="dark"] {
            --bg-primary: #1e293b;
            --bg-secondary: #0f172a;
            --bg-tertiary: #334155;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-tertiary: #64748b;
            --border: #334155;
            --shadow: rgba(0, 0, 0, 0.3);
            --shadow-hover: rgba(99, 102, 241, 0.25);
            --gradient: linear-gradient(135deg, #818cf8 0%, #a78bfa 100%);
        }

        * {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        body {
            background: var(--bg-secondary);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        .navbar {
            background: var(--bg-primary) !important;
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 0.625rem;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: var(--bg-tertiary);
        }

        .theme-toggle {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            border-radius: 0.625rem;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow);
        }

        .theme-toggle i {
            font-size: 1.125rem;
            color: var(--text-primary);
        }

        .hero {
            background: var(--gradient);
            color: white;
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            font-weight: 300;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-hero {
            background: white;
            color: var(--primary);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.2);
            color: var(--primary);
        }

        .btn-outline-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-outline-hero:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-3px);
        }

        .features-section {
            padding: 6rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--bg-primary);
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            height: 100%;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px var(--shadow-hover);
            border-color: var(--primary-light);
        }

        .feature-icon {
            font-size: 3rem;
            color: white;
            margin-bottom: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: var(--gradient);
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .feature-card h4 {
            font-weight: 700;
            margin: 1.5rem 0 1rem;
            color: var(--text-primary);
            font-size: 1.25rem;
        }

        .feature-card p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin: 0;
        }

        .cta-section {
            background: var(--gradient);
            padding: 5rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: white;
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        footer {
            background: var(--bg-primary);
            border-top: 1px solid var(--border);
            color: var(--text-secondary);
            padding: 2rem 0;
            text-align: center;
        }

        /* Modal Styles */
        .modal-content {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 1.25rem;
            overflow: hidden;
        }

        .modal-header {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 1.75rem 2rem;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 0;
        }

        .auth-tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
            background: var(--bg-secondary);
        }

        .auth-tab {
            flex: 1;
            padding: 1.25rem;
            text-align: center;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .auth-tab:hover {
            color: var(--primary);
            background: var(--bg-tertiary);
        }

        .auth-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
            background: var(--bg-primary);
        }

        .auth-content {
            display: none;
            padding: 2rem;
        }

        .auth-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-form .form-group {
            margin-bottom: 1.25rem;
        }

        .auth-form .form-label {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .auth-form .form-control {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: var(--text-primary);
            width: 100%;
        }

        .auth-form .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
            background: var(--bg-primary);
        }

        .auth-form .btn-submit {
            background: var(--gradient);
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 0.75rem;
            color: white;
            font-weight: 600;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .auth-form .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        }

        .auth-form .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .auth-form .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.4rem;
        }

        .auth-form .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .auth-form .form-check-input {
            cursor: pointer;
        }

        .auth-form .form-check-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            cursor: pointer;
        }

        .auth-form .alert {
            border: none;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
        }

        .auth-form .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero {
                padding: 80px 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-chat-dots" style="font-size: 24px;"></i>
                <strong style="margin-left: 10px;">{{ config('app.name') }}</strong>
            </a>
            <div class="d-flex align-items-center gap-2">
                <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
                    <i class="bi bi-moon-fill"></i>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    @auth
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">Logout</button>
                        </form>
                    @else
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#authModal">Sign In</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1>Customer Support Chat + Forum</h1>
                    <p>Connect with support agents and engage with our community in real-time. Experience seamless communication and community collaboration.</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        @guest
                            <a href="#" class="btn btn-hero" data-bs-toggle="modal" data-bs-target="#authModal"><i class="bi bi-rocket-takeoff"></i> Get Started</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-hero"><i class="bi bi-speedometer2"></i> Go to Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Why Choose Us</h2>
                <p class="section-subtitle">Everything you need for customer support and community engagement</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h4>Real-time Chat</h4>
                        <p>Connect instantly with support agents and get immediate assistance whenever you need help</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-chat-left-text"></i>
                        </div>
                        <h4>Community Forum</h4>
                        <p>Engage with thousands of users, share knowledge, and find answers to common questions</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Secure & Private</h4>
                        <p>Your data is protected with enterprise-grade security and privacy standards</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Join our growing community and experience the best in customer support</p>
            @guest
                <a href="#" class="btn btn-hero" data-bs-toggle="modal" data-bs-target="#authModal"><i class="bi bi-person-plus"></i> Create Free Account</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-hero"><i class="bi bi-speedometer2"></i> Go to Dashboard</a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-chat-dots"></i> Welcome to {{ config('app.name') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs -->
                    <div class="auth-tabs">
                        <button class="auth-tab active" data-tab="login">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </button>
                        <button class="auth-tab" data-tab="register">
                            <i class="bi bi-person-plus"></i> Register
                        </button>
                    </div>

                    <!-- Login Form -->
                    <div class="auth-content active" id="login-content">
                        <form class="auth-form" id="login-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div id="login-error"></div>
                            
                            <div class="form-group">
                                <label for="login-email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="login-email" name="email" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="login-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="login-password" name="password" required>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn-submit">Sign In</button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div class="auth-content" id="register-content">
                        <form class="auth-form" id="register-form" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div id="register-error"></div>
                            
                            <div class="form-group">
                                <label for="register-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="register-name" name="name" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="register-email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="register-email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="register-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="register-password" name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn-submit">Create Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const themeIcon = themeToggle.querySelector('i');

        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        themeIcon.className = savedTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            themeIcon.className = newTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
        });

        // Auth Modal Tabs
        const authModal = document.getElementById('authModal');
        const tabs = document.querySelectorAll('.auth-tab');
        const contents = document.querySelectorAll('.auth-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetTab = tab.dataset.tab;
                
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(`${targetTab}-content`).classList.add('active');
            });
        });

        // Handle form submissions
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');

        async function handleSubmit(form, errorDiv) {
            const submitBtn = form.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Please wait...';

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    const errors = await response.json();
                    let errorMsg = '';
                    if (errors.message) {
                        errorMsg = errors.message;
                    } else if (errors.errors) {
                        errorMsg = Object.values(errors.errors).flat().join('<br>');
                    }
                    document.getElementById(errorDiv).innerHTML = `<div class="alert alert-danger">${errorMsg}</div>`;
                }
            } catch (error) {
                document.getElementById(errorDiv).innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        }

        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubmit(loginForm, 'login-error');
        });

        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubmit(registerForm, 'register-error');
        });
    </script>
</body>
</html>
