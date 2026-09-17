<?php

namespace AnthonyEdmonds\LaravelGraph\Charts;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Enums\Palette;
use AnthonyEdmonds\LaravelGraph\Legend\Legend;
use AnthonyEdmonds\LaravelGraph\Series\Series;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

abstract class Chart extends Component
{
    public const int CAPTION_SIZE = 28;

    public const int CHARACTER_HEIGHT = 16;

    public const int CHARACTER_WIDTH = 10;

    public const int GAP = 8;

    public HorizontalAxis $horizontalAxis;

    public string $id;

    public Legend $legend;

    public array $palette;

    /** @var Series[] */
    public array $series = [];

    public VerticalAxis $verticalAxis;

    abstract public function chartType(): string;

    public function __construct(
        public string $caption,
        public string $description,
        public Collection $data,
        string $horizontalAxisKey,
        string $horizontalAxisCaption,
        string $verticalAxisCaption,
        ?array $verticalAxisKeys = null,
        public int $width = 630,
        public int $height = 340,
        ?string $id = null,
        string $verticalAxisUnit = '',
        ?int $verticalAxisMax = null,
        ?int $verticalAxisMin = null,
        string|Palette $palette = Palette::Default,
    ) {
        $this->id = $id ?? uniqid($this->chartType().'_');

        if (is_string($palette) === true) {
            $palette = Palette::from($palette);
        }

        $this->palette = Palette::get($palette);

        $verticalAxisKeys = $verticalAxisKeys ?? $this->getVerticalAxisKeys($horizontalAxisKey);
        $this->makeSeries($verticalAxisKeys);

        $this->legend = new Legend($this);

        $this->horizontalAxis = new HorizontalAxis(
            $this,
            $horizontalAxisCaption,
            $horizontalAxisKey,
        );

        $this->verticalAxis = new VerticalAxis(
            $this,
            $verticalAxisCaption,
            $verticalAxisKeys,
            $verticalAxisUnit,
            $verticalAxisMax,
            $verticalAxisMin,
        );
    }

    // Component
    public function render(): View
    {
        return view('laravel-graph::' . $this->chartType(), [
            'caption' => $this->caption,
            'description' => $this->description,
            'height' => $this->height,
            'horizontalAxis' => $this->horizontalAxis,
            'id' => $this->id,
            'legend' => $this->legend,
            'series' => $this->series,
            'verticalAxis' => $this->verticalAxis,
            'width' => $this->width,
        ]);
    }

    // Utilities
    protected function getVerticalAxisKeys(string $horizontalAxisKey): array
    {
        $keys = [];
        $point = $this->data->first() ?? [];

        foreach ($point as $key => $value) {
            if ($key === $horizontalAxisKey) {
                continue;
            }

            $keys[] = $key;
        }

        return $keys;
    }

    protected function makeSeries(array $verticalAxisKeys): void
    {
        $paletteIndex = 0;
        $paletteLength = array_key_last($this->palette);

        foreach ($verticalAxisKeys as $key) {
            $this->series[] = new Series(
                $this,
                $key,
                $key,
                $this->data,
                $this->palette[$paletteIndex],
                $this->palette[$paletteIndex],
            );

            $paletteIndex >= $paletteLength ? ($paletteIndex = 0) : $paletteIndex++;
        }
    }
}
