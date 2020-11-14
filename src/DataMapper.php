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
     * @param Entity $entity
     * @return array
     */
    protected function state(Entity $entity): array
    {
        $stateFields = array_flip($this->fields);

        return array_intersect_key(
            $entity->toState(), 
            $stateFields
        );
    }

    /**
     * Fetch entity state differences. 
     * This is available if $entity->trackState() has been called. 
     * Without calling $entity->trackState() method returns all stateable parameters. 
     * 
     * @param Entity $entity
     * @return array
     */
    protected function diffState(Entity $entity): array
    {
        $stateFields = array_flip($this->fields);

        return array_intersect_key(
            $entity->toDiffState(),
            $stateFields
        );
    }
}
