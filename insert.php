<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
        $key = $_POST['key'];
        $encr = $_POST['encrypted'];

        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = 'root';
        $db_name = 'datasecurity';
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, 3307);

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $stmt = $conn->prepare('INSERT INTO messages (`key`, `message`, `date`, `user`) VALUES (?, ?, NOW(), ?)');
        $stmt->bind_param('sss', $key, $encr, $_SESSION['user']);
        $stmt->execute();

        echo "Message inserted successfully.";
    }
?>
