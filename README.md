![PHP 8.4](https://img.shields.io/badge/php-8.4-blue?logo=php)
![MySQL 8](https://img.shields.io/badge/mysql-8.4-orange?logo=mysql&logoColor=white)
![Laravel 12](https://img.shields.io/badge/laravel-12-red?logo=laravel&style=flat)
![Bootstrap 5.3](https://img.shields.io/badge/bootstrap-5.3-563d7c?logo=bootstrap)
![Test Coverage](https://github.com/McNamara84/cleanup-laser-database/blob/image-data/coverage.svg?raw=true)

# Cleanup Laser Database

<!-- Add project description here -->

We are developing our own information system as part of the P11 laboratory. A specialist laser database is to be created for the “Restoration” department. This will be a contact point for restorers who want to find out about cleaning with a laser device. Among other things, information on the laser device, the material to be treated, the project and the location will be collected. In the first steps, we developed a data model and then tried to integrate existing information. Now the whole thing is to be implemented with code.

## Features

- **Admin Tools:** Enter `php artisan newuser <name> <email> <password>` in server terminal for easy user creation.

## Prerequisites

<!-- List dependencies and system requirements here -->

## Quick Start

Follow these steps to set up the development environment:

1. Clone the repository.
2. Run `composer install` to install PHP dependencies.
3. Run `npm install` to install JavaScript dependencies.
4. Copy `.env.example` to `.env` and configure your environment variables.
5. Run `php artisan key:generate` to generate the application key.
6. Run `php artisan migrate` to set up the database.
7. Run `composer run-script dev` to start the development server.
8. Access the application at [http://localhost:8000](http://localhost:8000).

> [!TIP]
> See [Development Environment Setup](https://github.com/McNamara84/cleanup-laser-database/wiki/Development-Environment-Setup) for detailed instructions.

### Commands for database handling

- `php artisan make:migration create_TABLENAME_table` to add a new migration for adding a new table.
- `php artisan migrate:status` to show which migrations have run thus far.
- `php artisan migrate --pretend` to see the SQL statements that will be executed by the migrations without actually running them.
- `php artisan migrate` to run database migrations.
- `php artisan migrate:rollback` to roll back the last migration.
- `php artisan migrate:reset` to reset all migrations.
- `php artisan migrate:fresh` to reset all migrations and newly execute all migrations.

> [!TIP]
> Detailed information about [migrations](https://github.com/McNamara84/cleanup-laser-database/wiki/Adding-a-new-table-with-a-new-migration) and [adding new models](https://github.com/McNamara84/cleanup-laser-database/wiki/Adding-new-models) can be found in the [Wiki](https://github.com/McNamara84/cleanup-laser-database/wiki).

### Commands for testing

- `php artisan serve` to start test server for manual testing
- `php artisan test` to execute the test suite.

## Production Deployment

This web application will be deployed automatically to the production server in the VPN of University of Applied Sciences Potsdam using GitHub Actions. We will inform you about the public release later.

## Database Schema

<!-- Introduction text for the db schema here -->

- `federal_states`
- `cities`
- `artifacts`
- `images`
- `institutions`
- `lenses`
- `locations`
- `devices`
- `materials`
- `venues`
- `conditions`
- `damage_patterns`

## Contributing

<!-- Summarized conributing guidelines here -->

## Contact

<!-- Add contact information -->

## License

<!-- Pick a license and explain and link it here -->
