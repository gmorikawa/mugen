@props([
'action' => ''
])

<form method="post" action="{{ $action }}">
    @csrf

    <x-button.submit>
        {{ $slot }}
    </x-button.submit>
</form>