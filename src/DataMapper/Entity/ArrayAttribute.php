<?php

namespace D2\DataMapper\Entity;

class ArrayAttribute
{
    private array $values = [];

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function values(): array
    {
        return $this->values;
    }

    public function put($value): void
    {
        $this->values[] = $value;
        $this->values = array_unique($this->values, SORT_STRING);
    }

    public function removeByValue($value): void
    {
        foreach ($this->values as $k => $v) {
            if ($v === $value) {
                unset($this->values[$k]);
            }
        }
    }

    public function removeAll(): void
    {
        $this->values = [];
    }
}