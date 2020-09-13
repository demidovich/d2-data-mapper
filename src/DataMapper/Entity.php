<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;
use D2\Hydrator\Hydrator;
use RuntimeException;

class Entity implements Stateable
{
    protected function init(): void
    {
    }

    /**
     * Array of value object prefixes in format [$prefix => $className]
     */
    protected static function valueObjectPrefixes(): array
    {
        return [];
    }

    public static function fromState($state)
    {
        $entityClass = get_called_class();

        if (method_exists($entityClass, '__construct')) {
            throw new RuntimeException("The hydrating class \"{$entityClass}\" cannot have a constructor.");
        }

        $hydrator = new Hydrator($entityClass);

        foreach (static::valueObjectPrefixes() as $prefix => $class) {
            $hydrator->addPrefix($prefix, $class);
        }

        if (! is_array($state)) {
            $state = (array) $state;
        }

        $instance = $hydrator->hydrate($state);
        $instance->init();

        return $instance;
    }

    public function toState(): array
    {
        $state = [];
        $prefixes = array_flip(static::valueObjectPrefixes());

        foreach (get_object_vars($this) as $attr => $value) {

            if (is_scalar($value)) {
                $state[$attr] = $value;
                continue;
            }

            if (! is_object($value)) {
                $state[$attr] = $value;
                continue;
            }

            if ($value instanceof Stateable) {
                $class  = get_class($value);
                $prefix = isset($prefixes[$class]) ? "{$prefixes[$class]}_" : null;
                foreach ($value->toState() as $k => $v) {
                    $state["{$prefix}{$k}"] = $v;
                }
            }

            elseif (method_exists($value, 'value')) {
                $state[$attr] = $value->value();
            }

            else {
                $state[$attr] = (string) $value;
            }
        }

        return $state;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
