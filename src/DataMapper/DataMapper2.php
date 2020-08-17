<?php

namespace D2\DataMapper;

use D2\DataMapper\Entity;
use RuntimeException;

abstract class DataMapper2
{
    protected string $entity;
    protected string $primaryKey;
    protected array  $fields;

    private array $identityMap = [];

    // public function mappedEntity(string $primaryKey)
    // {
    //     return isset($this->identityMap[$primaryKey]) ? $this->identityMap[$primaryKey] : null;
    // }

    abstract protected function entityProxy(): EntityProxy;

    public function entity($state)
    {
        if (! $state) {
            return null;
        }

        if (! is_array($state)) {
            $state = (array) $state;
        }

        $pkey = $state[$this->primaryKey];

        if (! isset($this->identityMap[$pkey])) {
            $this->identityMap[$pkey] = $this->entityProxy()->entity($state);
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