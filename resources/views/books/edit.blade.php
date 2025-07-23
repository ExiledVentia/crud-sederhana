<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Books</title>
</head>

<body>
    <form action="{{ route('books.update', $books->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Cover</label>
        <input type="file" name="cover">
        @error('cover')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Title</label>
        <input type="text" class="@error('title') is-invalid @enderror" name="title"
            value="{{ old('title', $books->title) }}" placeholder="Insert a Book Title">
        @error('title')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Description</label>
        <textarea name="description" class="@error('description') is-invalid @enderror" >{{ old('description', $books->description) }}</textarea>
        @error('description')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Author</label>
        <input type="text" class="@error('author') is-invalid @enderror" name="author"
            value="{{ old('author', $books->author) }}" placeholder="Insert a Book Author">
        @error('author')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Publisher</label>
        <input type="text" class="@error('publisher') is-invalid @enderror" name="publisher"
            value="{{ old('publisher', $books->publisher) }}" placeholder="Insert a Publisher">
        @error('publisher')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Category</label>
        <input type="text" class="@error('category') is-invalid @enderror" name="category"
            value="{{ old('category', $books->category) }}" placeholder="Insert a Category">
        @error('category')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <button type="submit"> UPDATE </button>
        <button type="reset"> RESET </button>
        <a href="{{ route('books.index') }}"> Return </a>
    </form>
</body>

</html>
