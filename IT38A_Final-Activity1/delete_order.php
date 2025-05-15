<?php
include('db.php');
if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    // Delete order items first (if not ON DELETE CASCADE)
    $conn->query("DELETE FROM order_items WHERE order_id = $order_id");
    // Delete the order
    $conn->query("DELETE FROM orders WHERE id = $order_id");
}
header('Location: orders.php');
exit(); 