<x-layout.app>
    <form method="post" action="/users/create">
        @csrf

        <x-container.stack>
            <x-input.form-radio
                property="role"
                label="Role"
                value="{{ old('role') }}"
                :errors="$errors->get('role')"
                :options="$roles"
            />

            <x-input.text-input
                property="username"
                label="Username"
                value="{{ old('username') }}"
                :errors="$errors->get('username')" />

            <x-input.email-input
                property="email"
                label="Email"
                value="{{ old('email') }}"
                :errors="$errors->get('email')" />

            <x-input.password-input
                property="password"
                label="Password"
                :errors="$errors->get('password')" />

            <x-button.submit>
                Save
            </x-button.submit>
        </x-container.stack>
    </form>
</x-layout.app>