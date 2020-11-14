<?php

namespace D2\DataMapper\State;

use D2\DataMapper\Contracts\Stateable;

/**
 * The class stores the initial state of the entities.
 * This is needed to detect modified attributes.
 */
class StateMap
{
    private static array $map;

    public static function put(Stateable $entity, $pkey): void
    {
        $class = get_class($entity);

        if ($pkey instanceof Stateable) {
            $pkey = $pkey->toState();
        }

        if (! isset(self::$map[$class][$pkey])) {
            self::$map[$class][$pkey] = $entity->toState();
        }
    }

    public static function diff(Stateable $entity, $pkey): ?array
    {
        $class = get_class($entity);

        if ($pkey instanceof Stateable) {
            $pkey = $pkey->toState();
        }

        if (! isset(self::$map[$class][$pkey])) {
            return $entity->toState();
        }

        $prev = self::$map[$class][$pkey];
        $curr = $entity->toState();
        $diff = [];

        foreach ($curr as $k => $v) {
            if (! array_key_exists($k, $prev) || $prev[$k] != $v) {
                $diff[$k] = $v;
            }
        }

        return $diff;
    }
}