<x-layout.auth>
    <section>
        <h2 class="text-center font-bold text-3xl">
            Login
        </h2>
    </section>

    <form class="flex flex-col gap-4" method="post" action="/login">
        @csrf

        <x-input.email-input property="email" label="E-mail" :errors="$errors->get('email')" value="{{ old('email') }}" />

        <x-input.password-input property="password" label="Password" />

        <div>
            <button type="submit" class="border rounded-md p-3 cursor-pointer">
                Login
            </button>
        </div>
    </form>
</x-layout.auth>