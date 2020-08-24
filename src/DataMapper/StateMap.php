<?php

namespace D2\DataMapper;

/**
 * The class stores the initial state of the entities.
 * This is needed to detect modified attributes.
 */
class StateMap
{
    private static array $map;

    public static function add(string $class, string $pkey, array $state): void
    {
        if (! isset(self::$map[$class][$pkey])) {
            self::$map[$class][$pkey] = $state;
        }
    }

    public static function has(string $class, string $pkey): bool
    {
        return isset(self::$map[$class][$pkey]);
    }

    public static function state(string $class, string $pkey): array
    {
        return isset(self::$map[$class][$pkey]) ? self::$map[$class][$pkey] : [];
    }

    public static function modifiedState(string $class, string $pkey, array $newState): array
    {
        $originState = self::state($class, $pkey);

        if (! $originState) {
            return $newState;
        }

        return array_diff($newState, $originState);
    }
}