# Laravel Customer Support Chat + Posts Forum

A comprehensive Laravel-based application featuring a real-time customer support chat system and a community posts/forum system with authentication and authorization.

## Features

### 1. Customer Support Chat System

- **Real-time Messaging**: Customers can initiate support chats with detailed descriptions
- **Chat Management**: Support agents can manage, assign, and close chats
- **Message Tracking**: All messages are tracked with sender type, read status, and timestamps
- **Chat Status**: Track chat status (open, in_progress, closed)

### 2. Posts/Forum System

- **Create & Manage Posts**: Users can create, edit, and delete forum posts
- **Categories**: Organize posts by categories
- **Featured Posts**: Mark important posts as featured
- **Comments**: Community engagement through post comments
- **View Tracking**: Track post views
- **Search**: Search functionality for posts

### 3. User Management

- **Role-Based Access Control**: Support for multiple user roles (customer, support_agent, admin)
- **Authentication**: Built-in Laravel authentication with Sanctum for API tokens
- **Authorization**: Policies for controlling access to resources

## Project Structure

```
chat-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ChatController.php
│   │       ├── CommentController.php
│   │       └── PostController.php
│   ├── Models/
│   │   ├── Chat.php
│   │   ├── Comment.php
│   │   ├── Message.php
│   │   ├── Post.php
│   │   └── User.php
│   └── Policies/
│       ├── ChatPolicy.php
│       ├── CommentPolicy.php
│       └── PostPolicy.php
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── routes/
│   ├── api.php (API routes)
│   └── web.php (Web routes)
├── resources/
└── config/
```

## Database Schema

### Users Table

- id
- name
- email
- password
- role (customer, support_agent, admin)
- email_verified_at
- timestamps

### Chats Table

- id
- customer_id (FK to users)
- support_agent_id (FK to users, nullable)
- status (open, in_progress, closed)
- subject
- description
- timestamps

### Messages Table

- id
- chat_id (FK to chats)
- user_id (FK to users)
- content
- sender_type (customer, support)
- is_read
- timestamps

### Posts Table

- id
- user_id (FK to users)
- title
- slug (unique)
- content
- category
- is_featured
- views_count
- timestamps

### Comments Table

- id
- post_id (FK to posts)
- user_id (FK to users)
- content
- is_approved
- timestamps

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0+
- Laravel 13

### Setup Steps

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd chat-app
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Copy environment file**

    ```bash
    cp .env.example .env
    ```

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Configure database**
   Edit `.env` and set your database connection:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=chat_app
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Run migrations**

    ```bash
    php artisan migrate
    ```

7. **Seed database (optional)**

    ```bash
    php artisan db:seed
    ```

8. **Start the development server**
    ```bash
    php artisan serve
    ```

The application will be available at `http://localhost:8000`

## API Endpoints

### Chat Endpoints

- `GET /api/chats` - Get all chats for authenticated user
- `POST /api/chats` - Create new chat
- `GET /api/chats/{id}` - Get specific chat with messages
- `PUT /api/chats/{id}` - Update chat
- `PUT /api/chats/{id}/close` - Close chat
- `POST /api/chats/{id}/messages` - Send message in chat
- `GET /api/chats/{id}/messages` - Get messages for chat

### Forum Endpoints

- `GET /api/posts` - Get all posts (paginated)
- `GET /api/posts/featured` - Get featured posts
- `GET /api/posts/category/{category}` - Get posts by category
- `GET /api/posts/{id}` - Get specific post
- `POST /api/posts` - Create post (requires auth)
- `PUT /api/posts/{id}` - Update post (requires auth)
- `DELETE /api/posts/{id}` - Delete post (requires auth)

### Comment Endpoints

- `GET /api/posts/{postId}/comments` - Get comments for post
- `POST /api/posts/{postId}/comments` - Add comment to post (requires auth)
- `PUT /api/comments/{id}` - Update comment (requires auth)
- `DELETE /api/comments/{id}` - Delete comment (requires auth)

## User Roles

### Customer

- Can initiate support chats
- Can create and manage own forum posts
- Can comment on forum posts
- Can view all posts and chats

### Support Agent

- Can view and respond to assigned chats
- Can manage chat assignments
- Can view all customer chats
- Can create forum posts

### Admin

- Full access to all features
- Can manage users and their roles
- Can approve/disapprove comments
- Can feature/unfeature posts
- Can close any chat

## Testing

Run tests with:

```bash
php artisan test
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
