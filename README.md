[![Build Status](https://travis-ci.com/demidovich/d2-data-mapper.svg?branch=master)](https://travis-ci.com/demidovich/d2-data-mapper) [![codecov](https://codecov.io/gh/demidovich/d2-data-mapper/branch/master/graph/badge.svg)](https://codecov.io/gh/demidovich/d2-data-mapper)

## d2 data mapper

Package provides a simple implementation of the data mapper.


#### Example of usage

Entity

```php

use App\User\UserAddress;
use App\User\UserId;
use App\User\UserPreferencesJsonable;
use D2\DataMapper\Entity;
use DateTimeImmutable;
use InvalidArgumentException;

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
```

Mapper

```php

use D2\DataMapper\DataMapper;

class UseRepository extends DataMapper
{
    protected string $entity = User::class;
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

    private PostgresConnection $db;

    public function __construct(PostgresConnection $db)
    {
        $this->db = $db;
    }

    public function find(int $pkey): ?User
    {
        $state = $this->db->table('users')->where('id', $pkey)->first();

        return $this->entity($state);
    }

    public function retrieve(int $pkey): User
    {
        if (! ($entity = $this->db->find($pkey))) {
            throw new NotFoundException();
        }

        return $entity;
    }

    public function create(User $entity): void
    {
        $state = $this->state($entity);

        $this->db->table('users')->insert($state);
    }

    public function update(User $entity): void
    {
        $state = $this->diffState($entity);

        if ($state) {
            $this->db->table('users')->where('id', $entity->id)->update($state);
        }
    }
}
```

Usage

```php
$db = DB::connection('default');
$repository = new UseRepository($db);

$user = $repository->retrieve(12345);
$user->rename('Tom');

$repository->update($user);
```
