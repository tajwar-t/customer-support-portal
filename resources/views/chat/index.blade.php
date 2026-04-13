<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support Chat</title>
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
        .chat-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .chat-header {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chat-header h1 {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
        }
        .chat-content {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .chat-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .chat-item {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 0.75rem;
            padding: 1.5rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .chat-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.2);
            color: white;
        }
        .chat-item h5 {
            margin: 0;
            font-weight: 700;
            color: white;
        }
        .chat-item p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
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
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <div>
                <h1><i class="bi bi-chat-dots"></i> Support Chat</h1>
                <p class="text-muted mb-0" style="margin-top: 0.5rem;">Browse or start a support conversation</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="chat-content">
            <div class="chat-list" id="chat-list">
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No support chats yet</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Start a New Chat</a>
                </div>
            </div>
        </div>
    </div>

    <!-- New Chat Modal -->
    <div class="modal fade" id="newChatModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none;">
                    <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Start New Chat</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="new-chat-form">
                        <div class="mb-3">
                            <label for="subject" class="form-label" style="font-weight: 600; color: var(--dark);">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required placeholder="What is this chat about?">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label" style="font-weight: 600; color: var(--dark);">Description</label>
                            <textarea class="form-control" id="description" name="description" required rows="3" placeholder="Describe your issue..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="create-chat-btn">Create Chat</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const chatListEl = document.getElementById('chat-list');
        const newChatForm = document.getElementById('new-chat-form');
        const createChatBtn = document.getElementById('create-chat-btn');
        const newChatModal = new bootstrap.Modal(document.getElementById('newChatModal'));

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                         document.querySelector('input[name="_token"]')?.value;

        // Add CSRF token to all fetch requests
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

        // Load chats
        async function loadChats() {
            try {
                const response = await fetchWithCSRF('/api/chats');
                const chats = await response.json();
                
                if (Array.isArray(chats) && chats.length > 0) {
                    chatListEl.innerHTML = chats.map(chat => `
                        <a href="/chat/${chat.id}" class="chat-item">
                            <h5>${chat.subject}</h5>
                            <p>${chat.description.substring(0, 100)}${chat.description.length > 100 ? '...' : ''}</p>
                            <p style="margin-top: 0.75rem; font-size: 0.85rem; opacity: 0.8;">
                                <i class="bi bi-calendar"></i> ${new Date(chat.created_at).toLocaleDateString()}
                            </p>
                        </a>
                    `).join('');
                } else {
                    chatListEl.innerHTML = `
                        <div class="empty-state" style="grid-column: 1 / -1;">
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
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-exclamation-triangle"></i>
                        <p>Error loading chats</p>
                    </div>
                `;
            }
        }

        // Create new chat
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

        // Add new chat button to header
        const chatHeader = document.querySelector('.chat-header');
        if (chatHeader && chatHeader.querySelector('.btn-primary')?.textContent.includes('Back')) {
            const backBtn = chatHeader.querySelector('.btn-primary');
            backBtn.insertAdjacentHTML('afterend', `
                <button type="button" class="btn btn-primary" style="margin-left: 0.5rem;" data-bs-toggle="modal" data-bs-target="#newChatModal">
                    <i class="bi bi-plus-circle"></i> New Chat
                </button>
            `);
        }

        // Load chats on page load
        loadChats();
    </script>
</body>
</html>
