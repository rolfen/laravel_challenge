
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

### Windows

If you are on Windows and `touch` is not available, then you can try the following command instead, to create an emtpy file. Alternatively just create and save an empty `database.sqlite` file using Notepad, for example.

```
type nul > database\database.sqlite
```

## Running api tests

```
php artisan test
```

## Serving

```
php artisan serve --env=testing
```

