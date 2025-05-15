<?php
session_start();
// Include database connection
include('db.php');

$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error_message = "Email already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'customer';
            $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $hashed_password, $role);
            if ($stmt->execute()) {
                header('Location: login.php?registered=success');
                exit();
            } else {
                $error_message = "Registration failed. Please try again.";
            }
        }
        $stmt->close();
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="register-container">
  <div class="register-box">
    <div class="logo-wrapper">
      <div class="logo">
        <img src="final-logo.png" alt="Logo">
      </div>
      <div class="brand-name">HardwareHub</div>
    </div>

    <h2>Register</h2>

    <!-- Registration Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form method="POST" action="register.php">
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="login-btn">Register</button>
    </form>

    <div class="links">
      <a href="login.php">Already have an account?</a>
    </div>
  </div>
</div>
</body>
</html>
