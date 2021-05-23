<?php

declare(strict_types=1);

namespace App\Service\DataReader;

interface ReaderInterface
{
    public function read(): DataCollectionInterface;
}
