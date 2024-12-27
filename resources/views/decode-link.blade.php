<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortener - Decode Link</title>
</head>
<body>
    <h1>Link Shortener - Decode Link</h1>

    <form action="{{ route('link.decode') }}" method="post">
        @csrf
        <label for="url">Enter URL:</label>
        <input type="text" name="url" id="url" required>
        <button type="submit">Expand URL</button>
    </form>
</body>
</html>