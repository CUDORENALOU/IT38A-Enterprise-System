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
  <meta charset="UTF-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <main class="confirmation-main">
    <div class="confirmation-card" style="max-width: 900px; width: 100%;">
      <div class="confirmation-header">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="final-logo.png" alt="HardwareHub Logo" class="confirmation-logo">
            <span style="font-weight: bold; font-size: 1.2rem; color: #000;">HardwareHub</span>
    </div>
        <div class="confirmation-check"><i class="fas fa-check"></i></div>
        <h2>Thank you!</h2>
        <p class="confirmation-message">Your order has been placed.</p>
      </div>
      <div class="confirmation-details" style="margin-bottom: 18px;">
        <table style="width:100%; border-collapse:collapse; background:#f8f9fa; border-radius:10px; overflow:hidden;">
            <thead>
                <tr style="background:#e3f0fa;">
                    <th style="padding:10px 8px; text-align:left; font-size:1rem; color:#1a73e8;">Order ID</th>
                    <th style="padding:10px 8px; text-align:left; font-size:1rem; color:#222;">Product</th>
                    <th style="padding:10px 8px; text-align:center; font-size:1rem; color:#222;">Quantity</th>
                    <th style="padding:10px 8px; text-align:right; font-size:1rem; color:#222;">Price</th>
                    <th style="padding:10px 8px; text-align:left; font-size:1rem; color:#222;">Shipping</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order['items'] as $idx => $item): ?>
                <tr style="border-bottom:1px solid #e3e8ee;">
                    <td style="padding:10px 8px; color:#1a73e8; font-weight:400; font-size:0.93rem;">
                        <?php 
                            $oid = htmlspecialchars($order['order_number']);
                            $short_oid = 'ORD-' . substr($oid, -6);
                        ?>
                        <?= $short_oid ?>-<?= $idx+1 ?>
                    </td>
                    <td style="padding:10px 8px; display:flex; align-items:center; gap:10px;">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width:40px; height:40px; border-radius:6px; background:#fff; box-shadow:0 2px 8px rgba(30,42,73,0.04);">
                        <span style="font-weight:500; color:#222; font-size:1rem;"><?= htmlspecialchars($item['name']) ?></span>
                    </td>
                    <td style="padding:10px 8px; text-align:center; color:#222; font-size:1rem;"><?= $item['quantity'] ?></td>
                    <td style="padding:10px 8px; text-align:right; color:#222; font-size:1rem;">$<?= number_format($item['price'], 2) ?></td>
                    <td style="padding:10px 8px; color:#888; font-size:0.95rem;">Arrives soon</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="confirmation-shipping-info" style="margin-top: 18px;">
            <span class="confirmation-shipping-title" style="font-weight: bold;">Shipping to</span>
            <div class="confirmation-shipping-address" style="font-size: 0.98rem; color: #333;">
                <?= htmlspecialchars($order['name']) ?><br>
                <?= nl2br(htmlspecialchars($order['address'])) ?>
          </div>
        </div>
        </div>
      <div class="confirmation-summary" style="display: flex; justify-content: flex-end; align-items: center; margin-top: 18px; gap: 12px; font-size: 1.1rem; font-weight: 700;">
        <span style="font-weight:700; color:#222;">Total</span>
        <span class="confirmation-total" style="font-weight:700; color:#222;">$<?= number_format($order['total'], 2) ?></span>
      </div>
      <div class="confirmation-actions">
        <a href="products.php" class="confirmation-btn confirmation-btn-outline">Back to Shopping</a>
      </div>
    </div>
  </main>
</body>
</html>
<?php
// Don't clear order details so we can track it later
// unset($_SESSION['order_details']);
?>