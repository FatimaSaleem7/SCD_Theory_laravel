<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Medicine
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('admin.medicines.update', $medicine->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="bg-white shadow-sm p-6 rounded-lg space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium text-gray-700">Name</label>
                    <input type="text" name="name"
                        value="{{ $medicine->name }}"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600"
                        required>
                </div>

                <div>
                <label class="block font-medium text-gray-700">Category</label>
                <select name="category"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                            focus:border-green-600 focus:ring-green-600">
                    <option value="">Select Category</option>
                    <option value="prescription" {{ $medicine->category=='prescription' ? 'selected' : '' }}>
                        Prescription Medicine
                    </option>
                    <option value="otc" {{ $medicine->category=='otc' ? 'selected' : '' }}>
                        OTC & Wellness
                    </option>
                    <option value="vitamins" {{ $medicine->category=='vitamins' ? 'selected' : '' }}>
                        Vitamins & Supplements
                    </option>
                    <option value="personal" {{ $medicine->category=='personal' ? 'selected' : '' }}>
                        Personal Care
                    </option>
                    <option value="baby" {{ $medicine->category=='baby' ? 'selected' : '' }}>
                        Baby & Mother Care
                    </option>
                </select>
            </div>


                <div>
                    <label class="block font-medium text-gray-700">Price</label>
                    <input type="number" name="price"
                        value="{{ $medicine->price }}"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600"
                        required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600">{{ $medicine->description }}</textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Image</label>

                    <input type="file" name="image"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600">

                    @if($medicine->image)
                        <img src="{{ asset('storage/'.$medicine->image) }}"
                             width="80"
                             class="mt-2 rounded border">
                    @endif
                </div>

                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                    Update
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
