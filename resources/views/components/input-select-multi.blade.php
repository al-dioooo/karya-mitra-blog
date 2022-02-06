@props(['for', 'items', 'value', 'header'])

<div {!! $attributes->class(['']) !!}>
    <select class="hidden" id="select">
        @foreach ($items as $row)
            <option value="{{ $row->id }}"
                {{ $value != null ? (in_array($row->id, $value->toArray()) ? 'selected' : '') : '' }}>
                {{ $row->name }}
            </option>
        @endforeach
    </select>

    <div x-data="dropdown()" x-init="loadOptions()">
        <input name="{{ $for }}" type="hidden" :value="selectedValues()">
        <div class="relative">
            <div class="relative flex flex-col items-center">
                <div x-on:click="open" class="w-full">
                    <div :class="isOpen() === true ? 'border-indigo-300 ring ring-indigo-200 ring-opacity-50' : ''"
                        class="flex p-1 mt-1 transition bg-white border border-gray-300 rounded-md shadow-sm">
                        <div class="flex flex-wrap flex-auto">
                            <template x-for="(option,index) in selected" :key="options[option].value">
                                <div
                                    class="flex items-center justify-between px-2 m-1 space-x-2 font-medium text-indigo-700 bg-indigo-100 border border-indigo-300 rounded-full ">
                                    <div class="flex-initial max-w-full text-xs font-normal leading-none" x-model="
                                        options[option]" x-text="options[option].text"></div>
                                    <div class="flex flex-row-reverse flex-auto">
                                        <div x-on:click="remove(index,option)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" role="button"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 border-l border-gray-200">

                            <button type="button" x-on:click="show = !show"
                                class="w-6 h-6 pr-2 text-gray-400 outline-none cursor-pointer focus:outline-none">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 mt-1">
                    <div x-show="isOpen()" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="absolute left-0 z-40 w-full overflow-y-auto origin-top bg-white rounded-md shadow ring-1 ring-black ring-opacity-5 top-100 max-h-select"
                        x-on:click.away="close">
                        <div class="flex flex-col w-full">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ isset($header) ? $header : 'Select option' }}
                            </div>
                            <template x-for="(option,index) in options" :key="option">
                                <div>
                                    <div class="w-full border-b border-gray-100 cursor-pointer hover:bg-gray-100"
                                        @click="select(index,$event)">
                                        <div
                                            class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                            <div class="flex items-center w-full">
                                                <div class="mx-2 leading-6" x-model="option" x-text="option.text">
                                                </div>
                                            </div>
                                            <span x-show="option.selected"
                                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                                <svg class="w-5 h-5 text-green-400" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="options.length == 0">
                                <div>
                                    <div class="w-full border-b border-gray-100">
                                        <div
                                            class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                            <div class="flex items-center w-full">
                                                <div class="mx-2 leading-6">
                                                    {{ 'No option' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function dropdown() {
            return {
                options: [],
                selected: [],
                show: false,
                open() {
                    this.show = true
                },
                close() {
                    this.show = false
                },
                isOpen() {
                    return this.show === true
                },
                select(index, event) {

                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);


                },
                loadOptions() {
                    const options = document.getElementById('select').options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                            value: options[i].value,
                            text: options[i].innerText,
                            selected: options[i].getAttributeNode('selected') != null ? options[i].getAttributeNode(
                                'selected') : false,
                        });

                        if (options[i].getAttributeNode('selected')) {
                            this.selected.push(i);
                        }
                    }


                },
                selectedValues() {
                    return this.selected.map((option) => {
                        return this.options[option].value;
                    })
                }
            }
        }
    </script>
</div>
