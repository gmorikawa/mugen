<div>
    @isset ($label)
    <label for="{{ $property }}" class="block mb-1">{{ $label }}</label>
    @endisset

    <input
        name="{{ $property }}"
        id="{{ $property }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        type="password"
        class="block border w-full rounded-md px-2 py-1"
    >

    @foreach ($errors as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>