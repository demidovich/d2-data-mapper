<?php

namespace D2\DataMapper\State;

/**
 * The class stores the initial state of the entities.
 * This is needed to detect modified attributes.
 */
class StateMap
{
    private static array $map;

    public static function put(string $class, string $pkey, array $state): void
    {
        if (! isset(self::$map[$class][$pkey])) {
            self::$map[$class][$pkey] = $state;
        }
    }

    public static function get(string $class, string $pkey): ?array
    {
        return isset(self::$map[$class][$pkey]) ? self::$map[$class][$pkey] : null;
    }
}