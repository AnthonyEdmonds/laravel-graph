<?php

namespace AnthonyEdmonds\LaravelGraph\Providers;

use Illuminate\Support\Facades\Blade;
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
        $this->bootComponents();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/resources' => resource_path('views/vendor/laravel-graph'),
        ], 'laravel-graph');
    }

    protected function bootComponents(): void
    {
        Blade::componentNamespace('AnthonyEdmonds\\LaravelGraph\\Charts', 'laravel-graph');
    }
}
