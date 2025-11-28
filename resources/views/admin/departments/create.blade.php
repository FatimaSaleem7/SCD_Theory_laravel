
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Add Department
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('admin.departments.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="bg-white shadow-sm p-6 rounded-lg space-y-4">
                @csrf

                <div>
                    <label class="block font-medium text-gray-700">Name</label>
                    <input type="text" name="name"
                           class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                                  focus:border-green-600 focus:ring-green-600"
                           required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Icon (Font Awesome)</label>
                    <input type="text" name="icon"
                           placeholder="e.g. fas fa-heartbeat"
                           class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                                  focus:border-green-600 focus:ring-green-600">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                              class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                                     focus:border-green-600 focus:ring-green-600"></textarea>
                </div>

                
                <div>
                    <label class="block font-medium text-gray-700">Image</label>
                    <input type="file" name="image"
                           class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                                  focus:border-green-600 focus:ring-green-600">
                </div>
                
                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                    Save
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
