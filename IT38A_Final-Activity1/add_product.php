<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "hardwarehub");
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Upload image
    $image = $_FILES['image']['name'];
    $target = "imgs/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdis", $name, $price, $stock, $target);
    $stmt->execute();

    header("Location: manage_products.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="sidebar">
    <!-- (same sidebar content) -->
</div>

<div class="main-content">
    <h1>Add Product</h1>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br>
        <label>Stock:</label><br>
        <input type="number" name="stock" required><br>
        <label>Image:</label><br>
        <input type="file" name="image" required><br><br>
        <button type="submit">Save Product</button>
    </form>
</div>

</body>
</html>
