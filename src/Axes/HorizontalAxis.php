<?php

namespace AnthonyEdmonds\LaravelGraph\Axes;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;

class HorizontalAxis extends Axis
{
    public string $key;

    public function __construct(Chart $chart, string $caption, string $key)
    {
        $this->key = $key;

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
        $this->height = Chart::GAP + Axis::CAPTION_SIZE + Chart::GAP + Chart::CHARACTER_HEIGHT;
    }

    public function calculateWidth(): void
    {
        $this->width = $this->chart->width - $this->paddingLeft - $this->paddingRight;
    }

    public function getLabels(): array
    {
        return $this->chart->data->pluck($this->key)->toArray();
    }

    public function positionFor(int $point): int
    {
        return $point * $this->spacing + $this->spacing / 2;
    }

    public function preRender(): void
    {
        $this->labels = $this->getLabels();

        $this->paddingLeft = $this->chart->verticalAxis->width;
        $this->calculateWidth();
        $this->spacing = $this->width / count($this->labels);
    }
}
