<div>
    @if ($label)
    <label
        for="{{ $property }}"
        class="{{ $errors ? 'block mb-1 text-red-500' : 'block mb-1' }}">
        {{ $label }}
    </label>
    @endif

    <input
        name="{{ $property }}"
        id="{{ $property }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        type="{{ $type }}"
        class="{{ $errors ? 'block border w-full rounded-md px-2 py-1 border-red-500' : 'block border w-full rounded-md px-2 py-1' }}">

    @if ($errors)
    <ul>
        @foreach ($errors as $error)
        <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>