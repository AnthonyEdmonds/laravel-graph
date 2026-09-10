<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\HorizontalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\Axis;
use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class CalculateHeightTest extends TestCase
{
    protected HorizontalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->horizontalAxis;
        $this->axis->calculateHeight();
    }

    public function test(): void
    {
        $this->assertEquals(
            Chart::GAP + Axis::CAPTION_SIZE + Chart::GAP + Chart::CHARACTER_HEIGHT + Chart::GAP,
            $this->axis->height,
        );
    }
}
