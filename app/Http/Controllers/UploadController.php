<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function createForm()
    {
        return view('Upload');
    } 
    
    public function bookUpload(Request $req)
    {
        $req->validate([
            'pdf' => 'required|mimes:pdf|max:20480',
            'cover_image' => 'required|mimes:jpeg,png|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
        ]);

        $book = new Book;

        if ($req->hasFile('pdf')) {
            $pdfFileName = time().'_'.$req->file('pdf')->getClientOriginalName();
            $pdfPath = $req->file('pdf')->storeAs('uploads/pdfs', $pdfFileName, 'public');
            $book->filePath = '/storage/' . $pdfPath;
        }

        if ($req->hasFile('cover_image')) {
            $coverImageName = time().'_'.$req->file('cover_image')->getClientOriginalName();
            $coverImagePath = $req->file('cover_image')->storeAs('uploads/covers', $coverImageName, 'public');
            $book->coverImage = '/storage/' . $coverImagePath;
        }

        $book->title = $req->input('title');
        $book->author = $req->input('author');
        $book->genre = $req->input('genre');
        $book->save();

        return redirect()->route('home')
            ->with('success', 'Your Book and Cover Image have been uploaded.');
            
    }
}


