<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
</head>

<body>
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Category Name</label>
        <input type="text" class="@error('category_name') is-invalid @enderror" name="category_name"
            value="{{ old('category_name', $category->category_name) }}" placeholder="Insert a Category Name">
        @error('category_name')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        
        <button type="submit"> UPDATE </button>
        <button type="reset"> RESET </button>
        <a href="{{ route('category.index') }}"> Return </a>
    </form>
</body>

</html>