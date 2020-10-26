<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Arr;

/**
 * Class DataStorage
 * @package App\Support
 */
class DataStorageIterable implements \Iterator
{
    private $pointer;
    private $data;

    /**
     * DataStorageIterable constructor.
     */
    public function __construct()
    {
        $this->pointer = 0;
        $this->data = [];
    }

    /**
     * @param $item
     */
    protected function addToStorage($item)
    {
        $this->data[] = $item;
    }

    /**
     * @param $identifier
     * @return array|\ArrayAccess|mixed
     */
    protected function getFromStorage($identifier)
    {
        return Arr::get(
            $this->data,
            $identifier,
            function () {
                throw new \InvalidArgumentException('Identifier not found.');
            }
        );
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return Arr::exists($this->data, $this->pointer);
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->pointer;
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->data[$this->pointer];
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->pointer = 0;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return string|float|int|bool|null scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->pointer;
    }
}
