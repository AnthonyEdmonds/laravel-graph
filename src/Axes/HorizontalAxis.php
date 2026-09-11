<?php

namespace AnthonyEdmonds\LaravelGraph\Axes;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use DivisionByZeroError;

class HorizontalAxis extends Axis
{
    public function __construct(
        public Chart $chart,
        public string $caption,
        public string $key,
    ) {
        parent::__construct($chart, $caption);

        $this->calculateHeight();
    }

    // Axis
    public function axisType(): string
    {
        return 'horizontal-axis';
    }

    public function calculateHeight(): void
    {
        $this->height = Chart::GAP + Axis::CAPTION_SIZE + Chart::GAP + Chart::CHARACTER_HEIGHT + Chart::GAP;
    }

    public function calculateWidth(): void
    {
        $this->width = $this->chart->width - $this->paddingLeft - $this->paddingRight;
    }

    public function getLabels(): array
    {
        $this->allLabels = $this->chart->data->pluck($this->key)->toArray();

        if (empty($this->allLabels) === true) {
            return [];
        }

        $longestLabel = max($this->allLabels);
        $characters = strlen($longestLabel) + 1;
        $labelWidth = $characters * Chart::CHARACTER_WIDTH;
        $maxLabels = floor($this->width / $labelWidth);
        $gap = floor(count($this->allLabels) / $maxLabels);

        $labels = [];
        $current = 0;

        foreach ($this->allLabels as $label) {
            $labels[] = $current === 0
                ? $label
                : '';

            $current++;

            if ($current > $gap) {
                $current = 0;
            }
        }

        return $labels;
    }

    public function positionFor(int $index): int
    {
        return ($index * $this->spacing) + ($this->spacing / 2);
    }

    public function preRender(): void
    {
        $this->paddingLeft = $this->chart->verticalAxis->width;
        $this->paddingRight = $this->chart->legend->width;
        $this->calculateWidth();
        $this->labels = $this->getLabels();

        try {
            $this->spacing = $this->width / count($this->labels);
        } catch (DivisionByZeroError $exception) {
            $this->spacing = 1;
        }
    }
}
