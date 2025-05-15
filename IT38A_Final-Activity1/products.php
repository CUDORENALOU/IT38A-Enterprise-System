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
                    <?php
                    session_start();
                    $cart_count = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $cart_count += $item['quantity'];
                        }
                    }
                    ?>
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

    <section class="products-section">
    <div class="search-bar-wrapper">
    
</div>
            
            <div class="products-list">

                <!-- Product 1 -->
                <div class="product-card">
                    <div class="product-img-bg">
                        <img src="imgs/stanley.png" alt="Stanley Adjustable Wrench Set" class="product-img">
                    </div>
                    <div class="product-title">Stanley Adjustable Wrench Set</div>
                    <div class="product-desc-wrap">
                        <div class="product-desc">
                            <span class="desc-label">Description:</span>
                            This high-quality set of adjustable wrenches is built for durability and precision. 
                            Each wrench offers a strong grip, ensuring secure handling during use.
                            It has easy adjustment feature fit for a wide range of bolt sizes with ease.

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
                            <span class="product-price">$142</span>
                            <button type="button" class="add-to-cart-btn" data-name="Stanley Adjustable Wrench Set" data-price="142" data-image="imgs/stanley.png" style="background:none;border:none;padding:0;">
                            <i class="fa fa-shopping-cart cart-icon"></i>
                            </button>
                        </div>
                        <button class="buy-btn">Buy now!</button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card">
                    <div class="product-img-bg">
                        <img src="imgs/castle.png" alt="Castile Claw Hammer" class="product-img">
                    </div>
                    <div class="product-title">Castile Claw Hammer</div>
                    <div class="product-desc-wrap">
                        <div class="product-desc">
                            <span class="desc-label">Description:</span>
                            A reliable claw hammer built for both professional and DIY use. Its steel head provides powerful striking force, while the rubberized grip ensures comfort and control.
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
                            <span class="product-price">$242</span>
                            <button type="button" class="add-to-cart-btn" data-name="Castile Claw Hammer" data-price="242" data-image="imgs/castle.png" style="background:none;border:none;padding:0;">
                            <i class="fa fa-shopping-cart cart-icon"></i>
                            </button>
                        </div>
                        <button class="buy-btn">Buy now!</button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card">
                    <div class="product-img-bg">
                        <img src="imgs/black.png" alt="Black & Decker Electric Drill" class="product-img">
                    </div>
                    <div class="product-title">Black & Decker Electric Drill</div>
                    <div class="product-desc-wrap">
                        <div class="product-desc">
                            <span class="desc-label">Description:</span>
                            A powerful electric drill designed for professionals and DIYers. With its compact design and ergonomic grip, it ensures precision drilling in wood, metal, and concrete.
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
                            <span class="product-price">$542</span>
                            <button type="button" class="add-to-cart-btn" data-name="Black & Decker Electric Drill" data-price="542" data-image="imgs/black.png" style="background:none;border:none;padding:0;">
                            <i class="fa fa-shopping-cart cart-icon"></i>
                            </button>
                        </div>
                        <button class="buy-btn">Buy now!</button>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card">
                    <div class="product-img-bg">
                        <img src="imgs/hanpex.png" alt="Hanpex Handsaw" class="product-img">
                    </div>
                    <div class="product-title">Hanpex Handsaw</div>
                    <div class="product-desc-wrap">
                        <div class="product-desc">
                            <span class="desc-label">Description:</span>
                            A manual cutting tool with a sharp toothed blade. The teeth vary in size depending on the type of cut needed, with larger teeth for rough cuts and finer teeth for precise cuts.
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
                            <span class="product-price">$342</span>
                            <button type="button" class="add-to-cart-btn" data-name="Hanpex Handsaw" data-price="342" data-image="imgs/hanpex.png" style="background:none;border:none;padding:0;">
                            <i class="fa fa-shopping-cart cart-icon"></i>
                            </button>
                        </div>
                        <button class="buy-btn">Buy now!</button>
                    </div>
                </div>
            </div>
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
