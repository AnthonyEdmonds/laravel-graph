<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\HorizontalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class AxisTypeTest extends TestCase
{
    protected HorizontalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->horizontalAxis;
    }

    public function test(): void
    {
        $this->assertEquals(
            'horizontal-axis',
            $this->axis->axisType(),
        );
    }
}
