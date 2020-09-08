<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;
use D2\DataMapper\State\StateMap;
use RuntimeException;

class DataMapper
{
    protected string $entity;
    protected string $primaryKey;
    protected array  $fields;

    protected function entity(array $state)
    {
        if (! $state) {
            return null;
        }

        if (! ($this->entity instanceof Stateable)) {
            throw new RuntimeException(
                "Entity class \"{$this->entity}\" does not implementing interface \"" . Stateable::class . "\""
            );
        }

        $pkey   = $state[$this->primaryKey];
        $entity = ($this->entity)::fromState($state);

        StateMap::put($this->entity, $pkey, $state);

        return $entity;
    }

    protected function state(Stateable $entity): array
    {
        $stateFields = array_flip($this->fields);

        return array_intersect_key(
            $entity->toState(), 
            $stateFields
        );
    }

    protected function stateDiff(Stateable $entity): array
    {
        $oldState = StateMap::get($this->entity, $this->primaryKey);
        $newState = $this->state($entity);

        return $oldState ? array_diff($newState, $oldState) : $newState;
    }
}
