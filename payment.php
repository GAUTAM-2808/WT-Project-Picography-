<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
            color: #fff;
            text-align: center;
            padding: 50px;
        }
        .payment-container {
            background: rgba(255, 255, 255, 0.1); /* Semi-transparent background */
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        img {
            max-width: 100%;
            max-height: 300px;
            width: auto;
            height: auto;
            margin: 20px 0;
            border-radius: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Payment for Product</h1>
        <img id="productImage" alt="Product Image" />
        <p>Product: <span id="productName"></span></p>
        <p>Price: <span id="productPrice"></span></p>
        
        <button id="payButton">Pay Now</button>
    </div>

    <script>
        // Fetching product details from localStorage
        const selectedItem = JSON.parse(localStorage.getItem('selectedItem'));
        
        if (selectedItem) {
            document.getElementById('productImage').src = selectedItem.imageUrl; // Set image URL
            document.getElementById('productName').innerText = selectedItem.imageUrl.split('/').pop(); // Get image name
            document.getElementById('productPrice').innerText = `₹${selectedItem.price}`;
        } else {
            alert('No product selected. Please add a product to your cart.');
            window.location.href = 'gallery.html'; // Redirect if no product
        }

        // Function to handle payment
        function makePayment() {
            const options = {
                key: 'rzp_test_YkzRgpsdIxrZ7h', // Replace with your Razorpay key id
                amount: selectedItem.price * 100, // Amount in paise
                currency: 'INR',
                name: 'PictoGraphy.com',
                description: 'Product Purchase',
                image: 'HomeBg.png',
                order_id: '', // If you have an order ID, you can set it here
                handler: function (response) {
                    alert(`Payment successful: ${response.razorpay_payment_id}`);
                    
                    // Prepare purchase data
                    const purchaseData = {
                        username: '<?php echo htmlspecialchars($_SESSION["username"]); ?>',
                        imageUrl: selectedItem.imageUrl,
                        price: selectedItem.price
                    };

                    // Make an AJAX request to save the purchase
                    fetch('process_payment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(purchaseData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to dashboard or success page
                            window.location.href = 'dashboard.php';
                        } else {
                            alert('Error processing purchase: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                },
                prefill: {
                    name: '',
                    email: '',
                    contact: ''
                },
                notes: {
                    address: ''
                },
                theme: {
                    color: '#F37254'
                }
            };

            const rzp1 = new Razorpay(options);
            rzp1.open();
            event.preventDefault();
        }

        document.getElementById('payButton').onclick = makePayment;
    </script>
</body>
</html>
