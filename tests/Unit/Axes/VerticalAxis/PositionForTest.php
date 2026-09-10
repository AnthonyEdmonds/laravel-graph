<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\VerticalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class PositionForTest extends TestCase
{
    protected VerticalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->verticalAxis;
        $this->axis->height = 10;
        $this->axis->range = 20;
        $this->axis->max = 50;
    }

    public function test(): void
    {
        $this->assertEquals(
            23,
            $this->axis->positionFor(3),
        );
    }
}
