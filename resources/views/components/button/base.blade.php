@props([
    'type' => 'button'
])

<button
    type="{{ $type }}"
    class="border px-4 py-2 cursor-pointer rounded-sm"
>
    {{ $slot }}
</button>