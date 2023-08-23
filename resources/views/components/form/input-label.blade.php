@props(['value'])

@if (isset($attributes['required']))
    <div class="flex gap-x-1">
        <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
            {{ $value ?? $slot }}
        </label>
        <p class="text-red-500">*</p>
    </div>
@else
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
        {{ $value ?? $slot }}
    </label>
@endif
