<?php

namespace Performance\Hydratable;

use D2\DataMapper\Contracts\Stateable;

/**
 * @property string $field0;
 * @property string $field1;
 * @property string $field2;
 * @property string $field3;
 * @property string $field4;
 * @property string $field5;
 */
class UserFields implements Stateable
{
    private string $field0;
    private string $field1;
    private string $field2;
    private string $field3;
    private string $field4;
    private string $field5;

    public function toState()
    {
        return [
            'field0' => $this->field0,
            'field1' => $this->field1,
            'field2' => $this->field2,
            'field3' => $this->field3,
            'field4' => $this->field4,
            'field5' => $this->field5,
        ];
    }
}