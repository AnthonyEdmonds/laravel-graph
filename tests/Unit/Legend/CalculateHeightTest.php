<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Legend;

use AnthonyEdmonds\LaravelGraph\Legend\Legend;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class CalculateHeightTest extends TestCase
{
    protected Legend $legend;

    protected function setUp(): void
    {
        parent::setUp();

        $this->legend = $this->makeChart()->legend;
        $this->legend->calculateHeight();
    }

    public function test(): void
    {
        $this->assertEquals(
            24,
            $this->legend->height,
        );
    }
}
