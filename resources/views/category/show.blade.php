<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details for {{ $category->category_name }}</title>
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
        <h2>{{ $category->category_name }} Books</h2>
        <a href="{{ route('category.index') }}" class="back-link">Return</a>
        <hr>

        @if ($books->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Book Cover</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/books/' . $book->cover) }}"
                                    alt="Cover for {{ $book->title }}" style="width:150px">
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher->publisher_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $books->links() }}
            </div>
        @else
            <p>There's no books in this category.</p>
        @endif
    </div>
</body>

</html>
