<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Series;

use AnthonyEdmonds\LaravelGraph\Enums\PointType;
use AnthonyEdmonds\LaravelGraph\Series\Series;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class PositionForTest extends TestCase
{
    protected Series $series;

    protected function setUp(): void
    {
        parent::setUp();

        $chart = $this->makeChart();
        $chart->verticalAxis->preRender();
        $chart->horizontalAxis->preRender();

        $this->series = $chart->series[0];
    }

    #[DataProvider('expectations')]
    public function test(
        string $axis,
        PointType $point,
        int $expected,
    ): void {
        $this->series->pointShape = $point;

        $this->assertEquals(
            $expected,
            $this->series->positionFor(0, $axis),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'axis' => 'x',
                'point' => PointType::Square,
                'expected' => 47,
            ],
            [
                'axis' => 'y',
                'point' => PointType::Square,
                'expected' => 299,
            ],
            [
                'axis' => 'x',
                'point' => PointType::Circle,
                'expected' => 50,
            ],
            [
                'axis' => 'y',
                'point' => PointType::Circle,
                'expected' => 302,
            ],
            [
                'axis' => 'x',
                'point' => PointType::Text,
                'expected' => 50,
            ],
            [
                'axis' => 'y',
                'point' => PointType::Text,
                'expected' => 298,
            ],
        ];
    }
}
