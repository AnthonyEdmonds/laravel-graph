<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\HorizontalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Support\Collection;

class PreRenderTest extends TestCase
{
    protected HorizontalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->horizontalAxis;
        $this->axis->chart->verticalAxis->width = 10;
        $this->axis->chart->legend->width = 20;
    }

    public function test(): void
    {
        $this->axis->preRender();

        $this->assertEquals(
            10,
            $this->axis->paddingLeft,
        );

        $this->assertEquals(
            20,
            $this->axis->paddingRight,
        );

        $this->assertEquals(
            600,
            $this->axis->width,
        );

        $this->assertNotEmpty(
            $this->axis->labels,
        );

        $this->assertEquals(
            120,
            $this->axis->spacing,
        );
    }

    public function testHandlesDivZero(): void
    {
        $this->axis->chart->data = new Collection();
        $this->axis->preRender();

        $this->assertEquals(
            1,
            $this->axis->spacing,
        );
    }
}
