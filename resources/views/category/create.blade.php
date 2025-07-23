<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Categories</title>
</head>

<body>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <label>Category Name</label>
        <input type="text" name="category_name">
        @error('category_name')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <button type="submit"> ADD </button>
        <button type="reset"> RESET </button>
        <a href="{{ route('category.index') }}"> Return </a>
    </form>
</body>

</html>
