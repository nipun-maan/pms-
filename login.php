<?php
session_start();
include 'db.php';

$error = '';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        if($password === $user['password_hash']) { // simple match for demo, ideally use password_hash
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pakenham Hospital</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }
    /* Navbar */
.navbar {
  background-color: #243447;
  display: flex;
  justify-content: center; 
  align-items: center;
  padding: 25px 0;           
  width: 100%;
  position: fixed;          
  top: 0;
  left: 0;
  z-index: 999;
}

.navbar a {
  color: white;
  text-decoration: none;
  margin: 0 40px;           
  font-size: 20px;          
  font-weight: 600;
}

.navbar a:hover {
  text-decoration: underline;
}

.navbar .login {
  color: red;
  font-weight: bold;
}

/* Layout */
.container {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 60px;               
  padding: 20px;
  margin-top: 140px;        
}

.left-box {
  background-color: #173a58;
  color: white;
  padding: 40px;
  width: 500px;            
  border-radius: 12px;
  text-align: center;
  font-size: 18px;           
}

.left-box h2 {
  font-size: 26px;
  margin-bottom: 25px;
}

.left-box button {
  display: block;
  background: #0a2f4e;
  border: none;
  color: white;
  padding: 14px 20px;
  margin: 15px auto;
  border-radius: 6px;
  cursor: pointer;
  width: 85%;
  font-size: 16px;
}

.left-box button:hover {
  background: #0056b3;
}

.right-box {
  background: white;
  padding: 30px;
  width: 500px;              
  border-radius: 12px;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  text-align: center;
  font-size: 18px;           
}

.doctor-img {
  width: 100%;
  border-radius: 6px;
  margin-top: 20px;
}


    /* Modal (login popup) */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      width: 380px;
      padding: 40px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      text-align: center;
    }
    .modal-content h2 { margin-bottom: 25px; color: #2c3e50; }
    .modal-content input[type=text], 
    .modal-content input[type=password] {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    .modal-content button {
      padding: 12px 25px;
      border:none;
      border-radius: 5px;
      background-color: #3498db;
      color: #fff;
      font-size: 16px;
      cursor:pointer;
      margin-top: 15px;
    }
    .modal-content button:hover { background-color: #2980b9; }
    .error { color:red; margin-top:10px; }
    .register-link {
      display:block;
      margin-top:15px;
      color:#3498db;
      text-decoration:none;
    }
    .register-link:hover { text-decoration:underline; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <div>
      <a href="#">Pakenham Hospital</a>
      <a href="#">Dashboard</a>
      <a href="#">Appointments</a>
      <a href="#">Treatments</a>
      <a href="#">Support</a>
      <a href="#">Chatbot</a>
    </div>
    <a href="#" class="login">Login</a>
  </div>

  <!-- Main content -->
  <div class="container">
    <div class="left-box">
      <h2>Why choosing us?</h2>
      <p>At Pakenham Hospital, you can expect quality care, modern facilities, and dedicated staff. 
      We are here to support your health every step of the way</p>
      <button>Contact our specialist clinics</button>
      <button>Booking now</button>
    </div>
    <div class="right-box">
      <div>
        <p>📞 0441254587</p>
        <p>📍 350 Queen Street, Melbourne, Victoria 3000</p>
        <p>✉️ PakenhamHospitall@gmail.com</p>
      </div>
      <img src="images/doctor.jpg" alt="Doctor with patient" class="doctor-img">
    </div>
  </div>

  <!-- Modal (login popup) -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <h2>PMS Login</h2>
      <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
      </form>
      <?php if($error) echo "<div class='error'>$error</div>"; ?>
      <a class="register-link" href="register_patient.php">New user? Register here</a>
    </div>
  </div>

  <script>
    // Show modal when clicking anywhere
    const modal = document.getElementById("loginModal");
    document.addEventListener("click", function(){
      modal.style.display = "flex";
    });
  </script>
</body>
</html>
