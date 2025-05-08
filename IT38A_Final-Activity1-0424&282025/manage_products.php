<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - HardwareHub</title>
    <link rel="stylesheet" href="styles.css"> 
   
<div class="sidebar">
    <div class="logo">
        <img src="final-logo.png" alt="HardwareHub Logo">
    </div>
    <h2>HardwareHub</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_products.php">Manage Products</a>
    <a href="#">Orders</a>
    <a href="#">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="main-content">
    <h1>Manage Products</h1>

    <div class="buttons">
        <button>Add Products</button>
        <button>Remove Products</button>
    </div>

    <table class="product-list">
        <thead>
            <tr>
                <th>Products</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="imgs/stanley.png" alt=""></div>
                        <strong>Stanley Adjustable Wrench Set</strong>
                    </div>
                </td>
                <td>$142.00</td>
                <td>25</td>
            </tr>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="imgs/black.png" alt=""></div>
                        <strong>Black & Decker Electric Drill</strong>
                    </div>
                </td>
                <td>$542.00</td>
                <td>30</td>
            </tr>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="imgs/castle.png" alt=""></div>
                        <strong>Castile Claw Hammer</strong>
                    </div>
                </td>
                <td>$242.00</td>
                <td>27</td>
            </tr>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="imgs/hanpex.png" alt=""></div>
                        <strong>Hanpex Handsaw</strong>
                    </div>
                </td>
                <td>$342.00</td>
                <td>15</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
