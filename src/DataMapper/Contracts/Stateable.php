<?php

namespace D2\DataMapper\Contracts;

interface Stateable
{
    public static function fromState(array $state);

    public function toState(): array;
}
