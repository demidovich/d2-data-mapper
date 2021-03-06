<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;
use D2\DataMapper\State\StateMap;
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
        $hydrator = Hydrator::onClass($entityClass);

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
        $state    = [];
        $prefixes = array_flip(static::valueObjectPrefixes());

        foreach (get_object_vars($this) as $attr => $value) {

            if (is_scalar($value) || $value === null) {
                $state[$attr] = $value;
                continue;
            }

            if (! ($value instanceof Stateable)) {
                continue;
            }

            $attrState = $value->toState();

            if (is_scalar($attrState)) {
                $state[$attr] = $attrState;
            }

            elseif (is_array($attrState)) {
                $class  = get_class($value);
                $prefix = isset($prefixes[$class]) ? "{$prefixes[$class]}_" : null;
                foreach ($value->toState() as $k => $v) {
                    $state["{$prefix}{$k}"] = $v;
                }
            }

            else {
                throw new RuntimeException(
                    "Results toState() method can be a scalar or array. Attribute \"{$attr}\"."
                );
            }
        }

        return $state;
    }

    /**
     * Difference beetween trackable and current states.
     */
    public function toDiffState(): array
    {
        return StateMap::diff($this);
    }

    /**
     * Primary key field name.
     */
    public static function primaryKeyField()
    {
        return 'id';
    }

    /**
     * Value of the primary key.
     */
    public function primaryKey()
    {
        return $this->{static::primaryKeyField()};
    }

    /**
     * Enable tracking of entity state.
     */
    public function trackState(): void
    {
        StateMap::put($this);
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }
}
