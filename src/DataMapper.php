<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;
use RuntimeException;

class DataMapper
{
    protected string $entity;
    protected array  $fields;

    /**
     * Construct entity from state.
     * 
     * @param array|object $state
     * @return Stateable
     */
    protected function entity($state): ?Stateable
    {
        // if (! property_exists($this, 'entity')) {
        //     throw new RuntimeException(
        //         vsprintf('DataMapper realisation %s does not define "entity" property.', [
        //             get_called_class()
        //         ])
        //     );
        // }

        // if ($state) {
        //     $entity = ($this->entity)::fromState($state);
        //     if (! ($entity instanceof Stateable)) {
        //         throw new RuntimeException(
        //             vsprintf('The property "entity" of DataMapper realisation %s not implementing the %s.', [
        //                 get_called_class(),
        //                 Stateable::class
        //             ])
        //         );
        //     }
        // } else {
        //     $entity = null;
        // }

        // return $entity;

        return $state ? ($this->entity)::fromState($state) : null;
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
