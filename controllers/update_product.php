<?php
session_start();
require_once '../config/db.php';

if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name']; // Get the uploaded file name
    $targetDir = "../uploads/"; // Directory to store uploaded images
    $targetFilePath = $targetDir . basename($image); // Full path to store image
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); // File extension

    // Valid image file types
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    // Create a new Database instance and get the connection
    $database = new Database();
    $db = $database->getConnection();

    if ($image) {
        // Check if the image file type is allowed
        if (in_array($imageFileType, $allowedTypes)) {
            // Check if the image was uploaded without errors
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // Prepare SQL query to update product details along with image path
                $query = "UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?";
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssssi', $name, $price, $description, $targetFilePath, $id);
            } else {
                echo "Error: There was an error uploading your file.";
                exit;
            }
        } else {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }
    } else {
        // If no image is uploaded, update product details without changing the image
        $query = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssi', $name, $price, $description, $id);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "Product updated successfully!";
        header("Location: /views/products.php");
    } else {
        echo "Error: Unable to update product. " . $stmt->error;
    }
}
