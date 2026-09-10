<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\VerticalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class CalculateHeightTest extends TestCase
{
    protected VerticalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->verticalAxis;
        $this->axis->calculateHeight();
    }

    public function test(): void
    {
        $this->assertEquals(
            242,
            $this->axis->height,
        );
    }
}
