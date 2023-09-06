@props(['disabled' => false])

<input accept="image/jpeg,image/jpg,image/png,.pdf" type="file" {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
    ]) !!}>
