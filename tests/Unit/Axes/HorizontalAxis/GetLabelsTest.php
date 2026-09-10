<?php

namespace AnthonyEdmonds\LaravelGraph\Tests\Unit\Axes\HorizontalAxis;

use AnthonyEdmonds\LaravelGraph\Axes\HorizontalAxis;
use AnthonyEdmonds\LaravelGraph\Tests\TestCase;

class GetLabelsTest extends TestCase
{
    protected HorizontalAxis $axis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->axis = $this->makeChart()->horizontalAxis;
    }

    public function test_when_wide(): void
    {
        $this->axis->width = 600;

        $this->assertEquals(
            [
                '09:00',
                '10:00',
                '11:00',
                '12:00',
                '13:00',
            ],
            $this->axis->getLabels(),
        );
    }

    public function test_when_narrow(): void
    {
        $this->axis->width = 200;

        $this->assertEquals(
            [
                '09:00',
                '',
                '11:00',
                '',
                '13:00',
            ],
            $this->axis->getLabels(),
        );
    }
}
