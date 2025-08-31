<div>
    @isset ($label)
    <label for="{{ $property }}" class="block mb-1">{{ $label }}</label>
    @endisset

    <input
        name="{{ $property }}"
        id="{{ $property }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        type="email"
        class="block border w-full rounded-md px-2 py-1"
    >

    @isset ($errors)
    <ul>
        @foreach ($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>