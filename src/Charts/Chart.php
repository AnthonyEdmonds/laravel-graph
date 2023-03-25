<?php

namespace AnthonyEdmonds\LaravelGraph\Charts;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Palettes\GovukPalettes;
use AnthonyEdmonds\LaravelGraph\Series\Series;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

abstract class Chart extends Component
{
    const CAPTION_SIZE = 28;

    const CHARACTER_HEIGHT = 16;

    const CHARACTER_WIDTH = 10;

    const GAP = 8;

    public string $caption;

    public Chart $chart;

    public Collection $data;

    public string $description;

    public int $height;

    public HorizontalAxis $horizontalAxis;

    public string $id;

    public array $palette;

    public array $series = [];

    public VerticalAxis $verticalAxis;

    public int $width;

    abstract public function chartType(): string;

    public function __construct(
        string $caption,
        string $description,
        Collection $data,
        string $horizontalAxisKey,
        string $horizontalAxisCaption,
        string $verticalAxisCaption,
        array $verticalAxisKeys = null,
        int $width = 630,
        int $height = 340,
        string $id = null,
        string $verticalAxisUnit = null,
        int $verticalAxisMax = null,
        int $verticalAxisMin = null,
    ) {
        $this->caption = $caption;
        $this->chart = $this;
        $this->data = $data;
        $this->description = $description;
        $this->height = $height;
        $this->id = $id ?? uniqid($this->chartType().'_');
        $this->palette = GovukPalettes::default();
        $this->width = $width;

        $verticalAxisKeys = $verticalAxisKeys ?? $this->getVerticalAxisKeys($horizontalAxisKey);
        $this->makeSeries($verticalAxisKeys);

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
        return view('components.charts.'.$this->chartType());
    }

    // Setters
    public function setPalette(array $palette): self
    {
        $this->palette = $palette;

        return $this;
    }

    // Utilities
    protected function getVerticalAxisKeys(string $horizontalAxisKey): array
    {
        $keys = [];
        $point = $this->data->first();

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
                Str::headline($key),
                $key,
                $this->data,
                $this->palette[$paletteIndex],
            );

            $paletteIndex >= $paletteLength ? ($paletteIndex = 0) : $paletteIndex++;
        }
    }
}
