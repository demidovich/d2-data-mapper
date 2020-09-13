<?php

namespace Tests\Stubs;

class UserId
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}