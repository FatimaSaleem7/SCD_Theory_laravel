
/**
 * Admin Panel Ajax Search for Medicines
 * Uses Tailwind CSS for styling
 */

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('globalSearch');
    const button = document.getElementById('globalSearchBtn');
    const dropdown = document.getElementById('globalSearchDropdown');
    const results = document.getElementById('globalSearchResults');

    // Check if elements exist
    if (!input || !button || !dropdown || !results) {
        return;
    }

    /**
     * Escape HTML to prevent XSS
     */
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

    /**
     * Perform Ajax search
     */
    async function searchMedicines(query) {
        // Hide dropdown if query is empty
        if (!query.trim()) {
            results.innerHTML = '';
            dropdown.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(`/ajax/medicines/search?query=${encodeURIComponent(query)}`);
            const data = await response.json();

            if (!data.length) {
                results.innerHTML = '<li class="p-4 text-center text-gray-500 text-sm">No results found</li>';
            } else {
                // Build results HTML using Tailwind CSS classes
                results.innerHTML = data.map(item => `
                    <li class="hover:bg-gray-50 transition duration-150 ease-in-out cursor-pointer border-b border-gray-100 last:border-0">
                        <a href="/admin/medicines/${item.id}/edit" class="flex items-center p-3 text-decoration-none group">
                            <!-- Image -->
                            <div class="flex-shrink-0 mr-4">
                                ${item.image
                        ? `<img src="/storage/${item.image}" class="h-12 w-12 rounded object-cover border border-gray-200 shadow-sm">`
                        : `<div class="h-12 w-12 rounded bg-gray-100 flex items-center justify-center border border-gray-200"><i class="fas fa-pills text-gray-400"></i></div>`
                    }
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate group-hover:text-green-600">
                                    ${escapeHtml(item.name)}
                                </p>
                                <p class="text-xs text-gray-500 truncate mt-0.5">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        ${escapeHtml(item.category || 'Uncategorized')}
                                    </span>
                                </p>
                            </div>

                            <!-- Price -->
                            <div class="ml-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                    Rs. ${item.price}
                                </span>
                            </div>
                        </a>
                    </li>
                `).join('');
            }

            // Show dropdown
            dropdown.classList.remove('hidden');

        } catch (error) {
            console.error('Search error:', error);
            results.innerHTML = '<li class="p-4 text-center text-red-500 text-sm">Error loading results</li>';
            dropdown.classList.remove('hidden');
        }
    }

    // Debounce timer
    let debounceTimeout;
    input.addEventListener('keyup', function () {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            searchMedicines(input.value);
        }, 300);
    });

    // Button click
    button.addEventListener('click', function (e) {
        e.preventDefault();
        searchMedicines(input.value);
    });

    // Enter key
    input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchMedicines(input.value);
        }
    });

    // Click outside to close
    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target) && e.target !== input && e.target !== button) {
            dropdown.classList.add('hidden');
        }
    });

    // Focus to show (if has results)
    input.addEventListener('focus', function () {
        if (input.value.trim() && results.innerHTML) {
            dropdown.classList.remove('hidden');
        }
    });
});
