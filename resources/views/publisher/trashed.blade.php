<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trashed Publishers</title>
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
        <h2>Trashed Publishers</h2>
        <a href="{{ route('publisher.index') }}">Return to Publishers List</a>
        <hr>

        @if ($publisher->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Publisher Name</th>
                        <th>Date Deleted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publisher as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->publisher_name }}</td>
                            <td>{{ $p->deleted_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('publisher.restore', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Restore</button>
                                </form>

                                <form action="{{ route('publisher.forceDelete', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to permanently delete this? This action cannot be undone.');">
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
                {{ $publisher->links() }}
            </div>
        @else
            <p>The trash is empty.</p>
        @endif
    </div>
</body>

</html>