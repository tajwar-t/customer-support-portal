<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Details</title>
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

        .chat-container {
            display: flex;
            max-width: 1400px;
            margin: 0 auto;
            height: 100vh;
            gap: 1rem;
            padding: 1rem;
        }

        .chat-sidebar {
            width: 300px;
            background: var(--bg-primary);
            border-radius: 1rem;
            box-shadow: 0 4px 6px var(--shadow);
            padding: 1.75rem;
            overflow-y: auto;
            border: 1px solid var(--border);
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--bg-primary);
            border-radius: 1rem;
            box-shadow: 0 4px 6px var(--shadow);
            border: 1px solid var(--border);
        }

        .chat-header {
            background: var(--gradient);
            color: white;
            padding: 1.75rem;
            border-radius: 1rem 1rem 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header h5 {
            margin: 0;
            font-weight: 800;
            color: white;
            font-size: 1.25rem;
        }

        .button-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .theme-toggle {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.625rem;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .theme-toggle i {
            font-size: 1.125rem;
            color: white;
        }

        .chat-messages {
            flex: 1;
            padding: 1.75rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            background: var(--bg-secondary);
        }

        .message {
            display: flex;
            margin-bottom: 1rem;
            animation: slideIn 0.3s ease-out;
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message-bubble {
            max-width: 70%;
            padding: 0.875rem 1.25rem;
            border-radius: 1rem;
            word-wrap: break-word;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .message.received .message-bubble {
            background: var(--bg-primary);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .message.sent .message-bubble {
            background: var(--gradient);
            color: white;
        }

        .message-time {
            font-size: 0.75rem;
            color: var(--text-tertiary);
            margin-top: 0.35rem;
            text-align: center;
        }

        .message-sender {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        .chat-input-area {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 0.875rem;
            background: var(--bg-primary);
            border-radius: 0 0 1rem 1rem;
        }

        .chat-input-area input {
            flex: 1;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .chat-input-area input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .chat-input-area input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-send {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 0.875rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            white-space: nowrap;
        }

        .btn-send:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        }

        .btn-send:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-back {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 0.625rem 1rem;
            border-radius: 0.625rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .btn-back:hover {
            background: var(--border);
            border-color: var(--primary);
            color: var(--primary);
        }

        .chat-info-item {
            padding: 0.875rem;
            margin-bottom: 0.75rem;
            background: var(--bg-secondary);
            border-radius: 0.625rem;
            border: 1px solid var(--border);
        }

        .chat-info-label {
            font-size: 0.8rem;
            color: var(--text-tertiary);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .chat-info-value {
            font-size: 0.95rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.875rem;
            border-radius: 0.625rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
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

        @media (max-width: 1024px) {
            .chat-container {
                flex-direction: column;
                height: auto;
            }

            .chat-sidebar {
                width: 100%;
                max-height: 300px;
            }

            .chat-main {
                min-height: 600px;
            }
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="chat-sidebar">
            <a href="{{ route('chat.index') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Back to Chats</a>
            <h6 class="mt-3 mb-2" style="color: var(--text-primary); font-weight: 700;">Chat Info</h6>
            <div id="chat-info">
                <p style="font-size: 0.9rem; color: var(--text-tertiary); margin: 0;">Loading...</p>
            </div>
        </div>

        <!-- Main Chat -->
        <div class="chat-main">
            <div class="chat-header">
                <div>
                    <h5 id="chat-title" style="margin: 0;"><i class="bi bi-chat-dots"></i> Support Chat</h5>
                    <small id="chat-status" style="opacity: 0.9;">Active now</small>
                </div>
                <div class="button-group">
                    <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
                        <i class="bi bi-moon-fill"></i>
                    </button>
                    <div id="chat-status-badge"></div>
                </div>
            </div>

            <div class="chat-messages" id="messages-container">
                <div style="text-align: center; color: var(--text-tertiary); margin: auto;">
                    <i class="bi bi-hourglass-split" style="font-size: 2.5rem; margin-bottom: 0.75rem;"></i>
                    <p>Loading messages...</p>
                </div>
            </div>

            <div class="chat-input-area">
                <input type="text" placeholder="Type your message..." class="form-control" id="message-input">
                <button class="btn-send" id="send-btn"><i class="bi bi-send"></i> Send</button>
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

        const chatId = {{ $chatId }};
        const messagesContainer = document.getElementById('messages-container');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const chatTitle = document.getElementById('chat-title');
        const chatStatus = document.getElementById('chat-status');
        const chatStatusBadge = document.getElementById('chat-status-badge');
        const chatInfo = document.getElementById('chat-info');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        console.log('CSRF Token:', csrfToken ? 'Found' : 'Not found');

        const fetchWithCSRF = (url, options = {}) => {
            return fetch(url, {
                ...options,
                credentials: 'include',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    ...options.headers,
                }
            });
        };

        let currentUserId = null;
        let messageRefreshInterval = null;
        let lastMessageCount = 0;
        let isRefreshing = false;

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

        // Load chat details
        async function loadChat() {
            try {
                const response = await fetchWithCSRF(`/api/chats/${chatId}`);

                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }

                if (!response.ok) throw new Error('Failed to load chat');

                const chat = await response.json();
                chatTitle.innerHTML = `<i class="bi bi-chat-dots"></i> ${escapeHtml(chat.subject)}`;
                chatStatus.textContent = `Status: ${chat.status}`;
                const statusColor = getStatusColor(chat.status);
                chatStatusBadge.innerHTML = `
                    <span class="status-badge" style="background: ${statusColor}; color: white;">
                        ${chat.status.replace('_', ' ').toUpperCase()}
                    </span>
                `;

                const customerName = chat.customer?.name || 'Customer';
                const agentName = chat.support_agent?.name || 'Not assigned';

                chatInfo.innerHTML = `
                    <div class="chat-info-item">
                        <div class="chat-info-label">Customer</div>
                        <div class="chat-info-value">${escapeHtml(customerName)}</div>
                    </div>
                    <div class="chat-info-item">
                        <div class="chat-info-label">Support Agent</div>
                        <div class="chat-info-value">${escapeHtml(agentName)}</div>
                    </div>
                    <div class="chat-info-item">
                        <div class="chat-info-label">Created</div>
                        <div class="chat-info-value">${new Date(chat.created_at).toLocaleDateString()}</div>
                    </div>
                `;
            } catch (error) {
                console.error('Error loading chat:', error);
                chatInfo.innerHTML = `<p style="color: #ef4444;">Error loading chat details</p>`;
            }
        }

        // Load messages
        async function loadMessages() {
            if (isRefreshing) return;
            isRefreshing = true;

            try {
                const response = await fetchWithCSRF(`/api/chats/${chatId}`);

                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }

                if (!response.ok) throw new Error('Failed to load messages');

                const chat = await response.json();
                const messages = chat.messages || [];

                if (messages.length !== lastMessageCount) {
                    lastMessageCount = messages.length;

                    if (messages.length === 0) {
                        messagesContainer.innerHTML = `
                            <div style="text-align: center; color: var(--text-tertiary); margin: auto;">
                                <i class="bi bi-chat-dots" style="font-size: 2.5rem; margin-bottom: 0.75rem;"></i>
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        `;
                    } else {
                        messagesContainer.innerHTML = messages.map(msg => {
                            const isCurrentUser = msg.user_id === {{ auth()->id() }};
                            const messageClass = isCurrentUser ? 'sent' : 'received';
                            
                            return `
                                <div class="message ${messageClass}">
                                    <div>
                                        ${!isCurrentUser ? `<div class="message-sender">${escapeHtml(msg.user?.name || 'Unknown')}</div>` : ''}
                                        <div class="message-bubble">${escapeHtml(msg.content)}</div>
                                        <div class="message-time">${new Date(msg.created_at).toLocaleTimeString()}</div>
                                    </div>
                                </div>
                            `;
                        }).join('');

                        setTimeout(() => {
                            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        }, 100);
                    }
                }
            } catch (error) {
                console.error('Error loading messages:', error);
                messagesContainer.innerHTML = `<p style="color: #ef4444; padding: 1rem;">Error loading messages</p>`;
            } finally {
                isRefreshing = false;
            }
        }

        // Send message
        async function sendMessage() {
            const content = messageInput.value.trim();
            if (!content) {
                console.log('Empty message, not sending');
                return;
            }

            console.log('Sending message:', content);
            const originalContent = messageInput.value;
            messageInput.value = '';
            messageInput.disabled = true;
            sendBtn.disabled = true;

            try {
                const response = await fetchWithCSRF(`/api/chats/${chatId}/messages`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ content })
                });

                console.log('Response status:', response.status);

                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }

                if (response.ok) {
                    const message = await response.json();
                    console.log('Message sent successfully:', message);
                    await loadMessages();
                } else {
                    const error = await response.json();
                    console.error('Error response:', error);
                    alert('Error sending message: ' + (error.message || 'Unknown error'));
                    messageInput.value = originalContent;
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Error sending message: ' + error.message);
                messageInput.value = originalContent;
            } finally {
                messageInput.disabled = false;
                sendBtn.disabled = false;
                messageInput.focus();
            }
        }

        // Initial load
        async function initialize() {
            console.log('Initializing chat with ID:', chatId);
            await loadChat();
            await loadMessages();

            messageRefreshInterval = setInterval(loadMessages, 5000);
            console.log('Chat initialized successfully');
        }

        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM loaded, attaching event listeners');
            
            if (!messageInput) {
                console.error('Message input not found!');
                return;
            }
            if (!sendBtn) {
                console.error('Send button not found!');
                return;
            }

            sendBtn.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Send button clicked');
                sendMessage();
            });

            messageInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    console.log('Enter key pressed');
                    sendMessage();
                }
            });

            messageInput.focus();
        });

        initialize();

        window.addEventListener('beforeunload', () => {
            if (messageRefreshInterval) clearInterval(messageRefreshInterval);
        });
    </script>
</body>
</html>
