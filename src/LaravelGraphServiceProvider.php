<?php

namespace AnthonyEdmonds\LaravelGraph;

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
        $this->bootComponents();
        $this->bootPublishes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/laravel-graph'),
        ], 'laravel-graph');
    }

    protected function bootComponents(): void
    {
        Blade::componentNamespace('AnthonyEdmonds\\LaravelGraph\\Charts', 'laravel-graph');
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/Views',
            'laravel-graph',
        );
    }
}
