<form method="post" action="{{ $action }}">
    @csrf

    <button
        type="submit"
        class="border px-4 py-2 cursor-pointer rounded-sm"
    >
        {{ $slot }}
    </button>
</form>