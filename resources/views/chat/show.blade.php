@extends('layouts.app')

@section('title', 'Chat Details - ' . config('app.name'))

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
        /* Role-based colors */
        --admin-color: #ef4444;
        --admin-dark: #dc2626;
        --admin-light: rgba(239, 68, 68, 0.1);
        --agent-color: #6366f1;
        --agent-dark: #4f46e5;
        --agent-light: rgba(99, 102, 241, 0.1);
        --customer-color: #10b981;
        --customer-dark: #059669;
        --customer-light: rgba(16, 185, 129, 0.1);
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
        /* Role-based colors for dark mode */
        --admin-color: #f87171;
        --admin-dark: #ef4444;
        --admin-light: rgba(248, 113, 113, 0.2);
        --agent-color: #818cf8;
        --agent-dark: #6366f1;
        --agent-light: rgba(129, 140, 248, 0.2);
        --customer-color: #34d399;
        --customer-dark: #10b981;
        --customer-light: rgba(52, 211, 153, 0.2);
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
        display: flex;
        max-width: 1400px;
        margin: 0 auto;
        height: calc(100vh - 2rem);
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
        flex-shrink: 0;
    }

    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: 0 4px 6px var(--shadow);
        border: 1px solid var(--border);
        min-width: 0;
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
        min-width: 0;
    }

    .chat-input-area input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
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
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-send:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
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
        width: 100%;
        justify-content: center;
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

    .status-select {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 0.625rem;
        padding: 0.5rem 0.75rem;
        color: var(--text-primary);
        font-weight: 600;
        width: 100%;
        margin-top: 0.5rem;
        cursor: pointer;
    }

    .status-select:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .agent-assign-section,
    .review-section {
        margin-top: 1rem;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 0.625rem;
        border: 1px solid var(--border);
    }

    .star-rating {
        display: flex;
        gap: 0.25rem;
        margin-bottom: 0.5rem;
    }

    .star-rating i {
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--text-tertiary);
        transition: color 0.2s;
    }

    .star-rating i.active {
        color: #fbbf24;
    }

    .star-rating i:hover {
        color: #fbbf24;
    }

    .pending-badge {
        display: inline-block;
        padding: 0.25rem 0.625rem;
        border-radius: 0.5rem;
        font-size: 0.7rem;
        font-weight: 700;
        background: #fbbf24;
        color: #000;
        margin-top: 0.5rem;
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
@endpush

@section('content')
<div class="chat-container">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <a href="{{ route('chat.index') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Back to Chats</a>
        <h6 class="mt-3 mb-2" style="color: var(--text-primary); font-weight: 700;">Chat Info</h6>
        <div id="chat-info">
            <p style="font-size: 0.9rem; color: var(--text-tertiary); margin: 0;">Loading...</p>
        </div>
        
        <!-- Status Management (for agents) -->
        <div id="status-management" style="display: none;">
            <h6 class="mt-3 mb-2" style="color: var(--text-primary); font-weight: 700;">Manage Status</h6>
            <select id="status-select" class="status-select" style="display: none;">
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="closed">Closed</option>
            </select>
            <div id="pending-approval-badge" style="display: none;">
                <span class="pending-badge"><i class="bi bi-clock"></i> Awaiting Admin Approval</span>
            </div>
        </div>

        <!-- Agent Assignment (for admin) -->
        <div id="agent-assignment" style="display: none;">
            <div class="agent-assign-section">
                <h6 style="color: var(--text-primary); font-weight: 700; margin-bottom: 0.5rem;">Assign Agent</h6>
                <select id="agent-select" class="status-select">
                    <option value="">Select Agent...</option>
                </select>
            </div>
        </div>

        <!-- Status Approval (for admin) -->
        <div id="status-approval" style="display: none;">
            <div class="agent-assign-section">
                <h6 style="color: var(--text-primary); font-weight: 700; margin-bottom: 0.5rem;">Approve Status Change</h6>
                <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Agent requested status change. Click to approve.</p>
                <button id="approve-status-btn" class="btn-back" style="background: var(--gradient); color: white; border: none; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);">
                    <i class="bi bi-check-circle"></i> Approve Status Change
                </button>
            </div>
        </div>

        <!-- Review Section (for customers) -->
        <div id="review-section" style="display: none;">
            <div class="review-section">
                <h6 style="color: var(--text-primary); font-weight: 700; margin-bottom: 0.5rem;">Leave a Review</h6>
                <div class="star-rating" id="star-rating">
                    <i class="bi bi-star" data-rating="1"></i>
                    <i class="bi bi-star" data-rating="2"></i>
                    <i class="bi bi-star" data-rating="3"></i>
                    <i class="bi bi-star" data-rating="4"></i>
                    <i class="bi bi-star" data-rating="5"></i>
                </div>
                <textarea id="review-comment" class="status-select" rows="3" placeholder="Share your experience (optional)..." style="resize: vertical; min-height: 80px;"></textarea>
                <button id="submit-review" class="btn-back" style="margin-top: 0.5rem;">
                    <i class="bi bi-send"></i> Submit Review
                </button>
            </div>
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
@endsection

@push('scripts')
<script>
    const chatId = {{ $chatId }};
    const currentUserRole = '{{ auth()->user()->role }}';
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
    let selectedRating = 0;
    let agents = [];

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
        return colors[status] || '#0ea5e9';
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
            chatStatus.textContent = `Status: ${chat.status.replace('_', ' ')}`;
            const statusColor = getStatusColor(chat.status);
            chatStatusBadge.innerHTML = `
                <span class="status-badge" style="background: ${statusColor}; color: white;">
                    ${chat.status.replace('_', ' ').toUpperCase()}
                </span>
            `;
            
            if (chat.requires_admin_approval) {
                chatStatusBadge.innerHTML += `<br><span class="pending-badge"><i class="bi bi-clock"></i> Pending Approval</span>`;
            }

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

            // Show/hide role-based UI elements
            setupRoleBasedUI(chat);
        } catch (error) {
            console.error('Error loading chat:', error);
            chatInfo.innerHTML = `<p style="color: #ef4444;">Error loading chat details</p>`;
        }
    }

    function setupRoleBasedUI(chat) {
        const statusManagement = document.getElementById('status-management');
        const agentAssignment = document.getElementById('agent-assignment');
        const statusApproval = document.getElementById('status-approval');
        const reviewSection = document.getElementById('review-section');
        const statusSelect = document.getElementById('status-select');
        const pendingBadge = document.getElementById('pending-approval-badge');

        console.log('Current user role:', currentUserRole);

        // Hide all by default
        statusManagement.style.display = 'none';
        agentAssignment.style.display = 'none';
        statusApproval.style.display = 'none';
        reviewSection.style.display = 'none';

        if (currentUserRole === 'support_agent') {
            // Agents can change status
            statusManagement.style.display = 'block';
            statusSelect.style.display = 'block';
            statusSelect.value = chat.status;

            if (chat.requires_admin_approval) {
                pendingBadge.style.display = 'block';
            } else {
                pendingBadge.style.display = 'none';
            }

            statusSelect.addEventListener('change', async (e) => {
                await updateStatus(chat.id, e.target.value);
            });
        } else if (currentUserRole === 'admin') {
            // Admin can assign agents and approve status changes
            console.log('Admin detected - showing agent assignment');
            agentAssignment.style.display = 'block';
            loadAgents(chat);

            // Show approval button if there's a pending status change
            if (chat.requires_admin_approval && chat.pending_status) {
                statusApproval.style.display = 'block';
                const approveBtn = document.getElementById('approve-status-btn');
                approveBtn.innerHTML = `<i class="bi bi-check-circle"></i> Approve: ${chat.pending_status.replace('_', ' ').toUpperCase()}`;
                approveBtn.onclick = async () => {
                    await approveStatusAction(chat.id);
                };
            }
        } else if (currentUserRole === 'customer' && chat.status === 'closed') {
            // Customers can review closed chats
            const existingReview = chat.review;
            if (!existingReview) {
                reviewSection.style.display = 'block';
                setupStarRating();
            }
        }
    }

    // Load agents list
    async function loadAgents(chat) {
        try {
            const response = await fetchWithCSRF('/api/admin/agents');
            if (response.ok) {
                agents = await response.json();
                const agentSelect = document.getElementById('agent-select');
                agentSelect.innerHTML = '<option value="">Select Agent...</option>';
                
                agents.forEach(agent => {
                    const option = document.createElement('option');
                    option.value = agent.id;
                    option.textContent = `${agent.name} (${agent.active_chats_count || 0} active chats, ★ ${agent.avg_rating || 'N/A'})`;
                    if (chat.support_agent_id === agent.id) {
                        option.selected = true;
                    }
                    agentSelect.appendChild(option);
                });

                // Remove old event listener by cloning
                const newAgentSelect = agentSelect.cloneNode(true);
                agentSelect.parentNode.replaceChild(newAgentSelect, agentSelect);
                
                newAgentSelect.addEventListener('change', async (e) => {
                    if (e.target.value) {
                        await assignAgent(chat.id, e.target.value);
                    }
                });
            }
        } catch (error) {
            console.error('Error loading agents:', error);
        }
    }

    // Update chat status
    async function updateStatus(chatId, status) {
        try {
            const response = await fetchWithCSRF(`/api/chats/${chatId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ status })
            });

            if (response.ok) {
                const chat = await response.json();
                if (chat.requires_admin_approval) {
                    alert('Status change submitted. Awaiting admin approval.');
                    document.getElementById('pending-approval-badge').style.display = 'block';
                } else {
                    chatStatus.textContent = `Status: ${chat.status.replace('_', ' ')}`;
                    const statusColor = getStatusColor(chat.status);
                    chatStatusBadge.innerHTML = `
                        <span class="status-badge" style="background: ${statusColor}; color: white;">
                            ${chat.status.replace('_', ' ').toUpperCase()}
                        </span>
                    `;
                }
            } else {
                alert('Failed to update status');
            }
        } catch (error) {
            console.error('Error updating status:', error);
            alert('Error updating status');
        }
    }

    // Assign agent to chat
    async function assignAgent(chatId, agentId) {
        try {
            const response = await fetchWithCSRF(`/api/chats/${chatId}/assign-agent`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ support_agent_id: agentId })
            });

            if (response.ok) {
                await loadChat();
            } else {
                alert('Failed to assign agent');
            }
        } catch (error) {
            console.error('Error assigning agent:', error);
            alert('Error assigning agent');
        }
    }

    // Approve status change
    async function approveStatusAction(chatId) {
        try {
            const response = await fetchWithCSRF(`/api/chats/${chatId}/approve-status`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            });

            if (response.ok) {
                alert('Status change approved!');
                await loadChat();
            } else {
                const error = await response.json();
                alert('Error: ' + (error.message || 'Failed to approve status'));
            }
        } catch (error) {
            console.error('Error approving status:', error);
            alert('Error approving status');
        }
    }

    // Setup star rating
    function setupStarRating() {
        const stars = document.querySelectorAll('#star-rating i');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                selectedRating = parseInt(star.dataset.rating);
                updateStars(selectedRating);
            });

            star.addEventListener('mouseenter', () => {
                updateStars(parseInt(star.dataset.rating));
            });
        });

        document.getElementById('star-rating').addEventListener('mouseleave', () => {
            updateStars(selectedRating);
        });

        document.getElementById('submit-review').addEventListener('click', submitReview);
    }

    // Update star display
    function updateStars(rating) {
        const stars = document.querySelectorAll('#star-rating i');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
                star.classList.remove('bi-star');
                star.classList.add('bi-star-fill');
            } else {
                star.classList.remove('active');
                star.classList.remove('bi-star-fill');
                star.classList.add('bi-star');
            }
        });
    }

    // Submit review
    async function submitReview() {
        if (selectedRating === 0) {
            alert('Please select a rating');
            return;
        }

        const comment = document.getElementById('review-comment').value;
        const submitBtn = document.getElementById('submit-review');
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting...';

        try {
            const response = await fetchWithCSRF(`/api/chats/${chatId}/review`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    rating: selectedRating,
                    comment: comment || null
                })
            });

            if (response.ok) {
                alert('Review submitted successfully!');
                document.getElementById('review-section').style.display = 'none';
            } else {
                const error = await response.json();
                alert('Error: ' + (error.message || 'Failed to submit review'));
            }
        } catch (error) {
            console.error('Error submitting review:', error);
            alert('Error submitting review');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-send"></i> Submit Review';
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
@endpush
