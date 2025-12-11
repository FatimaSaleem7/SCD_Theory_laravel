// ===== CART COUNT =====
function updateCartCount() {
    const cart = getCart();
    const count = cart.reduce((sum, item) => sum + item.qty, 0);
    const el = document.getElementById("cart-count");
    if (el) el.textContent = count;
}

// ===== CART HELPERS =====
function getCart() {
    return JSON.parse(localStorage.getItem("cart") || "[]");
}

function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
    displayCart();
    updateCartCount();
}

// ===== ADD TO CART =====
function addToCart(name, price, img, btn) {
    let qty = 1;

    if (btn) {
        let input =
            btn.closest(".card")?.querySelector("input[type='number']") || // inside card
            btn.parentElement.querySelector("input[type='number']") ||     // same section
            document.querySelector("section input[type='number']");        // detail page
        if (input) qty = parseInt(input.value) || 1;
    }

    const cart = getCart();
    const existing = cart.find(item => item.name === name);

    if (existing) {
        existing.qty += qty;
    } else {
        cart.push({ name, price, img, qty });
    }

    saveCart(cart);
    updateCartCount();
    //alert(`${name} (x${qty}) added to cart!`);
}

// ===== DISPLAY CART =====
function displayCart() {
    const cart = getCart();
    const cartContainer = document.getElementById("cart-items");
    const totalEl = document.getElementById("cart-total");
    if (!cartContainer) return;

    cartContainer.innerHTML = "";
    let total = 0;

    if (cart.length === 0) {
        cartContainer.innerHTML = `<tr><td colspan="6" class="text-center py-4">Your cart is empty.</td></tr>`;
        if (totalEl) totalEl.textContent = "Rs. 0";
        return;
    }

    cart.forEach((item, index) => {
        total += item.price * item.qty;
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td><img src="${item.img}" style="width:80px;height:80px;object-fit:contain;"></td>
            <td>${item.name}</td>
            <td>Rs. ${item.price}</td>
            <td>
                <button class="btn btn-outline-success btn-sm" onclick="updateQty(${index}, -1)">−</button>
                <input type="number" value="${item.qty}" min="1" class="form-control d-inline-block text-center mx-1" style="width:60px;" onchange="setQty(${index}, this.value)">
                <button class="btn btn-outline-success btn-sm" onclick="updateQty(${index}, 1)">+</button>
            </td>
            <td>Rs. ${item.price * item.qty}</td>
            <td><button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button></td>
        `;
        cartContainer.appendChild(tr);
    });

    if (totalEl) totalEl.textContent = `Rs. ${total}`;
    updateCartCount();
}

// ===== QUANTITY CONTROL =====
function updateQty(index, delta) {
    const cart = getCart();
    cart[index].qty += delta;
    if (cart[index].qty < 1) cart[index].qty = 1;
    saveCart(cart);
}

function setQty(index, value) {
    const cart = getCart();
    cart[index].qty = Math.max(1, parseInt(value) || 1);
    saveCart(cart);
}

function removeItem(index) {
    const cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
}

// ===== MAIN DOM LOADED HANDLER =====
document.addEventListener("DOMContentLoaded", () => {
    // Category filtering
    document.querySelectorAll(".category-card").forEach(card => {
        card.addEventListener("click", () => {
            const category = card.dataset.category;
            document.querySelectorAll(".medicine-card").forEach(med => {
                med.style.display = (category === "all" || med.dataset.category === category)
                    ? "block"
                    : "none";
            });
        });
    });

    // Show cart if on cart page
    displayCart();
    updateCartCount();

    // ===== CHECKOUT PAGE =====
    const checkoutForm = document.getElementById("checkout-form");
    const checkoutItemsContainer = document.getElementById("checkoutItems");
    const checkoutTotalEl = document.getElementById("checkoutTotal");

    // Display checkout summary
    if (checkoutItemsContainer && checkoutTotalEl) {
        const cart = getCart();
        let total = 0;
        checkoutItemsContainer.innerHTML = "";

        if (cart.length === 0) {
            checkoutItemsContainer.innerHTML = `<p class="text-muted">Your cart is empty.</p>`;
            checkoutTotalEl.textContent = "Rs. 0";
        } else {
            cart.forEach(item => {
                total += item.price * item.qty;
                const div = document.createElement("div");
                div.classList.add("mb-2");
                div.innerHTML = `<div class="d-flex justify-content-between">
                    <span>${item.name} x${item.qty}</span>
                    <span>Rs. ${item.price * item.qty}</span>
                </div>`;
                checkoutItemsContainer.appendChild(div);
            });
            checkoutTotalEl.textContent = `Rs. ${total}`;
        }
    }

    // Handle checkout submission
    if (checkoutForm) {
    checkoutForm.addEventListener("submit", e => {
        e.preventDefault();
        const cart = getCart();
        if (cart.length === 0) return; // no alert

        // Clear cart and redirect directly
        localStorage.removeItem("cart");
        updateCartCount();
        window.location.href = "/thankyou";
    });
}
});
