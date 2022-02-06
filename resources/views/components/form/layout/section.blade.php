@props(['description' => '', 'submit', 'method', 'encoding'])

<div {{ $attributes->merge(['class' => '']) }}>
    <x-jet-section-title class="mb-5">
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="col-span-2 mt-5 md:mt-0">
        <form action="{{ $submit }}" method="{{ $method }}" novalidate autocomplete="off" enctype="{{ $encoding }}">
            @csrf
            <div
                class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3 space-x-4 text-right shadow bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
