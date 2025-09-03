<div>
    @if ($label)
    <label
        class="{{ $errors ? 'block mb-1 text-red-500' : 'block mb-1' }}">
        {{ $label }}
    </label>
    @endif

    <div class="flex flex-row gap-4">
        @foreach ($options as $option)
        <div>
            <input
                name="{{ $property }}"
                id="{{ $option['key'] }}"
                value="{{ $option['key'] }}"
                type="radio"
                @if ($option['key'] === $value) checked @endif
                class="{{ $errors ? 'border w-full rounded-md px-2 py-1 border-red-500' : 'border rounded-md px-2 py-1' }}">
            <label for="{{ $option['key'] }}">
                {{ $option['label'] }}
            </label>
        </div>
        @endforeach
    </div>

    @if ($errors)
    <ul>
        @foreach ($errors as $error)
        <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>