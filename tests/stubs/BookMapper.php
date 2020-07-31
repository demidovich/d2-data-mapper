<?php

namespace Tests\Stubs;

use D2\DataMapper\DataMapper;
use D2\Entity\EntityBuilder;
use Tests\Stubs\Book;

class BookMapper extends DataMapper
{
    protected string $entity = Book::class;
    protected string $primariKey = 'id';
}