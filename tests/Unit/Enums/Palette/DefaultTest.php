<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Enums\Palette;

use AnthonyEdmonds\LaravelGraph\Enums\Colour;
use AnthonyEdmonds\LaravelGraph\Enums\Palette;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class DefaultTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            [
                Colour::BluePrimary,
                Colour::OrangePrimary,
                Colour::GreenPrimary,
                Colour::RedPrimary,
                Colour::PurplePrimary,
                Colour::BrownPrimary,
                Colour::MagentaPrimary,
                Colour::YellowPrimary,
                Colour::TealPrimary,
            ],
            Palette::default(),
        );
    }
}
