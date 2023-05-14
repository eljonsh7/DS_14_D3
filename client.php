<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
    session_abort();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Client Site</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
    <h1>Simple Form</h1>
    <form id="my-form" method="POST">
        <div class="form-group">
        <label for="key">Key: </label>
        <input type="text" placeholder="Key: " class="form-control" id="key" name="key" value="<?= $_POST['key'] ?? '' ?>" required>
        </div>
        <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control"  placeholder="Message:" id="message" name="message" rows="5" required><?= $_POST['message'] ?? '' ?></textarea>
        <p id="hidden"></p>
        </div>
        <button type="submit" class="btn btn-primary" style="">Submit</button>
    </form>
    </div>
    <div>   
        <a href="server.php" class="btn btn-warning" style="margin: 2% 15%; width: 70%;">Go to Server</a>
        <a href="logout.php" class="btn btn-danger" style="margin: 1% 15%; width: 70%;">Sign out</a>
    </div>

    <script>
        <?php 
            $myFile = fopen("publicKey.pem", "r") or die("File not found!");
            $text = fread($myFile, filesize("publicKey.pem"));
        ?>

        $('#my-form').submit(function(event) {
            event.preventDefault();

            const publicKey = "<?php echo $text; ?>";

            var message = document.getElementById("message").value;
            var key = document.getElementById("key").value;
            var encrypted = CryptoJS.DES.encrypt(message, key).toString();

            const encryptedKey = CryptoJS.DES.encrypt(key, publicKey).toString();
            console.log('Message: ' + message);
            console.log('Key: ' + key); 
            console.log('Encrypted key: ' + encryptedKey);
            console.log('Public key: ' + publicKey);

            $.ajax({
                type: 'POST',
                url: 'insert.php',
                data: { 
                    key: encryptedKey,
                    encrypted: encrypted 
                },
                success: function(response) {
                    console.log(response);
                },
                error: function() {
                    console.log('Error sending encrypted message to server.');
                }
            });
            console.log('Encrypted message: ' + encrypted);
            document.getElementById("key").value = "";
            document.getElementById("message").value = "";
        });
    </script>
</body>
</html>
