// cart.js

// Get the cart container
const cartContainer = document.getElementById('cart-container');
const totalPriceElement = document.getElementById('total-price');

// Initialize the cart
let cart = [];

// Function to add item to cart
function addToCart(item) {
  // Check if item is already in cart
  const existingItem = cart.find((i) => i.id === item.id);
  if (existingItem) {
    // If item is already in cart, increment quantity
    existingItem.quantity++;
  } else {
    // If item is not in cart, add it
    cart.push({ ...item, quantity: 1 });
  }
  updateCartContainer();
}

// Function to remove item from cart
function removeFromCart(itemId) {
  // Find the item in the cart
  const index = cart.findIndex((i) => i.id === itemId);
  if (index !== -1) {
    // If item is found, remove it
    cart.splice(index, 1);
  }
  updateCartContainer();
}

// Function to update cart container
function updateCartContainer() {
  // Clear the cart container
  cartContainer.innerHTML = '';
  // Loop through cart items and add them to the container
  cart.forEach((item) => {
    const cartItem = document.createElement('div');
    cartItem.innerHTML = `
      <h3>${item.name}</h3>
      <p>Quantity: ${item.quantity}</p>
      <button class="remove-from-cart" data-id="${item.id}">Remove from Cart</button>
    `;
    cartContainer.appendChild(cartItem);
  });
  // Update the total price
  const totalPrice = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
  totalPriceElement.innerText = `Total: $${totalPrice.toFixed(2)}`;
}

// Add event listeners to add to cart buttons
document.querySelectorAll('.add-to-cart').forEach((button) => {
  button.addEventListener('click', (e) => {
    const item = {
      id: e.target.dataset.id,
      name: e.target.dataset.name,
      price: parseFloat(e.target.dataset.price),
    };
    addToCart(item);
  });
});

// Add event listeners to remove from cart buttons
cartContainer.addEventListener('click', (e) => {
  if (e.target.classList.contains('remove-from-cart')) {
    const itemId = e.target.dataset.id;
    removeFromCart(itemId);
  }
});