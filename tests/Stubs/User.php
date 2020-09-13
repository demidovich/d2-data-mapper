<?php

namespace Tests\Stubs;

use Tests\Stubs\UserId;
use Tests\Stubs\UserAddress;
use D2\DataMapper\Entity;
use InvalidArgumentException;

/**
 * @property UserId $id
 * @property string $name
 * @property string $email
 * @property UserAddress $address
 * 
 * @method static self fromState($state)
 */
class User extends Entity
{
    protected UserId $id;
    protected string $name;
    protected string $email;
    protected UserAddress $address;

    protected function init(): void
    {
        if (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException();
        }
    }

    protected static function valueObjectPrefixes(): array
    {
        return [
            'preferences' => UserPreferences::class,
            'address'     => UserAddress::class,
        ];
    }
}