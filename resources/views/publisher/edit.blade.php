<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Publisher</title>
</head>

<body>
    <form action="{{ route('publisher.update', $publisher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Publisher Name</label>
        <input type="text" class="@error('publisher_name') is-invalid @enderror" name="publisher_name"
            value="{{ old('publisher_name', $publisher->publisher_name) }}" placeholder="Insert a Publisher Name">
        @error('publisher_name')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        
        <button type="submit"> UPDATE </button>
        <button type="reset"> RESET </button>
        <a href="{{ route('publisher.index') }}"> Return </a>
    </form>
</body>

</html>