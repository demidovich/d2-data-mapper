<?php

namespace Tests\Stubs\User;

use D2\DataMapper\Entity;

/**
 * @property string  $country
 * @property string  $locality
 * @property string  $street
 * @property string  $house
 * @property ?string $flat = null
 * @property int     $zip_code
 * 
 * @method static self fromState($state)
 */
class UserAddress extends Entity
{
    protected  string $country;
    protected  string $locality;
    protected  string $street;
    protected  string $house;
    protected ?string $flat = null;
    protected  int    $zip_code;
}