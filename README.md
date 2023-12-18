
# Article manager installation tips

#### Requirements installation

- git clone https://github.com/your-username/your-laravel-project.git
- cd your-laravel-project
- cp .env.example .env
- docker-compose up -d --build
- docker-compose exec php composer install
- docker-compose exec php php artisan key:generate
- docker-compose exec php php artisan migrate
- docker-compose exec php php artisan test

### Requirements Command
- docker-compose exec php php artisan make:admin
- docker-compose exec php php artisan make:user
