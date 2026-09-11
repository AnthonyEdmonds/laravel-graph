<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Series;

use AnthonyEdmonds\LaravelGraph\Series\Series;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class PointsAsPolylineTest extends TestCase
{
    protected Series $series;

    protected function setUp(): void
    {
        parent::setUp();

        $chart = $this->makeChart();
        $chart->verticalAxis->preRender();
        $chart->horizontalAxis->preRender();

        $this->series = $chart->series[0];
    }

    public function test(): void
    {
        $this->assertEquals(
            '50, 242 150, 181 250, 121 350, 60 450, 0',
            $this->series->pointsAsPolyline(),
        );
    }
}
