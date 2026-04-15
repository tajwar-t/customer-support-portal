<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <title>Forum Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            min-height: 100vh;
        }

        .post-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .post-header {
            background: var(--bg-primary);
            border-radius: 1rem;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--border);
        }

        .post-header h1 {
            color: var(--text-primary);
            font-weight: 800;
            font-size: 1.75rem;
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

        .btn-back {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            background: var(--border);
            transform: translateY(-2px);
        }

        .post-content-main {
            background: var(--bg-primary);
            border-radius: 1rem;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px var(--shadow);
            border: 1px solid var(--border);
            animation: slideIn 0.5s ease-out;
        }

        .post-meta-info {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1.75rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .post-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .post-title {
            color: var(--text-primary);
            font-weight: 800;
            font-size: 1.75rem;
            margin: 0 0 1.25rem 0;
            line-height: 1.3;
        }

        .post-body {
            color: var(--text-secondary);
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
            white-space: pre-wrap;
        }

        .category-badge {
            display: inline-block;
            padding: 0.35rem 0.875rem;
            border-radius: 0.625rem;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .comments-section {
            background: var(--bg-primary);
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 4px 6px var(--shadow);
            border: 1px solid var(--border);
            animation: slideIn 0.5s ease-out 0.1s both;
        }

        .comments-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.35rem;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .comment {
            padding: 1.25rem;
            border-left: 3px solid var(--primary);
            background: var(--bg-secondary);
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .comment:hover {
            box-shadow: 0 2px 8px var(--shadow);
        }

        .comment-author {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .comment-time {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin-bottom: 0.5rem;
        }

        .comment-body {
            color: var(--text-secondary);
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .empty-comments {
            text-align: center;
            padding: 2.5rem;
            color: var(--text-tertiary);
        }

        .empty-comments i {
            font-size: 3rem;
            opacity: 0.5;
            margin-bottom: 0.75rem;
        }

        .comment-form {
            background: var(--bg-secondary);
            padding: 1.75rem;
            border-radius: 0.875rem;
            margin-top: 1.75rem;
            border: 1px solid var(--border);
        }

        .comment-form textarea {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1rem;
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            margin-bottom: 1rem;
            width: 100%;
            resize: vertical;
            min-height: 100px;
            transition: all 0.3s ease;
        }

        .comment-form textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .btn-submit {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 0.875rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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

        @media (max-width: 768px) {
            .post-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .post-meta-info {
                gap: 1rem;
                justify-content: center;
            }

            .post-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="post-container">
        <div class="post-header">
            <h1><i class="bi bi-chat-left-text"></i> Forum Post</h1>
            <div class="button-group">
                <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
                    <i class="bi bi-moon-fill"></i>
                </button>
                <a href="{{ route('forum.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Back to Forum
                </a>
            </div>
        </div>

        <div class="post-content-main">
            <div class="post-meta-info">
                <div class="post-meta-item">
                    <i class="bi bi-person"></i>
                    <span>Author</span>
                </div>
                <div class="post-meta-item">
                    <i class="bi bi-calendar"></i>
                    <span>Date</span>
                </div>
                <div class="post-meta-item">
                    <i class="bi bi-eye"></i>
                    <span id="view-count">0 views</span>
                </div>
            </div>

            <h2 class="post-title">Post Title</h2>
            <div class="post-body">
                Post content will be displayed here. Click on a forum post to view its full content and comments.
            </div>
        </div>

        <div class="comments-section">
            <h3 class="comments-title"><i class="bi bi-chat-dots"></i> Comments</h3>
            <div class="empty-comments">
                <i class="bi bi-chat-left-dots"></i>
                <p>No comments yet. Be the first to share your thoughts!</p>
            </div>

            <div class="comment-form">
                <textarea rows="4" placeholder="Share your thoughts on this post..." id="comment-input"></textarea>
                <button class="btn-submit" id="comment-submit"><i class="bi bi-send"></i> Post Comment</button>
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

        const postSlug = window.location.pathname.split('/').pop();
        const postContentMain = document.querySelector('.post-content-main');
        const commentsSection = document.querySelector('.comments-section');
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

        async function loadPost() {
            try {
                const response = await fetchWithCSRF(`/api/posts/${postSlug}`);
                if (!response.ok) throw new Error('Failed to load post');

                const post = await response.json();
                const category = post.category ? `<span class="category-badge" style="color: ${getCategoryColor(post.category)}; background: ${getCategoryColor(post.category)}20; border: 1px solid ${getCategoryColor(post.category)};">${escapeHtml(post.category)}</span>` : '';
                
                postContentMain.innerHTML = `
                    <div class="post-meta-info">
                        <div class="post-meta-item">
                            <i class="bi bi-person-circle"></i>
                            <span>${escapeHtml(post.user?.name || 'Unknown')}</span>
                        </div>
                        <div class="post-meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>${new Date(post.created_at).toLocaleDateString()}</span>
                        </div>
                        <div class="post-meta-item">
                            <i class="bi bi-eye"></i>
                            <span>${post.views_count || 0} views</span>
                        </div>
                        ${category ? `<div class="post-meta-item">${category}</div>` : ''}
                    </div>

                    <h2 class="post-title">${escapeHtml(post.title)}</h2>
                    <div class="post-body">${escapeHtml(post.content)}</div>
                `;

                await loadComments(post);
            } catch (error) {
                console.error('Error loading post:', error);
                postContentMain.innerHTML = `
                    <div class="post-meta-info">
                        <p style="color: #ef4444;">Error loading post: ${escapeHtml(error.message)}</p>
                    </div>
                `;
            }
        }

        async function loadComments(post) {
            const comments = post.comments || [];
            let commentsHTML = `<h3 class="comments-title"><i class="bi bi-chat-dots"></i> Comments (${comments.length})</h3>`;

            if (comments.length > 0) {
                comments.forEach(comment => {
                    const authorName = comment.user?.name || 'Unknown';
                    commentsHTML += `
                        <div class="comment">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.875rem;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--gradient); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.85rem; font-weight: 700; flex-shrink: 0; box-shadow: 0 2px 8px rgba(14, 165, 233, 0.3);">
                                    ${getInitials(authorName)}
                                </div>
                                <div>
                                    <div class="comment-author">${escapeHtml(authorName)}</div>
                                    <div class="comment-time">${new Date(comment.created_at).toLocaleString()}</div>
                                </div>
                            </div>
                            <div class="comment-body">${escapeHtml(comment.content)}</div>
                        </div>
                    `;
                });
            } else {
                commentsHTML += `
                    <div class="empty-comments">
                        <i class="bi bi-chat-left-dots"></i>
                        <p>No comments yet. Be the first to share your thoughts!</p>
                    </div>
                `;
            }

            commentsHTML += `
                <div class="comment-form" style="margin-top: 1.75rem;">
                    <textarea rows="4" placeholder="Share your thoughts on this post..." id="comment-input"></textarea>
                    <button class="btn-submit" id="comment-submit"><i class="bi bi-send"></i> Post Comment</button>
                </div>
            `;

            commentsSection.innerHTML = commentsHTML;

            const commentInput = document.getElementById('comment-input');
            const submitButton = document.getElementById('comment-submit');

            submitButton.addEventListener('click', submitComment);
            commentInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    submitComment();
                }
            });
        }

        async function submitComment() {
            const commentInput = document.getElementById('comment-input');
            const submitBtn = document.getElementById('comment-submit');
            const content = commentInput.value.trim();

            if (!content) {
                alert('Please enter a comment');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Posting...';

            try {
                const response = await fetchWithCSRF(`/api/posts/${postSlug}/comments`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ content })
                });

                if (response.ok) {
                    commentInput.value = '';
                    await loadPost();
                } else {
                    const error = await response.json();
                    alert('Error posting comment: ' + (error.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error posting comment:', error);
                alert('Error posting comment');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-send"></i> Post Comment';
            }
        }

        loadPost();
    </script>
</body>
</html>
