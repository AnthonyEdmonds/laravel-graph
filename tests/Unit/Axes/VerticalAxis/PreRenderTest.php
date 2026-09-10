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

        $this->axis->preRender();
    }

    public function test(): void
    {
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
}
