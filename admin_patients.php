<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php"); exit();
}

// Add new patient
if(isset($_POST['add_patient'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Insert into patients
    $conn->query("INSERT INTO patients (first_name,last_name,dob,gender,phone,email,address) 
        VALUES ('$fname','$lname','$dob','$gender','$phone','$email','$address')");
    
    // Add to users table
    $patient_id = $conn->insert_id;
    $conn->query("INSERT INTO users (username,password_hash,role) VALUES ('$username','$password','patient')");
}

// Fetch patients
$result = $conn->query("SELECT * FROM patients");
?>

<div class="content">
<h2>Manage Patients</h2>

<h3>Add New Patient</h3>
<form method="post">
<input type="text" name="first_name" placeholder="First Name" required>
<input type="text" name="last_name" placeholder="Last Name" required>
<input type="date" name="dob" required>
<select name="gender" required>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
<input type="text" name="phone" placeholder="Phone" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<textarea name="address" placeholder="Address"></textarea>
<button type="submit" name="add_patient">Add Patient</button>
</form>

<h3>Existing Patients</h3>
<table border="1" style="width:100%; text-align:center;">
<tr><th>ID</th><th>Name</th><th>Gender</th><th>DOB</th><th>Phone</th><th>Email</th></tr>
<?php while($row=$result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['patient_id']."</td>";
    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
    echo "<td>".$row['gender']."</td>";
    echo "<td>".$row['dob']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "</tr>";
} ?>
</table>
</div>
