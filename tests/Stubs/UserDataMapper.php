<?php

namespace Tests\Stubs;

use D2\DataMapper\DataMapper;
use DateTimeImmutable;

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
        'preferences',
    ];
}