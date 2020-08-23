<?php

namespace Tests\Stubs;

use D2\Entity\Enity;
use DateTimeImmutable;

class Book implements Entity
{
    public function __construct(
        BookId $id,
        string $title,
        int $author_id,
        DateTimeImmutable $published_at
    ) {
        
    }
}
