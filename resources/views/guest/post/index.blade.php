<x-guest-layout>
    <x-slot name="title">
        {{ __('ui.post.all') }}
    </x-slot>

    <header class="flex items-center justify-center px-4 bg-indigo-500 h-72">

        <div class="flex flex-col tracking-widest text-white uppercase">
            <div class="font-semibold">
                {{ __('ui.post.plural') }}
            </div>
            <div class="text-4xl font-black md:text-6xl">
                {{ __('ui.post.all') }}
            </div>
        </div>
    </header>

    <div class="container mx-auto mt-12 mb-20 sm:px-4 md:px-10">
        <div class="gap-10 p-10 md:grid md:p-0 md:grid-cols-6">
            @foreach ($post as $row)

                @if ($loop->index == 0 || $loop->index == 1)


                    <div class="col-span-3">
                        <a href="{{ route('guest.post.show', $row) }}" class="group">
                            <div class="mb-2 aspect-w-21 aspect-h-9">
                                <img class="object-cover w-full rounded-xl" src="{{ asset($row->cover) }}" alt="">
                            </div>

                            <div class="py-1">
                                @foreach ($row->categories as $crow)
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                        {{ $crow->name }}
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

                @else

                    <div class="col-span-2">
                        <a href="{{ route('guest.post.show', $row) }}" class="group">
                            <div class="mb-2 aspect-w-16 aspect-h-9">
                                <img class="object-cover w-full rounded-xl" src="{{ asset($row->cover) }}" alt="">
                            </div>

                            <div class="py-1">
                                @foreach ($row->categories as $crow)
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                        {{ $crow->name }}
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

        {{ $post->links() }}

    </div>

</x-guest-layout>
