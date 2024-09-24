@extends('templates.master')
@section('title', 'Book Upload')
@section('content')
<header>
    <link rel="stylesheet" href="/css/upload.css">
</header>
<body>
    <div class="container mt-5">
        <form action="{{ route('bookUpload') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success"> 
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control" required>
            </div> 
            <div class="custom-file mb-3">
                <input type="file" name="cover_image" id="cover_image" class="custom-file-input" onchange="updateFileName(this)">
                <label for="cover_image" class="custom-file-label">
                    {{ old('cover_image') ? old('cover_image') : 'Select Cover Image' }}
                </label>
            </div>
            <div class="custom-file mb-3">
                <input type="file" name="pdf" id="pdf" class="custom-file-input" onchange="updateFileName(this)">
                <label for="pdf" class="custom-file-label">
                    {{ old('pdf') ? old('pdf') : 'Select PDF' }}
                </label>
            </div>
           
            <button type="submit" name="submit" class="btn btn-primary">Upload Book</button>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerText = fileName;
        }
    </script>
</body>
@endsection