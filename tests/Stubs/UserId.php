<?php

namespace Tests\Stubs;

use D2\DataMapper\Contracts\Stateable;

class UserId implements Stateable
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toState(): int
    {
        return $this->value;
    }

    public function value(): int
    {
        return $this->value;
    }
}