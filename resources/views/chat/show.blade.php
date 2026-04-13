<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Details</title>
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
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            height: 100vh;
            gap: 1rem;
        }
        .chat-sidebar {
            width: 280px;
            background: white;
            border-radius: 0.75rem;
            margin: 1rem 0 1rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            overflow-y: auto;
        }
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
            border-radius: 0.75rem;
            margin: 1rem 1rem 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .chat-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem;
            border-radius: 0.75rem 0.75rem 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chat-header h5 {
            margin: 0;
            font-weight: 700;
            color: white;
        }
        .chat-messages {
            flex: 1;
            padding: 1.5rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
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
            max-width: 60%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            word-wrap: break-word;
        }
        .message.received .message-bubble {
            background: #f1f5f9;
            color: var(--dark);
            border-left: 3px solid var(--primary);
        }
        .message.sent .message-bubble {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .message-time {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 0.25rem;
            text-align: center;
        }
        .chat-input-area {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 1rem;
        }
        .chat-input-area input {
            flex: 1;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-family: 'Inter', sans-serif;
        }
        .chat-input-area input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .btn-send {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        .btn-back {
            background: white;
            border: 1px solid #e2e8f0;
            color: var(--dark);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: #f8fafc;
            border-color: var(--primary);
            color: var(--primary);
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
</head>
<body>
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="chat-sidebar">
            <a href="{{ route('chat.index') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Back to Chats</a>
            <h6 class="mt-3 mb-2" style="color: var(--dark); font-weight: 700;">Chat Info</h6>
            <div id="chat-info">
                <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Loading...</p>
            </div>
        </div>

        <!-- Main Chat -->
        <div class="chat-main">
            <div class="chat-header">
                <div>
                    <h5 id="chat-title" style="margin: 0;"><i class="bi bi-chat-dots"></i> Support Chat</h5>
                    <small id="chat-status" style="opacity: 0.9;">Active now</small>
                </div>
                <div id="chat-status-badge"></div>
            </div>

            <div class="chat-messages" id="messages-container">
                <div style="text-align: center; color: #94a3b8; margin: auto;">
                    <i class="bi bi-hourglass" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
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
        const chatId = {{ $chatId }};
        const messagesContainer = document.getElementById('messages-container');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const chatTitle = document.getElementById('chat-title');
        const chatStatus = document.getElementById('chat-status');
        const chatStatusBadge = document.getElementById('chat-status-badge');
        const chatInfo = document.getElementById('chat-info');

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                         document.querySelector('input[name="_token"]')?.value;

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

        let currentUserId = null;
        let messageRefreshInterval = null;

        // Load chat details
        async function loadChat() {
            try {
                const response = await fetchWithCSRF(`/api/chats/${chatId}`);
                if (!response.ok) throw new Error('Failed to load chat');
                
                const chat = await response.json();
                chatTitle.innerHTML = `<i class="bi bi-chat-dots"></i> ${chat.subject}`;
                chatStatus.textContent = `Status: ${chat.status}`;
                chatStatusBadge.innerHTML = `
                    <span style="display: inline-block; padding: 0.35rem 0.75rem; border-radius: 0.25rem; font-size: 0.85rem; font-weight: 700; background: ${
                        chat.status === 'open' ? '#10b981' : chat.status === 'in_progress' ? '#f59e0b' : '#6b7280'
                    }; color: white;">
                        ${chat.status.toUpperCase()}
                    </span>
                `;

                const customerName = chat.customer?.name || 'Customer';
                const agentName = chat.support_agent?.name || 'Not assigned';
                
                chatInfo.innerHTML = `
                    <p style="font-size: 0.9rem; color: #64748b; margin: 0.5rem 0;">
                        <strong>Customer:</strong><br> ${customerName}
                    </p>
                    <p style="font-size: 0.9rem; color: #64748b; margin: 0.5rem 0;">
                        <strong>Support Agent:</strong><br> ${agentName}
                    </p>
                    <p style="font-size: 0.85rem; color: #94a3b8; margin: 0.5rem 0;">
                        <i class="bi bi-calendar"></i> ${new Date(chat.created_at).toLocaleDateString()}
                    </p>
                `;
            } catch (error) {
                console.error('Error loading chat:', error);
                chatInfo.innerHTML = `<p style="color: #ef4444;">Error loading chat details</p>`;
            }
        }

        // Load messages
        async function loadMessages() {
            try {
                const response = await fetchWithCSRF(`/api/chats/${chatId}`);
                if (!response.ok) throw new Error('Failed to load messages');
                
                const chat = await response.json();
                const messages = chat.messages || [];

                if (messages.length === 0) {
                    messagesContainer.innerHTML = `
                        <div style="text-align: center; color: #94a3b8; margin: auto;">
                            <i class="bi bi-chat-dots" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                            <p>No messages yet. Start the conversation!</p>
                        </div>
                    `;
                } else {
                    messagesContainer.innerHTML = messages.map(msg => `
                        <div class="message ${msg.sender_type === 'customer' || msg.user?.role === 'customer' ? 'received' : 'sent'}">
                            <div>
                                <div class="message-bubble">${escapeHtml(msg.content)}</div>
                                <div class="message-time">${new Date(msg.created_at).toLocaleTimeString()}</div>
                            </div>
                        </div>
                    `).join('');
                    
                    // Scroll to bottom
                    setTimeout(() => {
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    }, 100);
                }
            } catch (error) {
                console.error('Error loading messages:', error);
                messagesContainer.innerHTML = `<p style="color: #ef4444; padding: 1rem;">Error loading messages</p>`;
            }
        }

        // Send message
        async function sendMessage() {
            const content = messageInput.value.trim();
            if (!content) return;

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

                if (response.ok) {
                    await loadMessages();
                } else {
                    const error = await response.json();
                    alert('Error sending message: ' + (error.message || 'Unknown error'));
                    messageInput.value = originalContent;
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Error sending message');
                messageInput.value = originalContent;
            } finally {
                messageInput.disabled = false;
                sendBtn.disabled = false;
                messageInput.focus();
            }
        }

        // Event listeners
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Initial load
        async function initialize() {
            await loadChat();
            await loadMessages();
            
            // Refresh messages every 2 seconds
            messageRefreshInterval = setInterval(loadMessages, 2000);
        }

        initialize();

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (messageRefreshInterval) clearInterval(messageRefreshInterval);
        });
    </script>
</body>
</html>
