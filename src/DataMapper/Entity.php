<?php

namespace D2\DataMapper;

abstract class Entity
{
    abstract public static function fromState($state);
}