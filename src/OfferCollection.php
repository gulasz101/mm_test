<?php

declare(strict_types=1);

namespace App;

use App\Support\DataStorageIterable;
use App\Support\OfferCollectionInterface;
use App\Support\OfferInterface;

/**
 * Class OfferCollection
 * @package App\Support
 */
class OfferCollection extends DataStorageIterable implements OfferCollectionInterface
{

    /**
     * Creates offer collection from array.
     * @param array $offers
     * @return OfferCollection
     */
    public static function createFromArray(array $offers): OfferCollection
    {
        $collection = new self();
        foreach ($offers as $offerDataRow) {
            $collection->add(new Offer($offerDataRow));
        }

        return $collection;
    }

    /**
     * Get offer at specific index
     *
     * @param int $index
     * @return OfferInterface
     */
    public function get(int $index): OfferInterface
    {
        return $this->getFromStorage($index);
    }

    /**
     * Add offer to the collection
     *
     * @param OfferInterface $offer
     * @return void
     */
    public function add(OfferInterface $offer): void
    {
        $this->addToStorage($offer);
    }

    /**
     * @return \Iterator
     */
    public function getIterator(): \Iterator
    {
        return $this;
    }
}
