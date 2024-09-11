<?php
require_once '../config/db.php';

$product = null;

// Check if the 'id' parameter is set in the query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create a new Database instance and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Prepare and execute the query
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    // Fetch the product details
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-5">
    <h2 class="text-center mb-4">Update Product</h2>
    <form action="/controllers/update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <?php if (!empty($product['image'])): ?>
                <div class="mb-3">
                    <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="img-thumbnail" style="max-width: 300px;">
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        
        <div class="text-center">
            <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
        </div>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
