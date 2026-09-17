<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\VerticalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class GetLabelsTest extends TestCase
{
    protected VerticalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->verticalAxis;
        $this->axis->height = 60;
    }

    public function test(): void
    {
        $this->axis->width = 600;

        $this->assertEquals(
            [
                '50',
                '30',
                '10',
            ],
            $this->axis->getLabels(),
        );
    }

    public function testNoGap(): void
    {
        $this->axis->max = 0;
        $this->axis->min = 0;

        $this->assertEquals(
            [
                0 => 0,
            ],
            $this->axis->getLabels(),
        );
    }
}
