<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Index</title>
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
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input, .filter-form select, .filter-form button {
            padding: 8px;
            margin-right: 10px;
        }
        .export-buttons a, .export-buttons button {
             display: inline-block;
             padding: 8px 12px;
             background-color: darkgreen;
             color: white;
             text-decoration: none;
             border-radius: 4px;
             border: none;
             cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{route('dashboard')}}">Dashboard</a>
        ||
        <a href="{{ route('books.index')}}">Book List</a>
        ||
        <a href="{{ route('category.index')}}">Category List</a>
        ||
        <a href="{{ route('publisher.index')}}">Publisher List</a>
        <hr/>

        <div class="filter-form">
            <form action="{{ route('books.index') }}" method="GET" style="display: flex; align-items: center; flex-wrap: wrap; gap: 15px;">
                <input type="text" name="search" placeholder="Search Title, Author..." value="{{ request('search') }}">

                <select name="category_id">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>

                <select name="publisher_id">
                    <option value="">Select Publisher</option>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}" {{ request('publisher_id') == $publisher->id ? 'selected' : '' }}>
                            {{ $publisher->publisher_name }}
                        </option>
                    @endforeach
                </select>

                <div>
                    <label for="start_date" style="margin-right: 5px; font-weight: bold;">From:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>

                <div>
                    <label for="end_date" style="margin-right: 5px; font-weight: bold;">To:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') ?? now()->format('Y-m-d') }}">
                </div>

                <button type="submit">Filter</button>
                <a href="{{ route('books.index') }}" style="text-decoration: underline;">Clear Filter</a>
            </form>
        </div>

        <a href="{{ route('books.create') }}">Add Book</a>

        <div class="export-buttons" style="margin-top: 10px; margin-bottom: 10px;">
             <a href="{{ route('books.export.pdf', request()->query()) }}">Export to PDF</a>
             <a href="{{ route('books.export.excel', request()->query()) }}">Export to Excel</a>
        </div>
        
        <table>
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
                            <img src="{{ asset('storage/books/'. $b->cover) }}" style="width: 150px">
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
                    <tr>
                        <td colspan="6">
                            Book Data Not Found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $books->withQueryString()->links() }}
    </div>
</body>
</html>