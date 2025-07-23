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
    <img src="{{ asset('/storage/books/' . $books->cover) }}" style="width: 200px">
    <h3>{{ $books->title }}</h3>
    <hr />
    <code>
        <p>
            {!! $books->description !!}
        </p>
    </code>
    <hr />
    <p>{{ $books->author }}</p>
    <hr />
    <p>{{ $books->publisher }}</p>
    <hr />
    <p>{{ $books->category }}</p>
    <hr />
    <form onsubmit="return confirm('Are you sure?')" action="{{ route('books.destroy', $books->id) }}" method="POST">
        <a href="{{ route('books.show', $books->id) }}">SHOW</a>
        <a href="{{ route('books.edit', $books->id) }}">EDIT</a>
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>

</body>

</html>
