<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Provider;

use AnthonyEdmonds\LaravelGraph\LaravelGraphServiceProvider;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class BootTest extends TestCase
{
    protected string $basePath;

    protected string $outputPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->basePath = realpath(__DIR__ . '/../../../src');
        $this->outputPath = base_path();
    }

    public function test(): void
    {
        $publishes = LaravelGraphServiceProvider::$publishes[LaravelGraphServiceProvider::class];

        $this->assertEquals(
            [
                "$this->basePath/Views" => "$this->outputPath/resources/views/vendor/laravel-graph",
            ],
            $publishes,
        );

        $this->assertEquals(
            [
                'laravel-graph' => 'AnthonyEdmonds\LaravelGraph\Charts',
            ],
            Blade::getClassComponentNamespaces(),
        );

        $this->assertTrue(
            View::exists('laravel-graph::line-chart'),
        );
    }
}
