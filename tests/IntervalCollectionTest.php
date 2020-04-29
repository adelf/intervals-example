<?php

namespace Tests;

use App\Interval;
use App\IntervalCollection;

class IntervalCollectionTest extends BaseIntervalTest
{
    public function testDifferent()
    {
        $interval1 = new Interval($this->minus10Days, $this->yesterday);
        $interval2 = new Interval($this->today, $this->plus10Days);

        $collection = new IntervalCollection([$interval1, $interval2]);

        $result = $collection->diff(new IntervalCollection([
            new Interval($this->yesterday, $this->today)
        ]));

        $this->assertCount(2, $result);

        $this->assertEquals($interval1, $result[0]);
        $this->assertEquals($interval2, $result[1]);
    }

    public function testInside()
    {
        $collection = new IntervalCollection([
            new Interval($this->minus10Days, $this->yesterday),
            new Interval($this->today, $this->plus10Days),
        ]);

        $result = $collection->diff(new IntervalCollection([
            new Interval($this->minus5Days, $this->yesterday),
            new Interval($this->tomorrow, $this->plus5Days),
        ]));

        $this->assertCount(3, $result);

        $this->assertEquals(new Interval($this->minus10Days, $this->minus5Days), $result[0]);
        $this->assertEquals(new Interval($this->today, $this->tomorrow), $result[1]);
        $this->assertEquals(new Interval($this->plus5Days, $this->plus10Days), $result[2]);
    }

    // Tons of other tests here!
}
