<?php namespace Tests\Bot;

final class RangeCycle
{
    private array $range;
    private int $rangeCount;
    private int $startIndex;
    private int $currentIndex;
    private int $summand;

    public function __construct(
        array $range,
        int $startIndex = 0,
        int $summand = 1
    ) {
        $this->range = array_values($range);
        $this->rangeCount = count($this->range);
        $this->startIndex = $startIndex;
        $this->currentIndex = $startIndex;
        $this->summand = $summand;
    }

    public function next()
    {
        $current = $this->currentIndex;

        $this->currentIndex = ($this->currentIndex + $this->summand) % $this->rangeCount;
        
        return $this->range[$current];
    }
}