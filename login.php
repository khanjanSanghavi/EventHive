<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.0); /* Transparent white */

            max-width: 400px;
            margin-top: 50px;
           
;           padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Place the video behind other content */
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-primary {
            border-radius: 20px;
            padding-left: 30px;
            padding-right: 30px;
            width: 100%;
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-footer {
            margin-top: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<video autoplay muted loop>
        <source src="./image/soft_blur_bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="lusername" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="lpassword" required>
        </div>
        <button type="submit" name="btnLogin" class="btn btn-primary" >Login</button>
        <div class="form-footer">
            <p>Don't have an account? <a href="registration.php">Sign up</a></p>
            <p>Go back to <a href="profile.php">Profile</a></p>
        </div>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
    session_start();

    if(isset($_REQUEST['btnLogin']))
    {
        require "eventClass.php";

        $obj = new db();
        if($_REQUEST['lusername'] == 'admin' && $_REQUEST['lpassword'] == 'admin')
        {
         
            $_SESSION['admin'] = 'admin';         //create admin session var
            header("location:admin.php");
        }
        else{
            $r = $obj->validate_student($_REQUEST['lusername'],$_REQUEST['lpassword']);
            
                if($r==0)
                {
                    echo "Incorrect Username or password";
                    
                }
                else{
                    $_SESSION['UserId'] = $r['id'];
                    header("location:profile.php");
                }
            }
    }
?>