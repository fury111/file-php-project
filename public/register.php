<?php
// Optional: Start session if not already started by header.php
// session_start(); // Usually already in header.php
include '../includes/header.php';

// Optional: Check if already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to home or profile if already logged in
    header('Location: index.php');
    exit;
}

// Optional: Get any error message passed via session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
// Clear the message after displaying
unset($_SESSION['error_message']);

// Optional: Get success message
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['success_message']);

// Optional: Get form data to repopulate fields on error
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['form_data']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="mb-0"><i class="fas fa-user-plus"></i> Register</h3>
                    <p class="mb-0">Create a new account</p>
                </div>
                <div class="card-body">
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($error_message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($success_message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="process_register.php" method="POST"> <!-- Points to the updated processing script -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($form_data['first_name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($form_data['last_name'] ?? '') ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($form_data['location'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>