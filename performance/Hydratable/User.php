<?php

namespace Performance\Hydratable;

use DateTimeImmutable;
use D2\DataMapper\Entity;
use D2\DataMapper\Entity\Hydratable;

class User extends Entity
{
    use Hydratable;

    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserAddress $address;
    private UserPreferences $preferences;
    private DateTimeImmutable $created_at;
    private UserFields $fields;
    private $field6;
    private $field7;
    private $field8;
    private $field9;

    protected function init(): void
    {
        
    }

    protected static function statePrefixes(): array
    {
        return [
            'preferences' => UserPreferences::class,
            'address' => UserAddress::class,
        ];
    }
}