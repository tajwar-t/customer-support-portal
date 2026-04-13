# Quick Setup Guide

## Getting Started

### 1. Prerequisites

Ensure you have:

- PHP 8.2+
- Composer
- MySQL 8.0+
- Git

### 2. Generate Application Key

```bash
php artisan key:generate
```

### 3. Configure Database

Edit your `.env` file and set up MySQL connection:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chat_app
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Create Sample Data (Optional)

```bash
php artisan db:seed
```

### 6. Start Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Project Components

### Models

- **User**: Contains roles (customer, support_agent, admin)
- **Chat**: Support chat sessions
- **Message**: Messages within chats
- **Post**: Forum posts
- **Comment**: Comments on forum posts

### Controllers

- **ChatController**: Manages chat operations
- **PostController**: Manages forum posts
- **CommentController**: Manages comments

### Routes

- **API Routes** (`/routes/api.php`): RESTful API endpoints
- **Web Routes** (`/routes/web.php`): Web pages and authentication

### Database

- 5 main tables with proper foreign keys and relationships
- Automatic timestamps for audit trail
- Role-based user system

## Features Implemented

✅ Customer support chat system
✅ Multi-user forum with posts and comments
✅ Role-based access control
✅ User authentication (Laravel Fortify compatible)
✅ RESTful API endpoints
✅ Authorization policies

## Next Steps

1. Configure your database in `.env`
2. Run `php artisan migrate` to create tables
3. Run `php artisan serve` to start development
4. Access the API at `/api/*` endpoints
5. Implement frontend UI (React/Vue could be good options)

## API Documentation

All API endpoints require authentication except for reading posts and comments.

### Public Endpoints

- GET `/api/posts` - List all posts
- GET `/api/posts/{id}` - View specific post
- GET `/api/posts/{postId}/comments` - View post comments

### Authenticated Endpoints

- POST `/api/chats` - Create support chat
- GET `/api/chats` - View user's chats
- POST `/api/posts` - Create forum post
- POST `/api/posts/{postId}/comments` - Add comment

For full API documentation, see the main README.md file.

## Troubleshooting

### Database Connection Issues

- Verify MySQL is running
- Check DB credentials in `.env`
- Ensure database exists: `CREATE DATABASE chat_app;`

### Missing APP_KEY

Run: `php artisan key:generate`

### Permission Issues

Some Laravel directories need write permissions:

- `storage/`
- `bootstrap/cache/`

## Support

For issues or questions, check:

- Laravel Documentation: https://laravel.com/docs
- This project's README.md for detailed info
