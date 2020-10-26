<?php

declare(strict_types=1);

namespace App\Support;

/**
 * The Interface provides the contract for different readers
 * It can be XML, JSON Remote EntryPoint, or CSV, JSON, XML local files
 * @package App\Support
 */
interface ReaderInterface
{
    /**
     * Read in incoming data and parse to objects
     *
     * @param string $input
     * @return OfferCollectionInterface
     */
    public function read(string $input): OfferCollectionInterface;
}
