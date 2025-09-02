<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Home' }} || Mugen System</title>

    @vite('resources/css/app.css')
</head>
<body class="flex flex-col h-screen">
    <header class="basis-auto flex flex-row justify-between p-4">
        <div>LOGO</div>
        <div>
            <x-button.action action="/logout">
                Logout
            </x-button.action>
        </div>
    </header>

    <main class="grow flex flex-row">
        <nav class="basis-auto p-4">
            <x-menu.section title="Home">
                <x-menu.action-item label="Dashboard" action="/dashboard" />
            </x-menu.section>

            <x-menu.section title="Main">
                <x-menu.action-item label="Game" action="/games" />
                <x-menu.action-item label="Company" action="/companies" />
                <x-menu.action-item label="Category" action="/categories" />
                <x-menu.action-item label="Language" action="/languages" />
                <x-menu.action-item label="Platform" action="/platforms" />
                <x-menu.action-item label="User" action="/users" />
                <x-menu.action-item label="Color Encoding" action="/color-encodings" />
                <x-menu.action-item label="Country" action="/countries" />
            </x-menu.section>
        </nav>

        <div class="grow p-4">
            {{ $slot }}
        </div>
    </main>
</body>
</html>