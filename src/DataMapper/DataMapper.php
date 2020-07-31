<?php

namespace D2\DataMapper;

use D2\Entity\EntityBuilder;

abstract class DataMapper
{
    protected string $entity;
    protected string $primaryKey;

    private array $identityMap = [];

    public function mappedEntity(string $primaryKey)
    {
        return isset($this->identityMap[$primaryKey]) ? $this->identityMap[$primaryKey] : null;
    }

    public function entity($row)
    {
        if (! $row) {
            return null;
        }

        if (! is_array($row)) {
            $row = (array) $row;
        }

        $pkey = $row[$this->primaryKey];

        if (! isset($this->identityMap[$pkey])) {
            $this->identityMap[$pkey] = EntityBuilder::byConstructor($this->entity, $row);
        }

        return $this->identityMap[$pkey];
    }

    public function store($entity): void
    {

    }
}