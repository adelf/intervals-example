<?php

namespace Tests;

use App\Interval;

class IntervalTest extends BaseIntervalTest
{
    public function testValidDates()
    {
        $interval = new Interval($this->yesterday, $this->today);

        $this->assertEquals($this->yesterday, $interval->start);
        $this->assertEquals($this->today, $interval->end);
    }

    public function testInvalidDates()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Interval($this->today, $this->yesterday);
    }

    public function testNonEmpty()
    {
        $interval = new Interval($this->yesterday, $this->today);

        $this->assertFalse($interval->isEmpty());
    }

    public function testEmpty()
    {
        $interval = new Interval($this->today, $this->today);

        $this->assertTrue($interval->isEmpty());
    }
}
