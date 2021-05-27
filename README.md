## Installation

1. Clone the repository and change into the directory

```
git clone git@github.com:dmaksimov/shipping-zip-codes-prototype.git
```

2. Set up
```
cd shipping-zip-codes-prototype
cp .env.example .env
composer install
php artisan key:generate
```

3. Serve the site and visit the home page
```
php artisan serve
```

Go to: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
