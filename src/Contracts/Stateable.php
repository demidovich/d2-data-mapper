<?php

namespace D2\DataMapper\Contracts;

interface Stateable
{
    /**
     * Export entity to persist.
     *
     * @return string|array
     */
    public function toState();
}
