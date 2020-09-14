<?php

namespace D2\DataMapper\ValueObjects;

use D2\DataMapper\Contracts\Stateable;
use D2\DataMapper\Contracts\ValueObject;

class Id implements ValueObject, Stateable
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

    public function equalTo(ValueObject $other): bool
    {
        return $this->value === $other->value() && \get_called_class() === \get_class($other);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->primitive;
    }
}
