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
        return $this->start === $this->end;
    }

    /**
     * @param Interval $other
     * @return Interval[]
     */
    public function remove(Interval $other)
    {
        if ($this->start >= $other->end || $this->end <= $other->start) return [$this];

        if ($this->start >= $other->start && $this->end <= $other->end) return [];

        if ($this->start < $other->start && $this->end > $other->end) return [
            new Interval($this->start, $other->start),
            new Interval($other->end, $this->end),
        ];

        if ($this->start === $other->start) {
            return [new Interval($other->end, $this->end)];
        }

        return [new Interval($this->start, $other->start)];
    }
}