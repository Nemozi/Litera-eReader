<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ShowController extends Controller
{
    public function showAllBooks()
    {
        $books = Book::all();
        return view('Home', compact('books'));
    }

    public function readBook(Request $request)
    {
        $title = $request->query('title');

        $book = null;

        if ($title) {
            $book = Book::where('title', $title)->first();
        }

        if (!$book) {
            return abort(404, 'Book not found');
        }

        $pdfFileName = basename($book->filePath);
        $coverImageFileName = basename($book->coverImage);

        return view('Read', [
            'pdfPath' => $pdfFileName, 
            'coverImage' => $coverImageFileName, 
            'title' => $book->title,
            'author' => $book->author,
            'genre' => $book->genre,
            'bookId' => $book->id
        ]);
    }


}

