<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Books</title>
</head>

<body>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
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
            value="{{ old('title', $book->title) }}" placeholder="Insert a Book Title">
        @error('title')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Description</label>
        <textarea name="description" class="@error('description') is-invalid @enderror" >{{ old('description', $book->description) }}</textarea>
        @error('description')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Author</label>
        <input type="text" class="@error('author') is-invalid @enderror" name="author"
            value="{{ old('author', $book->author) }}" placeholder="Insert a Book Author">
        @error('author')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <label>Publisher</label>
        <input type="text" class="@error('publisher') is-invalid @enderror" name="publisher"
            value="{{ old('publisher', $book->publisher) }}" placeholder="Insert a Publisher">
        @error('publisher')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        
        {{-- This is the only section that has been changed --}}
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" class="@error('category_id') is-invalid @enderror" required>
            <option value="">Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
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