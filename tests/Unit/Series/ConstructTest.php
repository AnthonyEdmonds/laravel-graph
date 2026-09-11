<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Series;

use AnthonyEdmonds\LaravelGraph\Series\Series;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class ConstructTest extends TestCase
{
    protected Series $series;

    protected function setUp(): void
    {
        parent::setUp();

        $this->series = $this->makeChart()->series[0];
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                '10',
                '20',
                '30',
                '40',
                '50',
            ],
            $this->series->points,
        );
    }
}
