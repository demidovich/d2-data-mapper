<?php

namespace D2\DataMapper;

abstract class Entity
{
    abstract public function primaryKey(): string;

    abstract public static function fromState($state);
}