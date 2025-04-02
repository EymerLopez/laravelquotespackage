# Laravel Quotes Package (Laravel 12)

<p style="text-align: center">
    <a href="./LEAME.MD">Spanish / Español</a>
</p>

Package for displaying quotes with API integration, Inertia.js, VUE 3, and Tailwind CSS.

## Requirements
- PHP 8.2+
- Laravel 12+
- Node.js 22+
- Composer 2.6+

## Installation

1. Install a Laravel 12+ project.
2. Edit the application's `composer.json` file and manually add the package repository in the `repositories` section:
```json
...
"license": "MIT",
"repositories": [
    {
    "type": "git",
    "url": "https://github.com/EymerLopez/laravelquotespackage.git"
    }
],
"require": {
...
}
```
3. Install the package by running `composer require eymer/laravelquotes`.
4. Add `\Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider::class` to the application's `bootstrap/providers.php` if it was not added automatically.

```php
    return [
        App\Providers\AppServiceProvider::class,
        \Eymer\LaravelQuotes\LaravelQuotesServiceProvider::class
    ];
```
5. Add the Inertia middleware to `bootstrap/app.php` inside the `withMiddleware` function.
```php
        ->withMiddleware(function (Middleware $middleware) {
            ...
            $middleware->web(append: [
                \Eymer\LaravelQuotes\Http\Middleware\HandleInertiaRequests::class,
            ]);
            ...
        })
```
6. Publish the vendors to load views and CSS and JS files.
   `php artisan vendor:publish --provider="Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider" --tag=laravelquotes-assets --force`
7. Test.

## Configuration (`config/quotes.php`)
* `url`: Sets the default URL of the page to which we will connect.
* `max_limit_attempts`: Sets the default number of requests per IP the user can make. By default, it is 200.
* `max_limit_duration`: Sets the default time limit in minutes before the user can make requests again once the maximum is reached. By default, it is 1 minute.

## API Routes (`api.php`)
Prefix: `/quotes`

| Method | URI                  | Action                      | Description                          |
|--------|----------------------|----------------------------|--------------------------------------|
| GET    | /quotes              | QuoteController@index      | Paginated list of quotes            |
| GET    | /quotes/random       | QuoteController@random     | Get a random quote                   |
| GET    | /quotes/{id}         | QuoteController@show       | Get a specific quote by ID           |

## WEB Routes (`web.php`)
Prefix: `/quotes-ui`

| Method | URI               | Action                     | Description                          |
|--------|-------------------|----------------------------|--------------------------------------|
| GET    | /quotes-ui        | QuoteViewController@index  | Paginated list of quotes            |
| GET    | /quotes-ui/random | QuoteViewController@random | Get a random quote                   |
| GET    | /quotes-ui/{id}   | QuoteViewController@show   | Get a specific quote by ID           |

---