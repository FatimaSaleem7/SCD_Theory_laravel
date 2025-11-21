<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Manage Medicines</h2>
    </x-slot>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Medicines List</h3>
            <a href="{{ route('admin.medicines.create') }}" class="btn btn-success px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add Medicine</a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Image</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Category</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Price</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($medicines as $m)
                        <tr>
                            <td class="px-6 py-4">
                                @if($m->image)
                                    <img src="{{ asset('storage/'.$m->image) }}" width="60" class="rounded">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $m->name }}</td>
                            <td class="px-6 py-4">{{ $m->category ?? '-' }}</td>
                            <td class="px-6 py-4">Rs. {{ number_format($m->price, 2) }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.medicines.edit', $m->id) }}" class="btn btn-warning px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>

                                <form action="{{ route('admin.medicines.destroy', $m->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this medicine?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No medicines found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

</x-app-layout>
