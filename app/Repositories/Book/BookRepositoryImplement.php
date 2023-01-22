<?php

namespace App\Repositories\Book;


use App\Models\Book;
use LaravelEasyRepository\Implementations\Eloquent;

class BookRepositoryImplement extends Eloquent implements BookRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function getAllBooks()
    {
        $books = $this->model->all();
        return $books;
    }

    public function storeBook($payload)
    {
        return $this->model->create($payload);
    }

    public function findBookByName($name)
    {
        return $this->model->where('title', $name)->first();
    }
}
