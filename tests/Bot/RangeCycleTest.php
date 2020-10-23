<?php namespace Tests\Bot;

use PHPUnit\Framework\TestCase;

class RangeCycleTest extends TestCase
{
    public function testNext()
    {
        $range = new RangeCycle(
            ['a', 'b', 'c', 'd'],
            0, 3
        );
        
        self::assertSame('a', $range->next());
        self::assertSame('d', $range->next());
        self::assertSame('c', $range->next());
        self::assertSame('b', $range->next());
        self::assertSame('a', $range->next());
    }
}
