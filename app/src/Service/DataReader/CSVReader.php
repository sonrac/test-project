<?php

declare(strict_types=1);

namespace App\Service\DataReader;

use App\Service\DataReader\Exception\FileNotFoundException;

class CSVReader implements ReaderInterface
{
    private string $filename;

    public function __construct(string $filename)
    {
        if (!\is_file($filename)) {
            throw new FileNotFoundException($filename);
        }

        $this->filename = $filename;
    }

    public function read(): DataCollectionInterface
    {
        $fileHandler = \fopen($this->filename, "r");

        \gc_enable();
        $items = [];
        while($nextData = \fgetcsv($fileHandler)) {
            $name = $nextData[0];
            $coords = \explode(',', $nextData[1]);

            $items[] = new GeoData(
                $name,
                (float) $coords[1],
                (float) $coords[0]
            );
        }

        \gc_collect_cycles();
        \gc_disable();

        return new DataCollection(...$items);
    }
}
