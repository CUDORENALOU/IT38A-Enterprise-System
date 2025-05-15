<?php
include('db.php');
session_start();
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <li><a href="products.php" class="active">Products</a></li>
                    <li><a href="about us.php">About us</a></li>
                    <li><a href="contact.php">Contacts</a></li>
                    <li style="position:relative;">
                        <a href="cart.php" style="position:relative;">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cart-count-badge" style="position:absolute;top:-8px;right:-10px;background:#FF8800;color:#fff;border-radius:50%;padding:2px 7px;font-size:0.8rem;font-weight:bold;<?php echo ($cart_count > 0 ? '' : 'display:none;'); ?>"><?php echo $cart_count; ?></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="products-section" style="padding-top: 64px;">
        <div class="search-bar-wrapper"></div>
        <div class="products-list" style="margin-top: 32px;">
            <?php while($row = $products->fetch_assoc()): ?>
            <div class="product-card">
                <div class="product-img-bg">
                    <img src="imgs/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" class="product-img">
                </div>
                <div class="product-title"><?= htmlspecialchars($row['product_name']) ?></div>
                <div class="product-desc-wrap">
                    <div class="product-desc">
                        <span class="desc-label">Description:</span>
                        <?= isset($row['description']) ? htmlspecialchars($row['description']) : 'No description.' ?>
                    </div>
                </div>
                <div class="star-spacer"></div>
                <div class="product-rating">
                    <i class="fa fa-star" style="color:orange"></i>
                    <i class="fa fa-star" style="color:orange"></i>
                    <i class="fa fa-star" style="color:orange"></i>
                    <i class="fa fa-star" style="color:orange"></i>
                    <i class="fa fa-star" style="color:orange"></i>
                </div>
                <div class="product-bottom">
                    <div class="product-price-cart">
                        <span class="product-price">$<?= number_format($row['price'], 2) ?></span>
                        <button type="button" class="add-to-cart-btn" data-name="<?= htmlspecialchars($row['product_name']) ?>" data-price="<?= $row['price'] ?>" data-image="imgs/<?= htmlspecialchars($row['image']) ?>" style="background:none;border:none;padding:0;">
                            <i class="fa fa-shopping-cart cart-icon"></i>
                        </button>
                    </div>
                    <button class="buy-btn">Buy now!</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <script>
    document.querySelectorAll('.add-to-cart-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var formData = new FormData();
            formData.append('name', btn.getAttribute('data-name'));
            formData.append('price', btn.getAttribute('data-price'));
            formData.append('image', btn.getAttribute('data-image'));
            fetch('ajax_add_to_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let badge = document.getElementById('cart-count-badge');
                if (badge) {
                    badge.textContent = data.cart_count;
                    badge.style.display = data.cart_count > 0 ? 'inline-block' : 'none';
                }
            });
        });
    });
    </script>
</body>
</html>
