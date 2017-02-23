# Jotistry

[![CircleCI](https://circleci.com/gh/BenOvermyer/jotistry.svg?style=svg)](https://circleci.com/gh/BenOvermyer/jotistry)

Organize and explore your life as it comes. Jotistry helps you keep on track
and discover new truths about your life.

## Current Features

### The Journal

Write about your life as it happens.

### Tasks

Keep tabs on what's on your plate.

### Notes

Remember things easier with Notes.

## Docker development instructions

For development bootstrapping:

> This assumes you have the following installed on your workstation: Docker, PHP 7, Composer

```
docker-compose up -d
composer install
docker exec jotistry_app_1 php artisan key:generate
docker exec jotistry_app_1 php artisan migrate
```
