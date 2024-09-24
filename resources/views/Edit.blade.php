@extends('templates.master')

@section('title', 'Edit Book')

@section('content')
<header>
    <link rel="stylesheet" href="/css/edit.css">
</header>
<div class="container mt-5">
    <h1>Edit Book</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid-container">
        <div class="cover-image-container">
            <img src="{{ asset('storage/uploads/covers/' . basename($book->coverImage)) }}" alt="{{ $book->title }}" class="img-fluid book-image">
        </div>
        <div class="form-container">
            <form action="{{ route('updateBook', ['id' => $book->id]) }}" method="POST" id="updateForm">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" class="form-control" value="{{ $book->genre }}">
                </div>
                
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </form> 
            <form action="{{ route('deleteBook', ['id' => $book->id]) }}" method="POST" id="deleteForm" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this book?')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection