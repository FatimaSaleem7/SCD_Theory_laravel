<div class="d-flex position-relative mb-3" style="max-width:560px; margin:0 auto;">
    <input id="globalSearch" type="text" class="form-control" placeholder="Search medicines by name or category..." autocomplete="off">
    <button id="globalSearchBtn" class="btn btn-success ms-2">Search</button>

    <div id="globalSearchDropdown" 
         class="position-absolute start-0 end-0 bg-white border rounded-bottom shadow-lg" 
         style="top: 100%; z-index: 1000; display: none; max-height: 400px; overflow-y: auto; margin-top: 2px;">
        <ul id="globalSearchResults" class="list-group list-group-flush mb-0 text-start"></ul>
    </div>
</div>
