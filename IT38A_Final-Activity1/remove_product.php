<?php
$conn = new mysqli("localhost", "root", "", "hardwarehub");

if (isset($_POST['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_POST['delete_id']);
    $stmt->execute();
    header("Location: manage_products.php");
    exit;
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="sidebar">
    <!-- (same sidebar content) -->
</div>

<div class="main-content">
    <h1>Remove Product</h1>
    <form method="post">
        <label>Select a product to delete:</label><br>
        <select name="delete_id" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['product_id'] ?>"><?= $row['product_name'] ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <button type="submit">Delete Product</button>
    </form>
</div>

</body>
</html>
