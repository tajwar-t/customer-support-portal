<style>
    :root {
        --sidebar-width: 280px;
        --sidebar-collapsed-width: 80px;
        --header-height: 70px;
    }

    .app-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--bg-primary);
        border-right: 1px solid var(--border);
        box-shadow: 2px 0 8px var(--shadow);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1000;
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .sidebar.collapsed .sidebar-brand{
        display: none;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        overflow: hidden;
    }

    .sidebar-brand i {
        font-size: 1.75rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        flex-shrink: 0;
    }

    .brand-text {
        font-weight: 800;
        font-size: 1.25rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        white-space: nowrap;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .brand-text {
        opacity: 0;
        width: 0;
    }

    .sidebar-toggle {
        background: var(--bg-tertiary);
        border: 1px solid var(--border);
        border-radius: 0.625rem;
        width: 2.5rem;
        height: 2.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sidebar-toggle:hover {
        background: var(--border);
    }

    .sidebar-toggle i {
        font-size: 1.25rem;
        color: var(--text-primary);
    }

    .sidebar-nav {
        flex: 1;
        padding: 1rem 0.75rem;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.875rem 1rem;
        border-radius: 0.75rem;
        margin-bottom: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        white-space: nowrap;
        overflow: hidden;
    }

    .sidebar .nav-link i {
        font-size: 1.25rem;
        flex-shrink: 0;
        width: 1.5rem;
        text-align: center;
    }

    .sidebar .nav-link:hover {
        background: var(--bg-tertiary);
        color: var(--primary);
    }

    .sidebar .nav-link.active {
        background: var(--gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .sidebar.collapsed .nav-text {
        opacity: 0;
        width: 0;
    }

    .sidebar-divider {
        border-color: var(--border);
        margin: 1rem 0;
    }

    .sidebar-section-title {
        padding: 0.5rem 1rem;
        color: var(--text-tertiary);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .sidebar.collapsed .sidebar-section-title {
        opacity: 0;
    }

    .sidebar-footer {
        padding: 1rem 0.75rem;
        border-top: 1px solid var(--border);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: var(--bg-secondary);
        border-radius: 0.75rem;
        margin-bottom: 0.75rem;
        overflow: hidden;
    }

    .user-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    /* Role-based avatar colors */
    .user-avatar-admin {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    .user-avatar-support_agent {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }

    .user-avatar-customer {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .user-details {
        flex: 1;
        overflow: hidden;
        white-space: nowrap;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .user-details {
        opacity: 0;
        width: 0;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-primary);
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-role {
        font-size: 0.75rem;
        color: var(--text-tertiary);
        text-transform: capitalize;
    }

    /* Role badge in sidebar */
    .user-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 0.25rem;
        padding: 0.15rem 0.5rem;
        border-radius: 0.375rem;
    }

    .user-role-badge i {
        font-size: 0.4rem;
    }

    .user-role-admin {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .user-role-admin i {
        color: #ef4444;
    }

    .user-role-support_agent {
        background: rgba(99, 102, 241, 0.1);
        color: #6366f1;
    }

    .user-role-support_agent i {
        color: #6366f1;
    }

    .user-role-customer {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .user-role-customer i {
        color: #10b981;
    }

    [data-theme="dark"] .user-role-admin {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }

    [data-theme="dark"] .user-role-admin i {
        color: #f87171;
    }

    [data-theme="dark"] .user-role-support_agent {
        background: rgba(99, 102, 241, 0.2);
        color: #818cf8;
    }

    [data-theme="dark"] .user-role-support_agent i {
        color: #818cf8;
    }

    [data-theme="dark"] .user-role-customer {
        background: rgba(16, 185, 129, 0.2);
        color: #34d399;
    }

    [data-theme="dark"] .user-role-customer i {
        color: #34d399;
    }

    .btn-logout {
        display: flex;
        align-items: center;
        gap: 1rem;
        width: 100%;
        padding: 0.75rem 1rem;
        background: none;
        border: none;
        color: var(--text-secondary);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        white-space: nowrap;
        overflow: hidden;
    }

    .btn-logout:hover {
        background: #fee2e2;
        color: #ef4444;
    }

    .btn-logout i {
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .sidebar.collapsed .btn-logout .nav-text {
        opacity: 0;
        width: 0;
    }

    /* Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: margin-left 0.3s ease;
        min-height: 100vh;
    }

    .sidebar.collapsed ~ .main-content {
        margin-left: var(--sidebar-collapsed-width);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show-mobile {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: var(--sidebar-width);
            transform: translateX(-100%);
        }

        .sidebar-overlay {
            display: block;
        }

        .main-content {
            margin-left: 0 !important;
        }

        .sidebar-toggle {
            display: flex;
        }
    }
</style>
