<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Legend;

use AnthonyEdmonds\LaravelGraph\Legend\Legend;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Contracts\View\View;

class RenderTest extends TestCase
{
    protected Legend $legend;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->legend = $this->makeChart()->legend;
        $this->view = $this->legend->render();
    }

    public function test(): void
    {
        $this->assertViewRenders($this->view);

        $this->assertEquals(
            'laravel-graph::legend.legend',
            $this->view->name(),
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->legend,
            $data['legend'],
        );
    }
}
