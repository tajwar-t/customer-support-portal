@extends('layouts.app')

@section('title', 'Support Chat - ' . config('app.name'))

@push('styles')
@include('layouts.sidebar-styles')
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

    .chat-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 2.5rem;
    }

    .chat-header {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px var(--shadow);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 1rem;
    }

    .chat-header h1 {
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
        flex-wrap: wrap;
    }

    .chat-content {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px var(--shadow);
        border: 1px solid var(--border);
    }

    .chat-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.25rem;
    }

    .chat-item {
        background: var(--gradient);
        border-radius: 1rem;
        padding: 1.75rem;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        display: flex;
        flex-direction: column;
        position: relative;
        padding-right: 3.5rem;
    }

    .chat-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .chat-item h5 {
        margin: 0 0 0.75rem 0;
        font-weight: 700;
        color: white;
        font-size: 1.15rem;
    }

    .chat-item p {
        margin: 0.5rem 0 0 0;
        opacity: 0.95;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .delete-chat-btn {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 0.5rem;
        width: 2.5rem;
        height: 2.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        flex-shrink: 0;
    }

    .delete-chat-btn:hover {
        background: rgba(239, 68, 68, 0.8);
        border-color: #ef4444;
        transform: scale(1.1);
    }

    .delete-chat-btn i {
        font-size: 1rem;
        color: white;
    }

    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 0.625rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        grid-column: 1 / -1;
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
        cursor: pointer;
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

    .theme-toggle {
        background: var(--bg-tertiary);
        border: 1px solid var(--border);
        border-radius: 0.625rem;
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

    .modal-content {
        background: var(--bg-primary);
        border: 1px solid var(--border);
    }

    .modal-header {
        background: var(--gradient);
        color: white;
        border: none;
    }

    .modal-header .btn-close-white {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        background: var(--bg-primary);
    }

    .modal-footer {
        background: var(--bg-primary);
        border-top: 1px solid var(--border);
    }

    .form-label {
        color: var(--text-primary);
        font-weight: 600;
    }

    .form-control {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        color: var(--text-primary);
    }

    .form-control:focus {
        background: var(--bg-primary);
        border-color: var(--primary);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .chat-header {
            flex-direction: column;
            text-align: center;
        }

        .button-group {
            width: 100%;
            justify-content: center;
        }

        .chat-list {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="chat-container">
    <div class="chat-header">
        <div>
            <h1><i class="bi bi-chat-dots"></i> Support Chat</h1>
            <p style="margin-top: 0.5rem; color: var(--text-secondary);">Browse or start a support conversation</p>
        </div>
        <div class="button-group">
            <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
                <i class="bi bi-moon-fill"></i>
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newChatModal">
                <i class="bi bi-plus-circle"></i> New Chat
            </button>
        </div>
    </div>

    <div class="chat-content">
        <div class="chat-list" id="chat-list">
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>No support chats yet</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newChatModal">
                    <i class="bi bi-plus-circle"></i> Start a New Chat
                </button>
            </div>
        </div>
    </div>
</div>

<!-- New Chat Modal -->
<div class="modal fade" id="newChatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Start New Chat</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="new-chat-form">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required placeholder="What is this chat about?">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required rows="3" placeholder="Describe your issue..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border);" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="create-chat-btn">Create Chat</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const chatListEl = document.getElementById('chat-list');
    const newChatForm = document.getElementById('new-chat-form');
    const createChatBtn = document.getElementById('create-chat-btn');
    const newChatModal = new bootstrap.Modal(document.getElementById('newChatModal'));
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

    function getStatusColor(status) {
        const colors = {
            'open': '#10b981',
            'in_progress': '#f59e0b',
            'closed': '#6b7280'
        };
        return colors[status] || '#6366f1';
    }

    async function deleteChat(chatId) {
        try {
            const response = await fetchWithCSRF(`/api/chats/${chatId}`, {
                method: 'DELETE'
            });

            if (response.ok) {
                await loadChats();
            } else {
                const error = await response.json();
                alert('Error: ' + (error.message || 'Failed to delete chat'));
            }
        } catch (error) {
            console.error('Error deleting chat:', error);
            alert('Error deleting chat');
        }
    }

    async function loadChats() {
        try {
            const response = await fetchWithCSRF('/api/chats');

            if (response.status === 401) {
                window.location.href = '/login';
                return;
            }

            if (!response.ok) throw new Error(`HTTP ${response.status}`);

            const chats = await response.json();

            if (Array.isArray(chats) && chats.length > 0) {
                chatListEl.innerHTML = chats.map(chat => {
                    const status = chat.status || 'open';
                    const canDelete = {{ auth()->id() }} === chat.customer_id || '{{ auth()->user()->role }}' === 'admin';
                    return `
                        <div style="position: relative;">
                            <a href="/chat/${chat.id}" class="chat-item">
                                <span class="status-badge">${status.toUpperCase()}</span>
                                <h5>${escapeHtml(chat.subject)}</h5>
                                <p>${escapeHtml(chat.description.substring(0, 100))}${chat.description.length > 100 ? '...' : ''}</p>
                                <p style="margin-top: 0.75rem; font-size: 0.85rem; opacity: 0.9;">
                                    <i class="bi bi-calendar"></i> ${new Date(chat.created_at).toLocaleDateString()}
                                </p>
                                ${canDelete ? `
                                    <button class="delete-chat-btn" data-chat-id="${chat.id}" title="Delete chat" onclick="event.preventDefault(); event.stopPropagation();">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                ` : ''}
                            </a>
                        </div>
                    `;
                }).join('');

                // Attach delete event listeners
                document.querySelectorAll('.delete-chat-btn').forEach(btn => {
                    btn.addEventListener('click', async (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        const chatId = btn.dataset.chatId;
                        if (confirm('Are you sure you want to delete this chat? This action cannot be undone.')) {
                            await deleteChat(chatId);
                        }
                    });
                });
            } else {
                chatListEl.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No support chats yet</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newChatModal">
                            <i class="bi bi-plus-circle"></i> Start a New Chat
                        </button>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error loading chats:', error);
            chatListEl.innerHTML = `
                <div class="empty-state">
                    <i class="bi bi-exclamation-triangle"></i>
                    <p>Error loading chats: ${escapeHtml(error.message)}</p>
                    <button type="button" class="btn btn-primary" onclick="loadChats()">Retry</button>
                </div>
            `;
        }
    }

    createChatBtn.addEventListener('click', async () => {
        const subject = document.getElementById('subject').value;
        const description = document.getElementById('description').value;

        if (!subject || !description) {
            alert('Please fill in all fields');
            return;
        }

        try {
            const response = await fetchWithCSRF('/api/chats', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ subject, description })
            });

            if (response.ok) {
                const chat = await response.json();
                newChatForm.reset();
                newChatModal.hide();
                window.location.href = `/chat/${chat.id}`;
            } else {
                const error = await response.json();
                alert('Error creating chat: ' + (error.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error creating chat:', error);
            alert('Error creating chat');
        }
    });

    loadChats();
</script>
@endpush
