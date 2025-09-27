<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }

$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>

<div class="content">
<h2>Welcome, <?php echo $username; ?>!</h2>
<p>Your role: <?php echo ucfirst($role); ?></p>

<?php if($role=='patient'){ ?>
<p>Use the navigation bar to manage your appointments, tickets, treatments, or ask questions via chatbot.</p>
<?php } elseif($role=='doctor'){ ?>
<p>View your assigned appointments and patient treatments.</p>
<?php } else { ?>
<p>Admin can view/manage all patients, doctors, appointments, treatments, and support tickets.</p>
<?php } ?>
</div>
