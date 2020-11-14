<?php

namespace Performance\Hydratable;

use D2\DataMapper\Contracts\Stateable;

/**
 * @property string  $country;
 * @property string  $city;
 * @property string  $street;
 * @property string  $house;
 * @property string  $flat;
 * @property int     $zip_code;
 */
class UserAddress implements Stateable
{
    private  string $country;
    private  string $city;
    private  string $street;
    private  string $house;
    private ?string $flat = null;
    private  int    $zip_code;

    public function toState()
    {
        return [
            'address_country'  => $this->country,
            'address_city'     => $this->city,
            'address_street'   => $this->street,
            'address_house'    => $this->house,
            'address_flat'     => $this->flat,
            'address_zip_code' => $this->zip_code,
        ];
    }
}