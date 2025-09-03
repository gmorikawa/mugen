<x-layout.app>
    <form method="post" action="/users/{{ $user->id }}/remove">
        @csrf

        @if ($errors->get('user'))
            <div class="mb-4">
                <x-alert.error>
                    {{ $errors->first('user') }}
                </x-alert.error>
            </div>
        @endif

        <p class="text-center bold mb-10">
            Do you want to remove the user {{ $user->username }}?
        </p>

        <div class="flex flex-row gap-4 justify-center">
            <x-button.link href="/users">Cancel</x-button.link>
            <x-button.submit>Confirm</x-button.submit>
        </div>
    </form>
</x-layout.app>
