<?php

namespace atakajlo\cart\storage;

class SessionStorage implements StorageInterface
{
    /**
     * @var string
     */
    private $key;

    public function __construct($key = 'cart')
    {
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function load(): array
    {
        return isset($_SESSION[$this->key]) ? unserialize($_SESSION[$this->key]) : [];
    }

    /**
     * @param array $items
     * @return void
     */
    public function save(array $items): void
    {
        $_SESSION[$this->key] = serialize($items);
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        unset($_SESSION[$this->key]);
    }
}