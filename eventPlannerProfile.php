

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Event Hive</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .navbar {
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
        }

        .navbar a {
            color: #000;
        }    
        .container {
            background-color: #fff; /* Container background color */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
        }

        .profile-header {
            text-align: center;
        }
        .btn-green {
            background-color: #4CAF50;
            color: #fff;
        }

        .btn-red {
            background-color: #FF5722;
            color: #fff;
        }

        .btn-secondary {
            background-color: #3366ff;
            color: #fff;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Event Hive</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-user"></i> Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>

<?php
    session_start();
    $eid = $_SESSION["epId"] ;
    if(isset($eid)){

    require 'eventClass.php';
    $obj = new db();

    $r = $obj->fetchPlanner($eid);
?>

    <div class="container">
        <div class="profile-header">
            <h2>Hello,<?php echo $r['name'] ?> </h2>
            <p>Manage your profile here</p>
        </div>

        <div class="action-buttons">
            <a href="EventPlannerUpdate.php" class="btn btn-green btn-lg">Update Profile</a>
            <a href="EventPlannerDelete.php" class="btn btn-red btn-lg">Delete Account</a>
        </div>

        <div class="text-center mt-3">
            <a href="logout.php" class="btn btn-secondary btn-lg">Logout</a>
        </div>
    </div>

    <?php
    }else{
        header('location:login.php');
    }
    ?>