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
                '09:00',
                '10:00',
                '11:00',
                '12:00',
                '13:00',
            ],
            $this->axis->getLabels(),
        );
    }
}
