<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
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
        <a href="{{ route('books.index')}}">Book List</a>
        ||
        <a href="{{ route('category.index')}}">Category List</a>
        ||
        <a href="{{ route('publisher.index')}}">Publisher List</a>
        <hr/>
        <a href="{{ route('publisher.create') }}">Add Publisher</a>
        <table>
            <thead>
                <tr>
                    <th>
                        Publisher Name
                    </th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($publisher as $p)
                    <tr>
                        <td>{{ $p->publisher_name }}</td>
                        <td>
                            <form onsubmit="return confirm('Are you sure?')"
                                action="{{ route('publisher.destroy', $p->id) }}" method="POST">
                                <a href="{{ route('publisher.show', $p->id) }}">SHOW</a>
                                <a href="{{ route('publisher.edit', $p->id) }}">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div>
                        Data Not Found.
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
