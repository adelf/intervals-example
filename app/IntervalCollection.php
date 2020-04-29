<?php

namespace App;

/** @mixin Interval[] */
class IntervalCollection extends \ArrayIterator
{
    public function diff(IntervalCollection $other): IntervalCollection
    {
        /** @var Interval[] $items */
        $items = $this->getArrayCopy();
        foreach ($other as $interval) {
            $newItems = [];
            foreach ($items as $ourInterval) {
                array_push($newItems, ...$ourInterval->remove($interval));
            }
            $items = $newItems;
        }

        return new self($items);
    }
}