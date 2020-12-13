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
    private int $pointer;

    private array $data;

    /**
     * DataStorageIterable constructor.
     */
    public function __construct()
    {
        $this->pointer = 0;
        $this->data = [];
    }

    /**
     * Allows to filter Iterable, returns new filtered instance.
     * @param \Closure $whereClosure Usage same like with array_filter.
     * @return static
     */
    public function where(\Closure $whereClosure)
    {
        $clone = clone $this;

        $clone->pointer = 0;
        $clone->data = Arr::where($this->data, $whereClosure);

        return $clone;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
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
    public function next(): void
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
    public function rewind(): void
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

    /**
     * @param $item
     */
    protected function addToStorage($item): void
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
            function (): void {
                throw new \InvalidArgumentException('Identifier not found.');
            }
        );
    }
}
