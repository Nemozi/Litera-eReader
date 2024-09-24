<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return abort(404, 'Book not found');
        }

        return view('Edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'nullable'
        ]);

        $book = Book::find($id);

        if (!$book) {
            return abort(404, 'Book not found');
        }

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->genre = $request->input('genre');
        $book->save();

        return redirect()->route('home')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return abort(404, 'Book not found');
        }

        $book->delete();

        return redirect()->route('home')->with('success', 'Book deleted successfully');
    }
}