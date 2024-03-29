## Simple Ticketing App

This is a simple ticketing app where users can manage tickets via a dashboard. Users can perform various actions such as viewing, creating, editing, deleting tickets, as well as viewing and restoring deleted tickets.

## Getting Started
To run the project locally, follow these steps.



- Clone the repository to your local machine: 
  git clone <https://github.com/Heja0007/simple-ticketing-app>
- Install PHP dependencies using Composer: composer install
- Install JavaScript dependencies using npm: npm install
- Rename the .env.example file to .env and configure your database credentials and database name within the .env file.
- Generate an application key: php artisan key:generate
- Migrate the database tables: php artisan migrate
- Seed the database with initial data (users): php artisan db:seed

## Usage
Once the setup is complete, you can run the project using the built-in PHP server:
- php artisan serve
  Access the application in your web browser at http://localhost:8000.

## Features

- Authentication: Users can log in to access the dashboard.
- Ticket Management: Users can view, create, edit, and delete tickets.
- Deleted Ticket Management: Users can view deleted tickets and restore them.