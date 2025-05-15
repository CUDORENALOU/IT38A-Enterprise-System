<?php
include('db.php');
// Total products (sum of all stocks)
$total_products = $conn->query("SELECT SUM(stocks) FROM products")->fetch_row()[0];
// Total orders
$total_orders = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];
// Active users (all users with role 'admin' or 'customer')
$active_users = $conn->query("SELECT COUNT(*) FROM users WHERE role IN ('admin','customer')")->fetch_row()[0];
// Recent orders (last 4)
$recent_orders = $conn->query("SELECT o.id, u.email, o.order_date, o.total_price FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.order_date DESC LIMIT 4");
?>
<!-- dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

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
    <h1>Welcome, Admin!</h1>
    
    <div class="cards">
        <div class="card">
            <h3><i class="fas fa-box"></i> Total Products</h3>
            <p><?= $total_products ?></p>
        </div>
        <div class="card">
            <h3><i class="fas fa-shopping-cart"></i> Total Orders</h3>
            <p><?= $total_orders ?></p>
        </div>
        <div class="card">
            <h3><i class="fas fa-users"></i> Active Users</h3>
            <p><?= $active_users ?></p>
        </div>
    </div>

    <div class="recent-orders">
        <h2><i class="fas fa-receipt"></i> Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $recent_orders->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= date('M. d', strtotime($row['order_date'])) ?></td>
                    <td>$<?= number_format($row['total_price'], 2) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
