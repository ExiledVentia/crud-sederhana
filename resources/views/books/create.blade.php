<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Books</title>
</head>

<body>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Cover</label>
        <input type="file" name="cover">
        @error('cover')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Title</label>
        <input type="text" name="title">
        @error('title')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Description</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Author</label>
        <input type="text" name="author">
        @error('author')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Publisher</label>
        <input type="text" name="publisher">
        @error('publisher')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Category</label>
        <input type="text" name="category">
        @error('category')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <button type="submit"> ADD </button>
        <button type="reset"> RESET </button>
        <a href="{{ route('books.index')}}"> Return </a>
    </form>
</body>

</html>
