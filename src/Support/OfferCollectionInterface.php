<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Interface for The Collection class that contains OffersŁ
 * @package App\Support
 */
interface OfferCollectionInterface
{
    /**
     * Add offer to the collection
     *
     * @param OfferInterface $offer
     * @return void
     */
    public function add(OfferInterface $offer): void;

    /**
     * Get offer at specific index
     *
     * @param int $index
     * @return OfferInterface
     */
    public function get(int $index): OfferInterface;

    /**
     * @return \Iterator
     */
    public function getIterator(): \Iterator;
}
