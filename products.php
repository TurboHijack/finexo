<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product {
            margin-bottom: 20px;
        }
        .product img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Products</h1>
        <div class="row">
            <?php
            include 'config.php';
            
            try {
                $stmt = $pdo->query('SELECT * FROM products');
                while ($row = $stmt->fetch()) {
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 product">';
                    echo '<div class="card">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
                    echo '<p class="card-text"><strong>Price: $' . htmlspecialchars($row['price']) . '</strong></p>';
                    echo '<a href="buy.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-primary">Buy Now</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
</body>
</html>
