<?php

namespace atakajlo\cart\storage;

interface StorageInterface
{
    /**
     * @return array
     */
    public function load(): array;

    /**
     * @param array $items
     * @return void
     */
    public function save(array $items): void;

    /**
     * @return void
     */
    public function clear(): void;
}