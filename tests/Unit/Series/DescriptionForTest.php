<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Series;

use AnthonyEdmonds\LaravelGraph\Series\Series;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class DescriptionForTest extends TestCase
{
    protected Series $series;

    protected function setUp(): void
    {
        parent::setUp();

        $chart = $this->makeChart();
        $chart->verticalAxis->preRender();
        $chart->horizontalAxis->preRender();

        $this->series = $chart->series[0];
        $this->series->unit = '%';
    }

    public function test(): void
    {
        $this->assertEquals(
            '09:00: cpu, 10%',
            $this->series->descriptionFor(0, 10),
        );
    }
}
