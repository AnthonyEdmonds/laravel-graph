<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Series;

use AnthonyEdmonds\LaravelGraph\Series\Series;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Contracts\View\View;

class RenderTest extends TestCase
{
    protected Series $series;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $chart = $this->makeChart();
        $chart->horizontalAxis->preRender();
        $chart->verticalAxis->preRender();

        $this->series = $chart->series[0];
        $this->view = $this->series->render();
    }

    public function test(): void
    {
        $this->assertViewRenders($this->view);

        $this->assertEquals(
            'laravel-graph::series.line',
            $this->view->name(),
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->series,
            $data['series'],
        );
    }
}
