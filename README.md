# sade

Sade is an administrative app made for a university project. this app will help manage athletes and their information.

## Installation
Clone the repo 

install project dependencies

```bash
composer install
```

## Edit enviroment virables

Rename .env.example to .env and edit enviroment variables.
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=example
DB_USERNAME=root
DB_PASSWORD=
```

## Generate app key
```php
php artisan key:generate
```

## Run migrations
```php
php artisan migrate:fresh --seed
```

## Run server
```php
php artisan serve
```

## Default User
email: admin@example.com

password: admin

## Open in Browser
localhost:8000

## License
[MIT](https://choosealicense.com/licenses/mit/)