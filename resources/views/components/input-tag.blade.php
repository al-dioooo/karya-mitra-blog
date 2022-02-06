@props(['for', 'value'])

<div x-data @tags-update="console.log('tags updated', $event.detail.tags)" data-tags="{{ $value }}">
    <div x-data="tagSelect()" x-init="init('parentEl')" @click.away="clearSearch()" @keydown.escape="clearSearch()">
        <div class="relative" @keydown.enter.prevent="addTag(textInput)">
            <input x-model="textInput" id="{{ $for }}" x-ref="textInput" @input="search($event.target.value)"
                {{ $attributes->class(['transition', 'w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'focus:border-indigo-300', 'focus:ring', 'focus:ring-indigo-200', 'focus:ring-opacity-50', 'rounded-md', 'shadow-sm', 'focus:outline-none']) }}>
            <div :class="[open ? 'block' : 'hidden']">
                <div class="absolute left-0 z-40 w-full mt-2">
                    <div class="overflow-hidden text-sm bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                        <a @click.prevent="addTag(textInput)"
                            class="block px-4 py-2 cursor-pointer hover:bg-gray-100">Add tag "<span
                                class="font-semibold" x-text="textInput"></span>"</a>
                    </div>
                </div>
            </div>
            <!-- selections -->
            <template x-for="(tag, index) in tags">
                {{-- <div class="inline-flex items-center mt-2 mr-1 text-sm bg-indigo-100 rounded">
                    <span class="max-w-xs ml-2 mr-1 leading-relaxed truncate" x-text="tag"></span>
                    <button @click.prevent="removeTag(index)"
                        class="inline-block w-6 h-8 text-gray-500 align-middle hover:text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6 mx-auto fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z" />
                        </svg>
                    </button>
                </div> --}}
                <div
                    class="inline-flex items-center justify-between px-2 py-1 m-1 space-x-2 font-medium text-indigo-700 bg-indigo-100 border border-indigo-300 rounded-full ">
                    <div class="flex-initial max-w-full text-xs font-normal leading-none" x-text="tag"></div>
                    <div class="flex flex-row-reverse flex-auto">
                        <div x-on:click="removeTag(index)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" role="button" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <input type="hidden" name="{{ $for }}" :value="getTags()">
    </div>
</div>

@push('component-after-script')
    <script type="text/javascript">
        function tagSelect() {
            return {
                open: false,
                textInput: '',
                tags: [],
                init() {
                    this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags'));
                },
                getTags() {
                    return this.tags;
                },
                addTag(tag) {
                    tag = tag.trim()
                    if (tag != "" && !this.hasTag(tag)) {
                        this.tags.push(tag)
                    }
                    this.clearSearch()
                    this.$refs.textInput.focus()
                    this.fireTagsUpdateEvent()
                },
                fireTagsUpdateEvent() {
                    this.$el.dispatchEvent(new CustomEvent('tags-update', {
                        detail: {
                            tags: this.tags
                        },
                        bubbles: true,
                    }));
                },
                hasTag(tag) {
                    var tag = this.tags.find(e => {
                        return e.toLowerCase() === tag.toLowerCase()
                    })
                    return tag != undefined
                },
                removeTag(index) {
                    this.tags.splice(index, 1)
                    this.fireTagsUpdateEvent()
                },
                search(q) {
                    if (q.includes(",")) {
                        q.split(",").forEach(function(val) {
                            this.addTag(val)
                        }, this)
                    }
                    this.toggleSearch()
                },
                clearSearch() {
                    this.textInput = ''
                    this.toggleSearch()
                },
                toggleSearch() {
                    this.open = this.textInput != ''
                }
            }
        }
    </script>
@endpush
