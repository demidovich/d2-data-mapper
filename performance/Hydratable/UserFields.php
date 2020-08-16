<?php

namespace Performance\Hydratable;

use D2\DataMapper\Entity;
use D2\DataMapper\Entity\Hydratable;

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