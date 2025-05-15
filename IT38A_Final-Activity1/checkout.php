<?php
session_start();

// Check if cart exists and has items
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Payment methods
$payment_methods = ['Cash on delivery', 'G cash', 'Paypal'];

// Calculate subtotal
$subtotal = array_reduce($_SESSION['cart'], function($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('db.php');
    // Get customer info from form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment'];
    $status = 'pending';
    $total_price = $subtotal;

    // Insert order into orders table
    $user_id = 4; // Use a valid user id from your users table for now
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status, order_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ids", $user_id, $total_price, $status);
    $stmt->execute();
    $order_id = $conn->insert_id;

    // Insert each product into order_items
    foreach ($_SESSION['cart'] as $item) {
        $product_id = isset($item['product_id']) ? $item['product_id'] : 0;
        $product_name = $item['name'];
        $product_image = $item['image'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, quantity, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("iissid", $order_id, $product_id, $product_name, $product_image, $quantity, $price);
        $stmt2->execute();
    }

    // Store order details in session (optional, for confirmation page)
    $_SESSION['order_details'] = [
        'name' => $name,
        'address' => $address,
        'phone' => $phone,
        'payment_method' => $payment_method,
        'items' => $_SESSION['cart'],
        'total' => $subtotal,
        'order_number' => 'ORD-' . strtoupper(uniqid())
    ];
    
    // Clear the cart
    unset($_SESSION['cart']);
    
    // Redirect to confirmation page
    header('Location: confirmation.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="container header-flex">
            <div class="logo-nav">
                <img src="final-logo.png" alt="HardwareHub Logo" class="logo">
                <span class="brand">HardwareHub</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="about us.php">About us</a></li>
                    <li><a href="contact.php">Contacts</a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="checkout-main">
        <h1 class="checkout-title">Check Out</h1>
        <div class="checkout-card">
            <div class="checkout-left">
                <table class="checkout-table">
                    <thead>
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $index => $product): ?>
                            <tr>
                                <td class="checkout-product">
                                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="cart-product-img">
                                    <span><?= htmlspecialchars($product['name']) ?></span>
                                </td>
                                <td>$<?= number_format($product['price'], 2) ?></td>
                                <td>
                                    <div class="cart-qty">
                                        <button type="button" class="qty-btn" data-index="<?= $index ?>" data-action="decrease">-</button>
                                        <span id="qty-<?= $index ?>"><?= $product['quantity'] ?></span>
                                        <button type="button" class="qty-btn" data-index="<?= $index ?>" data-action="increase">+</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="checkout-right">
                <form class="checkout-form" method="POST" action="checkout.php">
                    <h2 class="checkout-form-title">Shipping Address</h2>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="text" name="phone" placeholder="Phone" required>
                    <h2 class="checkout-form-title">Payment</h2>
                    <div class="checkout-payment">
                        <?php foreach ($payment_methods as $method): ?>
                            <label><input type="radio" name="payment" value="<?= htmlspecialchars($method) ?>" checked> <?= htmlspecialchars($method) ?></label><br>
                        <?php endforeach; ?>
                    </div>
                    <div class="checkout-summary">
                        <span>Subtotal</span>
                        <span class="checkout-subtotal">$<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <button class="checkout-btn" type="submit">Place Order</button>
                </form>
            </div>
        </div>
    </main>

    <script>
    document.querySelectorAll('.qty-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var index = btn.getAttribute('data-index');
            var action = btn.getAttribute('data-action');
            var formData = new FormData();
            formData.append('index', index);
            formData.append('action', action);

            fetch('ajax_update_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('qty-' + index).textContent = data.quantity;
                document.querySelector('.checkout-subtotal').textContent = '$' + data.subtotal;
                if (data.quantity == 0) {
                    location.reload();
                }
            });
        });
    });
    </script>
</body>
</html>