<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        :root {
            --primary: #6366f1;
            --secondary: #4f46e5;
            --dark: #0f172a;
        }
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        .forum-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .forum-header {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .forum-header h1 {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
        }
        .button-group {
            display: flex;
            gap: 1rem;
        }
        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.65rem 1.25rem;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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
        .btn-secondary {
            background: white;
            border: 1px solid #e2e8f0;
            color: var(--dark);
        }
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: var(--primary);
            color: var(--primary);
        }
        .posts-list {
            display: grid;
            gap: 1.5rem;
        }
        .post-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }
        .post-card:hover {
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
            border-color: var(--primary-light);
            transform: translateY(-2px);
            color: inherit;
        }
        .post-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .post-content {
            flex: 1;
        }
        .post-title {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0 0 0.5rem 0;
        }
        .post-excerpt {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0 0 0.75rem 0;
            line-height: 1.5;
        }
        .post-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.85rem;
            color: #94a3b8;
        }
        .post-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .empty-state i {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }
        .empty-state p {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="forum-container">
        <div class="forum-header">
            <div>
                <h1><i class="bi bi-chat-left-text"></i> Forum</h1>
                <p class="text-muted mb-0" style="margin-top: 0.5rem;">Community discussions and support</p>
            </div>
            <div class="button-group">
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
                        
                        return `
                            <a href="/forum/${post.slug}" class="post-card">
                                <div class="post-avatar">${getInitials(authorName)}</div>
                                <div class="post-content">
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
