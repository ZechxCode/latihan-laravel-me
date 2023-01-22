<?php

namespace App\Services\Book;

use LaravelEasyRepository\BaseService;



interface BookService extends BaseService
{

    // Write something awesome :)
    public function getAllBooks();
    public function storeBook($payload);
    public function findBook($id);
    public function updateBook($payload, $id);
    public function deleteBook($id);
}
