<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Enums\Palette;

use AnthonyEdmonds\LaravelGraph\Enums\Colour;
use AnthonyEdmonds\LaravelGraph\Enums\Palette;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class GreyscaleTest extends TestCase
{
    public function testDefault(): void
    {
        $this->assertEquals(
            [
                Colour::BlackPrimary,
                Colour::BlackLighter,
                Colour::BlackLight,
                Colour::BlackLightest,
            ],
            Palette::greyscale(),
        );
    }
}
