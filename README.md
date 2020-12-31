# How to initialise my project

Prerequirements

- PHP 7.4
- Composer
- curl

Setup

1) Composer install
2) php bin/console doctrine:database:create
3) php bin/console doctrine:migrations:migrate
4) curl https://localhost:8000/initiation
