<?php
session_start(); // Start the session

// Include the database connection
include('db.php');

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); 
    exit();
}

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists with the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    // If user is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, create session and redirect
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: dashboard.php'); 
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid email or password!";
        }
    } else {
        // User not found
        $error_message = "No account found with that email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">

    <script>
        
        window.onload = function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
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
        
        <form method="POST" action="index.php">
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
