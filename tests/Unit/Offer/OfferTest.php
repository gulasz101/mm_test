<?php

declare(strict_types=1);

namespace Tests\Unit\Offer;

use App\Offer;
use PHPUnit\Framework\TestCase;

/**
 * Class OfferTest
 * @package Tests\Unit\Offer
 */
class OfferTest extends TestCase
{
    public function testPriceIsSet(): void
    {
        $offer = new Offer([
            'price' => 200,
        ]);

        $this->assertEquals(200, $offer->getPrice());
    }
}
