<?php
session_start();
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
$company_name = "HardwareHub";
$company_description = "HardwareHub is an e-commerce platform dedicated to offering high-quality hand tools. Our platform makes it easy to browse and purchase essential tools without the hassle of going to physical stores. HardwareHub aims to be the go-to place for all your hand tool needs, delivering a seamless online shopping experience.";
$mission = "Our mission is to become the go-to destination for all your hardware needs. We aim to revolutionize the industry with an easy-to-navigate platform, competitive prices, and an unmatched product selection.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us - HardwareHub</title>
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
                    <li><a href="products.php">Products</a></li>
                    <li><a href="about us.php"class="active">About us</a></li>
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

  
    <main class="about-main">
  <div class="about-content">
    <div class="text-section">
      <h1>
        <span class="bold-text">Quality Tools</span>
        <span class="normal-text">, Right at</span><br>
        <span class="normal-text">Your Fingertips</span>
      </h1>
      <section class="info">
        <div>
          <h2>About us</h2>
          <p><?php echo $company_description; ?></p>
        </div>
        <div>
          <h2>Our Mission</h2>
          <p><?php echo $mission; ?></p>
        </div>
      </section>
    </div>
    <div class="image-section">
      <img src="about pic.png" alt="Hand tools" />
    </div>
  </div>
</main>
