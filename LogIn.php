<!DOCTYPE html>
<html>

<head>
  <title>Login and Sign Up Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body style="margin: 5%;">
  <div class="container">
    <h2>Login</h2>
    <form method="post">
        <input type="hidden" name="logIn" value="1">
      <div class="form-group">
        <label for="loginEmail">Email address:</label>
        <input type="email" class="form-control" name="loginEmail" id="loginEmail" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="loginPassword">Password:</label>
        <input type="password" class="form-control" name="loginPassword" id="loginPassword" placeholder="Enter password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <hr>

    <h2>Sign Up</h2>
    <form method="post">
    <input type="hidden" name="signup" value="1">
      <div class="form-group">
        <label for="signupEmail">Email address:</label>
        <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="signupPassword">Password:</label>
        <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Enter password">
      </div>
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
  </div>
</body>

</html>

<?php
    session_start();
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'datasecurity';
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, 3307);
    
    if (isset($_POST['logIn']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];
        echo $email . $password;
    
        $PW_Hashed = hash('sha256', $password);
        echo $PW_Hashed;
    
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE Email = ? AND Password = ?");
        $stmt->bind_param('ss', $email, $PW_Hashed);
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $user['Email'];
            header("Location: client.php");
            exit();
        } else {
            echo "<script>alert('User not found');</script>";
        }
    }

    if (isset($_POST['signup'])) {
        $email = $_POST['signupEmail'];
        $password = $_POST['signupPassword'];
        echo '<script>window.location.href = "client.php";</script>';
        $_SESSION['user'] = $email;
    
        $PW_Hashed = hash('sha256', $password);
    
        $stmt = $conn->prepare("INSERT INTO `users` VALUES (?, ?)");
        $stmt->bind_param('ss', $email, $PW_Hashed);
        $stmt->execute();
    }
?>