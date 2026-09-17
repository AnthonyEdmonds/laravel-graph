<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\VerticalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class PreRenderTest extends TestCase
{
    protected VerticalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->verticalAxis;
        $this->axis->chart->verticalAxis->width = 10;
        $this->axis->chart->legend->width = 20;
    }

    public function test(): void
    {
        $this->axis->preRender();

        $this->assertEquals(
            242,
            $this->axis->height,
        );

        $this->assertNotEmpty(
            $this->axis->labels,
        );

        $this->assertNotEmpty(
            $this->axis->allLabels,
        );

        $this->assertEquals(
            24,
            $this->axis->spacing,
        );
    }

    public function testHandlesDivZero(): void
    {
        $this->axis->max = 0;
        $this->axis->min = 0;

        $this->axis->preRender();

        $this->assertEquals(
            1,
            $this->axis->spacing,
        );
    }
}
