<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Publisher</title>
</head>

<body>
    <form action="{{ route('publisher.store') }}" method="POST">
        @csrf
        <label>Publisher Name</label>
        <input type="text" name="publisher_name">
        @error('publisher_name')
            <div>
                {{ $message }}
            </div>
        @enderror
        <br>
        <button type="submit"> ADD </button>
        <button type="reset"> RESET </button>
        <a href="{{ route('publisher.index') }}"> Return </a>
    </form>
</body>

</html>
