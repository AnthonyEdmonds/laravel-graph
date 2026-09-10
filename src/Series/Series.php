<?php

namespace App\View\Components\Charts\Series;

use App\View\Components\Charts\Chart;
use App\View\Components\Charts\Enums\Colour;
use App\View\Components\Charts\Enums\Point;
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
        public Point $pointShape = Point::Circle,
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

        return view('components.charts.series.line', [
            'series' => $this,
        ]);
    }

    // Setters
    public function setLineColour(Colour $lineColour): self
    {
        $this->lineColour = $lineColour;

        return $this;
    }

    public function setPointColour(Colour $pointColour): self
    {
        $this->pointColour = $pointColour;

        return $this;
    }

    public function setPointShape(Point $shape): self
    {
        $this->pointShape = $shape;

        return $this;
    }

    public function setPointSize(int $size): self
    {
        $this->pointSize = $size;

        return $this;
    }

    public function setTextColour(Colour $textColour): self
    {
        $this->textColour = $textColour;

        return $this;
    }

    public function setStrokeWidth(string $strokeWidth): self
    {
        $this->strokeWidth = $strokeWidth;

        return $this;
    }

    public function hideLine(): self
    {
        $this->showLine = false;

        return $this;
    }

    public function hidePoint(): self
    {
        $this->showPoint = false;

        return $this;
    }

    public function hideText(): self
    {
        $this->showText = false;

        return $this;
    }

    public function showLine(): self
    {
        $this->showLine = true;

        return $this;
    }

    public function showPoint(): self
    {
        $this->showPoint = true;

        return $this;
    }

    public function showText(): self
    {
        $this->showText = true;

        return $this;
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
            Point::Square => $position - $this->pointSize,
            Point::Text => $axis === 'y' ? $position - Chart::CHARACTER_HEIGHT / 4 : $position,
            default => $position,
        };
    }

    public function descriptionFor(int|string $key, int|string $value): string
    {
        $axisValue = $this->chart->horizontalAxis->labels[$key];

        return "$axisValue: $this->label, $value$this->unit";
    }
}
