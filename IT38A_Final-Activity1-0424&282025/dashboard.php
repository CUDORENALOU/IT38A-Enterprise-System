<!-- dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="logo.jpg" alt="HardwareHub Logo">
    </div>
    <h2>HardwareHub</h2>
    <a href="#">Dashboard</a>
    <a href="http://localhost/IT38A-Enterprise-System/IT38A_Final-Activity1-0424&282025/manage_products.php">Manage Products</a>
    <a href="#">Orders</a>
    <a href="#">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="#">Log Out</a>
</div>

<div class="main-content">
    <h1>Welcome, Admin!</h1>
    
    <div class="cards">
        <div class="card">
            <h3><i class="fas fa-box"></i> Total Products</h3>
            <p>1,250</p>
        </div>
        <div class="card">
            <h3><i class="fas fa-shopping-cart"></i> Total Orders</h3>
            <p>150</p>
        </div>
        <div class="card">
            <h3><i class="fas fa-users"></i> Active Users</h3>
            <p>50</p>
        </div>
    </div>

    <div class="recent-orders">
        <h2><i class="fas fa-receipt"></i> Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#2571</td>
                    <td>Loren</td>
                    <td>Mar. 10</td>
                    <td>$142.00</td>
                </tr>
                <tr>
                    <td>#3584</td>
                    <td>Maricar</td>
                    <td>Jan. 28</td>
                    <td>$232.00</td>
                </tr>
                <tr>
                    <td>#3659</td>
                    <td>Vevien</td>
                    <td>June. 23</td>
                    <td>$400.00</td>
                </tr>
                <tr>
                    <td>#5215</td>
                    <td>Mariel</td>
                    <td>Feb. 30</td>
                    <td>$320.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
