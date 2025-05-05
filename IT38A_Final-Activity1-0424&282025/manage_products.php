<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - HardwareHub</title>
    <link rel="stylesheet" href="style.css"> <!-- Keep using your CSS -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #edf1f5, #dbe4ee);
        }
        .main-content {
            margin-left: 250px;
            padding: 40px;
        }
        .buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        .buttons button:first-child {
            background-color: #1a73e8;
            color: white;
        }
        .buttons button:last-child {
            background-color: #ccc;
        }
        .product-list {
            width: 100%;
            border-collapse: collapse;
        }
        .product-list th, .product-list td {
            padding: 15px;
            text-align: left;
            font-size: 16px;
        }
        .product-img {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            background-color: #eaeaea;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .product-img img {
            max-width: 100%;
            max-height: 100%;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="logo.jpg" alt="HardwareHub Logo">
    </div>
    <h2>HardwareHub</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="http://localhost/IT38A-Enterprise-System/IT38A_Final-Activity1-0424&282025/manage_products.php">Manage Products</a>
    <a href="#">Orders</a>
    <a href="#">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="#">Log Out</a>
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
                        <div class="product-img"><img src="images/wrench.png" alt=""></div>
                        <strong>Stanley Adjustable Wrench Set</strong>
                    </div>
                </td>
                <td>$142.00</td>
                <td>25</td>
            </tr>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="images/drill.png" alt=""></div>
                        <strong>Black & Decker Electric Drill</strong>
                    </div>
                </td>
                <td>$542.00</td>
                <td>30</td>
            </tr>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="images/hammer.png" alt=""></div>
                        <strong>Castile Claw Hammer</strong>
                    </div>
                </td>
                <td>$242.00</td>
                <td>27</td>
            </tr>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="product-img"><img src="images/handsaw.png" alt=""></div>
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
