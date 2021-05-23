<?php

declare(strict_types=1);

namespace App\Service\DataReader\Exception;

use Throwable;

class FileNotFoundException extends \InvalidArgumentException
{
    protected $message = 'File not %s found';

    public function __construct(string $filename)
    {
        parent::__construct(\sprintf($this->message, $filename), 5000, null);
    }
}
