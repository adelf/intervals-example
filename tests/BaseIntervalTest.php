<?php

namespace Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

abstract class BaseIntervalTest extends TestCase
{
    protected DateTimeImmutable $today;
    protected DateTimeImmutable $yesterday;
    protected DateTimeImmutable $tomorrow;

    protected DateTimeImmutable $minus5Days;
    protected DateTimeImmutable $plus5Days;

    protected DateTimeImmutable $minus10Days;
    protected DateTimeImmutable $plus10Days;

    protected function setUp(): void
    {
        $this->today = new DateTimeImmutable();
        $this->yesterday = $this->today->sub(\DateInterval::createFromDateString("1 day"));
        $this->tomorrow = $this->today->add(\DateInterval::createFromDateString("1 day"));

        $this->minus5Days = $this->today->sub(\DateInterval::createFromDateString("5 day"));
        $this->plus5Days = $this->today->add(\DateInterval::createFromDateString("5 day"));

        $this->minus10Days = $this->today->sub(\DateInterval::createFromDateString("10 day"));
        $this->plus10Days = $this->today->add(\DateInterval::createFromDateString("10 day"));

        parent::setUp();
    }
}
