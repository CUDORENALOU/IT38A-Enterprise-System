<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - HardwareHub</title>
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

    <main class="cart-main">
        <h1 class="cart-title">Shopping Cart</h1>
        <div class="cart-card">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $subtotal = 0;
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                    foreach ($_SESSION['cart'] as $index => $product):
                        $total = $product['price'] * $product['quantity'];
                        $subtotal += $total;
                ?>
                    <tr>
                        <td class="cart-product">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="cart-product-img">
                            <span><?php echo htmlspecialchars($product['name']); ?></span>
                        </td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                        <td>
                            <form method="POST" action="update_cart.php" style="display:inline;">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="action" value="decrease">-</button>
                                <span><?php echo $product['quantity']; ?></span>
                                <button type="submit" name="action" value="increase">+</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($total, 2); ?></td>
                    </tr>
                <?php
                    endforeach;
                else:
                ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px; margin-top: 12px;">
                <div class="cart-summary" style="margin: 0;">
                <span>Subtotal</span>
                    <span class="cart-subtotal"><?php echo number_format($subtotal, 2); ?></span>
                </div>
                <form action="checkout.php" method="get" style="margin:0;">
                    <button type="submit" class="cart-checkout-btn">Checkout</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
