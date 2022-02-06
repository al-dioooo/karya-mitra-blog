<x-app-layout>
    <x-slot name="title">
        {{ __('ui.category.create') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('ui.category.create') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form.layout.section submit="{{ route('dashboard.category.store') }}" method="POST" title="{{ __('ui.category.create') }}"
                x-data="formData()" class="grid-cols-3 md:grid">

                <x-slot name="form">

                    <!-- Name -->
                    <div class="col-span-3">
                        <x-jet-label for="name" value="{{ __('ui.name') }}" />
                        <x-input x-model="name" id="name" name="name" type="text" class="block w-full mt-1" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Slug -->
                    <div class="col-span-3">
                        <x-jet-label for="slug" value="{{ __('Slug') }}" />
                        <x-input id="slug" name="slug" x-bind:value="slugify(name)" type="text"
                            class="block w-full mt-1" />
                        <x-jet-input-error for="slug" class="mt-2" />
                    </div>

                    <x-slot name="actions">

                        <x-jet-button>
                            {{ __('ui.create') }}
                        </x-jet-button>

                    </x-slot>
                </x-slot>
            </x-form.layout.section>
        </div>
    </div>

    <script type="text/javascript">
        function formData() {
            return {

                name: '{{ old('name') }}',

                slugify(string) {
                    return string
                        .toString()
                        .trim()
                        .toLowerCase()
                        .replace(/\s+/g, "-")
                        .replace(/[^\w\-]+/g, "")
                        .replace(/\-\-+/g, "-")
                        .replace(/^-+/, "")
                        .replace(/-+$/, "");
                },
            }
        }
    </script>

</x-app-layout>
