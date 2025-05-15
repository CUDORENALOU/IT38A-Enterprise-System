<?php
include('db.php');

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_status = $_POST['status'];
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $order_id);
        $stmt->execute();
        header('Location: orders.php');
        exit();
    }
    // Fetch current order status
    $result = $conn->query("SELECT status FROM orders WHERE id = $order_id");
    $order = $result->fetch_assoc();
    $current_status = $order ? $order['status'] : '';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Order Status</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            body {
                background: #f4f6f8;
                font-family: Arial, sans-serif;
            }
            .edit-card {
                background: #fff;
                max-width: 400px;
                margin: 60px auto 0 auto;
                border-radius: 16px;
                box-shadow: 0 4px 24px rgba(30,42,73,0.10);
                padding: 32px 28px 24px 28px;
                text-align: center;
            }
            .edit-card h2 {
                margin-bottom: 24px;
                color: #1a73e8;
                font-size: 1.4rem;
                font-weight: 700;
            }
            .edit-card label {
                font-weight: 600;
                color: #344054;
                margin-bottom: 8px;
                display: block;
                text-align: left;
            }
            .edit-card select {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 1rem;
                background: #F2F4F7;
                margin-bottom: 18px;
            }
            .edit-card button[type="submit"] {
                background: #1a73e8;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 10px 24px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s;
            }
            .edit-card button[type="submit"]:hover {
                background: #1761c1;
            }
            .edit-card a {
                display: inline-block;
                margin-top: 18px;
                color: #1a73e8;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s;
            }
            .edit-card a:hover {
                color: #0f4c75;
            }
        </style>
    </head>
    <body>
        <div class="edit-card">
            <h2>Edit Order Status</h2>
            <form method="POST">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="pending" <?= $current_status == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="processing" <?= $current_status == 'processing' ? 'selected' : '' ?>>Processing</option>
                    <option value="completed" <?= $current_status == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= $current_status == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
                <button type="submit">Update</button>
            </form>
            <a href="orders.php">&larr; Back to Orders</a>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: orders.php');
    exit();
} 