<?php

namespace Tests\Stubs;

use D2\DataMapper\Entity;
use DateTimeImmutable;
use InvalidArgumentException;
use Tests\Stubs\User\UserAddress;
use Tests\Stubs\User\UserId;
use Tests\Stubs\User\UserPreferencesJsonable;

/**
 * @property UserId $id
 * @property string $name
 * @property string $email
 * @property UserAddress $address
 * @property UserPreferencesJsonable $preferences
 * @property DateTimeImmutable $active_at
 * 
 * @method static self fromState($state)
 */
class User extends Entity
{
    protected UserId $id;
    protected string $name;
    protected string $email;
    protected UserAddress $address;
    protected UserPreferencesJsonable $preferences;
    protected ?DateTimeImmutable $active_at = null;

    protected function init(): void
    {
        if (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException();
        }
    }

    protected static function valueObjectPrefixes(): array
    {
        return [
            'address' => UserAddress::class,
        ];
    }

    public function rename(string $value): void
    {
        $this->name = $value;
    }

    public function subscribeNews(): void
    {
        $this->preferences->subscribeNews(true);
    }
}