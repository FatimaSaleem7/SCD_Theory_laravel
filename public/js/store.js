// ===== CART HELPERS =====
function getCart() {
    return JSON.parse(localStorage.getItem("cart") || "[]");
}

function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
    displayCart();
}

// ===== ADD TO CART =====
function addToCart(name, price, img, btn) {
    let qty = 1;
    if (btn) {
        const input = btn.closest(".card")?.querySelector("input[type='number']");
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
    alert(`${name} (x${qty}) added to cart!`);
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
        cartContainer.innerHTML = `<div class="text-center py-4"><h5>Your cart is empty.</h5></div>`;
        totalEl.textContent = "Rs. 0";
        return;
    }

    cart.forEach((item, index) => {
        total += item.price * item.qty;
        const div = document.createElement("div");
        div.classList.add("col-md-4");
        div.innerHTML = `
            <div class="card shadow-sm border-0 h-100">
                <img src="${item.img}" class="card-img-top" alt="${item.name}" style="height:200px;object-fit:contain;">
                <div class="card-body text-center">
                    <h5 class="fw-bold">${item.name}</h5>
                    <p class="text-success mb-1">Rs. ${item.price}</p>
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <button class="btn btn-outline-success btn-sm" onclick="updateQty(${index}, -1)">−</button>
                        <input type="number" value="${item.qty}" min="1" style="width:60px;" class="form-control text-center mx-2" onchange="setQty(${index}, this.value)">
                        <button class="btn btn-outline-success btn-sm" onclick="updateQty(${index}, 1)">+</button>
                    </div>
                    <button class="btn btn-danger btn-sm mt-2" onclick="removeItem(${index})">Remove</button>
                </div>
            </div>
        `;
        cartContainer.appendChild(div);
    });

    totalEl.textContent = `Rs. ${total}`;
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

// ===== CATEGORY FILTER =====
document.addEventListener("DOMContentLoaded", () => {
    // Filter by category
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

    displayCart();

    // Checkout page handling
    const checkoutForm = document.getElementById("checkout-form");
    if (checkoutForm) {
        checkoutForm.addEventListener("submit", e => {
            e.preventDefault();
            if (getCart().length === 0) {
                alert("Your cart is empty.");
                return;
            }
            alert("Order placed successfully!");
            localStorage.removeItem("cart");
            displayCart();
            checkoutForm.reset();
        });
    }

    // Display checkout items if on checkout page
    const checkoutItemsContainer = document.getElementById("checkoutItems");
    const checkoutTotalEl = document.getElementById("checkoutTotal");
    if (checkoutItemsContainer && checkoutTotalEl) {
        const cart = getCart();
        let total = 0;
        checkoutItemsContainer.innerHTML = "";
        cart.forEach(item => {
            total += item.price * item.qty;
            const div = document.createElement("div");
            div.classList.add("mb-2");
            div.innerHTML = `<div class="d-flex justify-content-between"><span>${item.name} x${item.qty}</span><span>Rs. ${item.price * item.qty}</span></div>`;
            checkoutItemsContainer.appendChild(div);
        });
        checkoutTotalEl.textContent = `Rs. ${total}`;
    }
});
