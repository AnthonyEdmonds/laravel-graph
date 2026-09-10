<?php

namespace AnthonyEdmonds\LaravelGraph\Axes;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;

class VerticalAxis extends Axis
{
    public array $labels = [];

    public int $range = 0;

    public int $spacing = 0;

    public function __construct(
        public Chart $chart,
        public string $caption,
        public array $keys,
        public ?string $unit = null,
        public ?int $max = null,
        public ?int $min = null,
    ) {
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
        $this->height = $this->chart->height
            - $this->paddingTop
            - $this->chart->horizontalAxis->height;
    }

    public function calculateWidth(): void
    {
        $this->width = Axis::CAPTION_SIZE
            + Chart::GAP
            + (strlen($this->max.$this->unit) * (Chart::CHARACTER_WIDTH + 1))
            + Chart::GAP;
    }

    public function getLabels(): array
    {
        $labels = [];
        $maxSteps = floor($this->height / (Chart::CHARACTER_HEIGHT + Chart::GAP));
        $gap = floor(($this->max - $this->min) / $maxSteps);

        for ($label = $this->max; $label >= $this->min; $label -= $gap) {
            $labels[] = $label.$this->unit;
        }

        array_splice($labels, -1, 1, $this->min.$this->unit);

        return $labels;
    }

    public function positionFor(int $index): int
    {
        $verticalSpacing = $this->height / $this->range;
        $difference = $this->max - $index;

        return $verticalSpacing * $difference;
    }

    public function preRender(): void
    {
        $this->calculateHeight();
        $this->labels = $this->getLabels();
        $this->allLabels = $this->labels;
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
