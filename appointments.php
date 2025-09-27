<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }
$role = $_SESSION['role'];
$uid = $_SESSION['user_id'];

if($role=='patient' && isset($_POST['book'])){
    $doctor_id = $_POST['doctor_id'];
    $appt_date = $_POST['appt_date'];
    $conn->query("INSERT INTO appointments (patient_id,doctor_id,appointment_date,status) VALUES ('$uid','$doctor_id','$appt_date','Scheduled')");
}

// Get doctors list for booking
$doctors = $conn->query("SELECT * FROM doctors");

// Display appointments
if($role=='patient'){
    $result = $conn->query("SELECT a.*, d.first_name,d.last_name FROM appointments a JOIN doctors d ON a.doctor_id=d.doctor_id WHERE a.patient_id='$uid'");
} elseif($role=='doctor'){
    $result = $conn->query("SELECT a.*, p.first_name,p.last_name FROM appointments a JOIN patients p ON a.patient_id=p.patient_id WHERE a.doctor_id='$uid'");
} else { // admin
    $result = $conn->query("SELECT a.*, p.first_name AS patient_name, d.first_name AS doctor_name FROM appointments a JOIN patients p ON a.patient_id=p.patient_id JOIN doctors d ON a.doctor_id=d.doctor_id");
}
?>

<div class="content">
<h2>Appointments</h2>

<?php if($role=='patient'){ ?>
<form method="post">
<label>Select Doctor:</label>
<select name="doctor_id" required>
<?php while($d=$doctors->fetch_assoc()){ echo "<option value='".$d['doctor_id']."'>".$d['first_name']." ".$d['last_name']."</option>"; } ?>
</select><br>
<label>Date & Time:</label>
<input type="datetime-local" name="appt_date" required><br>
<button type="submit" name="book">Book Appointment</button>
</form>
<?php } ?>

<h3>Appointments List:</h3>
<table border="1" style="width:100%; text-align:center;">
<tr>
<?php if($role=='patient'){ echo "<th>Doctor</th>"; } elseif($role=='doctor'){ echo "<th>Patient</th>"; } else { echo "<th>Patient</th><th>Doctor</th>"; } ?>
<th>Date</th><th>Status</th></tr>
<?php while($row=$result->fetch_assoc()){ 
    echo "<tr>";
    if($role=='patient'){ echo "<td>".$row['first_name']." ".$row['last_name']."</td>"; }
    elseif($role=='doctor'){ echo "<td>".$row['first_name']." ".$row['last_name']."</td>"; }
    else{ echo "<td>".$row['patient_name']."</td><td>".$row['doctor_name']."</td>"; }
    echo "<td>".$row['appointment_date']."</td><td>".$row['status']."</td></tr>";
} ?>
</table>
</div>
