<?php

namespace Performance\Hydratable;

use D2\DataMapper\Entity;
use D2\DataMapper\Entity\Hydratable;

/**
 * @property string  $country;
 * @property string  $city;
 * @property string  $street;
 * @property string  $house;
 * @property ?string $flat = null;
 * @property int     $zip_code;
 */
class UserAddress extends Entity
{
    use Hydratable;

    private string $country;
    private string $city;
    private string $street;
    private string $house;
    private string $flat;
    private int    $zip_code;
}