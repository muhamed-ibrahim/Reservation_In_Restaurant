<x-guest-layout>
    @if ($categories->menus->count())
        <div class="container w-full px-5 py-6 mx-auto">
            <div class="grid lg:grid-cols-4 gap-y-6">
                @foreach ($categories->menus as $menu)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ Storage::url($menu->image) }}" alt="Image" />
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
        </div>
    @else
        <div class="flex items-center justify-center min-h-screen">
            <p class="text-center text-gray-500 text-lg">
                No menu items available for this category.
            </p>
        </div>
    @endif
</x-guest-layout>
