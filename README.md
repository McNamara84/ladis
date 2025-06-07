# Cleanup Laser Database

## Description

## Features

## Dependencies

## Installation

### Development

#### Setting up the development environment

1. Clone the repository.
2. Run `composer install` to install PHP dependencies.
3. Run `npm install` to install JavaScript dependencies.
4. Copy `.env.example` to `.env` and configure your environment variables.
5. Run `php artisan key:generate` to generate the application key.
6. Run `php artisan migrate` to set up the database.
7. Run `php artisan serve` to start the development server.
8. Access the application at [http://localhost:8000](http://localhost:8000).

#### Commands for database handling

- `php artisan make:migration create_TABLENAME_table` to add a new migration for adding a new table.
- `php artisan migrate:status` to show which migrations have run thus far.
- `php artisan migrate --pretend` to see the SQL statements that will be executed by the migrations without actually running them.
- `php artisan migrate` to run database migrations.
- `php artisan migrate:rollback` to roll back the last migration.
- `php artisan migrate:reset` to reset all migrations.
- `php artisan migrate:fresh` to reset all migrations and newly execute all migrations.

#### Commands for testing

- `php artisan serve` to start test server for manual testing
- `php artisan test` to execute the test suite.

### Production

This web application will be deployed automatically to the production server in VPN of University of Applied Sciences Potsdam using GitHub Actions. We will inform you about the public release later.

## Database

### Main tables

- materials

## Contributing

## Contact
