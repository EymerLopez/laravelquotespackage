# Laravel Quotes Package (Laravel 12)

<p style="text-align: center">
    <a href="./README.MD">English / Inglés</a>
</p>

Paquete para mostrar citas con integración de API, Inertia.js, VUE 3 y Tailwind CSS.

## Requisitos
- PHP 8.2+
- Laravel 12+
- Node.js 22+
- Composer 2.6+

## Instalación

1. Instala un proyecto Laravel 12+
2. Edita el `composer.json` de la aplicación y añade el repositorio del paquete manualmente en la sección `repositories`
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
3. Instalar el paquete ejecutando `composer require eymer/laravelquotes`
4. Añade `\Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider::class` al `bootstrap/providers.php` de la aplicación si este no fue añadido automáticamente.
```php
    return [
        App\Providers\AppServiceProvider::class,
        \Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider::class
    ];
```
5. Añade al `bootstrap/app.php` el middleware de inertia dentro la función ``withMiddleware``
```php
        ->withMiddleware(function (Middleware $middleware) {
            ...
            $middleware->web(append: [
                \Eymer\LaravelQuotes\Http\Middleware\HandleInertiaRequests::class,
            ]);
            ...
        })
```
6. Publica los vendors para cargar las vistas y los archivos css y js
`php artisan vendor:publish --provider="Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider" --tag=laravelquotes-assets --force`
7. Prueba.

## Configuración (`config/quotes.php`)
* ``url``: Establece la url por defecto de la página a donde nos vamos a conectar
* ``max_limit_attempts``: Establece por defecto cuántas solicitudes por IP el usuario puede realizar. Por defecto son 200.
* ``max_limit_duration``: Establece por defecto el límite de tiempo en minutos antes de que el usuario pueda realizar solicitudes una vez alcanzado el máximo. Por defecto 1 minuto.

## Rutas API (`api.php`)
Prefijo: `/quotes`

| Método | URI                  | Acción                      | Descripción                          |
|--------|----------------------|----------------------------|--------------------------------------|
| GET    | /quotes              | QuoteController@index      | Listado paginado de citas            |
| GET    | /quotes/random       | QuoteController@random     | Obtener una cita aleatoria           |
| GET    | /quotes/{id}         | QuoteController@show       | Obtener cita específica por ID       |

## Rutas WEB (`web.php`)
Prefijo: `/quotes-ui`

| Método | URI               | Acción                     | Descripción                          |
|--------|-------------------|----------------------------|--------------------------------------|
| GET    | /quotes-ui        | QuoteViewController@index  | Listado paginado de citas            |
| GET    | /quotes-ui/random | QuoteViewController@random | Obtener una cita aleatoria           |
| GET    | /quotes-ui/{id}   | QuoteViewController@show   | Obtener cita específica por ID       |
