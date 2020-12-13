<?php

declare(strict_types=1);

namespace App;

use App\Support\Reader\HttpJson;
use App\Support\Reader\RawDataReader;
use App\Support\ReaderInterface;
use Illuminate\Support\Str;

/**
 * Class Reader
 * @package App
 */
class Reader implements ReaderInterface
{
    /**
     * Read in incoming data and parse to objects
     *
     * @param string $input
     * @return OfferCollection
     */
    public function read(string $input): OfferCollection
    {
        $reader = $this->detectReader($input);

        return OfferCollection::createFromArray($reader->getDataArray());
    }

    protected function detectReader(string $input): RawDataReader
    {
        switch (true) {
            case Str::of($input)->containsAll(['http', 'json']):
                return new HttpJson($input);
            default:
                throw new \InvalidArgumentException('Input not supported: ' . $input);
        }
    }
}
