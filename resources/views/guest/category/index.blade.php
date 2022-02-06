<x-guest-layout>
    <x-slot name="title">
        {{ __('ui.collection.all') }}
    </x-slot>

    <header class="flex items-center justify-center px-4 bg-indigo-500 h-72">

        <div class="flex flex-col tracking-widest text-white uppercase">
            <div class="font-semibold">
                {{ __('ui.collection.plural') }}
            </div>
            <div class="text-4xl font-black md:text-6xl">
                {{ __('ui.collection.all') }}
            </div>
        </div>
    </header>

    <div class="container mx-auto my-12 mb-20 sm:px-4 md:px-20">
        @if (!$category->count())
            <div class="mt-2 text-2xl">
                <div>
                    {{ __('ui.collection.none') }}
                </div>
            </div>
        @else

            @foreach ($category as $crow)

                @if ($loop->index > 3)
                @break
            @endif

            <div class="p-10 mt-20 bg-gray-50 rounded-xl">
                <div class="space-y-10 lg:grid lg:space-y-0 lg:grid-cols-3">
                    <div class="flex flex-col">
                        <div class="font-bold">
                            {{ __('ui.collection.singular') }}
                        </div>
                        <div class="text-5xl font-black text-indigo-500">
                            {{ $crow->name }}
                        </div>
                        <div class="flex mt-8">
                            <a href="{{ route('guest.category.show', $crow) }}"
                                class="p-4 font-semibold tracking-wider text-white bg-indigo-600 rounded-full">
                                {{ __('ui.collection.view') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col col-span-2">
                        <div class="gap-8 space-y-10 lg:space-y-0 md:grid lg:grid-cols-3">
                            @foreach ($crow->posts->where('is_published', 1) as $row)
                                @if ($loop->index == 0)
                                    <div class="col-span-3">
                                        <a href="{{ route('guest.post.show', $row) }}" class="group">
                                            <div class="mb-2 aspect-w-21 aspect-h-9">
                                                <img class="object-cover w-full rounded-xl"
                                                    src="{{ asset($row->cover) }}" alt="">
                                            </div>

                                            <div class="py-2">
                                                @foreach ($row->categories as $crows)
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                                        {{ $crows->name }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <div>
                                                <h4
                                                    class="inline-flex text-xl font-bold text-black text-truncate group-hover:text-indigo-500">
                                                    {{ $row->title }}
                                                </h4>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div>
                                        <a href="{{ route('guest.post.show', $row) }}" class="group">
                                            <div class="mb-2 aspect-w-16 aspect-h-9">
                                                <img class="object-cover w-full rounded-xl"
                                                    src="{{ asset($row->cover) }}" alt="">
                                            </div>

                                            <div class="py-1">
                                                @foreach ($row->categories as $crows)
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                                        {{ $crows->name }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <div class="my-2">
                                                <h4
                                                    class="inline-flex text-xl font-bold text-black text-truncate group-hover:text-indigo-500">
                                                    {{ $row->title }}
                                                </h4>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        {{ $category->links() }}

        @endif

    </div>

</x-guest-layout>
