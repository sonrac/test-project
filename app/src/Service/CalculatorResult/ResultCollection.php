<?php

declare(strict_types=1);

namespace App\Service\CalculatorResult;

class ResultCollection implements ResultCollectionInterface
{
    private array $items;
    private int $position = 0;

    public function __construct(ResultItemInterface ...$items)
    {
        $this->items = $items;
    }


    public function current(): ResultItemInterface
    {
        return $this->items[$this->position];
    }

    public function next(): ResultItemInterface
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

    public function jsonSerialize(): array
    {
        $data = [];

        foreach ($this->items as $item) {
            $data[$item->getPlaceName()] = $item->getDistanceInKm();
        }

        return $data;
    }

    public function sortByDistance(): ResultCollectionInterface
    {
        \usort(
            $this->items,
            function (ResultItemInterface $firstResult, ResultItemInterface $secondResult) {
                return $firstResult->getDistanceInKm() > $secondResult->getDistanceInKm();
        });

        return $this;
    }
}
