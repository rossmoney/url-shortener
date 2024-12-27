<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortener - Encode Link</title>
</head>
<body>
    <h1>Link Shortener - Encode Link</h1>

    <form action="{{ route('link.encode') }}" method="post">
        @csrf
        <label for="url">Enter URL:</label>
        <input type="text" name="url" id="url" required>
        <button type="submit">Shorten URL</button>
    </form>
</body>
</html>