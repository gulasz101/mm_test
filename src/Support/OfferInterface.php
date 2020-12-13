<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonImmutable;

/**
 * Interface the Data Transfer Object, that is representation of external JSON Data
 * @package App\Support
 */
interface OfferInterface
{
    /**
     * Checks whether object has valid start date.
     * @return bool
     */
    public function hasStartDate(): bool;

    /**
     * Checks whether object has valid end date.
     * @return bool
     */
    public function hasEndDate(): bool;

    /**
     * Checks whether object has valid price.
     * @return bool
     */
    public function hasPrice(): bool;

    /**
     * Checks whether object has valid quantity.
     * @return bool
     */
    public function hasQuantity(): bool;

    /**
     * Checks whether object has valid vendor id.
     * @return bool
     */
    public function hasVendorId(): bool;

    /**
     * @return CarbonImmutable|null
     */
    public function getStartDateOrFail(): ?CarbonImmutable;

    /**
     * @return CarbonImmutable|null
     */
    public function getEndDateOrFail(): ?CarbonImmutable;

    /**
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * @return int|null
     */
    public function getQuantity(): ?int;

    /**
     * @return string|null
     */
    public function getVendorId(): ?string;
}
