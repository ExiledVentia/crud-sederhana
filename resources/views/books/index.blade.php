<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Index</title>
    <style>
        table {
            background-color:burlywood;
            width:50%;
            border-collapse:collapse;
            border:solid;
        }

        th, td {
            border: 1px solid;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>


<body>
    <div>
        <a href="{{ route('books.index')}}">Book List</a>
        ||
        <a href="{{ route('category.index')}}">Category List</a>
        ||
        <a href="{{ route('publisher.index')}}">Publisher List</a>
        <hr/>
        <a href="{{ route('books.create') }}">Add Book</a>
        <table style="">
            <thead>
                <tr>
                    <th>Book Cover</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Category</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $b)
                    <tr>
                        <td>
                            <img src="{{ asset('/storage/books/'. $b->cover) }}" style="width: 150px">
                        </td>
                        <td>{{ $b->title }}</td>
                        <td>{{ $b->author }}</td>
                        <td>{{ $b->publisher->publisher_name }}</td>
                        <td>{{ $b->category->category_name }}</td>
                        <td>
                            <form onsubmit="return confirm('Are you sure?')" action="{{ route('books.destroy', $b->id) }}" method="POST">
                                <a href="{{ route('books.show', $b->id)}}" >SHOW</a>
                                <a href="{{ route('books.edit', $b->id)}}">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div>
                        Book Data Not Found.
                    </div>
                @endforelse
            </tbody>
        </table>
        {{ $books->links() }}
    </div>
</body>
</html>