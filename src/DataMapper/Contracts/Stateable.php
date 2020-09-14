<?php

namespace D2\DataMapper\Contracts;

interface Stateable
{
    public static function fromState($state);

    public function toState();
}
