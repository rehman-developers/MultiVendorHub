<!-- welcome.blade.php (add this new file in resources/views) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to Newsletter System</h1>
    <p>Go to <a href="{{ route('subscribe.form') }}">Subscribe</a></p>
</body>
</html>