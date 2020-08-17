<?php

namespace D2\DataMapper\Entity;

interface Stateable
{
    public static function fromState($state);
}