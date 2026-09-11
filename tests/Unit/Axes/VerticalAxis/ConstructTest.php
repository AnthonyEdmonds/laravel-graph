<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\VerticalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class ConstructTest extends TestCase
{
    protected VerticalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->verticalAxis;
    }

    public function test(): void
    {
        $this->assertEquals(
            50,
            $this->axis->max,
        );

        $this->assertEquals(
            10,
            $this->axis->min,
        );

        $this->assertEquals(
            40,
            $this->axis->range,
        );

        $this->assertEquals(
            36,
            $this->axis->paddingTop,
        );

        $this->assertEquals(
            60,
            $this->axis->width,
        );
    }
}
