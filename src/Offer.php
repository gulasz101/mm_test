<?php

declare(strict_types=1);

namespace App;

use App\Support\OfferInterface;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * Class Offer
 * @package App
 */
class Offer implements OfferInterface
{
    /**
     * @var CarbonImmutable|null
     */
    private $startDate;

    /**
     * @var CarbonImmutable|null
     */
    private $endDate;

    /**
     * @var float|null
     */
    private $price;

    /**
     * @var int|null
     */
    private $quantity;

    /**
     * @var int|null
     */
    private $vendorId;

    /**
     * Offer constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if ($startDate = Arr::get($data, 'start_date')) {
            $this->startDate = Carbon::make($startDate)->toImmutable();
        }

        if ($endDate = Arr::get($data, 'end_date')) {
            $this->endDate = Carbon::make($endDate)->toImmutable();
        }

        $this->price = Arr::get($data, 'price');
        $this->quantity = Arr::get($data, 'quantity');
        $this->vendorId = Arr::get($data, 'vendor_id');
    }

    /**
     * @return CarbonImmutable|null
     */
    public function getStartDate(): ?CarbonImmutable
    {
        return $this->startDate;
    }

    /**
     * @return CarbonImmutable|null
     */
    public function getEndDate(): ?CarbonImmutable
    {
        return $this->endDate;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @return int|null
     */
    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }

    /**
     * Checks whether object has valid vendor id.
     * @return bool
     */
    public function hasVendorId(): bool
    {
        return null !== $this->vendorId;
    }

    /**
     * Checks whether object has valid price.
     * @return bool
     */
    public function hasPrice(): bool
    {
        return null !== $this->hasPrice();
    }

    /**
     * Checks whether object has valid start date.
     * @return bool
     */
    public function hasStartDate(): bool
    {
        return null !== $this->startDate;
    }

    /**
     * Checks whether object has valid end date.
     * @return bool
     */
    public function hasEndDate() : bool
    {
         return null !== $this->endDate;
    }

    /**
     * Checks whether object has valid quantity.
     * @return bool
     */
    public function hasQuantity(): bool
    {
        return null !== $this->quantity;
    }
}
