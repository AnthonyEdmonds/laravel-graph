<?php

namespace AnthonyEdmonds\LaravelGraph\Tests;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use AnthonyEdmonds\LaravelGraph\Charts\LineChart;
use AnthonyEdmonds\LaravelGraph\LaravelGraphServiceProvider;
use AnthonyEdmonds\LaravelTestingTraits\AssertsViews;
use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use AssertsViews;

    protected function getPackageProviders($app): array
    {
        return [
            LaravelGraphServiceProvider::class,
        ];
    }

    protected function makeChart(): Chart
    {
        return new LineChart(
            'My caption',
            'My description',
            new Collection([
                [
                    'time' => '09:00',
                    'cpu' => 10,
                ],
                [
                    'time' => '10:00',
                    'cpu' => 20,
                ],
                [
                    'time' => '11:00',
                    'cpu' => 30,
                ],
                [
                    'time' => '12:00',
                    'cpu' => 40,
                ],
                [
                    'time' => '13:00',
                    'cpu' => 50,
                ],
            ]),
            'time',
            'Time',
            'Count',
        );
    }
}
