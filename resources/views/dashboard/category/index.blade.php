<x-app-layout>
    <x-slot name="title">
        {{ __('ui.category.list') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('ui.category.list') }}
            </h2>
            <x-button href="{{ route('dashboard.category.create') }}">
                {{ __('ui.category.create') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-10 overflow-x-auto lg:py-8">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="inline-block min-w-full py-2 space-y-6 align-middle sm:px-6 lg:px-8">
                <form autocomplete="off">
                    <x-input id="search" name="search" type="text" class="block"
                        placeholder="{{ __('ui.category.search') }}" value="{{ request()->search }}" />
                </form>
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('ui.name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('Slug') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('ui.post.singular') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('ui.created-at') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">{{ __('ui.action') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($category->count() == null)
                                <tr class="text-center">
                                    <td colspan="7" class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ __('No category available') }}
                                    </td>
                                </tr>
                            @else
                                @foreach ($category as $row)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $row->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $row->slug }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                                {{ $row->posts->count() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ Carbon\Carbon::parse($row->created_at)->locale(app()->getlocale())->isoformat('D MMMM YYYY') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="inline-flex items-center space-x-4">

                                                <a href="{{ route('dashboard.category.edit', $row->slug) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                                <form id="destroy"
                                                    action="{{ route('dashboard.category.destroy', $row->slug) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                {{ $category->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
