<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <title>Laravel quotes</title>
        <link rel="stylesheet" href="{{ asset('vendor/laravelquotes/assets/app.css') }}">
        <script src="{{ asset('vendor/laravelquotes/assets/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
    <!-- Centered container -->
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center min-h-screen py-12 sm:px-6 lg:px-8">

            <!-- Inertia container -->
            <div class="flex flex-col items-center justify-center min-h-[calc(100vh-160px)]">
                @inertia
            </div>

            <!-- Footer -->
            <footer class="mt-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} Laravel Quotes. Todos los derechos reservados. Eymer López
                </p>
            </footer>
        </div>
    </div>
    </body>
</html>

