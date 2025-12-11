document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('deptSearch');
    const button = document.getElementById('deptSearchBtn');
    const dropdown = document.getElementById('deptSearchDropdown');
    const results = document.getElementById('deptSearchResults');

    if (!input || !button || !dropdown || !results) return;

    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>"']/g, function (m) {
            return ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            })[m];
        });
    }

    async function searchDepartments(query) {
        if (!query.trim()) {
            results.innerHTML = '';
            dropdown.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(`/ajax/departments/search?query=${encodeURIComponent(query)}`);
            const data = await response.json();

            if (!data.length) {
                results.innerHTML = '<li class="p-4 text-center text-gray-500 text-sm">No results found</li>';
            } else {
                results.innerHTML = data.map(item => `
                    <li class="hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-0">
                        <a href="/admin/departments/${item.id}/edit"
                           class="flex items-center p-3 group">

                            <div class="flex-shrink-0 mr-4">
                                ${item.image
                        ? `<img src="/storage/${item.image}" class="h-12 w-12 rounded object-cover border border-gray-200 shadow-sm">`
                        : `<div class="h-12 w-12 rounded bg-gray-100 flex items-center justify-center border border-gray-200">
                                <i class="fas fa-building text-gray-400"></i>
                           </div>`
                    }
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate group-hover:text-green-600">
                                    ${escapeHtml(item.name)}
                                </p>
                                <p class="text-xs text-gray-500 truncate mt-0.5">
                                    ${escapeHtml(item.description || 'No description')}
                                </p>
                            </div>
                        </a>
                    </li>
                `).join('');
            }

            dropdown.classList.remove('hidden');

        } catch (error) {
            console.error('Search error:', error);
            results.innerHTML = '<li class="p-4 text-center text-red-500 text-sm">Error loading results</li>';
            dropdown.classList.remove('hidden');
        }
    }

    let debounce;
    input.addEventListener('keyup', function () {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
            searchDepartments(input.value);
        }, 300);
    });

    button.addEventListener('click', function (e) {
        e.preventDefault();
        searchDepartments(input.value);
    });

    input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchDepartments(input.value);
        }
    });

    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target) && e.target !== input && e.target !== button) {
            dropdown.classList.add('hidden');
        }
    });

    input.addEventListener('focus', function () {
        if (input.value.trim() && results.innerHTML) {
            dropdown.classList.remove('hidden');
        }
    });
});
