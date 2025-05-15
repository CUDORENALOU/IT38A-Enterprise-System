<?php
session_start();

// Check if order details exist
if (!isset($_SESSION['order_details'])) {
    header('Location: products.php');
    exit();
}

// Get order details
$order = $_SESSION['order_details'];
$main_item = $order['items'][0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="confirmation-main">
        <div class="confirmation-card">
            <div class="confirmation-header">
                <img src="final-logo.png" alt="HardwareHub Logo" class="confirmation-logo">
                <div class="confirmation-check"><i class="fas fa-check"></i></div>
                <h2>Thank you!</h2>
                <p class="confirmation-message">Your order has been placed.</p>
            </div>
            <div class="confirmation-details">
                <div class="confirmation-order">
                    <span class="confirmation-order-number">Order#<?= htmlspecialchars($order['order_number']) ?></span>
                    <div class="confirmation-product">
                        <img src="<?= htmlspecialchars($main_item['image']) ?>" alt="<?= htmlspecialchars($main_item['name']) ?>" class="confirmation-product-img">
                        <div>
                            <span class="confirmation-product-name"><b><?= htmlspecialchars($main_item['name']) ?></b></span><br>
                            <span><?= $main_item['quantity'] ?> x $<?= number_format($main_item['price'], 2) ?></span><br>
                            <span class="confirmation-shipping">Shipping: Arrives soon</span>
                        </div>
                    </div>
                </div>
                <div class="confirmation-shipping-info">
                    <span class="confirmation-shipping-title">Shipping to</span>
                    <div class="confirmation-shipping-address">
                        <?= htmlspecialchars($order['name']) ?><br>
                        <?= nl2br(htmlspecialchars($order['address'])) ?>
                    </div>
                </div>
            </div>
            <div class="confirmation-summary">
                <span>Total</span>
                <span class="confirmation-total">$<?= number_format($order['total'], 2) ?></span>
            </div>
            <div class="confirmation-actions">
                <a href="track_order.php" class="confirmation-btn confirmation-btn-blue">Track Order</a>
                <a href="products.php" class="confirmation-btn confirmation-btn-outline">Continue Shopping</a>
            </div>
        </div>
    </main>
</body>
</html>