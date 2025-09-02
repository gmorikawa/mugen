@props([
'href' => ''
])

<a
    href="{{ $href }}"
    class="inline-block border px-4 py-2 cursor-pointer rounded-sm text-center">
    {{ $slot }}
</a>