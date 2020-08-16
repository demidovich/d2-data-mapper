<?php

namespace D2\DataMapper\Entity;

interface StateableEntity
{
    public static function fromState($state);
}