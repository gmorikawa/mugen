<x-layout.app>
    <form method="post" action="/users/create">
        @csrf

        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

        <x-container.stack>
            <x-input.text-input property="username" label="Username" />
            <x-input.email-input property="email" label="Email" />
            <x-input.password-input property="password" label="Password" />

            <x-button.submit>
                Save
            </x-button.submit>
        </x-container.stack>
    </form>
</x-layout.app>