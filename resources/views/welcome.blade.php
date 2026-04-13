<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --secondary: #4f46e5;
            --dark: #0f172a;
            --light: #f8fafc;
        }
        body {
            background: var(--light);
            overflow-x: hidden;
        }
        .navbar {
            background: white !important;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link {
            color: #64748b !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }
        .nav-link:hover {
            color: var(--primary) !important;
        }
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
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
            font-weight: 700;
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
        .btn-modern {
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-modern-primary {
            background: white;
            color: var(--primary);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-modern-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            color: var(--primary);
        }
        .btn-modern-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        .btn-modern-secondary:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-2px);
        }
        .features-section {
            padding: 6rem 0;
        }
        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: var(--primary-light);
        }
        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(79,70,229,0.05));
            border-radius: 1rem;
        }
        .feature-card h4 {
            font-weight: 700;
            margin: 1.5rem 0 1rem;
            color: var(--dark);
            font-size: 1.25rem;
        }
        .feature-card p {
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 5rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
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
            background: var(--dark);
            color: #cbd5e1;
            padding: 2rem 0;
            text-align: center;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-chat-dots" style="color: var(--primary); font-size: 24px;"></i>
                <strong style="color: var(--primary); margin-left: 10px;">{{ config('app.name') }}</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    @auth
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">Logout</button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
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
                            <a href="{{ route('register') }}" class="btn btn-modern btn-modern-primary">Get Started</a>
                            <a href="{{ route('login') }}" class="btn btn-modern btn-modern-secondary">Sign In</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-modern btn-modern-primary">Go to Dashboard</a>
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
                <h2 style="font-size: 2.5rem; font-weight: 700; color: var(--dark); margin-bottom: 1rem;">Why Choose Us</h2>
                <p style="color: #64748b; font-size: 1.1rem; max-width: 500px; margin: 0 auto;">Everything you need for customer support and community engagement</p>
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
                <a href="{{ route('register') }}" class="btn btn-modern btn-modern-primary">Create Free Account</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-modern btn-modern-primary">Go to Dashboard</a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
</html>

