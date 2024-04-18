<?php
    $eventId = $_GET["eventId"];
    //$eventId = 21;
    //echo $eventId;
    require "eventClass.php";

    $obj = new db();
    $r = $obj->bill($eventId);
              
?>

<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Bill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="./image/payment_success.png" alt="Success Logo" class="logo">
        <h2>Transaction Details</h2>
        
        <div class="row">
            <div class="col-md-6">
                <p><strong>Payment Method:</strong> <?php echo "CARD"; ?></p>
                <a href="profile.php">Profile</a>
            </div>
        </div>
    </div>
</body>
</html>
</html>
