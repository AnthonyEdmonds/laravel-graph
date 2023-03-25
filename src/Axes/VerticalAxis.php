<?php

namespace AnthonyEdmonds\LaravelGraph\Axes;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;

class VerticalAxis extends Axis
{
    public array $keys;

    public array $labels;

    public int|null $max = null;

    public int|null $min = null;

    public int $range;

    public int $spacing;

    public string|null $unit = null;

    public function __construct(
        Chart $chart,
        string $caption,
        array $keys,
        string $unit = null,
        int|null $max = null,
        int|null $min = null,
    ) {
        $this->keys = $keys;
        $this->max = $max;
        $this->min = $min;
        $this->unit = $unit;

        parent::__construct($chart, $caption);

        $this->getAxisRange();
        $this->paddingTop = Chart::CAPTION_SIZE + Chart::GAP;
        $this->calculateWidth();
    }

    // Axis
    public function axisType(): string
    {
        return 'vertical-axis';
    }

    public function calculateHeight(): void
    {
        $this->height =
            $this->chart->height - $this->paddingTop - $this->chart->horizontalAxis->height;
    }

    public function calculateWidth(): void
    {
        $this->width =
            Axis::CAPTION_SIZE +
            Chart::GAP +
            strlen($this->max.$this->unit) * Chart::CHARACTER_WIDTH +
            Chart::GAP;
    }

    public function getLabels(): array
    {
        $labels = [];
        $maxSteps = floor($this->height / Chart::CHARACTER_HEIGHT);

        for ($gap = $maxSteps; $gap < $this->range; $gap++) {
            if ($this->range % $gap === 0) {
                break;
            }
        }

        for ($label = $this->max; $label >= $this->min; $label -= $gap) {
            $labels[] = $label.$this->unit;
        }

        return $labels;
    }

    public function positionFor(int $point): int
    {
        $verticalSpacing = $this->height / $this->range;
        $difference = $this->max - $point;

        return $verticalSpacing * $difference;
    }

    public function preRender(): void
    {
        $this->calculateHeight();
        $this->labels = $this->getLabels();
        $this->spacing = $this->height / (count($this->labels) - 1);
    }

    // Utilities
    protected function getAxisRange(): void
    {
        foreach ($this->chart->series as $set) {
            if (isset($this->max) === false || $set->max() > $this->max) {
                $this->max = $set->max();
            }

            if (isset($this->min) === false || $set->min() < $this->min) {
                $this->min = $set->min();
            }
        }

        $this->range = $this->max - $this->min;
    }
}
