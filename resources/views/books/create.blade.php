<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
</head>
<body>
    <h1>Add New Book</h1>

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="cover">Cover</label><br>
            <input type="file" id="cover" name="cover" required>
            @error('cover') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="title">Title</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            @error('title') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="description">Description</label><br>
            <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="author">Author</label><br>
            <input type="text" id="author" name="author" value="{{ old('author') }}" required>
            @error('author') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="publisher_id">publisher</label><br>
            <select id="publisher_id" name="publisher_id" required>
                <option value="" disabled selected>-- Select a publisher --</option>
                @foreach ($publisher as $publisher)
                    <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->publisher_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="category_id">Category</label><br>
            <select id="category_id" name="category_id" required>
                <option value="" disabled selected>-- Select a Category --</option>
                @foreach ($category as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">ADD BOOK</button>
        <button type="reset">RESET</button>
        <a href="{{ route('books.index') }}">Return</a>
    </form>
</body>
</html>