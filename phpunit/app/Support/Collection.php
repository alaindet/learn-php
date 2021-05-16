<?php

namespace App\Support;

use \IteratorAggregate;
use \JsonSerializable;
use \ArrayIterator;

class Collection implements IteratorAggregate, JsonSerializable
{
    protected $items;

    public function __construct(array $items = [])
    {
        $this->set($items);
    }

    /**
     * From IteratorAggregate interface
     *
     * @return void
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * From JsonSerializable interface
     * Returns argument to use when using json_encode() on this object
     *
     * @return string
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function set(array $items): void
    {
        $this->items = $items;
    }

    public function get(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function add(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }

    public function merge(Collection $collection)
    {
        return $this->add($collection->get());
    }

    public function toJson()
    {
        return json_encode($this->items);
    }
}
