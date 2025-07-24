<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trashed Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            background-color: burlywood;
            width: 80%;
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
        <h2>Trashed Categories</h2>
        <a href="{{ route('category.index') }}">Return to Categories List</a>
        <hr>

        @if ($category->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Date Deleted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->category_name }}</td>
                            <td>{{ $c->deleted_at->format('Y-m-d') }}</td>
                            <td>

                                <form action="{{ route('category.restore', $c->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Restore</button>
                                </form>

                                <form action="{{ route('category.forceDelete', $c->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to permanently delete this? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $category->links() }}
            </div>
        @else
            <p>The trash is empty.</p>
        @endif
    </div>
</body>

</html>