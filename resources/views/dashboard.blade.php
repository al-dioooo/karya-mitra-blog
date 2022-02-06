<x-app-layout>
    <x-slot name="title">
        Website Dashboard
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
                <div class="p-6 bg-white border-b border-gray-200 shadow sm:rounded-lg">
                    <div class="flex items-center h-full space-x-8">
                        <div class="flex items-center p-4 text-indigo-500 bg-indigo-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M3 19c3.333 -2 5 -4 5 -6c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 2.877 2.5 4c1.5 2 2.5 2.5 3.5 1c.667 -1 1.167 -1.833 1.5 -2.5c1 2.333 2.333 3.5 4 3.5h2.5">
                                </path>
                                <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z"></path>
                                <path d="M16 7h4"></path>
                            </svg>
                        </div>

                        <div>
                            <div class="text-lg font-semibold text-gray-500">
                                @if ($post > 1)
                                    {{ __('ui.post.plural') }}
                                @else
                                    {{ __('ui.post.singular') }}
                                @endif
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $post }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200 shadow sm:rounded-lg">
                    <div class="flex items-center h-full space-x-8">
                        <div class="flex items-center p-4 text-indigo-500 bg-indigo-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                <line x1="4" y1="12" x2="20" y2="12"></line>
                            </svg>
                        </div>

                        <div>
                            <div class="text-lg font-semibold text-gray-500">
                                @if ($category > 1)
                                    {{ __('ui.category.plural') }}
                                @else
                                    {{ __('ui.category.singular') }}
                                @endif
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $category }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200 shadow sm:rounded-lg">
                    <div class="flex items-center h-full space-x-8">
                        <div class="flex items-center p-4 text-indigo-500 bg-indigo-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            </svg>
                        </div>

                        <div>
                            <div class="text-lg font-semibold text-gray-500">
                                @if ($user > 1)
                                    {{ __('ui.user.plural') }}
                                @else
                                    {{ __('ui.user.singular') }}
                                @endif
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $user }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
