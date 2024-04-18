<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            display:flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            font-family: 'Roboto', sans-serif;
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
        .navbar {
            background-color: rgba(255, 255, 255, 0.0); /* Transparent white */
            border-bottom: 0px solid #e9ecef;
            color: white; /* Change navbar text color to white */
            position: relative; /* Set position to relative to stack on top of video */
            z-index: 1; /* Ensure navbar is above video */
        }
        .navbar-brand {
            font-weight: 400; /* Set font weight to normal */
            color: white !important; /* Change navbar brand text color to white */
        }
        .navbar-nav .nav-link {
            color: white !important; /* Change navbar link text color to white */
            font-weight: 400; /* Set font weight to normal */
        }
        footer {
            color: #1E0342;
            background-color: rgba(255, 255, 255, 0.12); /* Transparent white */
            position: relative;
            bottom: 0;
            width: 100%;
            height: 50px; /* Adjust height as needed */
            text-align: center;
            padding: 5px 0;
}
        .container {
            flex: 1;
            margin-top: 20px; /* Adjust margin top for better spacing */
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.5); /* Transparent white */
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .map-container {
            max-width: 100%;
            overflow: hidden;
            position: relative;
            height: 500px; /* Increased height for the map container */
            border-radius: 10px;
        }
        .map-container iframe {
            width: 87%;
            height: 87%;
            border: none;
        }
    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="./image/soft_blur_bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">EventHive</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.html">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto"> <!-- Changed to ml-auto -->
                <li class="nav-item">
                    <a class="nav-link" href="eventPlannerLogin.php">Become an Event Planner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userProfileDisp.php">Profile</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="text-center mb-4">Feedback</h2>
        <div class="row">
            <div class="col-md-6">
                <form class="contact-form" action="#" method="POST">
                    <div class="form-group">
                        <label for="name">Enter Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Enter Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="query">Enter Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="submit-btn">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="map-container">
                    <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=chandaben&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>

    <footer>        
        <p>Created by Khanjan | Vishnu | Vaishvi</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    if(isset($_REQUEST['submit']))
    {
        require "eventClass.php";

        $obj = new db();

        $name = $_REQUEST['name'];

        $mail = $_REQUEST['email'];
        $feedback = $_REQUEST['feedback'];

        $r = $obj->userfeedback($name,$mail,$feedback);
        if($r>0)
        {
            echo "Feedback Successfully Submitted";
        }
    }
?>
