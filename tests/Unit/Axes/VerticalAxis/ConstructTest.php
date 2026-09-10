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
        $this->axis->height = 60;
    }

    public function test(): void
    {
        $this->assertEquals(
            60,
            $this->axis->height,
        );
    }
}
