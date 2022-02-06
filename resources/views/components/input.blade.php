@props(['disabled' => false, 'value'])

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->class(['transition', 'border-gray-300', 'focus:border-indigo-300', 'focus:ring', 'focus:ring-indigo-200', 'focus:ring-opacity-50', 'rounded-md', 'shadow-sm']); }} value="{{ $value }}">
