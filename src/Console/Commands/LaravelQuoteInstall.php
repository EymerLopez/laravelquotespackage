<?php

namespace Eymer\LaravelQuotes\Console\Commands;

use Illuminate\Console\Command;

class LaravelQuoteInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelquotes:install {--force : overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish necessary laravel files for compilation and configuration {--force : overwrite any existing files}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tags = [
            'config',
            'assets',
            'views',
        ];

        foreach ($tags as $tag) {
            $this->call('vendor:publish', [
                '--tag' => $tag,
                '--force' => $this->option('force'),
            ]);
        }
    }
}