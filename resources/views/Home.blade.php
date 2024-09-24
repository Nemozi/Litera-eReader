@extends('templates.master')
@section('title', 'Home')
@section('content')
<header>
    <link rel="stylesheet" href="/css/home.css">
</header>
<body>
    <div class="container mt-5">
        <h1>All Books</h1>
        <div class="book-grid">
            @foreach($books as $book)
                <div class="col book">
                    <a href="{{ route('readBook', ['title' => $book->title]) }}" class="book-link">
                        <img src="{{ asset('storage/uploads/covers/' . basename($book->coverImage)) }}" alt="{{ $book->title }}" class="img-fluid book-image">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
@endsection