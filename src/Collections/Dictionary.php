<?php namespace TelegramPro\Collections;

use Countable;
use ArrayAccess;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;

class Dictionary implements IteratorAggregate, Countable, ArrayAccess, JsonSerializable
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

    public function add(string $key, $value): Dictionary
    {
        $newItems = $this->items;
        $newItems[$key] = $value;
        return new static($newItems);
    }

    public function get(string $key)
    {
        return isset($this->items[$key]) ? $this->items[$key] : null;
    }

    public function remove(string $key): Dictionary
    {
        $newItems = $this->items;
        unset($newItems[$key]);
        return new static($newItems);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function keys(): Collection
    {
        return new Collection(array_keys($this->items));
    }

    public function values(): Collection
    {
        return new Collection(array_values($this->items));
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function merge(Dictionary $that): Dictionary
    {
        if (get_class($this) !== get_class($that)) {
            throw CollectionTypeError::cannotMergeDifferentTypes($this, $that);
        }
        $newItems = array_merge($this->items, $that->items);
        return new static($newItems);
    }

    public function copy(): Dictionary
    {
        return clone $this;
    }

    /**
     * Callable argument is $value, $key
     *
     * @param callable $f
     */
    public function each(callable $f)
    {
        array_walk($this->items, $f);
    }

    /**
     * Don't forget to return [$key=>$value] to maintain associativity.
     *
     * @param callable $f
     * @return Dictionary
     * @throws DictionaryMapFunctionHasIncorrectReturnFormat
     */
    public function map(callable $f): Dictionary
    {
        $newItems = [];

        foreach ($this->items as $key => $value) {
            $result = $f($key, $value);

            if (
                count($result) != 1 ||
                ! is_array($result)
            ) {
                throw new DictionaryMapFunctionHasIncorrectReturnFormat("When calling `map` on a Dictionary the function must always use this format: return [key=>value]. Received " . json_encode($result) . " instead.");
            }

            $newItems[key($result)] = $result[key($result)];
        }

        return new static($newItems);
    }

    /**
     * The arguments to the callback function are in the order of VALUE, KEY
     * @param callable|null $f
     * @return Dictionary
     */
    public function filter(?callable $f = null): Dictionary
    {
        return new static(array_filter($this->items, $f, ARRAY_FILTER_USE_BOTH));
    }

    public function toCollection(): Collection
    {
        return new Collection(array_values($this->items));
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    # Array Access

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        throw new CannotWriteToImmutableDictionaryUsingArrayAccess();
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        throw new CannotWriteToImmutableDictionaryUsingArrayAccess();
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public static function of(array $associativeArray): Dictionary
    {
        return new static($associativeArray);
    }

    public static function empty(): Dictionary
    {
        return new static;
    }
}
