<?php

namespace Performance\Hardcode;

use DateTimeImmutable;
use D2\DataMapper\Entity;

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

    public static function fromState($state)
    {
        $self = new self;

        $self->id          = new UserId($state['id']);
        $self->name        = new UserName($state['name']);
        $self->email       = new UserEmail($state['email']);
        $self->fields      = UserFields::fromState($state);
        $self->address     = UserAddress::fromState($state);
        $self->preferences = UserPreferences::fromState($state);

        return $self;
    }
}