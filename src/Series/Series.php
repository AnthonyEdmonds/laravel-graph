<?php

namespace AnthonyEdmonds\LaravelGraph\Series;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use AnthonyEdmonds\LaravelGraph\Enums\Colour;
use AnthonyEdmonds\LaravelGraph\Enums\PointType;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class Series
{
    public int $height = 0;

    public int $paddingLeft = 0;

    public int $paddingTop = 0;

    public int $pointSize = 3;

    public array $points = [];

    public bool $showLine = true;

    public bool $showPoint = true;

    public bool $showText = false;

    public string $strokeWidth = '3px';

    public string $unit = '';

    public int $width = 0;

    public function __construct(
        public Chart $chart,
        public string $label,
        string $seriesKey,
        Collection $data,
        public Colour $lineColour = Colour::BlackPrimary,
        public Colour $pointColour = Colour::BlackPrimary,
        public PointType $pointShape = PointType::Circle,
        public Colour $textColour = Colour::BlackPrimary,
    ) {
        $this->points = $data
            ->pluck($seriesKey)
            ->whereNotNull()
            ->toArray();
    }

    // Component
    public function render(): View
    {
        $this->paddingLeft = $this->chart->verticalAxis->width;
        $this->paddingTop = $this->chart->verticalAxis->paddingTop;
        $this->height = $this->chart->verticalAxis->height;
        $this->width = $this->chart->horizontalAxis->width;
        $this->unit = $this->chart->verticalAxis->unit;

        return view('laravel-graph::series.line', [
            'series' => $this,
        ]);
    }

    // Utilities
    public function max(): string|int
    {
        return max($this->points);
    }

    public function min(): string|int
    {
        return min($this->points);
    }

    public function pointsAsPolyline(): string
    {
        $points = [];

        foreach ($this->points as $index => $point) {
            $x = $this->chart->horizontalAxis->positionFor($index);
            $y = $this->chart->verticalAxis->positionFor($point);

            $points[] = "$x, $y";
        }

        return implode(' ', $points);
    }

    public function positionFor(int|string $subject, string $axis): int
    {
        $position = $axis === 'x'
            ? $this->chart->horizontalAxis->positionFor($subject)
            : $this->chart->verticalAxis->positionFor($subject);

        return match ($this->pointShape) {
            PointType::Square => $position - $this->pointSize,
            PointType::Text => $axis === 'y'
                ? $position - Chart::CHARACTER_HEIGHT / 4
                : $position,
            default => $position,
        };
    }

    public function descriptionFor(int|string $key, int|string $value): string
    {
        $axisValue = $this->chart->horizontalAxis->labels[$key];

        return "$axisValue: $this->label, $value$this->unit";
    }
}
