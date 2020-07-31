<?php

namespace Tests\Stubs;

class BookId
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;        
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}