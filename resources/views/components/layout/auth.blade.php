<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Home' }} || Mugen System</title>

    @vite('resources/css/app.css')
</head>
<body class="relative h-screen">
    <main class="absolute top-[50%] left-[50%] w-[500px] translate-[-50%] border p-5 rounded-lg">
        {{ $slot }}
    </main>
</body>
</html>