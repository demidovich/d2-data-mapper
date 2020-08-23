<?php

namespace D2\DataMapper;

interface EntityProxy
{
    public function entity($state): Entity;

    public function state(Entity $entity): array;
}
