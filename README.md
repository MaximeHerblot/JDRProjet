# How to initialise my project

Prerequirements

- PHP 7.4
- Composer
- curl
- MySql (or other database type if you dont want to execute my test)

Setup

1) Composer install
2) php bin/console doctrine:database:create
3) php bin/console doctrine:migrations:migrate
4) curl https://localhost:8000/initiation
5) vendor/bin/phpunit tests
