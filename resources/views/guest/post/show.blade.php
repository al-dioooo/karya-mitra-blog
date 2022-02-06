<x-guest-layout>
    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <div class="container pt-10 mx-auto mb-5 lg:px-20">
        <div class="space-y-8">
            <div class="flex flex-col px-10 py-5 space-y-4 text-center md:px-32">
                <div class="font-normal text-gray-500">
                    {{ __('ui.published') . ' ' . __('ui.on') .
    ' ' .
    Carbon\Carbon::parse($post->created_at)->locale(app()->getlocale())->isoformat('D MMMM YYYY') }}
                </div>
                <h4 class="text-4xl font-bold md:text-6xl">
                    {{ $post->title }}
                </h4>
                <p>
                    {{ $post->subtitle }}
                </p>
                <div class="flex items-center justify-center w-full space-x-4">
                    @foreach ($post->categories as $category)
                        <a href="{{ route('guest.category.show', $category) }}"
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="w-full aspect-w-21 aspect-h-9">
                <img src="{{ asset($post->cover) }}" alt="{{ $post->slug }}" class="object-cover w-full rounded-xl">
            </div>

            <div class="flex w-full px-10 md:px-16 lg:px-32">
                <div class="min-w-full prose prose-lg prose-indigo">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <div class="flex flex-col px-10 pt-8 my-20 space-y-4 border-t sm:px-0">
            <h4 class="text-2xl font-bold">
                {{ __('ui.author') }}
            </h4>
            <div class="flex items-center">
                <a href="{{ asset($post->author->profile_photo_url) }}" target="_blank"
                    class="flex-shrink-0 w-10 h-10">
                    <img class="object-cover w-10 h-10 rounded-full"
                        src="{{ asset($post->author->profile_photo_url) }}" alt="{{ $post->slug }}">
                </a>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $post->author->name }}
                    </div>
                    <div class="overflow-hidden text-sm text-gray-500 w-44 overflow-ellipsis">
                        {{ $post->author->email }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
