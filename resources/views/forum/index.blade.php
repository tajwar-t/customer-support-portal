@extends('layouts.app')

@section('title', 'Forum - ' . config('app.name'))

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

    .forum-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem 2.5rem;
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

    .btn-primary {
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
        background: var(--gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
        color: white;
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
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
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
@endpush

@section('content')
<div class="forum-container">
    <div class="forum-header">
        <div>
            <h1><i class="bi bi-chat-left-text"></i> Forum</h1>
            <p style="margin-top: 0.5rem; color: var(--text-secondary);">Community discussions and support</p>
        </div>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="theme-toggle" id="theme-toggle" title="Toggle theme" style="background: var(--bg-tertiary); border: 1px solid var(--border); border-radius: 0.625rem; padding: 0.65rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-moon-fill" style="font-size: 1.25rem; color: var(--text-primary);"></i>
            </button>
            <a href="{{ route('forum.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Create Post
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
@endsection

@push('scripts')
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

    function getCategoryColor(category) {
        const colors = {
            'general': '#0ea5e9',
            'support': '#10b981',
            'features': '#f59e0b',
            'announcements': '#ef4444'
        };
        return colors[category] || '#0ea5e9';
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
            }
            // If no posts, keep the server-rendered empty state
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
@endpush
