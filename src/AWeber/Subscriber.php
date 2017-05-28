<?php

namespace AWeberForLaravel;

class Subscriber
{
    protected $values = [];
    public function __construct(array $data)
    {
        $this->values = $data;
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }
}
