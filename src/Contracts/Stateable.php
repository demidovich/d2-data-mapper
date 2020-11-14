<?php

namespace D2\DataMapper\Contracts;

interface Stateable
{
    // /**
    //  * Retrieve entity from state.
    //  *
    //  * @param string|array|object $state
    //  */
    // public static function fromState($state);

    /**
     * Export entity to persist.
     *
     * @return string|array
     */
    public function toState();
}
