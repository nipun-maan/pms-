<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php"); exit();
}

// Add new doctor
if(isset($_POST['add_doctor'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $conn->query("INSERT INTO doctors (first_name,last_name,specialization,phone,email) 
        VALUES ('$fname','$lname','$specialization','$phone','$email')");
    
    // Add to users table
    $conn->query("INSERT INTO users (username,password_hash,role) VALUES ('$username','$password','doctor')");
}

// Fetch doctors
$result = $conn->query("SELECT * FROM doctors");
?>

<div class="content">
<h2>Manage Doctors</h2>

<h3>Add New Doctor</h3>
<form method="post">
<input type="text" name="first_name" placeholder="First Name" required>
<input type="text" name="last_name" placeholder="Last Name" required>
<input type="text" name="specialization" placeholder="Specialization" required>
<input type="text" name="phone" placeholder="Phone" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="add_doctor">Add Doctor</button>
</form>

<h3>Existing Doctors</h3>
<table border="1" style="width:100%; text-align:center;">
<tr><th>ID</th><th>Name</th><th>Specialization</th><th>Phone</th><th>Email</th></tr>
<?php while($row=$result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['doctor_id']."</td>";
    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
    echo "<td>".$row['specialization']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "</tr>";
} ?>
</table>
</div>
