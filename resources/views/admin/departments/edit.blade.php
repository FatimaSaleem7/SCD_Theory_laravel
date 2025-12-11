
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Department
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('admin.departments.update', $department->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="bg-white shadow-sm p-6 rounded-lg space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium text-gray-700">Name</label>
                    <input type="text" name="name"
                        value="{{ $department->name }}"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600"
                        required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Icon (Font Awesome)</label>
                    <input type="text" name="icon"
                        value="{{ $department->icon }}"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600"
                        placeholder="e.g. fas fa-heartbeat">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
                               focus:border-green-600 focus:ring-green-600">{{ $department->description }}</textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Image</label>
                   <input type="file" name="image" id="imageInput"
       class="mt-1 w-full border-gray-300 rounded-lg shadow-sm 
              focus:border-green-600 focus:ring-green-600">

<img id="previewImage" 
     src="{{ $department->image ? asset('storage/'.$department->image) : '' }}"
     class="mt-2 rounded border {{ $department->image ? '' : 'hidden' }}"
     width="120">


                    @if($department->image)
                        <img src="{{ asset('storage/'.$department->image) }}"
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

