<?php
require_once '../config/db.php';

if (isset($_POST['create_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle image upload
    $targetDir = "../uploads/"; // Directory to store uploaded images
    $image = $_FILES['image']['name']; // Image file name
    $targetFilePath = $targetDir . basename($image); // Full path to store image
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); // File extension

    // Valid image file types
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Database connection
    $database = new Database();
    $db = $database->getConnection();

    // Validate if an image is uploaded
    if (in_array($imageFileType, $allowedTypes)) {
        // Check if the image was uploaded without errors
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Prepare SQL query to insert product details along with image path
            $query = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssss', $name, $price, $description, $targetFilePath);

            if ($stmt->execute()) {
                echo "Product created successfully!";
                header("Location: /views/products.php");
            } else {
                echo "Error: Unable to create product.";
            }
        } else {
            echo "Error: There was an error uploading your file.";
        }
    } else {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
