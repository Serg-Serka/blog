This is a test task. The main purpose is to allow users share posts and comment them.

To install the project, follow these steps:
1. ``git clone https://github.com/Serg-Serka/blog.git``
2. ``cd blog/``
3. ``composer install``
4. ``npm install``
5. ``cp .env.example .env``
6. ``php artisan key:generate``
7. Create empty database
8. Fill ``.env`` file to make a bound with application and created database. You should set ``DB_DATABASE``, ``DB_USERNAME`` and ``DB_PASSWORD``.
9. ``php artisan migrate``
10. ``php artisan db:seed``
11. ``php artisan serve``
12. ``npm run dev``
13. Go to ``http://localhost:8000/blog`` and see all posts!

Also, there is an admin user with email ``serg@ser.com`` and password ``password``, so you can authorize with these credentials and see all the functionality.
