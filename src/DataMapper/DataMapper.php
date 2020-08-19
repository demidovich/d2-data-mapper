<?php

namespace D2\DataMapper;

use D2\DataMapper\Entity;
use RuntimeException;

abstract class DataMapper
{
    protected string $entity;
    protected string $primaryKey;
    protected array  $fields;

    abstract protected function entityProxy(): EntityProxy;

    public function entity($state)
    {
        if (! $state) {
            return null;
        }

        if (! is_array($state)) {
            $state = (array) $state;
        }

        $pkey   = $state[$this->primaryKey];
        $entity = $this->entityProxy()->entity($state);

        StateMap::add($this->entity, $pkey, $state);

        return $entity;
    }

    public function persistedFields($entity): void
    {
        // Собираем в кучу
        // Описание полей в маппере
        // Данные из сущности
        // Данные из StateMap
    }
}