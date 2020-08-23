<?php

namespace Performance\Hydratable;

use D2\DataMapper\Entity;
use D2\DataMapper\Entity\Hydratable;

/**
 * @property string $field0;
 * @property string $field1;
 * @property string $field2;
 * @property string $field3;
 * @property string $field4;
 * @property string $field5;
 */
class UserFields extends Entity
{
    use Hydratable;

    private string $field0;
    private string $field1;
    private string $field2;
    private string $field3;
    private string $field4;
    private string $field5;
}