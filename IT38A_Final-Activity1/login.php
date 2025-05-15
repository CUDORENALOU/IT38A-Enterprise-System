<?php
session_start();

// Connect to your database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hardwareHub';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if email exists
  $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password, $role);
    $stmt->fetch();

    // Verify hashed password
    if (password_verify($password, $hashed_password)) {
      $_SESSION['user'] = $email;
      $_SESSION['role'] = $role;

      if ($role === 'admin') {
        header("Location: admin_dashboard.php");
      } else {
        header("Location: home.php");
      }
      exit();
    } else {
      $error_message = "Invalid password.";
    }
  } else {
    $error_message = "Email not found.";
  }

  $stmt->close();
}

$conn->close();
?>

<!-- HTML Design -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - HardwareHub</title>
  <link rel="stylesheet" href="styles.css">

  <script>
    window.onload = function () {
      var successMessage = document.getElementById('success-message');
      if (successMessage) {
        setTimeout(function () {
          successMessage.style.display = 'none';
        }, 1000);
      }
    };
  </script>
</head>
<body>
<div class="login-container">
  <div class="login-box">
    <div class="logo-wrapper">
      <div class="logo">
        <img src="final-logo.png" alt="Logo">
      </div>
      <div class="brand-name">HardwareHub</div>
    </div>

    <h2>Login</h2>

    <!-- ✅ Registration Success Message -->
    <?php if (isset($_GET['registered']) && $_GET['registered'] === 'success'): ?>
      <div id="success-message" class="success-message">
        <span class="checkmark">✔️</span>
        Registration successful! Please log in.
      </div>
    <?php endif; ?>

    <!-- ✅ Logout Success Message -->
    <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
      <div id="success-message" class="success-message">
        <span class="checkmark">✔️</span>
        Successfully logged out.
      </div>
    <?php endif; ?>

    <!-- ❌ Login Error Message -->
    <?php if (isset($error_message)): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- 🔐 Login Form -->
    <form method="POST" action="">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="links">
      <a href="#">Forgot Password?</a>
      <a href="register.php" class="create">Create an account</a>
    </div>
  </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
