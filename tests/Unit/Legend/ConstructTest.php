<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Legend;

use AnthonyEdmonds\LaravelGraph\Legend\Legend;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class ConstructTest extends TestCase
{
    protected Legend $legend;

    protected function setUp(): void
    {
        parent::setUp();

        $this->legend = $this->makeChart()->legend;
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                'Cpu',
            ],
            $this->legend->labels,
        );

        $this->assertEquals(
            24,
            $this->legend->height,
        );

        $this->assertEquals(
            70,
            $this->legend->width,
        );
    }
}
