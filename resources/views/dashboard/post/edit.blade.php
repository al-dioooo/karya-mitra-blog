@push('before-script')
    <script src="https://cdn.tiny.cloud/1/4h71yxnbr7nen409y3t8fpota3b64vj809bska42glt8lxhh/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.content',
            language: '{{ app()->getlocale() }}',
            height: 400,
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            branding: false,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{ route('upload') }}',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            }
        });
    </script>
@endpush

<x-app-layout>
    <x-slot name="title">
        Edit {{ $post->title }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="flex items-center space-x-2 text-xl font-semibold leading-tight text-gray-800">
                <div>
                    {{ __('ui.post.edit') }}
                </div>
                @if ($errors->count() != null)
                    <div class="flex items-center justify-center w-6 h-6 text-sm text-red-700 bg-red-200 rounded-full">
                        {{ $errors->count() }}
                    </div>
                @endif
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form.layout.section submit="{{ route('dashboard.post.update', $post) }}" method="POST"
                title="{{ __('ui.post.edit') }}" x-data="formData()" encoding="multipart/form-data">

                <x-slot name="form">
                    @method('PUT')

                    <div class="flex justify-between col-span-6">
                        <x-jet-label x-show="lang == 'en'" value="{{ __('English') }}" />
                        <x-jet-label x-show="lang == 'id'" value="{{ __('Indonesia') }}" />
                        <div class="relative">
                            <x-jet-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                            {{ __('Post Language') }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Post Language -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('ui.post.language') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-jet-dropdown-link href="" x-on:click.prevent="lang = 'en'">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    {{ __('English') }}
                                                </div>

                                                <svg x-show="lang == 'en'" class="w-5 h-5 text-green-400" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>

                                            </div>
                                        </x-jet-dropdown-link>

                                        <x-jet-dropdown-link href="" x-on:click.prevent="lang = 'id'">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    {{ __('Indonesia') }}
                                                </div>

                                                <svg x-show="lang == 'id'" class="w-5 h-5 text-green-400" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>

                                            </div>
                                        </x-jet-dropdown-link>
                                    </div>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>

                    <!-- Cover -->
                    <div class="col-span-6 md:col-span-4">
                        <x-jet-label for="cover" value="{{ __('ui.post.cover') }}" />
                        <x-input-image src="{{ asset($post->cover) }}" aspect-w="16" aspect-h="9" class="mt-1"
                            name="cover" id="cover" />
                        <x-jet-input-error for="cover" class="mt-2" />
                    </div>

                    <div class="col-span-6 space-y-4 md:col-span-2">
                        <!-- Title EN -->
                        <div x-show="lang == 'en'">
                            <x-jet-label for="english_title" value="{{ __('Title') . ' ' . __('[EN]') }}" />
                            <x-input id="english_title" name="english_title" type="text"
                                value="{{ old('english_title') ? old('english_title') : $post->setLocale('en')->title }}" class="block w-full mt-1" />
                            <x-jet-input-error for="english_title" class="mt-2" />
                        </div>

                        <!-- Title ID -->
                        <div x-show="lang == 'id'">
                            <x-jet-label for="indonesia_title" value="{{ __('Title') . ' ' . __('[ID]') }}" />
                            <x-input id="indonesia_title" name="indonesia_title" type="text"
                                value="{{ old('indonesia_title') ? old('indonesia_title') : $post->setLocale('id')->title }}" class="block w-full mt-1" />
                            <x-jet-input-error for="indonesia_title" class="mt-2" />
                        </div>

                        <!-- Subtitle EN -->
                        <div x-show="lang == 'en'">
                            <x-jet-label for="english_subtitle" value="{{ __('Subtitle') . ' ' . __('[EN]') }}" />
                            <x-input-textarea id="english_subtitle" name="english_subtitle" class="block w-full mt-1" rows="3">
                                {{ old('english_subtitle') ? old('english_subtitle') : $post->setLocale('en')->subtitle }}</x-input-textarea>
                            <x-jet-input-error for="english_subtitle" class="mt-2" />
                        </div>

                        <!-- Subtitle ID -->
                        <div x-show="lang == 'id'">
                            <x-jet-label for="indonesia_subtitle" value="{{ __('Subtitle') . ' ' . __('[ID]') }}" />
                            <x-input-textarea id="indonesia_subtitle" name="indonesia_subtitle" class="block w-full mt-1" rows="3">
                                {{ old('indonesia_subtitle') ? old('indonesia_subtitle') : $post->setLocale('id')->subtitle }}</x-input-textarea>
                            <x-jet-input-error for="indonesia_subtitle" class="mt-2" />
                        </div>

                        <!-- Slug -->
                        <div>
                            <x-jet-label for="slug" value="{{ __('Slug') }}" />
                            <x-input id="slug" name="slug" value="{{ old('slug') ? old('slug') : $post->slug }}"
                                type="text" class="block w-full mt-1" />
                            <x-jet-input-error for="slug" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="category" value="{{ __('ui.category.singular') }}" />
                            <div class="flex space-x-2">
                                <x-input-select-multi for="category" :items="$category"
                                    :value="$post->categories->pluck('id')" header="{{ __('Select Category') }}"
                                    class="w-11/12" />
                                <x-button href="{{ route('dashboard.category.create') }}"
                                    class="mt-1 mb-1 space-x-2">
                                    {{ __('Add') }}
                                </x-button>
                            </div>
                            <x-jet-input-error for="category" class="mt-2" />
                        </div>

                        <!-- Tag -->
                        <div>
                            <x-jet-label for="tag" value="{{ __('Tag') }}" />
                            <x-input-tag for="tag" value="{!! $post->tags->pluck('name') !!}" class="mt-1" />
                            <x-input-info for="tag" message="Separate tags with comma or enter" class="mt-2" />
                            <x-jet-input-error for="tag" class="mt-2" />
                        </div>

                    </div>

                    <!-- Content EN -->
                    <div class="col-span-6" x-show="lang == 'en'">
                        <x-jet-label for="english_content" value="{{ __('Content') . ' ' . __('[EN]') }}"
                            class="mb-1" />
                        <textarea name="english_content"
                            class="content">{{ old('english_content') != null ? old('english_content') : $post->setLocale('en')->content }}</textarea>
                        <x-jet-input-error for="english_content" class="mt-2" />
                    </div>

                    <!-- Content ID -->
                    <div class="col-span-6" x-show="lang == 'id'">
                        <x-jet-label for="indonesia_content" value="{{ __('ui.post.content') . ' ' . __('[ID]') }}"
                            class="mb-1" />
                        <textarea name="indonesia_content"
                            class="content">{{ old('indonesia_content') != null ? old('indonesia_content') : $post->setLocale('id')->content }}</textarea>
                        <x-jet-input-error for="indonesia_content" class="mt-2" />
                    </div>

                    <!-- Meta Description EN -->
                    <div class="col-span-6 md:col-span-3" x-show="lang == 'en'">
                        <x-jet-label for="english_meta_description" value="{{ __('ui.post.meta') . ' ' . __('[EN]') }}" />
                        <x-input-textarea id="english_meta_description" name="english_meta_description" class="block w-full mt-1"
                            rows="3">
                            {{ old('english_meta_description') != null ? old('english_meta_description') : $post->setLocale('en')->meta_desc }}
                        </x-input-textarea>
                        <x-input-info for="english_meta_description"
                            message="Recommended descriptions between 155–160 characters." class="mt-2" />
                        <x-jet-input-error for="english_meta_description" class="mt-2" />
                    </div>

                    <!-- Meta Description ID -->
                    <div class="col-span-6 md:col-span-3" x-show="lang == 'id'">
                        <x-jet-label for="indonesia_meta_description" value="{{ __('ui.post.meta') . ' ' . __('[ID]') }}" />
                        <x-input-textarea id="indonesia_meta_description" name="indonesia_meta_description" class="block w-full mt-1"
                            rows="3">
                            {{ old('indonesia_meta_description') != null ? old('indonesia_meta_description') : $post->setLocale('id')->meta_desc }}
                        </x-input-textarea>
                        <x-input-info for="indonesia_meta_description"
                            message="Recommended descriptions between 155–160 characters." class="mt-2" />
                        <x-jet-input-error for="indonesia_meta_description" class="mt-2" />
                    </div>

                    <x-slot name="actions">

                        <div class="mr-1 text-sm text-gray-500">
                            {{ $post->is_published ? __('Post published') : __('Post draft') }}
                        </div>

                        @if ($post->is_published)
                            <x-jet-secondary-button type="submit" name="action" value="draft">
                                Draft
                            </x-jet-secondary-button>
                        @else
                            <x-jet-secondary-button type="submit" name="action" value="publish">
                                Publish
                            </x-jet-secondary-button>
                        @endif

                        <x-jet-button name="action" value="save">
                            Save
                        </x-jet-button>

                    </x-slot>
                </x-slot>
            </x-form.layout.section>
        </div>
    </div>

    <script type="text/javascript">
        function formData() {
            return {

                lang: '{{ app()->getlocale() }}',
                title_en: '{{ old('english_title') }}',
                title_id: '{{ old('indonesia_title') }}',

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
