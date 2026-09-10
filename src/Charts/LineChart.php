<?php

namespace App\View\Components\Charts;

class LineChart extends Chart
{
    public function chartType(): string
    {
        return 'line-chart';
    }
}
