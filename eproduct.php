<?php
session_start();
// Check if user is authenticated as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Example: Fetch product details from database based on ID
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    // Replace with your database query logic
    $product = [
        'id' => $productId,
        'name' => 'Product ' . $productId,
        'description' => 'Product description',
        'image' => 'path/to/product/image.jpg',
        'price' => 99.99 // Example price
    ];
} else {
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <!-- Add any navigation links or dropdown menus specific to admins -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form action="save_product.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" min="0" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Include your JavaScript files here if needed -->
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
