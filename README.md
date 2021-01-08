# How to initialise my project

Prerequirements

- PHP 7.4
- Composer
- curl
- MySql (or other database type if you dont want to execute my test)

Pre-setup

Change the .env *database_url* variable to setup it right (MySql)

Start your database 

Setup

1) Composer install
2) php bin/console doctrine:database:create
3) php bin/console doctrine:migrations:migrate
4) symfony serve
5) php src/service/initiationApp.php

*Here is for running the test 

6) ./vendor/bin/phpunit tests
