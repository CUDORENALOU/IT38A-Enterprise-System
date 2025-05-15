<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">
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
    <a href="orders.php" class="active">Orders</a>
    <a href="users.php">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="main-content">
    <h1>Order Management</h1>
    
    <div class="order-filters">
        <select id="statusFilter" class="filter-select">
            <option value="all">All Orders</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <div class="orders-table-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('db.php');

                // Fetch all orders with user email
                $sql = "SELECT o.*, u.email FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.order_date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($order = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>#{$order['id']}</td>";
                        echo "<td>" . htmlspecialchars($order['email']) . "</td>";
                        echo "<td>" . date('M. d', strtotime($order['order_date'])) . "</td>";
                        echo "<td>$" . number_format($order['total_price'], 2) . "</td>";
                        echo "<td><span class='status-badge " . strtolower($order['status']) . "'>{$order['status']}</span></td>";
                        echo "<td>
                                <button class='action-btn edit-btn' onclick='editOrder({$order['id']})'><i class='fas fa-edit'></i></button>
                                <button class='action-btn delete-btn' onclick='deleteOrder({$order['id']})'><i class='fas fa-trash'></i></button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-orders'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function viewOrder(orderId) {
    window.location.href = 'view_order.php?id=' + orderId;
}

function editOrder(orderId) {
    window.location.href = 'edit_order.php?id=' + orderId;
}

function deleteOrder(orderId) {
    if(confirm('Are you sure you want to delete this order?')) {
        window.location.href = 'delete_order.php?id=' + orderId;
    }
}

// Filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filtering
    filterOrders();
});

document.getElementById('searchOrder').addEventListener('input', function() {
    // Implement search functionality
    filterOrders();
});

function filterOrders() {
    const status = document.getElementById('statusFilter').value;
    const search = document.getElementById('searchOrder').value.toLowerCase();
    const rows = document.querySelectorAll('.orders-table tbody tr');

    rows.forEach(row => {
        const orderStatus = row.querySelector('.status-badge').textContent.toLowerCase();
        const orderText = row.textContent.toLowerCase();
        
        const statusMatch = status === 'all' || orderStatus === status;
        const searchMatch = orderText.includes(search);
        
        row.style.display = statusMatch && searchMatch ? '' : 'none';
    });
}
</script>

</body>
</html> 