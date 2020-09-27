<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;
use D2\DataMapper\State\StateMap;

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
     * Construct entity from state with modification tracking.
     * 
     * @param array|object $state
     * @return Stateable
     */
    protected function modifiableEntity($state): ?Stateable
    {
        $entity = $this->entity($state);

        if ($entity) {
            $pkey = $state[$this->primaryKey];
            StateMap::put($this->entity, $pkey, $state);
        }

        return $entity;
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

    /**
     * Fetch entity modified state.
     * 
     * @param Stateable $entity
     * @return array
     */
    protected function modifiedState(Stateable $entity): array
    {
        $pkeyName  = $this->primaryKey;
        $pkeyValue = $entity->$pkeyName->toState();

        $old = StateMap::get($this->entity, $pkeyValue);
        $new = $this->state($entity);

        return $old ? array_diff($new, $old) : $new;
    }
}
