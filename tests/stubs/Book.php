<?php

namespace Tests\Stubs;

use DateTimeImmutable;

class Book
{
    private $id;
    private $title;
    private $author_id;
    private $published_at;

    // public function __construct(
    //     BookId $id, 
    //     string $title, 
    //     int $author_id, 
    //     DateTimeImmutable $published_at
    // ) {
          
    // }

    public static function hydrate(array $params)
    {

    }
}

$book = Book::build($row);