<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CoordsCalculator;
use App\Service\DataReader\ReaderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoordsCalculatorController extends AbstractController
{
    public function findNearby(ReaderInterface $reader, int $index, int $distance): JsonResponse
    {
        $dataCollection = $reader->read();
        if (!$dataCollection->offsetExists($index)) {
            return new JsonResponse(
                [
                    'error' => 'Element does not found',
                ],
                400
            );
        }

        $calculator = new CoordsCalculator(
            $dataCollection->offsetGet($index),
            $dataCollection
        );

        $resultCollection = $calculator->findNearby($distance);

        return new JsonResponse(
            $resultCollection->sortByDistance()->jsonSerialize()
        );
    }
}
