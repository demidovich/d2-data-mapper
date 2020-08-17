<?php

namespace Performance\Hydratable;

use DateTimeImmutable;
use D2\DataMapper\Entity;
use D2\DataMapper\Entity\Hydratable;

/**
 * @property UserId $id;
 * @property UserName $name;
 * @property UserEmail $email;
 * @property UserAddress $address;
 * @property UserPreferences $preferences;
 * @property DateTimeImmutable $created_at;
 * @property UserFields $fields;
 * @property $field6;
 * @property $field7;
 * @property $field8;
 * @property $field9;
 */
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