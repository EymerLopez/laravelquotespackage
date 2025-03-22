# Laravel Quotes Package (Laravel 12)

Paquete para mostrar citas con integración de API, Inertia.js, VUE 3 y Tailwind CSS.

## Requisitos
- PHP 8.2+
- Laravel 12+
- Node.js 22+
- Composer 2.6+

## Instalación

1. Crear una carpeta en el repositorio de un proyecto llamada `packages`, dentro de ella crear otra llamada `laravelquotes` o clona este repositorio en esa carpeta

2. Añadir en `composer.json` del proyecto principal:
```json
"repositories": {
    "laravelquotes": {
        "type": "path",
        "url": "packages/laravelquotes",
        "options": {
            "symlink": true
        }
    }
}
```
3. Añadir en `composer.json` del proyecto principal:
```json
"require": {
    "eymer/laravelquotes": "dev-master",
},
```
4. Ejecutar `composer update`
5. Añade `\Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider::class` al `bootstrap/providers.php` de la aplicación
6. Añade al `bootstrap/app.php` el middleware de inertia dentro la función ``withMiddleware``
```php
        ->withMiddleware(function (Middleware $middleware) {
            ...
            $middleware->web(append: [
                HandleInertiaRequests::class,
            ]);
            ...
        })
```
7. Ir a la raíz del paquete (`cd packages/laravelquotes`) y ejecutar `npm install` y luego `npm run build`
8. Ahora vuelve a la raíz del proyecto principal y ejecuta el comando `php artisan vendor:publish`. Selecciona el provider `Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider`.
9. Probar.


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

