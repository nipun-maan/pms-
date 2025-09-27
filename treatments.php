<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }

$role = $_SESSION['role'];
$uid = $_SESSION['user_id'];

// Fetch treatments
if($role=='patient'){
    $result = $conn->query("SELECT t.*, d.first_name,d.last_name FROM treatments t JOIN doctors d ON t.doctor_id=d.doctor_id WHERE t.patient_id='$uid'");
} elseif($role=='doctor'){
    $result = $conn->query("SELECT t.*, p.first_name,p.last_name FROM treatments t JOIN patients p ON t.patient_id=p.patient_id WHERE t.doctor_id='$uid'");
} else { // admin
    $result = $conn->query("SELECT t.*, p.first_name AS patient_name, d.first_name AS doctor_name FROM treatments t JOIN patients p ON t.patient_id=p.patient_id JOIN doctors d ON t.doctor_id=d.doctor_id");
}
?>

<div class="content">
<h2>Treatments</h2>
<table border="1" style="width:100%; text-align:center;">
<tr>
<?php 
if($role=='patient'){ echo "<th>Doctor</th><th>Diagnosis</th><th>Prescription</th><th>Date</th>"; }
elseif($role=='doctor'){ echo "<th>Patient</th><th>Diagnosis</th><th>Prescription</th><th>Date</th>"; }
else{ echo "<th>Patient</th><th>Doctor</th><th>Diagnosis</th><th>Prescription</th><th>Date</th>"; }
?>
</tr>
<?php while($row=$result->fetch_assoc()){
    echo "<tr>";
    if($role=='patient'){ echo "<td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['diagnosis']."</td><td>".$row['prescription']."</td><td>".$row['treatment_date']."</td>"; }
    elseif($role=='doctor'){ echo "<td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['diagnosis']."</td><td>".$row['prescription']."</td><td>".$row['treatment_date']."</td>"; }
    else{ echo "<td>".$row['patient_name']."</td><td>".$row['doctor_name']."</td><td>".$row['diagnosis']."</td><td>".$row['prescription']."</td><td>".$row['treatment_date']."</td>"; }
    echo "</tr>";
} ?>
</table>
</div>
