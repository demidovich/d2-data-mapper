<?php

namespace Tests\Stubs;

use D2\DataMapper\DataMapper;

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

    private $testingState;

    public function __construct($testingState)
    {
        $this->testingState = $testingState;        
    }

    public function retrieve(int $pkey): User
    {
        return $this->entity(
            $this->testingState
        );
    }

    public function retrieveModifiable(int $pkey): User
    {
        return $this->modifiableEntity(
            $this->testingState
        );
    }

    public function entityState($entity): array
    {
        return $this->state($entity);
    }

    public function entityModifiedState($entity): array
    {
        return $this->modifiedState($entity);
    }
}