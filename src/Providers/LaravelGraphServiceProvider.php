<?php

namespace AnthonyEdmonds\LaravelGraph\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelGraphServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/resources' => resource_path('views/vendor/laravel-graph'),
        ], 'laravel-graph');
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/resources',
            'laravel-graph'
        );
    }
}
