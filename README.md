
These are instruction for a quick trial on a local, private machine. It uses the testing environment an sqlite database and is served using the embedded development server.


## Installing

First clone this repository and `cd` into it.

```
composer install
```

```
touch database/database.sqlite
php artisan key:generate --env=testing
php artisan migrate:fresh --env=testing
php artisan db:seed --env=testing
```

## Running api tests

```
php artisan test
```

## Serving

```
php artisan serve --env=testing
```

