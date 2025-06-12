<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.reservations.create') }}"
                    class="px-5 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Create New</a>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reservation Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                table
                            </th>
                            <th scope="col" class="px-6 py-3">
                                guest_number
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($reservation->count() > 0)

                            @foreach ($reservation as $data)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->first_name }}{{ $data->last_name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $data->email }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $data->res_date }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $data->table->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $data->guest_number }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        <div class="flex">
                                            <a class="px-4 py-2 ml-2 bg-green-500 hover:bg-green-700 rounded-lg text-white"
                                                href="{{ route('admin.reservations.edit', $data->id) }}">Edit</a>
                                            <form method="POST"
                                                action="{{ route('admin.reservations.destroy', $data->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete it?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-4 py-2 ml-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                    type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                    No reservation available.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-admin-layout>
