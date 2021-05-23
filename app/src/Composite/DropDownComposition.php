<?php

declare(strict_types=1);

namespace App\Composite;

use App\Service\DataReader\ReaderInterface;

class DropDownComposition
{
    private ReaderInterface $reader;

    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    public function getDropDownAttributes(): array
    {
        $collection = $this->reader->read();

        $items = [];
        foreach ($collection as $key => $nextItem) {
            /** @var \App\Service\DataReader\DataInterface $nextItem */
            $items[$key] = $nextItem->getName();
        }

        return $items;
    }
}
