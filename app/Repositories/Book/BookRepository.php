<?php

namespace App\Repositories\Book;

use LaravelEasyRepository\Repository;



interface BookRepository extends Repository
{

    // Write something awesome :)
    public function getAllBooks();
    public function storeBook($payload);
    public function findBookByName($name);
}
