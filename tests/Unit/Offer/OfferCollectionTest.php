<?php

declare(strict_types=1);

namespace Tests\Unit\Offer;

use App\OfferCollection;
use App\Support\OfferInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class OfferCollectionTest
 * @package Tests\Unit\Offer
 */
class OfferCollectionTest extends TestCase
{
    public function testFilterByPrice(): void
    {
        $collection = OfferCollection::createFromArray(
            [
                ['price' => 5],
                ['price' => 20],
                ['vendor_id' => 'foo:bar'],
            ]
        );

        $this->assertCount(
            1,
            $collection->where(
                function (OfferInterface $offer) {
                    if ($offer->hasPrice()) {
                        return $offer->getPrice() >= 4 && $offer->getPrice() <= 5;
                    }

                    return false;
                }
            )
        );
    }
}
