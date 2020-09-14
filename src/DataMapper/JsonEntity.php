<?php

namespace D2\DataMapper;

use D2\DataMapper\Contracts\Stateable;
use D2\Hydrator\Hydrator;

class JsonEntity implements Stateable
{
    protected function init(): void
    {
    }

    final public function __construct(string $json)
    {
        $state = json_decode($json, true);

        Hydrator::onInstance($this)->hydrate($state);

        $this->init();
    }

    public function toState(): string
    {
        return json_encode(get_object_vars($this));
    }
}