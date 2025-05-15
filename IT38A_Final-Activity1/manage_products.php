<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - HardwareHub</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "hardwarehub");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle Add Product
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['product_image']['name'];
    
    // Upload image
    $target_dir = "imgs/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
    
    $sql = "INSERT INTO products (product_name, price, stocks, image) VALUES ('$product_name', '$price', '$stock', '$image')";
    mysqli_query($conn, $sql);
}

// Handle Remove Product
if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM products WHERE product_id = '$product_id'";
    mysqli_query($conn, $sql);
}
?>
   
<div class="sidebar">
    <div class="logo">
        <img src="final-logo.png" alt="HardwareHub Logo">
    </div>
    <h2>HardwareHub</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_products.php">Manage Products</a>
    <a href="orders.php">Orders</a>
    <a href="users.php">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="main-content">
    <h1>Manage Products</h1>

    <div class="buttons">
        <button onclick="showAddForm()" class="action-btn">Add Products</button>
        <button onclick="showRemoveForm()" class="action-btn">Remove Products</button>
    </div>

    <!-- Add Product Form -->
    <div id="addProductForm" style="display: none;" class="form-container">
        <h2>Add New Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Product Name" required>
            <input type="number" name="price" placeholder="Price" step="0.01" required>
            <input type="number" name="stock" placeholder="Stock" required>
            <input type="file" name="product_image" required>
            <button type="submit" name="add_product">Add Product</button>
            <button type="button" onclick="hideAddForm()">Cancel</button>
        </form>
    </div>

    <!-- Remove Product Form -->
    <div id="removeProductForm" style="display: none;" class="form-container">
        <h2>Remove Product</h2>
        <form method="POST">
            <select name="product_id" required>
                <option value="">Select a product to remove</option>
                <?php
                $products_query = "SELECT * FROM products";
                $products_result = mysqli_query($conn, $products_query);
                if (mysqli_num_rows($products_result) > 0) {
                    while($row = mysqli_fetch_assoc($products_result)) {
                        echo "<option value='".$row['product_id']."'>".htmlspecialchars($row['product_name'])." - $".number_format($row['price'],2)." (Stock: ".htmlspecialchars($row['stock']).")</option>";
                    }
                } else {
                    echo "<option value='' disabled>No products available</option>";
                }
                ?>
            </select>
            <button type="submit" name="remove_product">Remove Product</button>
            <button type="button" onclick="hideRemoveForm()">Cancel</button>
        </form>
    </div>

    <table class="product-list">
        <thead>
            <tr>
                <th>Products</th>
                <th>Price</th>
                <th>Stocks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM products");
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td><div style="display: flex; align-items: center; gap: 20px;">';
                    echo '<div class="product-img"><img src="imgs/' . htmlspecialchars($row['image']) . '" alt=""></div>';
                    echo '<strong>' . htmlspecialchars($row['product_name']) . '</strong></div></td>';
                    echo '<td>$' . number_format($row['price'], 2) . '</td>';
                    echo '<td>' . htmlspecialchars($row['stocks']) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">No products found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function showAddForm() {
    document.getElementById('addProductForm').style.display = 'block';
    document.getElementById('removeProductForm').style.display = 'none';
}

function hideAddForm() {
    document.getElementById('addProductForm').style.display = 'none';
}

function showRemoveForm() {
    document.getElementById('removeProductForm').style.display = 'block';
    document.getElementById('addProductForm').style.display = 'none';
}

function hideRemoveForm() {
    document.getElementById('removeProductForm').style.display = 'none';
}
</script>

</body>
</html>