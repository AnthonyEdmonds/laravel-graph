<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Charts\Chart;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Axes\VerticalAxis;
use AnthonyEdmonds\LaravelGraph\Charts\Chart;
use AnthonyEdmonds\LaravelGraph\Charts\LineChart;
use AnthonyEdmonds\LaravelGraph\Enums\Palette;
use AnthonyEdmonds\LaravelGraph\Legend\Legend;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use Illuminate\Support\Collection;

class ConstructTest extends TestCase
{
    protected Chart $chart;

    protected Collection $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = new Collection([
            [
                'time' => '09:00',
                'cpu' => 10,
            ],
            [
                'time' => '10:00',
                'cpu' => 20,
            ],
            [
                'time' => '11:00',
                'cpu' => 30,
            ],
            [
                'time' => '12:00',
                'cpu' => 40,
            ],
            [
                'time' => '13:00',
                'cpu' => 50,
            ],
        ]);
    }

    public function test(): void
    {
        $this->chart = new LineChart(
            'My caption',
            'My description',
            $this->data,
            'time',
            'Time',
            'Count',
            verticalAxisKeys: [
                'cpu',
            ],
            id: 'my-id',
            palette: Palette::Greyscale->value,
        );

        $this->assertEquals(
            'my-id',
            $this->chart->id,
        );

        $this->assertEquals(
            Palette::greyscale(),
            $this->chart->palette,
        );

        $this->assertEquals(
            [
                'cpu',
            ],
            $this->chart->verticalAxis->keys,
        );

        $this->assertCount(
            1,
            $this->chart->series,
        );

        $this->assertInstanceOf(
            Legend::class,
            $this->chart->legend,
        );

        $this->assertInstanceOf(
            HorizontalAxis::class,
            $this->chart->horizontalAxis,
        );

        $this->assertInstanceOf(
            VerticalAxis::class,
            $this->chart->verticalAxis,
        );
    }

    public function testWhenNull(): void
    {
        $this->chart = new LineChart(
            'My caption',
            'My description',
            $this->data,
            'time',
            'Time',
            'Count',
        );

        $this->assertStringStartsWith(
            'line-chart_',
            $this->chart->id,
        );

        $this->assertEquals(
            [
                'cpu',
            ],
            $this->chart->verticalAxis->keys,
        );
    }
}
