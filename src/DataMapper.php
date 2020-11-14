<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;

class DataMapper
{
    protected string $entity;
    protected string $primaryKey;
    protected array  $fields;

    /**
     * Construct entity from state.
     * 
     * @param array|object $state
     * @return Stateable
     */
    protected function entity($state): ?Stateable
    {
        if (! $state) {
            return null;
        }

        return ($this->entity)::fromState($state);
    }

    /**
     * Fetch entity state.
     * 
     * @param Stateable $entity
     * @return array
     */
    protected function state(Stateable $entity): array
    {
        $stateFields = array_flip($this->fields);

        return array_intersect_key(
            $entity->toState(), 
            $stateFields
        );
    }
}
