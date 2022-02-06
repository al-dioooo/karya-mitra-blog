<x-guest-layout>
    <x-slot name="title">
        Imagine a Place
    </x-slot>

    <x-slot name="header">
        <header class="flex items-center justify-center px-4 bg-white h-72"
            style="background: url('https://cdn-images-1.medium.com/max/2100/1*HAlD8sfP4CyJ3cLp2RvmIg.png'); background-position: center;">

            <a href="{{ route('index') }}"
                class="flex flex-col items-center space-y-4 md:space-y-0 md:space-x-4 md:flex-row">
                <img src="https://tailwindui.com/img/logos/workflow-mark-white.svg" class="w-16 h-16 md:w-20 md:h-20"
                    alt="Karya Mitra Logo">
                <div class="text-2xl font-semibold tracking-widest text-white uppercase md:text-4xl">
                    Karyamitra <span class="font-bold">Blog</span>
                </div>
            </a>
        </header>
    </x-slot>

    <div class="container mx-auto my-12 mb-20 sm:px-4 md:px-20">
        @if (!$post->count())
            <div class="mt-2 text-2xl">
                <div>
                    {{ __('ui.post.none') }}
                </div>
            </div>
        @else
            <div class="gap-10 p-10 mb-6 space-y-10 md:p-0 md:grid md:space-y-0 md:grid-cols-2 lg:grid-cols-3">

                @foreach ($post as $row)
                    @if ($loop->index == 0)
                        <div class="col-span-3">
                            <a href="{{ route('guest.post.show', $row) }}" class="group">
                                <div class="mb-2 aspect-w-21 aspect-h-9">
                                    <img class="object-cover w-full rounded-xl" src="{{ asset($row->cover) }}" alt="">
                                </div>

                                <div class="py-4">
                                    @foreach ($row->categories as $crow)
                                        <span
                                            class="inline-flex px-4 py-1 font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                            {{ $crow->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="my-2">
                                    <h4
                                        class="inline-flex text-4xl font-black text-black text-truncate group-hover:text-indigo-500">
                                        {{ $row->title }}
                                    </h4>
                                </div>

                                <div class="hidden md:flex">
                                    <article class="text-lg text-gray-500">
                                        {{ $row->subtitle }}
                                    </article>
                                </div>
                            </a>
                        </div>

                    @else

                        <div>
                            <a href="{{ route('guest.post.show', $row) }}" class="group">
                                <div class="mb-2 aspect-w-16 aspect-h-9">
                                    <img class="object-cover w-full rounded-xl" src="{{ asset($row->cover) }}" alt="">
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
                                        class="inline-flex text-3xl font-bold text-black text-truncate group-hover:text-indigo-500">
                                        {{ $row->title }}
                                    </h4>
                                </div>

                                <div class="hidden md:flex">
                                    <article class="text-sm text-gray-500">
                                        {{ $row->subtitle }}
                                    </article>
                                </div>
                            </a>
                        </div>
                    @endif

                @endforeach
            </div>


            @foreach ($categories as $crow)

                @if ($loop->index > 3)
                @break
            @endif

            <div class="p-10 mt-20 bg-gray-50 rounded-xl">
                <div class="space-y-10 lg:grid lg:space-y-0 lg:grid-cols-3">
                    <div class="flex flex-col">
                        <div class="font-bold">
                            Collection
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

        @endif

    </div>

</x-guest-layout>
