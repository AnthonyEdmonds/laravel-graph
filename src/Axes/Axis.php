<?php

namespace AnthonyEdmonds\LaravelGraph\Axes;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use Illuminate\Contracts\View\View;

abstract class Axis
{
    const CAPTION_SIZE = 22;

    public string $caption;

    public Chart $chart;

    public int $height;

    public string $key;

    public array $labels;

    public int $paddingBottom = 0;

    public int $paddingLeft = 0;

    public int $paddingRight = 0;

    public int $paddingTop = 0;

    public int $spacing;

    public int $width;

    abstract public function axisType(): string;

    abstract public function calculateHeight(): void;

    abstract public function calculateWidth(): void;

    abstract public function getLabels(): array;

    abstract public function positionFor(int $point): int;

    abstract public function preRender(): void;

    public function __construct(Chart $chart, string $caption)
    {
        $this->chart = $chart;
        $this->caption = $caption;
    }

    public function render(): View
    {
        $this->preRender();

        return view('components.charts.axes.'.$this->axisType())->with('axis', $this);
    }
}
