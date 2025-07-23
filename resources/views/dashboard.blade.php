<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
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
        <hr />
        <table>
            <thead>
                <tr>
                    <th>Section</th>
                    <th>Go to</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Books</td>
                    <td><a href="{{ route('books.index') }}">View Books</a></td>
                </tr>
                <tr>
                    <td>Categories</td>
                    <td><a href="{{ route('category.index') }}">View Categories</a></td>
                </tr>
                <tr>
                    <td>Publishers</td>
                    <td><a href="{{ route('publisher.index') }}">View Publishers</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
