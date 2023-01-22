<?php

namespace App\Services\Book;


use LaravelEasyRepository\Service;
use App\Repositories\Book\BookRepository;

class BookServiceImplement extends Service implements BookService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(BookRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  // Define your custom methods :)

  public function getAllBooks()
  {
    # code...
    $books = $this->mainRepository->getAllBooks();
    return $books;
  }

  public function storeBook($payload)
  {
    $book = $this->mainRepository->storeBook($payload);
    return $book;
  }

  public function findBook($id)
  {
    $book = $this->mainRepository->find($id);
    return $book;
  }

  public function updateBook($payload, $id)
  {
    // $book = $this->mainRepository->update($id,$payload);
    $book = $this->mainRepository->find($id);
    $book->update($payload);

    return $book;
  }

  public function deleteBook($id)
  {
    $book = $this->mainRepository->find($id);
    $book->delete();

    return $book;
  }
}
