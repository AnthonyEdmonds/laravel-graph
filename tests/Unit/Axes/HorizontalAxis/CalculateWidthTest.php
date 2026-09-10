<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\HorizontalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class CalculateWidthTest extends TestCase
{
    protected HorizontalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->horizontalAxis;
        $this->axis->calculateWidth();
    }

    public function test(): void
    {
        $this->assertEquals(
            $this->axis->chart->width - $this->axis->paddingLeft - $this->axis->paddingRight,
            $this->axis->width,
        );
    }
}
