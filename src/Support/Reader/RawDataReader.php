<?php

declare(strict_types=1);

namespace App\Support\Reader;

/**
 * Interface RawDataReader
 * @package App\Support\Reader
 */
interface RawDataReader
{
    /**
     * Reads data from input and returns it as array.
     * @return array
     */
    public function getDataArray(): array;
}
