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
        <textarea name="description" class="@error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
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
        <label for="publisher_id">Publisher</label>
        <select id="publisher_id" name="publisher_id" class="@error('publisher_id') is-invalid @enderror" required>
            <option value="">Select a Publisher</option>
            @foreach ($publisher as $p)
                <option value="{{ $p->id }}"
                    {{ old('publisher_id', $book->publisher_id) == $p->id ? 'selected' : '' }}>
                    {{ $p->publisher_name }}
                </option>
            @endforeach
        </select>
        @error('publisher_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br>

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" class="@error('category_id') is-invalid @enderror" required>
            <option value="">Select a Category</option>
            @foreach ($category as $c)
                <option value="{{ $c->id }}"
                    {{ old('category_id', $book->category_id) == $c->id ? 'selected' : '' }}>
                    {{ $c->category_name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
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
