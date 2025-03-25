<?php

namespace Eymer\LaravelQuotes\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class LaravelQuotesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // Register config
        $this->mergeConfigFrom(__DIR__.'/../config/quotes.php', 'quotes');

        // Register views
        $this->loadViewsFrom(__DIR__ . '/../views', 'laravelquotes');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/quotes.php' => config_path('quotes.php'),
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/laravelquotes'),
                __DIR__.'/../../dist' => public_path('vendor/laravelquotes'),
            ], 'laravelquotes-assets');
        }

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RateLimiter::for('laravelquotes', function (Request $request) {
            $maxAttempts = config('quotes.max_limit_attempts', 5);
            $maxDuration = config('quotes.max_limit_duration', 1);

            return Limit::perMinute($maxAttempts, $maxDuration)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) use ($maxAttempts, $maxDuration) {

                    return response()->json([
                        'time_remaining' => $headers['Retry-After'],
                        'message' => "You've reached the maximum number request {$maxAttempts} per every {$maxDuration} minutes.",
                    ]);
                });
        });
    }
}
