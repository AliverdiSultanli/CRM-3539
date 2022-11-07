# Test task

## Tech Stach

**Server:** Apache, also I can use Nginix;

**Programming Language:** PHP 8.0 , Laravel 9;

**Database:** MySQL, also I can use MongoDB;

## Environment configuration 
```javascript
  cp .env.example .env
```
And add your own database name to DB_DATABASE

## Run key generate and clear config's cache and full cache
```javascript
  php artisan key:generate
  php artisan config:cache
  php artisan cache:clear
```
## Run migration
```javascript
  php artisan migrate
```
