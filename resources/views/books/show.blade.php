<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            background-color: burlywood;
            width: 50%;
            border-collapse: collapse;
            border: solid;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid;
            padding: 10px;
            text-align: center;
        }

        a {
            margin: 0 5px;
            text-decoration: none;
            color: darkblue;
        }

        hr {
            margin: 20px 0;
        }

        .container {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
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
        <p>{{ $book->publisher->publisher_name }}</p>
        <hr />
        <p>{{ $book->category->category_name }}</p>
        <hr />
        <form onsubmit="return confirm('Are you sure?')" action="{{ route('books.destroy', $book->id) }}"
            method="POST">
            <a href="{{ route('books.show', $book->id) }}">SHOW</a>
            <a href="{{ route('books.edit', $book->id) }}">EDIT</a>
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    </div>
</body>

</html>
