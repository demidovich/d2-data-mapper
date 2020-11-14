<?php

namespace D2\DataMapper\Traits;

use D2\DataMapper\Contracts\Stateable;
use D2\Hydrator\Hydrator;

trait Jsonable
{
    public function __construct(string $json)
    {
        $data  = json_decode($json, true);
        $class = get_called_class();

        Hydrator::onInstance($this)->hydrate($data);
    }

    /**
     * Export entity to persist.
     *
     * @return string|array
     */
    public function toState()
    {
        $state = [];

        foreach (get_object_vars($this) as $attr => $value) {
            if ($value instanceof Stateable) {
                $state[$attr] = $value->toState(); 
            } else {
                $state[$attr] = $value;
            }
        }

        return json_encode($state, JSON_UNESCAPED_UNICODE);
    }
}
