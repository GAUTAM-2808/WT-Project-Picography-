// Get the grid items and store section
const gridItems = document.querySelectorAll('.grid-item');
const storeLink = document.getElementById('store-link');

// Add event listeners to the add to cart buttons
gridItems.forEach((gridItem) => {
  const addToCartButton = gridItem.querySelector('.add-to-cart');
  addToCartButton.addEventListener('click', () => {
    // Get the image URL and add it to local storage
    const imageUrl = gridItem.querySelector('img').src;
    addItemToLocalStorage(imageUrl);
    window.location.href = 'store.html';
  });
});

// Function to add item to local storage
function addItemToLocalStorage(imageUrl) {
  let storedItems = localStorage.getItem('storeItems');
  if (storedItems) {
    storedItems = JSON.parse(storedItems);
    storedItems.push(imageUrl);
  } else {
    storedItems = [imageUrl];
  }
  localStorage.setItem('storeItems', JSON.stringify(storedItems));
}

// Add event listener to the store link
storeLink.addEventListener('click', () => {
  window.location.href = 'store.html';
});