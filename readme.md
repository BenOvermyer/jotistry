# Kettle Personal Dashboard

A dashboard for a variety of random things. Not intended for anyone's use but my own, but go ahead if you feel like it.

Note: you'll need to make sure that GITHUB_TOKEN is filled out, since at present the GitHub integration is mandatory.

## Docker development instructions

For development bootstrapping:

> This assumes you have the following installed on your workstation: Docker, PHP 7, Composer

```
docker-compose up -d
composer install
docker exec kettledashboard_app_1 php artisan key:generate
docker exec kettledashboard_app_1 php artisan migrate
```
