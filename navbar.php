<?php
// Ensure session is started
if(!isset($_SESSION)) session_start();

$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Navbar styling */
        nav {
            background-color: #2c3e50;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        nav a {
            color: #ecf0f1;
            text-decoration: none;
            margin: 0 25px; /* extra spacing */
            font-size: 18px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        nav a:hover {
            color: #3498db;
        }

        nav i {
            font-size: 20px;
            vertical-align: middle;
        }

        /* Center content */
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f6f7;
        }

        /* Optional: spacing for main content below navbar */
        .content {
            margin: 30px auto;
            max-width: 900px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<nav>
    <a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a>
    <a href="appointments.php"><i class="fas fa-calendar-check"></i>Appointments</a>
    <a href="treatments.php"><i class="fas fa-notes-medical"></i>Treatments</a>
    <a href="support.php"><i class="fas fa-headset"></i>Support</a>
    <a href="chatbot.php"><i class="fas fa-robot"></i>Chatbot</a>

    <?php if($role=='admin'){ ?>
        <a href="admin_patients.php"><i class="fas fa-users"></i>Patients</a>
        <a href="admin_doctors.php"><i class="fas fa-user-md"></i>Doctors</a>
    <?php } ?>

    <a href="logout.php" style="color:#e74c3c;"><i class="fas fa-sign-out-alt"></i>Logout</a>
</nav>
<div class="content">
