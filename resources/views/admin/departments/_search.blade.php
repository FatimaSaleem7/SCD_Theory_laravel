<div class="relative w-full max-w-sm ml-auto mr-4">
    <div class="flex shadow-sm rounded-md">
        <input id="deptSearch" 
               type="text" 
               class="flex-1 w-full border border-gray-300 rounded-l-md focus:ring-green-500 focus:border-green-500 sm:text-sm px-4 py-2" 
               placeholder="Search departments..." 
               autocomplete="off">

        <button id="deptSearchBtn" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-green-600 hover:bg-green-700">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Results dropdown -->
    <div id="deptSearchDropdown" 
         class="absolute z-50 w-full mt-1 bg-white rounded-md shadow-xl border border-gray-200 hidden max-h-96 overflow-y-auto">
        <ul id="deptSearchResults" class="divide-y divide-gray-100"></ul>
    </div>
</div>
