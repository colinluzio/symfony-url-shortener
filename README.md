# Symfony url shortener
A simple application built on Symfony 2.8 generating shortened urls

## Setup the Project

1. Clone the project to your local machine

2. Install the composer dependencies:

```bash
composer install
```

3. Load up your database

Make sure `app/config/parameters.yml` is correct for your database
credentials. You can give the database any name you desire. Then navigate to project folder and run:

```bash
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
```
4. Start up the built-in PHP web server:

```bash
php app/console server:run
```

Then find the site at http://localhost:8000.
