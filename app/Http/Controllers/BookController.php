<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\User;
use App\Services\Book\BookService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;
    private $userService;
    public function __construct(BookService $bookService, UserService $userService)
    {
        $this->bookService = $bookService;
        $this->userService = $userService;
    }





    public function index()
    {
        // $books = Book::all();
        $books = $this->bookService->getAllBooks();
        return view('index', compact('books'));
    }

    public function addBook()
    {
        // $users = User::All();
        $users = $this->userService->getAllUsers();

        // return view('add-book', ['users' => $users]);
        return view('add-book', compact('users'));
    }

    public function storeBook(StoreBookRequest $storeBookRequest)
    {
        $payload = $storeBookRequest->validated();
        // return $payload;
        // Book::create($payload);
        $this->bookService->storeBook($payload);
        return redirect('/');
    }

    public function editBook($bookID)
    {
        // $book = Book::find($bookID);
        $book = $this->bookService->findBook($bookID);

        // $users = User::all();
        $users = $this->userService->getAllUsers();

        // return $book;
        return view('edit-book', compact('book', 'users'));
    }
    public function updateBook(StoreBookRequest $storeBookRequest, $bookID)
    {
        $payload = $storeBookRequest->validated();

        // Book::find($bookID)->update($payload);
        $this->bookService->updateBook($payload, $bookID);
        return redirect('/');
    }

    public function deleteBook($bookID)
    {
        // Book::find($bookID)->delete();
        $this->bookService->deleteBook($bookID);
        return redirect('/');
    }
}
