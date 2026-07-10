<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Laravel -admin-</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{ $slot }}

</body>
</html>