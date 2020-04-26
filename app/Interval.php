<?php

namespace App;

use DateTimeImmutable;

class Interval
{
    public DateTimeImmutable $start;
    public DateTimeImmutable $end;

    public function __construct(DateTimeImmutable $start, DateTimeImmutable $end)
    {
        if ($start > $end) {
            throw new \InvalidArgumentException("Invalid date interval");
        }

        $this->start = $start;
        $this->end = $end;
    }

    public function isEmpty(): bool
    {
        return $this->start->getTimestamp() == $this->end->getTimestamp();
    }
}