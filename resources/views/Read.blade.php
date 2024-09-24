
@extends('templates.master')
@section('title', 'Show Book')
@section('content')
<header>
    <link rel="stylesheet" href="/css/read.css">
</header>
<body>
<div class="headInfo container mt-5">
    <div class="cover-image-container">
            <img src="{{ asset('storage/uploads/covers/' . $coverImage) }}"  class="img-fluid book-image">
        </div>
    <div class="headings">
        <h1 class="title">{{ $title }}</h1>
        <h2 class="genre">{{ $genre }}</h2>
        <h3 class="author">{{ $author }}</h3>
    </div>
  
    <div class="button-group">
        <a href="{{ route('edit', ['id' => $bookId]) }}" class="btn btn-warning edit-button">Edit Book</a>
        <a href="{{ asset('storage/uploads/pdfs/' . $pdfPath) }}" download class="btn btn-success download-button">Download</a>
    </div>
</div>

<div id="pdfContainer" style="margin:10rem;">
<h1>Preview : {{ $title }}</h1>
    <iframe src="{{ asset('storage/uploads/pdfs/' . $pdfPath) }}" class="iFrame" width="100%"></iframe>
</div>
</body>
@endsection
