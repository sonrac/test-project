<?php

declare(strict_types=1);

namespace App\Service\CalculatorResult;

interface ResultCollectionInterface extends \Iterator, \JsonSerializable
{
    public function sortByDistance(): ResultCollectionInterface;
}
