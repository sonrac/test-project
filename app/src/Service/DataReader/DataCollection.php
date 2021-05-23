<?php

declare(strict_types=1);

namespace App\Service\DataReader;

class DataCollection implements DataCollectionInterface
{
    private $items;
    private $position = 0;

    public function __construct(DataInterface ...$items)
    {
        $this->items = $items;
    }

    public function current(): DataInterface
    {
        return $this->items[$this->position];
    }

    public function next(): DataInterface
    {
        ++$this->position;

        return $this->current();
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->items[$this->position + 1]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @param int $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param int $offset
     *
     * @return \App\Service\DataReader\DataInterface
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \InvalidArgumentException("Offset {$offset} does not exists");
        }

        return $this->items[$offset];
    }

    /**
     * @param int $offset
     * @param \App\Service\DataReader\DataInterface $value
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)) {
            return;
        }

        unset($this->items[$offset]);
    }
}
