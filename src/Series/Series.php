<?php

namespace AnthonyEdmonds\LaravelGraph\Series;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use AnthonyEdmonds\LaravelGraph\Colours\GovukColours;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class Series
{
    const CIRCLE = 'circle';

    const RECTANGLE = 'rect';

    const TEXT = 'text';

    const POINT_SHAPES = [self::CIRCLE, self::RECTANGLE];

    public Chart $chart;

    public int $height;

    public string $label;

    public string $lineColour;

    public int $paddingLeft = 0;

    public int $paddingTop = 0;

    public string $pointColour = GovukColours::BLACK;

    public string $pointShape = self::CIRCLE;

    public int $pointSize = 3;

    public array $points;

    public bool $showLine = true;

    public bool $showPoint = true;

    public bool $showText = false;

    public string $strokeWidth = '3px';

    public string $textColour = GovukColours::BLACK;

    public string $unit;

    public int $width;

    public function __construct(
        Chart $chart,
        string $label,
        string $seriesKey,
        Collection $data,
        string $lineColour,
    ) {
        $this->chart = $chart;
        $this->label = $label;
        $this->lineColour = $lineColour;

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
    public function setLineColour(string $lineColour): self
    {
        $this->lineColour = $lineColour;

        return $this;
    }

    public function setPointColour(string $pointColour): self
    {
        $this->pointColour = $pointColour;

        return $this;
    }

    public function setPointShape(string $shape): self
    {
        if (in_array($shape, self::POINT_SHAPES) === false) {
            throw new \InvalidArgumentException("$shape is not a valid point shape");
        }

        $this->pointShape = $shape;

        return $this;
    }

    public function setPointSize(int $size): self
    {
        $this->pointSize = $size;

        return $this;
    }

    public function setTextColour(string $textColour): self
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

    public function positionFor(int|string $subject, string $axis, string $shape = null): int
    {
        $position =
            $axis === 'x'
                ? $this->chart->horizontalAxis->positionFor($subject)
                : $this->chart->verticalAxis->positionFor($subject);

        return match ($shape) {
            self::RECTANGLE => $position - $this->pointSize,
            self::TEXT => $axis === 'y' ? $position - Chart::CHARACTER_HEIGHT / 4 : $position,
            default => $position,
        };
    }
}
