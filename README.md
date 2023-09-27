Laravel To-Do Application with Docker

This repository contains a Laravel-based To-Do application that has been dockerized for easy development and deployment.

Features
User authentication.
Task CRUD (Create, Read, Update, Delete).
Mark tasks as completed or uncompleted.
Dockerized development environment.
Prerequisites
Docker and Docker Compose installed on your machine.
Basic understanding of Laravel and Docker.
Getting Started
Clone the Repository

Copy code
git clone https://github.com/yourusername/to-do-list.git
cd to-do-list
Start the Docker Containers
With Docker installed, you can set up the application environment with:


Copy code
./start.sh
Access the Application
Open your browser and navigate to:

arduino
Copy code
http://localhost:8080
(Note: Adjust the port 8080 if you've mapped Nginx to a different port in docker-compose.yml)

Application Setup
Install Composer dependencies:


Copy code
docker-compose exec laravel_app composer install
Set up environment variables:

Copy .env.example to .env and modify the database and other configurations if necessary.

Generate an app key:


Copy code
docker-compose exec laravel_app php artisan key:generate
Run database migrations:


Copy code
docker-compose exec laravel_app php artisan migrate
Stopping Containers
To stop the Docker containers, you can use:


Copy code
docker-compose down
Development
PHP & Laravel Commands
To run any PHP or artisan commands, you can do so within the app container:


Copy code
docker-compose exec laravel_app php artisan [YOUR COMMAND]
Replace [YOUR COMMAND] with any artisan command you'd like to run.
