<?php

namespace D2\DataMapper;

interface _EntityProxy
{
    public function entity($state);

    public function state($entity): array;

    public function modifiedState($entity): array;
}
