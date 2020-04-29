<?php

namespace Tests;

use App\Interval;

class IntervalRemoveTest extends BaseIntervalTest
{
    public function testDifferent()
    {
        $interval = new Interval($this->minus10Days, $this->yesterday);

        $result = $interval->remove(new Interval($this->tomorrow, $this->plus10Days));

        $this->assertCount(1, $result);

        $this->assertEquals($this->minus10Days, $result[0]->start);
        $this->assertEquals($this->yesterday, $result[0]->end);
    }

    public function testFullyCovered()
    {
        $interval = new Interval($this->yesterday, $this->tomorrow);

        $this->assertEmpty($interval->remove(new Interval($this->minus10Days, $this->plus10Days)));
    }

    public function testFullyCoveredWithCommonStart()
    {
        $interval = new Interval($this->yesterday, $this->tomorrow);

        $this->assertEmpty($interval->remove(new Interval($this->yesterday, $this->plus10Days)));
    }

    public function testInsideStart()
    {
        $interval = new Interval($this->yesterday, $this->tomorrow);

        $result = $interval->remove(new Interval($this->yesterday, $this->today));

        $this->assertCount(1, $result);

        $this->assertEquals($this->today, $result[0]->start);
        $this->assertEquals($this->tomorrow, $result[0]->end);
    }

    public function testInside()
    {
        $interval = new Interval($this->minus10Days, $this->plus10Days);

        $result = $interval->remove(new Interval($this->yesterday, $this->tomorrow));

        $this->assertCount(2, $result);

        $this->assertEquals($this->minus10Days, $result[0]->start);
        $this->assertEquals($this->yesterday, $result[0]->end);

        $this->assertEquals($this->tomorrow, $result[1]->start);
        $this->assertEquals($this->plus10Days, $result[1]->end);
    }
}
