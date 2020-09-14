<?php

namespace D2\DataMapper\ValueObjects;

use D2\DataMapper\Contracts\Stateable;
use D2\DataMapper\Contracts\ValueObject;

class Uuid implements ValueObject, Stateable
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toState(): string
    {
        return $this->value;
    }

    public function equalTo(ValueObject $other): bool
    {
        return $this->value === $other->value() && \get_called_class() === \get_class($other);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->primitive;
    }
}
