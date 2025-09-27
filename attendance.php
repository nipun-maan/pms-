<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }

$role = $_SESSION['role'];
$uid = $_SESSION['user_id'];

// Patient creates ticket
if($role=='patient' && isset($_POST['submit_ticket'])){
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $conn->query("INSERT INTO attendance (patient_id, subject, description, status) VALUES ('$uid','$subject','$description','Open')");
}

// Fetch tickets
if($role=='patient'){
    $result = $conn->query("SELECT * FROM attendance WHERE patient_id='$uid'");
} else { // admin sees all
    $result = $conn->query("SELECT a.*, p.first_name,p.last_name FROM attendance a JOIN patients p ON a.patient_id=p.patient_id");
}
?>

<div class="content">
<h2>Patient Support / Tickets</h2>

<?php if($role=='patient'){ ?>
<form method="post">
<label>Subject:</label><input type="text" name="subject" required><br>
<label>Description:</label><textarea name="description" required></textarea><br>
<button type="submit" name="submit_ticket">Submit Ticket</button>
</form>
<?php } ?>

<h3>Tickets List:</h3>
<table border="1" style="width:100%; text-align:center;">
<tr>
<?php if($role=='patient'){ echo "<th>Subject</th><th>Description</th><th>Status</th><th>Created At</th>"; } else { echo "<th>Patient</th><th>Subject</th><th>Description</th><th>Status</th><th>Created At</th>"; } ?>
</tr>
<?php while($row=$result->fetch_assoc()){
    echo "<tr>";
    if($role=='patient'){ 
        echo "<td>".$row['subject']."</td><td>".$row['description']."</td><td>".$row['status']."</td><td>".$row['created_at']."</td>";
    } else {
        echo "<td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['subject']."</td><td>".$row['description']."</td><td>".$row['status']."</td><td>".$row['created_at']."</td>";
    }
    echo "</tr>";
} ?>
</table>
</div>
