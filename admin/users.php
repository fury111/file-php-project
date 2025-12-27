<?php


include 'admin_header.php';

// Include the AdminUser class
require_once 'AdminUser.php'; // Adjust path if necessary

// Create an instance of the AdminUser class
$adminUser = new AdminUser();

// Fetch all users from the database
$users = $adminUser->getAllUsers(); // This method needs to be implemented in AdminUser.php

?>

<div class="container-fluid mt-4">
    <div class="row">

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Users</h1>
                <!-- No "Add New User" button typically for end users -->
            </div>

            <!-- User Search -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search users...">
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No users found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['user_id']) ?></td>
                                    <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <span class="badge 
                                            <?php 
                                            if ($user['role'] === 'admin') echo 'bg-danger'; 
                                            elseif ($user['role'] === 'user') echo 'bg-success'; 
                                            else echo 'bg-secondary'; // For other roles if any
                                            ?>">
                                            <?= htmlspecialchars($user['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $user['user_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="delete_user.php?id=<?= $user['user_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php include 'admin_footer.php'; ?>