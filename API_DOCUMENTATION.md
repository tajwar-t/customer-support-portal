# API Documentation

## Base URL

```
http://localhost:8000/api
```

## Authentication

Most endpoints require Bearer token authentication via Laravel Sanctum.

### Get Auth Token

```bash
POST /login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}

Response:
{
  "token": "your-api-token"
}
```

### Using Token in Requests

```bash
Authorization: Bearer your-api-token
```

## Chat Endpoints

### Create a Chat

```bash
POST /chats
Authorization: Bearer {token}
Content-Type: application/json

{
  "subject": "Help with billing",
  "description": "I have questions about my recent invoice"
}

Response (201):
{
  "id": 1,
  "customer_id": 1,
  "support_agent_id": null,
  "status": "open",
  "subject": "Help with billing",
  "description": "I have questions about my recent invoice",
  "created_at": "2024-04-13T10:30:00Z"
}
```

### Get All Chats

```bash
GET /chats
Authorization: Bearer {token}

Response (200):
{
  "data": [
    {
      "id": 1,
      "customer_id": 1,
      "support_agent_id": null,
      "status": "open",
      "subject": "Help with billing",
      ...
    }
  ]
}
```

### Get Specific Chat

```bash
GET /chats/{id}
Authorization: Bearer {token}

Response (200):
{
  "id": 1,
  "customer_id": 1,
  "support_agent_id": null,
  "status": "open",
  "subject": "Help with billing",
  "description": "I have questions about my recent invoice",
  "messages": [
    {
      "id": 1,
      "chat_id": 1,
      "user_id": 1,
      "content": "Hello, I need help",
      "sender_type": "customer",
      "is_read": true,
      "created_at": "2024-04-13T10:30:00Z"
    }
  ]
}
```

### Send Message

```bash
POST /chats/{id}/messages
Authorization: Bearer {token}
Content-Type: application/json

{
  "content": "Thank you for your help!"
}

Response (201):
{
  "id": 2,
  "chat_id": 1,
  "user_id": 1,
  "content": "Thank you for your help!",
  "sender_type": "customer",
  "is_read": false,
  "created_at": "2024-04-13T10:35:00Z"
}
```

### Update Chat (Admin/Support Agent)

```bash
PUT /chats/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "status": "in_progress",
  "support_agent_id": 2
}

Response (200):
{
  "id": 1,
  "customer_id": 1,
  "support_agent_id": 2,
  "status": "in_progress",
  ...
}
```

### Close Chat

```bash
PUT /chats/{id}/close
Authorization: Bearer {token}

Response (200):
{
  "id": 1,
  "customer_id": 1,
  "support_agent_id": 2,
  "status": "closed",
  ...
}
```

## Forum Endpoints

### Get All Posts

```bash
GET /posts?page=1&search=query&category=general

Response (200):
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "title": "How to reset password?",
      "slug": "how-to-reset-password-1681395600",
      "content": "I forgot my password and need help resetting it.",
      "category": "general",
      "is_featured": false,
      "views_count": 125,
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
      },
      "created_at": "2024-04-13T10:00:00Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "total": 50,
    "per_page": 15
  }
}
```

### Get Featured Posts

```bash
GET /posts/featured

Response (200):
{
  "data": [...]
}
```

### Get Posts by Category

```bash
GET /posts/category/{category}

Response (200):
{
  "data": [...]
}
```

### Get Specific Post

```bash
GET /posts/{id}

Response (200):
{
  "id": 1,
  "user_id": 1,
  "title": "How to reset password?",
  "slug": "how-to-reset-password-1681395600",
  "content": "I forgot my password and need help resetting it.",
  "category": "general",
  "is_featured": false,
  "views_count": 126,
  "user": {
    "id": 1,
    "name": "John Doe"
  },
  "comments": [
    {
      "id": 1,
      "post_id": 1,
      "user_id": 2,
      "content": "Click on 'Forgot Password' on the login page.",
      "is_approved": true,
      "user": {
        "id": 2,
        "name": "Jane Smith"
      },
      "created_at": "2024-04-13T10:05:00Z"
    }
  ],
  "created_at": "2024-04-13T10:00:00Z"
}
```

### Create Post

```bash
POST /posts
Authorization: Bearer {token}
Content-Type: application/json

{
  "title": "How to change email?",
  "content": "I want to change the email associated with my account",
  "category": "account"
}

Response (201):
{
  "id": 2,
  "user_id": 1,
  "title": "How to change email?",
  "slug": "how-to-change-email-1681395700",
  "content": "I want to change the email associated with my account",
  "category": "account",
  "is_featured": false,
  "views_count": 0,
  "created_at": "2024-04-13T10:10:00Z"
}
```

### Update Post

```bash
PUT /posts/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "title": "Updated title",
  "content": "Updated content",
  "category": "account",
  "is_featured": true
}

Response (200):
{
  "id": 1,
  "user_id": 1,
  "title": "Updated title",
  ...
}
```

### Delete Post

```bash
DELETE /posts/{id}
Authorization: Bearer {token}

Response (200):
{
  "message": "Post deleted successfully"
}
```

## Comment Endpoints

### Get Comments for Post

```bash
GET /posts/{postId}/comments

Response (200):
{
  "data": [
    {
      "id": 1,
      "post_id": 1,
      "user_id": 2,
      "content": "Great post!",
      "is_approved": true,
      "user": {
        "id": 2,
        "name": "Jane Smith"
      },
      "created_at": "2024-04-13T10:05:00Z"
    }
  ]
}
```

### Add Comment

```bash
POST /posts/{postId}/comments
Authorization: Bearer {token}
Content-Type: application/json

{
  "content": "This helped me so much! Thanks!"
}

Response (201):
{
  "id": 2,
  "post_id": 1,
  "user_id": 1,
  "content": "This helped me so much! Thanks!",
  "is_approved": true,
  "user": {
    "id": 1,
    "name": "John Doe"
  },
  "created_at": "2024-04-13T10:15:00Z"
}
```

### Update Comment

```bash
PUT /comments/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "content": "Updated comment text"
}

Response (200):
{
  "id": 1,
  ...
}
```

### Delete Comment

```bash
DELETE /comments/{id}
Authorization: Bearer {token}

Response (200):
{
  "message": "Comment deleted successfully"
}
```

## Error Responses

### 401 Unauthorized

```json
{
    "message": "Unauthenticated."
}
```

### 403 Forbidden

```json
{
    "message": "This action is unauthorized."
}
```

### 404 Not Found

```json
{
    "message": "Resource not found"
}
```

### 422 Validation Error

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "title": ["The title field is required."]
    }
}
```

## Status Codes

- `200 OK` - Successful GET, PUT requests
- `201 Created` - Successful POST request
- `204 No Content` - Successful DELETE request
- `400 Bad Request` - Invalid request format
- `401 Unauthorized` - Authentication required
- `403 Forbidden` - Access denied
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation error
- `500 Internal Server Error` - Server error
