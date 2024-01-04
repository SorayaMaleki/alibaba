# Article manager installation tips

## Table of Contents

- [Getting Started](#getting-started)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Code Style and Patterns](#code-style-and-patterns)
- [Testing](#testing)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes.

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/SorayaMaleki/alibaba.git
    ```

2. Navigate into the project directory:

    ```bash
    cd alibaba
    ```

3. Create a copy of the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```


6. Set up your database configuration in the `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
4. build docker:

    ```bash
    docker-compose up -d --build
    ```
   
5. Generate the application key:

    ```bash
    docker-compose exec php php artisan key:generate
    ```
7. Run the database migrations:

    ```bash
    docker-compose exec php php artisan migrate
    ```
8. To make admin user run this command:

    ```bash
    docker-compose exec php php artisan make:admin
    ```

8. To make user run this command:

    ```bash
    docker-compose exec php php artisan make:user
    ```

### Code Style and Patterns

- **PSR-12 for Code Style**: This project follows the PSR-12 (PHP Standard Recommendation) for code style, ensuring a
  consistent and readable codebase.


- **PSR-5 for DocBlocks**: PSR-5 is used for DocBlocks in this project, providing standardized documentation comments
  for classes, methods, and properties.


- **Observer Pattern**: The project utilizes the Observer pattern for handling events and state changes.


- **Repository Pattern**: The project utilizes the Repository pattern for data access.
-

- **Service Pattern**: The project utilizes the Service pattern for business logic implementation. This promotes
  separation of concerns and maintainability.

...

### Testing

I have added test cases for this task, for run tests
```bash
docker-compose exec php php artisan test
```
