<?php
include '../includes/header.php';
require '../Classes/Database.php';
include '../includes/auth.php';

requireLogin();

$db = Database::getInstance();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id'];

$sql= "SELECT first_name , last_name, email ,location FROM users WHERE user_id=?";
$stmt=$conn->prepare($sql);
$stmt->execute([$user_id]);
$user= $stmt->fetch(PDO::FETCH_ASSOC);


$first_name=$user['first_name'];
$last_name=$user['last_name'];
$email=$user['email'];
$location=$user['location'];

$password='';
$confirm_password = '';


$error_message ='';
$success_message ='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $first_name=trim($_POST['first_name']);
    $last_name=trim($_POST['last_name']);
    $email=trim($_POST['email']);
    $location=trim($_POST['location']);
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];




if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error_message ='Invalid email format!';
}
elseif($password && $password!==$confirm_password){
    $error_message ="Passwords do not match!";
}
elseif($password && strlen($password)<8){
    $error_message = "Password must be at least 8 characters!";
}
else{
    //update here

    if($password){
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $sql="UPDATE users SET first_name=? , last_name=? , email=? , location=? , password=? WHERE user_id=?";
      $stmt=$conn->prepare($sql);
      $stmt->execute([$first_name,$last_name,$email,$location,$hashed_password,$user_id]);
    }

    else {
      $sql="UPDATE users SET first_name=? , last_name=? , email=? , location=?  WHERE user_id=?";
      $stmt=$conn->prepare($sql);
      $stmt->execute([$first_name,$last_name,$email,$location,$user_id]);
    }

    $success_message="Profile updated successfully!";
}
}


?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="mb-0">My Profile</h3>
                </div>
                <div class="card-body">
              
                       <?php if($error_message): ?>
                       <div class="alert alert-danger"><?= $error_message ?></div>
                       <?php endif; ?>
                       <?php if($success_message): ?>
                       <div class="alert alert-success"><?= $success_message ?></div>
                       <?php endif; ?>

                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"  value="<?=htmlspecialchars($first_name)?>" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"  value="<?=htmlspecialchars($last_name)?>" >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=htmlspecialchars($email) ?>"  >
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?=htmlspecialchars($location)?>" >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Edit Profile</button>
                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>