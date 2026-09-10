<?php

namespace AnthonyEdmonds\LaravelGraph\Axes;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use Illuminate\Contracts\View\View;

abstract class Axis
{
    public const int CAPTION_SIZE = 22;

    public array $allLabels = [];

    public int $height = 0;

    public string $key = '';

    public array $labels = [];

    public int $paddingBottom = 0;

    public int $paddingLeft = 0;

    public int $paddingRight = 0;

    public int $paddingTop = 0;

    public int $spacing = 0;

    public int $width = 0;

    abstract public function axisType(): string;

    abstract public function calculateHeight(): void;

    abstract public function calculateWidth(): void;

    abstract public function getLabels(): array;

    abstract public function positionFor(int $index): int;

    abstract public function preRender(): void;

    public function __construct(
        public Chart $chart,
        public string $caption,
    ) {
        //
    }

    public function render(): View
    {
        $this->preRender();

        return view('laravel-graph::axes.'.$this->axisType())->with('axis', $this);
    }
}
