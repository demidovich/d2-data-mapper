<?php

namespace D2\DataMapper;

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
}