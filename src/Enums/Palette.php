<?php

namespace App\View\Components\Charts\Enums;

enum Palette: string
{
    case Default = 'default';

    case Greyscale = 'greyscale';

    public static function get(Palette $palette): array
    {
        return match ($palette) {
            Palette::Default => Palette::default(),
            Palette::Greyscale => Palette::greyscale(),
        };
    }

    public static function default(): array
    {
        return [
            Colour::BluePrimary,
            Colour::OrangePrimary,
            Colour::GreenPrimary,
            Colour::RedPrimary,
            Colour::PurplePrimary,
            Colour::BrownPrimary,
            Colour::MagentaPrimary,
            Colour::YellowPrimary,
            Colour::TealPrimary,
        ];
    }

    public static function greyscale(): array
    {
        return [
            Colour::BlackPrimary,
            Colour::BlackLighter,
            Colour::BlackLight,
            Colour::BlackLightest,
        ];
    }
}
