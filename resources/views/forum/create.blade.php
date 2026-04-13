<!DOCTYPE html>
<html>
<head>
    <title>Create Forum Post</title>
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
        .create-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .create-header {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .create-header h1 {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
        }
        .btn-back {
            background: white;
            border: 1px solid #e2e8f0;
            color: var(--dark);
            padding: 0.65rem 1.25rem;
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
        .form-card {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: slideIn 0.5s ease-out;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            color: var(--dark);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        textarea.form-control {
            resize: vertical;
            min-height: 250px;
        }
        .form-helper {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }
        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
            color: white;
        }
        .btn-cancel {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: var(--dark);
        }
        .btn-cancel:hover {
            background: #e2e8f0;
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
    <div class="create-container">
        <div class="create-header">
            <h1><i class="bi bi-plus-circle"></i> Create New Post</h1>
            <a href="{{ route('forum.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Forum
            </a>
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
                        <option value="">Select a category</option>
                        <option value="general">General Discussion</option>
                        <option value="support">Support Issues</option>
                        <option value="features">Feature Requests</option>
                        <option value="announcements">Announcements</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Post Content</label>
                    <textarea class="form-control" name="content" placeholder="Share your thoughts, questions, or insights..." required></textarea>
                    <p class="form-helper">Markdown formatting is supported</p>
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
