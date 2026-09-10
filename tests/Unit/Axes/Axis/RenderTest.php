<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\Axis;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Contracts\View\View;

class RenderTest extends TestCase
{
    protected HorizontalAxis $axis;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->horizontalAxis;
        $this->view = $this->axis->render();
    }

    public function test(): void
    {
        $this->assertViewRenders($this->view);

        $this->assertEquals(
            'laravel-graph::axes.horizontal-axis',
            $this->view->name(),
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->axis,
            $data['axis'],
        );
    }
}
