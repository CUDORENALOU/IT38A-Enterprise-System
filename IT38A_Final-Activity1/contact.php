<?php
session_start();
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
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
                      <li><a href="products.php">Products</a></li>
                      <li><a href="about us.php">About us</a></li>
                      <li><a href="contact.php"class="active">Contacts</a></li>
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
  

  <main class="contact-main">
    <section class="contact-card">
      <div class="contact-info">
        <h2>Contact Information</h2>
        <p>Fill up the form and we will get back to you within 24 hours</p>
        <div class="info-list">
          <div class="info-item">
            <span class="info-icon"><i class="fas fa-phone-alt"></i></span>
            <span>Phone : 09357484257</span>
          </div>
          <div class="info-item">
            <span class="info-icon"><i class="fab fa-telegram-plane"></i></span>
            <span>Email : HardWareHub@gmail.com</span>
          </div>
          <div class="info-item">
            <span class="info-icon"><i class="fab fa-facebook-f"></i></span>
            <span>Facebook : HardWareHub</span>
          </div>
        </div>
      </div>
      <form class="contact-form" method="post" action="contact_process.php">
        <h2>Send Us Message</h2>
        <div class="form-row">
          <input placeholder="Full Name" type="text" name="full_name" required />
          <input placeholder="Phone" type="tel" name="phone" required />
        </div>
        <textarea placeholder="Write your message" rows="5" name="message" required></textarea>
        <button type="submit">Send Message</button>
      </form>
    </section>
  </main>
</body>
</html>';
?>
