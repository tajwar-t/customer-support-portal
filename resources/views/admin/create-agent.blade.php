@extends('layouts.app')

@section('title', 'Create Agent - ' . config('app.name'))

@push('styles')
@include('layouts.sidebar-styles')
<style>
    :root {
        --primary: #0ea5e9;
        --primary-light: #38bdf8;
        --primary-dark: #0284c7;
        --secondary: #8b5cf6;
        --accent: #14b8a6;
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-tertiary: #f1f5f9;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-tertiary: #94a3b8;
        --border: #e2e8f0;
        --shadow: rgba(0, 0, 0, 0.05);
        --shadow-hover: rgba(14, 165, 233, 0.15);
        --gradient: linear-gradient(135deg, #0ea5e9 0%, #14b8a6 100%);
        --success: #10b981;
        --danger: #ef4444;
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
        --shadow-hover: rgba(14, 165, 233, 0.25);
        --gradient: linear-gradient(135deg, #38bdf8 0%, #2dd4bf 100%);
    }

    * {
        font-family: 'Inter', sans-serif;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    body {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }

    .page-header {
        background: var(--bg-primary);
        border-bottom: 1px solid var(--border);
        padding: 1.5rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px var(--shadow);
    }

    .page-header h2 {
        color: var(--text-primary);
        font-weight: 800;
        margin: 0;
        font-size: 1.75rem;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
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
    }

    .theme-toggle:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px var(--shadow);
    }

    .theme-toggle i {
        font-size: 1.125rem;
        color: var(--text-primary);
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 0.625rem;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-primary {
        background: var(--gradient);
        color: white;
    }

    .container {
        padding: 2rem 2.5rem;
        max-width: 800px;
    }

    .form-card {
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: 1rem;
        padding: 2.5rem;
        box-shadow: 0 2px 4px var(--shadow);
        animation: slideIn 0.5s ease-out;
    }

    .form-card:hover {
        box-shadow: 0 8px 24px var(--shadow-hover);
    }

    .form-title {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }

    .form-label {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        color: var(--text-primary);
        border-radius: 0.625rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        background: var(--bg-primary);
    }

    .form-control::placeholder {
        color: var(--text-tertiary);
    }

    .form-text {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin-top: 0.35rem;
    }

    .btn {
        border-radius: 0.75rem;
        font-weight: 600;
        padding: 0.875rem 1.75rem;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: var(--gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
        color: white;
    }

    .btn-outline-secondary {
        border: 2px solid var(--border);
        color: var(--text-secondary);
        background: transparent;
    }

    .btn-outline-secondary:hover {
        background: var(--bg-tertiary);
        border-color: var(--border);
        color: var(--text-primary);
    }

    .alert {
        border-radius: 0.625rem;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        border: none;
        font-weight: 500;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        border-left: 4px solid var(--success);
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        border-left: 4px solid var(--danger);
    }

    .is-invalid {
        border-color: var(--danger) !important;
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 0.35rem;
        display: block;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .form-actions .btn {
        flex: 1;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h2>Create Support Agent</h2>
    <div class="header-right">
        <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
            <i class="bi bi-moon-fill"></i>
        </button>
        <div>
            <span class="badge badge-primary">{{ Auth::user()->role }}</span>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-card">
        <h3 class="form-title">Agent Account Creation</h3>
        <p class="form-subtitle">Create a new support agent account to handle customer chats</p>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i> Please fix the errors below
            </div>
        @endif

        <form action="{{ route('admin.agents.store') }}" method="POST" id="create-agent-form">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">
                    <i class="bi bi-person"></i> Full Name
                </label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="Enter agent's full name"
                    required
                    autofocus
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope"></i> Email Address
                </label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="agent@example.com"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">This will be used for login and notifications</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="bi bi-lock"></i> Password
                </label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="Minimum 8 characters"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Must be at least 8 characters long</div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    <i class="bi bi-lock-fill"></i> Confirm Password
                </label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Re-enter password"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i> Create Agent Account
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Password confirmation validation
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    passwordConfirmation.addEventListener('input', function() {
        if (this.value !== password.value) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
@endpush
