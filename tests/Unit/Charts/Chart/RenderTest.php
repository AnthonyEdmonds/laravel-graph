<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Charts\Chart;

use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Contracts\View\View;

class RenderTest extends TestCase
{
    protected Chart $chart;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->chart = $this->makeChart();
        $this->view = $this->chart->render();
    }

    public function test(): void
    {
        $this->assertViewRenders($this->view);

        $this->assertEquals(
            'laravel-graph::line-chart',
            $this->view->name(),
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->chart->caption,
            $data['caption'],
        );

        $this->assertEquals(
            $this->chart->description,
            $data['description'],
        );

        $this->assertEquals(
            $this->chart->height,
            $data['height'],
        );

        $this->assertEquals(
            $this->chart->horizontalAxis,
            $data['horizontalAxis'],
        );

        $this->assertEquals(
            $this->chart->id,
            $data['id'],
        );

        $this->assertEquals(
            $this->chart->legend,
            $data['legend'],
        );

        $this->assertEquals(
            $this->chart->series,
            $data['series'],
        );

        $this->assertEquals(
            $this->chart->verticalAxis,
            $data['verticalAxis'],
        );

        $this->assertEquals(
            $this->chart->width,
            $data['width'],
        );
    }
}
