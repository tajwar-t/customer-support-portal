@extends('layouts.app')

@section('title', 'Dashboard - ' . config('app.name'))

@push('styles')
@include('layouts.sidebar-styles')
@endpush

@section('content')
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

    .dashboard-container {
        padding: 2rem 2.5rem;
    }

    .dashboard-card {
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 2px 4px var(--shadow);
        transition: all 0.3s ease;
        animation: slideIn 0.5s ease-out;
    }

    .dashboard-card:hover {
        box-shadow: 0 8px 24px var(--shadow-hover);
        border-color: var(--primary-light);
        transform: translateY(-4px);
    }

    .stat-card {
        text-align: center;
        padding: 2.5rem 1.5rem !important;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: inline-block;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-count {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0.75rem 0;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.95rem;
        font-weight: 600;
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
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .btn-outline-primary {
        border: 2px solid var(--primary);
        color: var(--primary);
        background: transparent;
    }

    .btn-outline-primary:hover {
        background: var(--gradient);
        border-color: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-outline-success {
        border: 2px solid #10b981;
        color: #10b981;
        background: transparent;
    }

    .btn-outline-success:hover {
        background: #10b981;
        border-color: #10b981;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .card-title {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1.25rem;
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
</style>

<div class="page-header">
    <h2>Dashboard</h2>
    <div class="header-right">
        <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
            <i class="bi bi-moon-fill"></i>
        </button>
        <div>
            <span class="badge badge-primary">{{ Auth::user()->role }}</span>
        </div>
    </div>
</div>

<div class="dashboard-container">
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon">
                    <i class="bi bi-chat"></i>
                </div>
                <h5 class="stat-label">Support Chats</h5>
                <p class="stat-count" id="chats-count">0</p>
                <a href="{{ route('chat.index') }}" class="btn btn-sm btn-primary">View Chats</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon">
                    <i class="bi bi-chat-left-text"></i>
                </div>
                <h5 class="stat-label">Forum Posts</h5>
                <p class="stat-count" id="posts-count">0</p>
                <a href="{{ route('forum.index') }}" class="btn btn-sm btn-primary">View Forum</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h5 class="stat-label">My Profile</h5>
                <p style="font-size: 0.9rem; color: var(--text-secondary); margin: 0.75rem 0;">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="dashboard-card mb-4">
        <h5 class="card-title">Quick Actions</h5>
        <div class="row mt-3 g-3">
            <div class="col-md-6">
                <a href="{{ route('chat.index') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-chat"></i> Start Support Chat
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('forum.create') }}" class="btn btn-outline-success w-100">
                    <i class="bi bi-plus-circle"></i> Create Forum Post
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Fetch dashboard statistics
    fetch('/api/chats')
    .then(response => response.json())
    .then(data => {
        document.getElementById('chats-count').textContent = data.length || 0;
    })
    .catch(error => console.log('Note: API calls require authentication'));

    fetch('/api/posts')
    .then(response => response.json())
    .then(data => {
        document.getElementById('posts-count').textContent = data.data ? data.data.length : 0;
    })
    .catch(error => console.log('Note: API calls require authentication'));
</script>
@endpush
