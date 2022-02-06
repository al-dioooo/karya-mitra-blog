@props(['for', 'message'])

@error($for)
@else
    <p {{ $attributes->merge(['class' => 'text-sm text-gray-500']) }}>{{ $message }}</p>
@enderror
