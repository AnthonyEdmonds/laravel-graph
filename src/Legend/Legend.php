<?php

namespace App\View\Components\Charts\Legend;

use App\View\Components\Charts\Chart;
use Illuminate\Contracts\View\View;

class Legend
{
    public int $height = 0;

    public array $labels = [];

    public int $width = 0;

    public function __construct(
        public Chart $chart,
    ) {
        foreach ($this->chart->series as $series) {
            $this->labels[] = $series->label;
        }

        $this->calculateHeight();
        $this->calculateWidth();
    }

    public function calculateHeight(): void
    {
        $this->height = count($this->labels) * (Chart::CHARACTER_HEIGHT + Chart::GAP);
    }

    public function calculateWidth(): void
    {
        $longestLabel = max($this->labels);
        $this->width
            = Chart::GAP
            + Chart::CHARACTER_HEIGHT
            + Chart::GAP
            + (strlen($longestLabel) * Chart::CHARACTER_WIDTH)
            + Chart::GAP;
    }

    public function render(): View
    {
        return view('components.charts.legend.legend', [
            'legend' => $this,
        ]);
    }
}
