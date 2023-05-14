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
    <title>Server Side</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Search Messages</h1>
        <div class="row mt-5">
            <h2>Search by Key</h2>
            <form>
                <div class="form-group">
                    <label for="key">Key :</label>
                    <input type="text" class="form-control" id="key" name="key" placeholder="Enter key" required>
                </div>
                <button type="submit" class="btn btn-primary" style="margin: 2% 0;">Search</button>
            </form>
        </div>
        <div>   
            <a href="client.php" class="btn btn-warning" style="margin: 2% 15%; width: 70%;">Go to Client</a>
            <a href="logout.php" class="btn btn-danger" style="margin: 1% 15%; width: 70%;">Sign out</a>
        </div>

        <div class="mt-5">
            <h2>Results</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php 
                $myFile = fopen("publicKey.pem", "r") or die("File not found!");
                $text = fread($myFile, filesize("publicKey.pem"));
            ?>
            const publicKey = "<?php echo $text; ?>";
            $('form').submit(function(event) {
                event.preventDefault();
                var inputKey = document.getElementById("key").value;
                function decryptMessages() {
                    $('table tbody tr').each(function() {
                        var key = $(this).find('td:eq(0)').text();
                        var decryptedKey = CryptoJS.DES.decrypt(key, publicKey).toString(CryptoJS.enc.Utf8);
                        $(this).find('td:eq(0)').text(decryptedKey);

                        var message = $(this).find('td:eq(1)').text();
                        var decryptedMessage = CryptoJS.DES.decrypt(message, decryptedKey.toString()).toString(CryptoJS.enc.Utf8);
                        $(this).find('td:eq(1)').text(decryptedMessage);

                        
                        if (decryptedKey != inputKey) { 
                            $(this).remove(); 
                        }
                        console.log("Decrypted message: " + decryptedMessage);
                        console.log("Decrypted key: " + decryptedKey);
                        console.log("Key: " + key);
                        console.log("Keys: " + key.toString());
                        
                    });
                }

                
                const encryptedKey = CryptoJS.DES.encrypt(inputKey, publicKey).toString().substr(0, 10);
                $.ajax({
                    type: 'POST',
                    url: 'get.php',
                    data: { 
                        key: encryptedKey,
                    },
                    success: function(response) {
                        $('#table-body').html(response);
                        decryptMessages();
                    },
                    error: function() {
                        console.log('Error searching messages from server.');
                    }
                });
            });
        });
    </script>
</body>
</html>
