<?php

namespace D2\DataMapper\Entity;

use D2\Hydrator\Hydrator;
use RuntimeException;

trait Hydratable
{
    public static function fromState($state)
    {
        $class = get_called_class();

        if (method_exists($class, '__construct')) {
            throw new RuntimeException("The hydrating class \"{$class}\" cannot have a constructor.");
        }

        $hydrator = new Hydrator($class);

        foreach (static::statePrefixes() as $prefix => $class) {
            $hydrator->addPrefix($prefix, $class);
        }

        if (! is_array($state)) {
            $state = (array) $state;
        }

        $instance = $hydrator->hydrate($state);
        $instance->init();

        return $instance;
    }

    protected function init(): void
    {
    }

    protected static function statePrefixes(): array
    {
        return [];
    }
}