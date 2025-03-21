<?php

namespace Eymer\LaravelQuotes\Tests;


use Eymer\LaravelQuotes\Providers\LaravelQuotesServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelQuotesServiceProvider::class,
        ];
    }
}
