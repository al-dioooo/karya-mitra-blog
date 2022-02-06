<div class="flex flex-col p-10 space-y-10 bg-gray-900 md:p-20">
    <div class="flex flex-col justify-between space-y-10 md:space-y-0 md:flex-row">
        <h3 class="text-4xl font-black text-white">
            Imagine a Place
        </h3>

        <div class="grid grid-cols-3 gap-12 text-white">
            <div class="flex flex-col space-y-2">
                <div class="font-semibold text-indigo-600">{{ __('ui.company') }}</div>
                <a href="https://karyamitra.co.id/" target="_blank" class="hover:underline">Karya Mitra</a>
                <a href="{{ route('index') }}" class="hover:underline">Blog</a>
            </div>

            <div class="flex flex-col space-y-2">
                <div class="font-semibold text-indigo-600">{{ __('ui.collection.plural') }}</div>
                <a href="{{ route('guest.category.index') }}" class="hover:underline">{{ __('ui.all') }}</a>
                @foreach ($categories as $row)
                    <a href="{{ route('guest.category.show', $row) }}" class="hover:underline">{{ $row->name }}</a>
                @endforeach
            </div>

            <div class="flex flex-col space-y-2">
                <div class="font-semibold text-indigo-600">{{ __('ui.post.plural') }}</div>
                <a href="{{ route('guest.post.index') }}" class="hover:underline">{{ __('ui.all') }}</a>
                <a href="{{ route('login') }}" class="hover:underline">{{ __('ui.write') }}</a>
            </div>
        </div>
    </div>

    <hr>

    <div class="flex flex-col items-center justify-between space-y-10 md:space-y-0 md:flex-row">
        <div>
            <a href="{{ route('index') }}" class="flex items-center space-x-4">
                <img src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" class="w-10 h-10"
                    alt="Karya Mitra Logo">
                <div class="text-xl font-semibold tracking-widest text-indigo-600 uppercase">
                    Karyamitra <span class="font-bold">Blog</span>
                </div>
            </a>
        </div>

        <div class="text-xs text-gray-200">
            © <span x-data="{ year: (new Date()).getFullYear() }" x-text="year">2021</span> Karya Mitra Usaha. All
            rights reserved.
        </div>
    </div>
</div>
