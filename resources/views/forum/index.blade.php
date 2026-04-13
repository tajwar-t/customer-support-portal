<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <title>Forum</title>
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
            
            /* Light theme */
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
            min-height: 100vh;
        }

        .forum-container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .forum-header {
            background: var(--bg-primary);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--border);
        }

        .forum-header h1 {
            color: var(--text-primary);
            font-weight: 800;
            font-size: 2rem;
            margin: 0;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .button-group {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .theme-toggle {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.65rem;
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
            font-size: 1.25rem;
            color: var(--text-primary);
        }

        .btn {
            border-radius: 0.75rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
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

        .btn-secondary {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background: var(--border);
            transform: translateY(-2px);
        }

        .posts-list {
            display: grid;
            gap: 1rem;
        }

        .post-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.75rem;
            box-shadow: 0 2px 4px var(--shadow);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            gap: 1.25rem;
            align-items: flex-start;
            cursor: pointer;
        }

        .post-card:hover {
            box-shadow: 0 8px 24px var(--shadow-hover);
            border-color: var(--primary);
            transform: translateY(-4px);
            color: inherit;
        }

        .post-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .post-content {
            flex: 1;
        }

        .post-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.15rem;
            margin: 0 0 0.5rem 0;
        }

        .post-excerpt {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin: 0 0 0.75rem 0;
            line-height: 1.6;
        }

        .post-meta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            font-size: 0.85rem;
            color: var(--text-tertiary);
        }

        .post-meta-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .post-meta-item i {
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--bg-primary);
            border-radius: 1rem;
            box-shadow: 0 4px 6px var(--shadow);
            border: 1px solid var(--border);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--text-tertiary);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .category-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            background: var(--bg-tertiary);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        @media (max-width: 768px) {
            .forum-header {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }

            .button-group {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .post-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .post-meta {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="forum-container">
        <div class="forum-header">
            <div>
                <h1><i class="bi bi-chat-left-text"></i> Forum</h1>
                <p class="text-muted mb-0" style="margin-top: 0.5rem; color: var(--text-secondary) !important;">Community discussions and support</p>
            </div>
            <div class="button-group">
                <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
                    <i class="bi bi-moon-fill"></i>
                </button>
                <a href="{{ route('forum.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create Post
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
            </div>
        </div>

        <div class="posts-list">
            <div class="empty-state">
                <i class="bi bi-chat-dots"></i>
                <p>No forum posts yet</p>
                <a href="{{ route('forum.create') }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Be the first to post
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const themeIcon = themeToggle.querySelector('i');

        // Load saved theme
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

        const postsListEl = document.querySelector('.posts-list');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        const fetchWithCSRF = (url, options = {}) => {
            return fetch(url, {
                ...options,
                credentials: 'include',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    ...options.headers,
                }
            });
        };

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }

        function getInitials(name) {
            return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
        }

        function getCategoryColor(category) {
            const colors = {
                'general': '#6366f1',
                'support': '#10b981',
                'features': '#f59e0b',
                'announcements': '#ef4444'
            };
            return colors[category] || '#6366f1';
        }

        async function loadPosts() {
            try {
                const response = await fetchWithCSRF('/api/posts');
                if (!response.ok) throw new Error('Failed to load posts');

                const data = await response.json();
                const posts = data.data || data;

                if (posts && posts.length > 0) {
                    postsListEl.innerHTML = posts.map(post => {
                        const authorName = post.user?.name || 'Unknown';
                        const commentCount = post.comments?.length || 0;
                        const excerpt = post.content.substring(0, 150) + (post.content.length > 150 ? '...' : '');
                        const category = post.category ? `<span class="category-badge" style="color: ${getCategoryColor(post.category)}; border-color: ${getCategoryColor(post.category)};">${escapeHtml(post.category)}</span>` : '';
                        
                        return `
                            <a href="/forum/${post.slug}" class="post-card">
                                <div class="post-avatar">${getInitials(authorName)}</div>
                                <div class="post-content">
                                    ${category}
                                    <h3 class="post-title">${escapeHtml(post.title)}</h3>
                                    <p class="post-excerpt">${escapeHtml(excerpt)}</p>
                                    <div class="post-meta">
                                        <span class="post-meta-item">
                                            <i class="bi bi-person"></i> ${escapeHtml(authorName)}
                                        </span>
                                        <span class="post-meta-item">
                                            <i class="bi bi-calendar"></i> ${new Date(post.created_at).toLocaleDateString()}
                                        </span>
                                        <span class="post-meta-item">
                                            <i class="bi bi-chat-dots"></i> ${commentCount} comment${commentCount !== 1 ? 's' : ''}
                                        </span>
                                        <span class="post-meta-item">
                                            <i class="bi bi-eye"></i> ${post.views_count || 0} views
                                        </span>
                                    </div>
                                </div>
                            </a>
                        `;
                    }).join('');
                } else {
                    postsListEl.innerHTML = `
                        <div class="empty-state">
                            <i class="bi bi-chat-dots"></i>
                            <p>No forum posts yet</p>
                            <a href="/forum/create" class="btn btn-primary">
                                <i class="bi bi-pencil"></i> Be the first to post
                            </a>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading posts:', error);
                postsListEl.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-exclamation-triangle"></i>
                        <p>Error loading posts: ${escapeHtml(error.message)}</p>
                        <button onclick="loadPosts()" class="btn btn-primary">Retry</button>
                    </div>
                `;
            }
        }

        loadPosts();
    </script>
</body>
</html>
