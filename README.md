# Laravel Blog with Comment System

## Overview
This is a simple Laravel application for creating blog posts and allowing users to add comments to posts. It features basic authentication, post management (CRUD), and comment functionality.

## Requirements
- PHP >= 8.0
- Composer
- MySQL
- Laravel 11.x

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-repository.git
    cd your-repository
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up the `.env` file:
    Copy the `.env.example` to `.env`:
    ```bash
    cp .env.example .env
    ```

4. Configure your database in the `.env` file:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

5. Generate the application key:
    ```bash
    php artisan key:generate
    ```

6. Run migrations to set up the database:
    ```bash
    php artisan migrate
    ```

7. Serve the application:
    ```bash
    php artisan serve
    ```

    Now, you can access the application at `http://127.0.0.1:8000`.

## Usage

1. **Register & Login:**
   - Visit `/register` to create a new user account.
   - After registration, log in via `/login` with your credentials.

2. **Create & Manage Posts:**
   - Once logged in, you can create new posts, view existing posts, and edit or delete posts.
   - Use the "Create New Post" button on the dashboard or posts index page.

3. **Add Comments to Posts:**
   - Visit any post page and add comments via the "Add a Comment" section.
   - Comments will be visible below the post.

## File Structure
- `app/Models/Post.php` - The Post model with relationships to users and comments.
- `app/Models/Comment.php` - The Comment model, associated with posts and users.
- `app/Http/Controllers/PostController.php` - Handles CRUD operations for posts.
- `app/Http/Controllers/CommentController.php` - Handles storing comments for posts.
- `resources/views/posts/show.blade.php` - The post view where comments are displayed.
- `resources/views/auth/login.blade.php` - The login page.
- `resources/views/auth/register.blade.php` - The registration page.

## Known Issues
- Ensure the MySQL tables `posts`, `comments`, and `users` exist.
- The session table (`sessions`) is required for user authentication. If it's missing, run `php artisan session:table` and migrate again.

## License
This project is for evaluation purposes and is not licensed for production use.