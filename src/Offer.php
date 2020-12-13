<?php

declare(strict_types=1);

namespace App;

use App\Support\OfferInterface;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;

/**
 * Class Offer
 * @package App
 */
class Offer implements OfferInterface
{
    private ?\Carbon\CarbonImmutable $startDate;

    private ?\Carbon\CarbonImmutable $endDate;

    private ?float $price;

    private ?int $quantity;

    private ?string $vendorId;

    /**
     * Offer constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if ($startDate = Arr::get($data, 'start_date')) {
            $this->startDate = Carbon::parse($startDate)->toImmutable();
        }

        if ($endDate = Arr::get($data, 'end_date')) {
            $this->endDate = Carbon::parse($endDate)->toImmutable();
        }

        $this->price = Arr::get($data, 'price');
        $this->quantity = Arr::get($data, 'quantity');
        $this->vendorId = Arr::get($data, 'vendor_id');
    }

    /**
     * @return CarbonImmutable
     */
    public function getStartDateOrFail(): CarbonImmutable
    {
        if (isset($this->startDate)) {
            return $this->startDate;
        }

        throw new \InvalidArgumentException('Missing startDate in offer');
    }

    /**
     * @return CarbonImmutable
     */
    public function getEndDateOrFail(): CarbonImmutable
    {
        if (isset($this->endDate)) {
            return $this->endDate;
        }

        throw new \InvalidArgumentException('Missing endDate in offer.');
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return (float) $this->price;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return (int) $this->quantity;
    }

    /**
     * @return string|null
     */
    public function getVendorId(): ?string
    {
        return $this->vendorId;
    }

    /**
     * Checks whether object has valid vendor id.
     * @return bool
     */
    public function hasVendorId(): bool
    {
        return $this->vendorId !== null;
    }

    /**
     * Checks whether object has valid price.
     * @return bool
     */
    public function hasPrice(): bool
    {
        return $this->price !== null;
    }

    /**
     * Checks whether object has valid start date.
     * @return bool
     */
    public function hasStartDate(): bool
    {
        return $this->startDate !== null;
    }

    /**
     * Checks whether object has valid end date.
     * @return bool
     */
    public function hasEndDate(): bool
    {
        return $this->endDate !== null;
    }

    /**
     * Checks whether object has valid quantity.
     * @return bool
     */
    public function hasQuantity(): bool
    {
        return $this->quantity !== null;
    }
}
