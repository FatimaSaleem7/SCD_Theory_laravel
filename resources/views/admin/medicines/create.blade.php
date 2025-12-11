<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Add Medicine
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('admin.medicines.store') }}" 
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
            <label class="block font-medium text-gray-700">Category</label>
            <select name="category"
                    class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                        focus:border-green-600 focus:ring-green-600">
                <option value="">Select Category</option>
                <option value="prescription">Prescription Medicine</option>
                <option value="otc">OTC & Wellness</option>
                <option value="vitamins">Vitamins & Supplements</option>
                <option value="personal">Personal Care</option>
                <option value="baby">Baby & Mother Care</option>
            </select>
        </div>


                <div>
                    <label class="block font-medium text-gray-700">Price</label>
                    <input type="number" name="price"
                           class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                                  focus:border-green-600 focus:ring-green-600"
                           required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                              class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                                     focus:border-green-600 focus:ring-green-600"></textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="imageInput"
       class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
              focus:border-green-600 focus:ring-green-600">

<img id="previewImage" src="" class="mt-2 rounded border hidden" width="120">

                </div>

                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                    Save
                </button>

            </form>

        </div>
    </div>
<script>
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('previewImage');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
</script>

</x-app-layout>
