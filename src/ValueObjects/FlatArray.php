<?php

namespace D2\DataMapper\ValueObjects;

class FlatArray
{
    private $values;

    public function __construct($values)
    {
        $this->values = $values;
    }

    public function push($value): void
    {
        $this->values[] = $value;
        $this->values = array_unique($this->values, SORT_STRING);
    }

    public function removeByValue($value): void
    {
        foreach ($this->values as $k => $v) {
            if ($v == $value) {
                unset($this->values[$k]);
            }
        }
    }

    public function removeAll(): void
    {
        $this->values = [];
    }

    public function values(): array
    {
        return $this->values;
    }

    public function count(): int
    {
        return count($this->values);
    }
}
