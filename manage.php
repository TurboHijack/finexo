<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h2>Update Product</h2>
    <form id="updateForm" action="update_product.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="price">Product Price:</label>
            <input type="text" id="price" name="price" required>
        </div>
        <div>
            <label for="description">Product Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit">Update Product</button>
    </form>
    <hr>
    <h2>Buy Product</h2>
    <form id="payment-form">
        <div>
            <label for="product-id">Product ID:</label>
            <input type="text" id="product-id" name="product-id" required>
        </div>
        <button id="checkout-button">Checkout</button>
    </form>

    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe('your-publishable-key-here');

        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function (e) {
            e.preventDefault();

            fetch('create-checkout-session.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: document.getElementById('product-id').value,
                }),
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (sessionId) {
                return stripe.redirectToCheckout({ sessionId: sessionId });
            })
            .then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
