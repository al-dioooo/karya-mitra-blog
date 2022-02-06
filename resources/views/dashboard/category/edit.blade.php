<x-app-layout>
    <x-slot name="title">
        {{ __('ui.edit') . ' ' . $category->name }}
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('ui.category.edit') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form.layout.section submit="{{ route('dashboard.category.update', $category) }}" method="POST"
                title="{{ __('ui.category.edit') }}" class="grid-cols-3 md:grid">

                <x-slot name="form">
                    @method('patch')

                    <!-- Name -->
                    <div class="col-span-3">
                        <x-jet-label for="name" value="{{ __('ui.name') }}" />
                        <x-input id="name" name="name" type="text" class="block w-full mt-1" value="{{ old('name') != null ? old('name') : $category->name }}" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Slug -->
                    <div class="col-span-3">
                        <x-jet-label for="slug" value="{{ __('Slug') }}" />
                        <x-input id="slug" name="slug" type="text"
                            class="block w-full mt-1" value="{{ old('slug') != null ? old('slug') : $category->slug }}" />
                        <x-jet-input-error for="slug" class="mt-2" />
                    </div>

                    <x-slot name="actions">

                        <x-jet-button>
                            Update
                        </x-jet-button>

                    </x-slot>
                </x-slot>
            </x-form.layout.section>
        </div>
    </div>

</x-app-layout>
