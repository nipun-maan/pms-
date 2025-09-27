<?php
include 'db.php';
session_start();
$error = "";
$success = "";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if($check->num_rows > 0){
        $error = "Username already taken";
    } else {
        $conn->query("INSERT INTO patients (first_name,last_name,dob,gender,phone,email,address) 
                     VALUES ('$first_name','$last_name','$dob','$gender','$phone','$email','$address')");
        $conn->query("INSERT INTO users (username,password_hash,role) VALUES ('$username','$password','patient')");
        $success = "Registration successful! You can now <a href='login.php'>login</a>.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Register</title>
</head>
<body>
<div class="content">
<h2>Patient Registration</h2>
<?php if($error!=""){ echo "<p class='error'>$error</p>"; } ?>
<?php if($success!=""){ echo "<p class='success'>$success</p>"; } ?>
<form method="post">
<label>Username:</label>
<input type="text" name="username" required><br>
<label>Password:</label>
<input type="password" name="password" required><br>
<label>First Name:</label>
<input type="text" name="first_name" required><br>
<label>Last Name:</label>
<input type="text" name="last_name" required><br>
<label>Date of Birth:</label>
<input type="date" name="dob" required><br>
<label>Gender:</label>
<select name="gender" required>
<option value="">--Select--</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select><br>
<label>Phone:</label>
<input type="text" name="phone" required><br>
<label>Email:</label>
<input type="email" name="email" required><br>
<label>Address:</label>
<textarea name="address" required></textarea><br>
<button type="submit" name="register">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
