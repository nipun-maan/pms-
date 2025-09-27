<?php
include 'db.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Handle ticket submission (patients only)
if($role=='patient' && isset($_POST['submit_ticket'])){
    $subject = $_POST['subject'];
    $description = $_POST['description'];

    $sql = "INSERT INTO attendance (patient_id, subject, description, status) 
            VALUES ('$user_id','$subject','$description','Open')";
    $conn->query($sql);
}

// Fetch tickets
if($role=='admin'){
    $result = $conn->query("SELECT a.*, p.first_name AS patient_fname, p.last_name AS patient_lname 
                            FROM attendance a 
                            JOIN patients p ON a.patient_id=p.patient_id 
                            ORDER BY created_at DESC");
} else {
    $result = $conn->query("SELECT * FROM attendance 
                            WHERE patient_id='$user_id' 
                            ORDER BY created_at DESC");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
    <title>Support / Tickets</title>
</head>
<body>
<?php include 'navbar.php'; ?>

<h2>Patient Support / Tickets</h2>

<?php if($role=='patient'){ ?>
<form method="post">
    <label>Subject:</label><input type="text" name="subject" required><br>
    <label>Description:</label><textarea name="description" required></textarea><br>
    <button type="submit" name="submit_ticket">Submit Ticket</button>
</form>
<?php } ?>

<h3>Your Tickets:</h3>
<?php if($result->num_rows > 0){ ?>
<table>
    <tr>
        <th>Ticket ID</th>
        <th>Patient</th>
        <th>Subject</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
    </tr>
    <?php while($row = $result->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $row['ticket_id']; ?></td>
        <td><?php echo $role=='admin' ? $row['patient_fname'].' '.$row['patient_lname'] : $_SESSION['username']; ?></td>
        <td><?php echo $row['subject']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php } ?>
</table>
<?php } else { ?>
<p>No tickets submitted yet.</p>
<?php } ?>

<p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
