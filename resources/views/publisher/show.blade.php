<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
    <style>
        table {
            background-color: burlywood;
            width: 50%;
            border-collapse: collapse;
            border: solid;
        }

        th,
        td {
            border: 1px solid;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Books Published</h2>
    <a href="{{ route('publisher.index') }}" class="back-link">Return</a>
    <hr>
    @forelse ($books as $book)
        <table>
            <thead>
                <tr>
                    <th>Book Cover</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('storage/books/' . $book->cover) }}" alt="Cover for {{ $book->title }}"
                            style="width:150px">
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category->category_name }}</td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            {{ $books->links() }}
        </div>
    @empty
        <p>Publisher hasn't released a book yet.</p>
    @endforelse
</body>

</html>
