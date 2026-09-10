<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Enums\Palette;

use AnthonyEdmonds\LaravelGraph\Enums\Palette;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class GetTest extends TestCase
{
    public function testDefault(): void
    {
        $this->assertEquals(
            Palette::default(),
            Palette::get(Palette::Default),
        );
    }

    public function testGreyscale(): void
    {
        $this->assertEquals(
            Palette::greyscale(),
            Palette::get(Palette::Greyscale),
        );
    }
}
