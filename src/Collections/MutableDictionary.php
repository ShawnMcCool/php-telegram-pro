<?php namespace TelegramPro\Collections;

use Countable;
use ArrayIterator;
use IteratorAggregate;

class MutableDictionary implements IteratorAggregate, Countable
{
    private $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->items);
    }

    public function add(string $key, $value): void
    {
        $this->items[$key] = $value;
    }

    public function get(string $key)
    {
        return isset($this->items[$key]) ? $this->items[$key] : null;
    }

    public function remove(string $key): void
    {
        unset($this->items[$key]);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function merge(MutableDictionary $that): void
    {
        if (get_class($this) !== get_class($that)) {
            throw CollectionTypeError::cannotMergeDifferentTypes($this, $that);
        }
        $this->items = array_merge($this->items, $that->items);
    }

    public function copy(): MutableDictionary
    {
        return clone $this;
    }

    /**
     * Don't forget to return [$key=>$value] to maintain associativity.
     *
     * @param callable $f
     * @return Dictionary
     * @throws DictionaryMapFunctionHasIncorrectReturnFormat
     */
    public function map(callable $f): MutableDictionary
    {
        $newItems = [];

        foreach ($this->items as $key => $value) {
            $result = $f($value, $key);

            if (
                count($result) != 1 ||
                ! is_array($result)
            ) {
                throw new DictionaryMapFunctionHasIncorrectReturnFormat("When calling `map` on a Dict the function must always use this format: return [key=>value]. Received " . json_encode($result) . " instead.");
            }

            $newItems[key($result)] = $result[key($result)];
        }

        return new MutableDictionary($newItems);
    }

    public function filter(?callable $f = null): MutableDictionary
    {
        return new static(array_filter($this->items, $f, ARRAY_FILTER_USE_BOTH));
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function toCollection(): Collection
    {
        return new Collection(array_values($this->items));
    }

    public static function of(array $associativeArray): self
    {
        return new static($associativeArray);
    }

    public static function empty(): MutableDictionary
    {
        return new static;
    }
}
