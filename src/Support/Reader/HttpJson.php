<?php

declare(strict_types=1);

namespace App\Support\Reader;

use Illuminate\Support\Facades\Http;

/**
 * Class HttpJson
 * @package App\Support\Reader
 */
class HttpJson implements RawDataReader
{
    /** @var string */
    protected $input;

    /**
     * HttpJson constructor.
     * @param string $input
     */
    public function __construct(string $input)
    {
        $this->input = $input;
    }

    /**
     * Reads data from input and returns it as array.
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getDataArray(): array
    {
        $response = Http::timeout(5)
            ->acceptJson()
            ->get($this->input)
            ->throw();

        return $response->json();
    }
}
