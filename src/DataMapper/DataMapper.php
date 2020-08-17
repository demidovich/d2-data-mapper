<?php

namespace D2\DataMapper;

use D2\DataMapper\Entity;
use RuntimeException;

abstract class DataMapper
{
    protected string $entity;
    protected string $primaryKey;
    protected array  $fields;

    private array $identityMap = [];

    // public function mappedEntity(string $primaryKey)
    // {
    //     return isset($this->identityMap[$primaryKey]) ? $this->identityMap[$primaryKey] : null;
    // }

    public function entity($row)
    {
        if (! $row) {
            return null;
        }

        if (! is_array($row)) {
            $row = (array) $row;
        }

        $pkey   = $row[$this->primaryKey];
        $entity = $this->entity;

        if (! is_subclass_of($this->entity, Entity::class)) {
            throw new RuntimeException("The class $entity must be implements an interface " . Entity::class);
        }

        if (! isset($this->identityMap[$pkey])) {
            $this->identityMap[$pkey] = $entity::fromState($row);
        }

        return $this->identityMap[$pkey];
    }

    public function persistedFields($entity): void
    {
        // Собираем в кучу
        // Описание полей в маппере
        // Данные из сущности
        // Данные из unit of works
    }
}