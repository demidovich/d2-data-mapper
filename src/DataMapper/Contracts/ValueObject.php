<?php

namespace D2\DataMapper\Contracts;

interface ValueObject
{
    public function value();

    public function equalTo(ValueObject $other): bool;
}