# Test task

## Tech Stach

**Server:** Apache, also I can use Nginx;

**Programming Language:** PHP 8.0.2 , Laravel 9.19;

**Database:** MySQL, also I can use MongoDB;

## Composer installation 
```javascript
  composer install
```

## Environment configuration 
```javascript
  cp .env.example .env
```
And add your own database name to DB_DATABASE

## Run key generate, clear config's cache and cache of project
```javascript
  php artisan key:generate
  php artisan config:cache
  php artisan cache:clear
```
## Run migration
```javascript
  php artisan migrate
```
