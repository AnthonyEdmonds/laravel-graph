<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Charts\LineChart;

use AnthonyEdmonds\LaravelGraph\Charts\LineChart;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class ChartTypeTest extends TestCase
{
    protected LineChart $chart;

    protected function setUp(): void
    {
        parent::setUp();

        $this->chart = $this->makeChart();
    }

    public function test(): void
    {
        $this->assertEquals(
            'line-chart',
            $this->chart->chartType(),
        );
    }
}
