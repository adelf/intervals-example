<?php

namespace Tests;

use App\Interval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class IntervalTest extends TestCase
{
    private DateTimeImmutable $today;
    private DateTimeImmutable $yesterday;
    private DateTimeImmutable $tomorrow;

    protected function setUp(): void
    {
        $this->today = new DateTimeImmutable();
        $this->yesterday = $this->today->sub(\DateInterval::createFromDateString("1 day"));
        $this->tomorrow = $this->today->add(\DateInterval::createFromDateString("1 day"));

        parent::setUp();
    }

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
