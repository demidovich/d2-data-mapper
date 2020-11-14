<?php

namespace Tests;

use Tests\Stubs\User;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\UserDataMapper;

class DataMapperTest extends TestCase
{
    public function test_retrieve()
    {
        $state  = $this->userState();
        $mapper = new UserDataMapper($state);
        $entity = $mapper->retrieve(123);

        $this->assertInstanceOf(User::class, $entity);
    }

    public function test_entity_state()
    {
        $originState = $this->userState();

        $mapper = new UserDataMapper($originState);
        $entity = $mapper->retrieve(123);
        $state  = $mapper->entityState($entity);

        $this->assertNotEmpty($state);
        $this->assertEquals($originState, $state);
    }

    public function test_entity_diff_state()
    {
        $originState = $this->userState();

        $mapper = new UserDataMapper($originState);
        $entity = $mapper->retrieve(123);
        $entity->track();

        $entity->rename('new name');
        $entity->subscribeNews();

        $stateDiff = $entity->toDiffState();

        $this->assertEquals(2, count($stateDiff));
        $this->assertTrue(isset($stateDiff['name']));
        $this->assertTrue(isset($stateDiff['preferences']));
    }

    private function userState()
    {
        return [
            'id' => 123,
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

    private function userPreferencesState()
    {
        return [
            'subsribe_news' => false,
            'subsribe_notifications' => false,
            'locale' => 'en_EN',
            'page_size' => 1000,
        ];
    }
}