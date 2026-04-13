<!DOCTYPE html>
<html>
<head>
    <title>Forum Post</title>
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
        .post-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .post-header {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .post-header h1 {
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
        .post-content-main {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: slideIn 0.5s ease-out;
        }
        .post-meta-info {
            display: flex;
            gap: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #64748b;
        }
        .post-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .post-title {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0 0 1rem 0;
        }
        .post-body {
            color: #475569;
            line-height: 1.75;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .comments-section {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: slideIn 0.5s ease-out 0.1s both;
        }
        .comments-title {
            color: var(--dark);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .comment {
            padding: 1rem;
            border-left: 3px solid var(--primary);
            background: #f8fafc;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .comment-author {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }
        .comment-time {
            font-size: 0.85rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }
        .comment-body {
            color: #475569;
            line-height: 1.6;
        }
        .empty-comments {
            text-align: center;
            padding: 2rem;
            color: #94a3b8;
        }
        .comment-form {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
        }
        .comment-form textarea {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-family: 'Inter', sans-serif;
            margin-bottom: 1rem;
            width: 100%;
        }
        .comment-form textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.65rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
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
    <div class="post-container">
        <div class="post-header">
            <h1><i class="bi bi-chat-left-text"></i> Forum Post</h1>
            <a href="{{ route('forum.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Forum
            </a>
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
                <i class="bi bi-chat-left-dots" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                <p>No comments yet. Be the first to share your thoughts!</p>
            </div>

            <div class="comment-form">
                <textarea rows="4" placeholder="Share your thoughts on this post..."></textarea>
                <button class="btn-submit"><i class="bi bi-send"></i> Post Comment</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
