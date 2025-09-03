<x-layout.app>
    <form method="post" action="/users/{{ $user->id }}/update">
        @csrf

        <x-container.stack>
            <x-input.form-radio
                property="role"
                label="Role"
                value="{{ $user->role }}"
                :errors="$errors->get('role')"
                :options="$roles"
            />

            <x-input.text-input
                property="username"
                label="Username"
                value="{{ $user->username }}"
                :errors="$errors->get('username')" />

            <x-input.email-input
                property="email"
                label="Email"
                value="{{ $user->email }}"
                :errors="$errors->get('email')" />

            <x-button.submit>
                Save
            </x-button.submit>
        </x-container.stack>
    </form>
</x-layout.app>