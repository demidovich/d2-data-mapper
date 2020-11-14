<?php

namespace Tests;

use InvalidArgumentException;
use Tests\Stubs\User;
use Tests\Stubs\User\UserId;
use Tests\Stubs\User\UserAddress;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function test_value_object_from_state()
    {
        $state = $this->userAddressState();
        $valueObject = UserAddress::fromState($state);

        $this->assertEquals($state->country,  $valueObject->country);
        $this->assertEquals($state->locality, $valueObject->locality);
    }

    public function test_entity_primitive_attribute()
    {
        $state  = $this->userState();
        $entity = User::fromState($state);

        $this->assertEquals($state->name, $entity->name);
        $this->assertEquals($state->email, $entity->email);
    }

    public function test_entity_value_object_attribute()
    {
        $state  = $this->userState();
        $entity = User::fromState($state);

        $this->assertInstanceOf(UserId::class, $entity->id);
        $this->assertEquals($state->id, $entity->id->value());
    }

    public function test_entity_complex_value_object_attribute()
    {
        $state  = $this->userState();
        $entity = User::fromState($state);

        $this->assertInstanceOf(UserAddress::class, $entity->address);

        $this->assertEquals($state->address_country,  $entity->address->country);
        $this->assertEquals($state->address_locality, $entity->address->locality);
        $this->assertEquals($state->address_street,   $entity->address->street);
        $this->assertEquals($state->address_house,    $entity->address->house);
        $this->assertEquals($state->address_flat,     $entity->address->flat);
        $this->assertEquals($state->address_zip_code, $entity->address->zip_code);
    }

    public function test_entity_init_invariant_exception()
    {
        $state = $this->userState();
        $state->email = 'wrong_email';

        $this->expectException(InvalidArgumentException::class);

        User::fromState($state);
    }

    public function test_entity_to_state()
    {
        $originState   = (array) $this->userState();
        $entity        = User::fromState($originState);
        $exportedState = $entity->toState();

        $this->assertIsArray($exportedState);
        $this->assertNotEmpty($exportedState);
        $this->assertEmpty(array_diff_assoc($originState, $exportedState));
    }

    private function userState()
    {
        return (object) [
            'id' => rand(100, 500),
            'name' => 'Ivan',
            'email' => 'ivan@ivan.com',
            'address_country' => 'Russia',
            'address_locality' => 'Krasnodar',
            'address_street' => 'Krasnaya',
            'address_house' => '1',
            'address_flat' => null,
            'address_zip_code' => '350000',
            'preferences' => json_encode($this->userPreferencesState()),
        ];
    }

    private function userAddressState()
    {
        return (object) [
            'country' => 'Russia',
            'locality' => 'Krasnodar',
            'street' => 'Krasnaya',
            'house' => '1',
            'flat' => null,
            'zip_code' => '350000',
        ];
    }

    private function userPreferencesState()
    {
        return (object) [
            'subsribe_news' => false,
            'subsribe_notifications' => false,
            'locale' => 'en_EN',
            'page_size' => 1000,
        ];
    }
}