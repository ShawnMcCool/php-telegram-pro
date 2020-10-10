<?php namespace TelegramPro\Bot\Types;

use Countable;
use Exception;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use TelegramPro\Collections\Collection;
use TelegramPro\Bot\Methods\Types\Message;

abstract class ArrayOfApiTypes implements Countable, IteratorAggregate, ArrayAccess
{
    protected Collection $items;

    protected function __construct(Collection $messages)
    {
        $this->items = $messages;
    }

    public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }
    
    public function count()
    {
        return $this->items->count();
    }

    public function getIterator(): ArrayIterator
    {
        return $this->items->getIterator();
    }

    public function get(int $index): ?Message
    {
        return $this->items[$index];
    }

    abstract static function fromApi($items): self;

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        throw new Exception('temporary exception - can not set');
    }

    public function offsetUnset($offset)
    {
        throw new Exception('temporary exception - can not unset');
    }
}