<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Management - HardwareHub</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="final-logo.png" alt="HardwareHub Logo">
    </div>
    <h2>HardwareHub</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_products.php">Manage Products</a>
    <a href="orders.php">Orders</a>
    <a href="users.php" class="active">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="main-content">
    <h1>User Management</h1>
    
    <div class="user-actions">
        <div class="user-filters">
            <select id="roleFilter" class="filter-select">
                <option value="all">All Roles</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
    </div>

    <!-- Add User Form -->
    <div id="addUserForm" class="form-container" style="display: none;">
        <h2>Add New User</h2>
        <form method="POST" action="add_user.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        
    </div>

    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('db.php');

                $sql = "SELECT * FROM users ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td><span class='role-badge " . $row['role'] . "'>" . ucfirst($row['role']) . "</span></td>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-users'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function showAddUserForm() {
    document.getElementById('addUserForm').style.display = 'block';
}

function hideAddUserForm() {
    document.getElementById('addUserForm').style.display = 'none';
}

function editUser(userId) {
    window.location.href = 'edit_user.php?id=' + userId;
}

function deleteUser(userId) {
    if(confirm('Are you sure you want to delete this user?')) {
        window.location.href = 'delete_user.php?id=' + userId;
    }
}

function toggleUserStatus(userId, currentStatus) {
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    if(confirm('Are you sure you want to ' + (newStatus === 'active' ? 'activate' : 'deactivate') + ' this user?')) {
        window.location.href = 'toggle_user_status.php?id=' + userId + '&status=' + newStatus;
    }
}

// Filter functionality
document.getElementById('roleFilter').addEventListener('change', filterUsers);
document.getElementById('statusFilter').addEventListener('change', filterUsers);
document.getElementById('searchUser').addEventListener('input', filterUsers);

function filterUsers() {
    const role = document.getElementById('roleFilter').value;
    const status = document.getElementById('statusFilter').value;
    const search = document.getElementById('searchUser').value.toLowerCase();
    const rows = document.querySelectorAll('.users-table tbody tr');

    rows.forEach(row => {
        const userRole = row.querySelector('.role-badge').textContent.toLowerCase();
        const userStatus = row.querySelector('.status-badge').textContent.toLowerCase();
        const userText = row.textContent.toLowerCase();
        
        const roleMatch = role === 'all' || userRole === role;
        const statusMatch = status === 'all' || userStatus === status;
        const searchMatch = userText.includes(search);
        
        row.style.display = roleMatch && statusMatch && searchMatch ? '' : 'none';
    });
}
</script>

</body>
</html> 