<x-app-layout>
    <x-slot name="title">
        {{ __('ui.user.create') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('ui.user.create') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form.layout.section submit="{{ route('dashboard.user.store') }}" method="POST"
                title="{{ __('ui.user.create') }}"
                class="grid-cols-3 md:grid" encoding="multipart/form-data">

                <x-slot name="form">
                    <div class="flex flex-col col-span-6 space-y-4 md:col-span-4">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="photo" value="{{ __('ui.user.photo') }}" />

                            <!-- Profile Photo -->
                            <div class="w-40 h-40 mt-2">
                                <x-input-image aspect-w="1" aspect-h="1" name="photo" id="photo"
                                    class="overflow-hidden rounded-full"
                                    src="https://ui-avatars.com/api/?color=7F9CF5&background=EBF4FF" />
                            </div>

                            <x-jet-input-error for="photo" class="mt-2" />
                        </div>
                        <!-- Name -->
                        <div>
                            <x-jet-label for="name" value="{{ __('ui.name') }}" />
                            <x-input id="name" name="name" type="text" value="{{ old('name') }}"
                                class="block w-full mt-1" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" name="email" type="text" value="{{ old('email') }}"
                                class="block w-full mt-1" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" name="password" type="password" class="block w-full mt-1" />
                            <x-jet-input-error for="password" class="mt-2" />
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <x-jet-label for="password_confirmation" value="{{ __('Password Confirmation') }}" />
                            <x-input id="password_confirmation" name="password_confirmation" type="password"
                                class="block w-full mt-1" />
                            <x-jet-input-error for="password_confirmation" class="mt-2" />
                        </div>

                        <!-- Team -->
                        <div>
                            <x-jet-label for="team" value="{{ __('ui.team.singular') }}" />
                            <select id="team" name="team"
                                class="block w-full mt-1 transition border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($team as $row)
                                    <option value="{{ $row->id }}" value="{{ old('team') == $row->id ? 'selected' : '' }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="team" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div class="col-span-6 lg:col-span-4" x-data="{selected: ''}">
                            <x-jet-label for="role" value="{{ __('ui.team.role') }}" />
                            <input type="hidden" name="role" :value="selected">
                            <x-jet-input-error for="role" class="mt-2" />

                            <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                                @foreach ($role as $index => $row)
                                    <button type="button" x-on:click.prevent="selected = '{{ $row->key }}'"
                                        class="transition relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}">
                                        <div :class="selected !== '{{ $row->key }}' ? 'opacity-50' : ''"
                                            class="transition">
                                            <!-- Role Name -->
                                            <div class="flex items-center">
                                                <div :class="selected == '{{ $row->key }}' ? 'font-semibold' : ''"
                                                    class="text-sm text-gray-600 transition">
                                                    {{ $row->name }}
                                                </div>

                                                <svg x-show="selected == '{{ $row->key }}'"
                                                    class="w-5 h-5 ml-2 text-green-400" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>

                                            <!-- Role Description -->
                                            <div class="mt-2 text-xs text-gray-600">
                                                {{ $row->description }}
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
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
                photo: 'https://ui-avatars.com/api/?name=Aldio+Lisafron&color=7F9CF5&background=EBF4FF'
            }
        }
    </script>

</x-app-layout>
