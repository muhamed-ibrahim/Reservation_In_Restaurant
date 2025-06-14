<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto min-h-screen">
        @if (!empty($menus) && $menus->count())
            <div class="grid lg:grid-cols-4 gap-y-6">
                @foreach ($menus as $menu)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48 object-cover" src="{{ Storage::url($menu->image) }}" alt="Image" />
                        <div class="px-6 py-4 text-center">
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                                {{ $menu->name }}
                            </h4>
                            <p class="leading-normal text-gray-700">
                                {{ $menu->description }}
                            </p>
                            <div class="p-4">
                                <span class="text-xl text-green-600">${{ $menu->price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex items-center justify-center h-full min-h-[400px] w-full">
                <p class="text-gray-600 text-xl text-center">No menus available.</p>
            </div>
        @endif
    </div>
</x-guest-layout>
