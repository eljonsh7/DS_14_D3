<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = 'root';
        $db_name = 'datasecurity';
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, 3307);

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $key = $_POST['key'];

        $stmt = $conn->prepare('SELECT `key`, `message`, `date`, `user` FROM Messages');
        // $stmt->bind_param('s', $key);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<table>';
            while ($row = $result->fetch_assoc()) {
                if(isset($_SESSION['user']) && $_SESSION['user'] == $row['user']){
                    echo '<tr><td>' . $row['key'] . '</td><td>'. $row['message'] . '</td><td>' . $row['date'] . '</td></tr>';
                }
            }
            echo '</table>';
        } else {
            echo 'No results found.';
        }
    }
?>
