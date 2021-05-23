<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\CalculatorResult\ResultCollection;
use App\Service\CalculatorResult\ResultCollectionInterface;
use App\Service\CalculatorResult\ResultItem;
use App\Service\DataReader\DataCollectionInterface;
use App\Service\DataReader\DataInterface;
use Ballen\Distical\Calculator;
use Ballen\Distical\Entities\LatLong;

class CoordsCalculator
{
    private DataInterface $startCoord;
    private DataCollectionInterface $dataCollection;
    private LatLong $startPoint;

    public function __construct(DataInterface $startCoord, DataCollectionInterface $dataCollection)
    {
        $this->startCoord = $startCoord;
        $this->dataCollection = $dataCollection;
        $this->startPoint = new LatLong($this->startCoord->getLatitude(), $this->startCoord->getLongitude());
    }

    public function findNearby(int $maxDistance, int $precision = 6): ResultCollectionInterface
    {
        $items = [];
        foreach ($this->dataCollection as $nextItem) {
            /** @var \App\Service\DataReader\DataInterface $nextItem */
            if ($nextItem->getName() === $this->startCoord->getName()) {
                continue;
            }

            $calculator = new Calculator($this->startPoint, new LatLong($nextItem->getLatitude(), $nextItem->getLongitude()));

            $currentDistance = $calculator->get()->asKilometres();

            if ($currentDistance > $maxDistance) {
                continue;
            }

            $items[] = new ResultItem($nextItem->getName(), \round($currentDistance, $precision));
        }

        return new ResultCollection(...$items);
    }
}
