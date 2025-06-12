<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        @if (!empty($categories) && $categories->count())
            <div class="grid lg:grid-cols-4 gap-y-6">
                @foreach ($categories as $category)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48 object-cover"
                             src="{{ $category->image ? Storage::url($category->image) : asset('images/default.jpg') }}"
                             alt="{{ $category->name }}" />
                        <div class="px-6 py-4 text-center">
                            <a href="{{ route('categories.show', $category->id) }}">
                                <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                                    {{ $category->name }}
                                </h4>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex items-center justify-center h-96">
                <p class="text-gray-600 text-xl">No categories available.</p>
            </div>
        @endif
    </div>
</x-guest-layout>
