
## Installing

```
composer install
```

```
touch database/database.testing.sqlite
php artisan migrate:fresh --env=testing
```

## Testing

```
php artisan test
```