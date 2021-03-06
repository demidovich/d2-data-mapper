<?php

namespace Performance\Hardcode;

use D2\DataMapper\Entity;

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
    private string  $country;
    private string  $city;
    private string  $street;
    private string  $house;
    private ?string $flat = null;
    private int     $zip_code;

    public static function fromState($state)
    {
        $self = new self;

        $self->country  = $state['address_country'];
        $self->city     = $state['address_city'];
        $self->street   = $state['address_street'];
        $self->house    = $state['address_house'];
        $self->flat     = $state['address_flat'];
        $self->zip_code = $state['address_zip_code'];

        return $self;
    }
}