<?php

namespace tests\storage;

use atakajlo\cart\storage\StorageInterface;

class FakeStorage implements StorageInterface
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @return array
     */
    public function load(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return void
     */
    public function save(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->items = [];
    }
}