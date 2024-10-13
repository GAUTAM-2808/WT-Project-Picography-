// Get the grid items and store section
const gridItems = document.querySelectorAll('.grid-item');
const storeLink = document.getElementById('store-link');

// Function to add item to local storage
function addItemToLocalStorage(imageUrl) {
  console.log(`Adding image URL to local storage: ${imageUrl}`);
  let storedItems = localStorage.getItem('storeItems');
  if (storedItems) {
    storedItems = JSON.parse(storedItems);
    storedItems.push({ imageUrl: imageUrl, quantity: 1 }); // Store image URL and quantity
  } else {
    storedItems = [{ imageUrl: imageUrl, quantity: 1 }];
  }
  localStorage.setItem('storeItems', JSON.stringify(storedItems));
}

function displayStoreImages() {
  console.log(`Retrieving image URLs from local storage`);
  const storedItems = JSON.parse(localStorage.getItem('storeItems'));
  console.log(`Stored items: ${storedItems}`);
  const storeGallery = document.getElementById('store-gallery');
  storeGallery.innerHTML = ''; // Clear the container

  storedItems.forEach((item) => {
    const img = document.createElement('img');
    img.src = item.imageUrl;
    img.alt = 'Image'; // Add alt text for accessibility
    img.style.width = '100px'; // Add styling to display the images
    img.style.height = '100px';
    storeGallery.appendChild(img);
  });
}

// Add event listeners to the add to cart buttons and store link
gridItems.forEach((gridItem) => {
  const addToCartButton = gridItem.querySelector('.add-to-cart');
  addToCartButton.addEventListener('click', () => {
    const imageUrl = gridItem.querySelector('img').src;
    addItemToLocalStorage(imageUrl);
    window.location.href = 'store.html';
  });
});

storeLink.addEventListener('click', () => {
  window.location.href = 'store.html';
  window.addEventListener('load', displayStoreImages);
});