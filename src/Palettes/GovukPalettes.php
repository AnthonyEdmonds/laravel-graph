<?php

namespace AnthonyEdmonds\LaravelGraph\Palettes;

use AnthonyEdmonds\LaravelGraph\Colours\GovukColours;

class GovukPalettes
{
    public static function default(): array
    {
        return [
            GovukColours::RED,
            GovukColours::YELLOW,
            GovukColours::GREEN,
            GovukColours::BLUE,
            GovukColours::DARK_BLUE,
            GovukColours::LIGHT_BLUE,
            GovukColours::PURPLE,
            GovukColours::LIGHT_PURPLE,
            GovukColours::BRIGHT_PURPLE,
            GovukColours::PINK,
            GovukColours::LIGHT_PINK,
            GovukColours::ORANGE,
            GovukColours::BROWN,
            GovukColours::LIGHT_GREEN,
            GovukColours::TURQUOISE,
        ];
    }

    public static function greyscale(): array
    {
        return [GovukColours::MID_GREY, GovukColours::DARK_GREY];
    }

    public static function muted(): array
    {
        return [
            GovukColours::LIGHT_BLUE,
            GovukColours::LIGHT_PURPLE,
            GovukColours::LIGHT_PINK,
            GovukColours::ORANGE,
            GovukColours::LIGHT_GREEN,
            GovukColours::BROWN,
        ];
    }

    public static function vibrant(): array
    {
        return [
            GovukColours::RED,
            GovukColours::YELLOW,
            GovukColours::GREEN,
            GovukColours::BLUE,
            GovukColours::PURPLE,
            GovukColours::PINK,
            GovukColours::BRIGHT_PURPLE,
        ];
    }
}
