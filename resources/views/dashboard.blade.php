<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
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
            --light-gray: #f8fafc;
        }
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        .sidebar {
            background: white;
            border-right: 1px solid #e2e8f0;
            min-height: 100vh;
            padding: 2rem 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .sidebar h4 {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .nav-link {
            color: #64748b;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateX(4px);
        }
        .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.75rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .header h2 {
            color: var(--dark);
            font-weight: 700;
            margin: 0;
        }
        .header .badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            font-weight: 600;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }
        .dashboard-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
            border-color: var(--primary-light);
            transform: translateY(-2px);
        }
        .stat-card {
            text-align: center;
            padding: 1.5rem !important;
        }
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .stat-icon.primary { color: var(--primary); }
        .stat-icon.success { color: #10b981; }
        .stat-icon.warning { color: #f59e0b; }
        .stat-count {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.65rem 1.25rem;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
            color: white;
        }
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
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
        }
        h5 {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 1rem;
        }
        .text-muted {
            color: #94a3b8 !important;
            font-size: 0.9rem;
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
        .dashboard-card {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" style="width: 250px;">
            <h4 class="mb-4" style="color: var(--primary);">
                <i class="bi bi-chat-dots"></i> {{ config('app.name') }}
            </h4>
            <nav class="nav flex-column">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('chat.index') }}" class="nav-link">
                    <i class="bi bi-chat"></i> Support Chat
                </a>
                <a href="{{ route('forum.index') }}" class="nav-link">
                    <i class="bi bi-chat-left-text"></i> Forum
                </a>
                <hr class="my-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer;">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div style="flex: 1;">
            <div class="header">
                <h2>Dashboard</h2>
                <div>
                    <span class="me-3">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                    <span class="badge bg-primary">{{ Auth::user()->role }}</span>
                </div>
            </div>

            <div class="container-fluid" style="padding: 0 30px;">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="dashboard-card stat-card">
                            <div class="stat-icon primary">
                                <i class="bi bi-chat"></i>
                            </div>
                            <h5 class="stat-label">Support Chats</h5>
                            <p class="stat-count" id="chats-count">0</p>
                            <a href="{{ route('chat.index') }}" class="btn btn-sm btn-primary">View Chats</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stat-card">
                            <div class="stat-icon success">
                                <i class="bi bi-chat-left-text"></i>
                            </div>
                            <h5 class="stat-label">Forum Posts</h5>
                            <p class="stat-count" id="posts-count">0</p>
                            <a href="{{ route('forum.index') }}" class="btn btn-sm btn-primary">View Forum</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stat-card">
                            <div class="stat-icon warning">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <h5 class="stat-label">My Profile</h5>
                            <p style="font-size: 0.9rem; color: #64748b; margin: 0.5rem 0;">{{ Auth::user()->email }}</p>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal">Edit Profile</button>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <h5>Quick Actions</h5>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="{{ route('chat.index') }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="bi bi-chat"></i> Start Support Chat
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('forum.create') }}" class="btn btn-outline-success w-100 mb-2">
                                <i class="bi bi-plus-circle"></i> Create Forum Post
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <h5>Recent Activity</h5>
                    <p class="text-muted">Your recent chats and posts will appear here.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fetch dashboard statistics
        fetch('/api/chats', {
            headers: {
                'Authorization': 'Bearer ' + document.querySelector('meta[name="csrf-token"]') || ''
            }
        })
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
</body>
</html>
