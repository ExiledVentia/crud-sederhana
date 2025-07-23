<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Details</title>
</head>

<body>
    <a href="{{ route('books.index') }}"> Return </a>
    <br><br>
    <img src="{{ asset('/storage/books/' . $book->cover) }}" style="width: 200px">
    <h3>{{ $book->title }}</h3>
    <hr />
    <code>
        <p>
            {!! $book->description !!}
        </p>
    </code>
    <hr />
    <p>{{ $book->author }}</p>
    <hr />
    <p>{{ $book->publisher }}</p>
    <hr />
    <p>{{ $book->category->category_name }}</p>
    <hr />
    <form onsubmit="return confirm('Are you sure?')" action="{{ route('books.destroy', $book->id) }}" method="POST">
        <a href="{{ route('books.show', $book->id) }}">SHOW</a>
        <a href="{{ route('books.edit', $book->id) }}">EDIT</a>
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>

</body>

</html>
