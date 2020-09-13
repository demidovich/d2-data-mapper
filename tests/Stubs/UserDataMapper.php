<?php

namespace Tests\Stubs;

use D2\DataMapper\DataMapper;
use DateTimeImmutable;

/**
 * @property UserId $id;
 * @property string $name;
 * @property string $email;
 * @property UserAddress $address;
 * @property UserPreferences $preferences;
 * @property DateTimeImmutable $created_at;
 */
class UserDataMapper extends DataMapper
{
    protected string $entity = User::class;
    protected string $primaryKey = 'id';
    protected array  $fields = [
        'id',
        'name',
        'email',
        'created_at',
        'address_country',
        'address_locality',
        'address_street',
        'address_house',
        'address_flat',
        'address_zip_code',
        'preferences_locale',
        'preferences_language',
        'preferences_timezone',
        'preferences_subscribe_news',
        'preferences_subscribe_messages',
    ];
}