<?php

namespace AnthonyEdmonds\LaravelGraph\Tests;

use AnthonyEdmonds\LaravelGraph\LaravelGraphServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelGraphServiceProvider::class,
        ];
    }
}
