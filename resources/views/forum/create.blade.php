<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <title>Create Forum Post</title>
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

        .create-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .create-header {
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

        .create-header h1 {
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

        .form-card {
            background: var(--bg-primary);
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 4px 6px var(--shadow);
            border: 1px solid var(--border);
            animation: slideIn 0.5s ease-out;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--text-primary);
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            background: var(--bg-primary);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 280px;
            line-height: 1.6;
        }

        .form-helper {
            color: var(--text-tertiary);
            font-size: 0.85rem;
            margin-top: 0.4rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.75rem;
            border-top: 1px solid var(--border);
        }

        .btn {
            border-radius: 0.75rem;
            font-weight: 600;
            padding: 0.875rem 1.75rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-submit {
            background: var(--gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
            color: white;
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-cancel {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            color: var(--text-primary);
        }

        .btn-cancel:hover {
            background: var(--border);
            transform: translateY(-2px);
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
            .create-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="create-container">
        <div class="create-header">
            <h1><i class="bi bi-plus-circle"></i> Create New Post</h1>
            <div class="button-group">
                <button class="theme-toggle" id="theme-toggle" title="Toggle theme">
                    <i class="bi bi-moon-fill"></i>
                </button>
                <a href="{{ route('forum.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Back to Forum
                </a>
            </div>
        </div>

        <div class="form-card">
            <form id="create-post-form">
                <div class="form-group">
                    <label class="form-label">Post Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter an engaging title for your post" required>
                    <p class="form-helper">Make your title clear and concise</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control" name="category">
                        <option value="general">General Discussion</option>
                        <option value="support">Support Issues</option>
                        <option value="features">Feature Requests</option>
                        <option value="announcements">Announcements</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Post Content</label>
                    <textarea class="form-control" name="content" placeholder="Share your thoughts, questions, or insights..." required></textarea>
                    <p class="form-helper">Write detailed content for better engagement</p>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle"></i> Publish Post
                    </button>
                    <a href="{{ route('forum.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
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

        const form = document.getElementById('create-post-form');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const data = {
                title: formData.get('title'),
                category: formData.get('category') || 'general',
                content: formData.get('content')
            };

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Publishing...';

            try {
                const response = await fetch('/api/posts', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    const post = await response.json();
                    window.location.href = `/forum/${post.slug}`;
                } else {
                    const error = await response.json();
                    alert('Error creating post: ' + (error.message || 'Validation failed'));
                    console.error('Error:', error);
                }
            } catch (error) {
                console.error('Error creating post:', error);
                alert('Error creating post');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    </script>
</body>
</html>
