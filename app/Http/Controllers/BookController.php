<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('index', compact('books'));
    }

    public function addBook()
    {
        $users = User::All();
        // return view('add-book', ['users' => $users]);
        return view('add-book', compact('users'));
    }

    public function storeBook(StoreBookRequest $storeBookRequest)
    {
        $payload = $storeBookRequest->validated();
        // return $payload;
        Book::create($payload);
        return redirect('/');
    }

    public function editBook($bookID)
    {
        $book = Book::find($bookID);
        $users = User::all();
        // return $book;
        return view('edit-book', compact('book', 'users'));
    }
    public function updateBook(StoreBookRequest $storeBookRequest, $bookID)
    {
        $payload = $storeBookRequest->validated();
        Book::find($bookID)->update($payload);
        return redirect('/');
    }

    public function deleteBook($bookID)
    {
        Book::find($bookID)->delete();
        return redirect('/');
    }
}
