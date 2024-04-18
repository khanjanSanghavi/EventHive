<?php
session_start();

if(isset($_POST['createEvent'])){
    require "eventClass.php";
    $obj = new db();    

    $eventName = $_POST['EventName'];
    $organizerName = $_POST['OrganizerName'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = $_POST['veneu']; 
    $Description = $_POST['description'];
    $cost = $_POST['cost'];

    // Handling image upload
    $target_dir = "image/";
    $img_name = $_FILES['eImage']['name'];
    $img_size = $_FILES['eImage']['size'];
    $tmp_name = $_FILES['eImage']['tmp_name'];
    $error = $_FILES['eImage']['error'];

   
    if($error === 0){
        if($img_size > 125000){
            $em = "File size too large";
            header('location:createEvent.php?error=' . $em); 
            exit;   
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $new_img_name = uniqid() . "." . $img_ex;
            $target_file = $target_dir . $new_img_name;

            // Move uploaded file to desired location
            if(move_uploaded_file($tmp_name, $target_file)) {
                // Getting user ID from session
                $s_id = $_SESSION['epId'];

                // Call the event_register function with all the parameters
                $r = $obj->event_register($eventName, $organizerName, $date, $time, $venue, $Description, $cost, $target_file, $s_id);

                if($r > 0) {
                    header('location:manageEvent.php');
                    exit;
                } else {
                    $em = "Failed to register event";
                    header('location:createEvent.php?error=' . $em); 
                    exit;
                }
            } else {
                $em = "Error uploading file";
                header('location:createEvent.php?error=' . $em); 
                exit;
            }
        }
    } else {
        $em = "Error uploading file";
        header('location:createEvent.php?error=' . $em); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Event - Event Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar styles */
        #sidebar {
            position: fixed;
            width: 250px;
            height: 100%;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            padding-top: 20px;
            transition: all 0.3s;
        }

        #sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 15px;
            color: #818181;
            display: block;
            transition: all 0.3s;
        }

        #sidebar a:hover {
            color: #f8f9fa;
        }

        /* Content styles */
        #content {
            margin-left: 250px; /* Adjusted to match the sidebar width */
            padding: 15px;
            color: #000;
            padding-top: 20px; /* Adjusted to provide space for the fixed navbar */
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
        }

        .form-container {
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: auto;
            margin-top: 20px;
            margin-bottom: 30px; /* Added padding to the bottom */
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="bg-dark" id="sidebar">
    <div class="text-center">
        <h2 class="text-white">EventMS</h2>
    </div>
    <hr class="bg-light">
    <ul class="list-unstyled">
        <li><a href="profile.php"><i class="fas fa-home"></i> Home</a></li>     
        <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="createEvent.php"><i class="fas fa-calendar-alt"></i> Create Events</a></li>
        <li><a href="manageEvent.php"><i class="fas fa-users"></i> Manage Event</a></li>
        <li><a href="eventPlannerProfile.php"><i class="fas fa-users"></i> Profile</a></li>

    </ul>
</div>
<!-- End Sidebar -->

<!-- Main Content -->
<div id="content" class="bg-light">
    <div class="container mt-4">
        <div class="form-container">
            <h2>Create Event</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="eventName" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="eventName" name="EventName" placeholder="Enter event name">
                </div>
                <div class="mb-3">
                    <label for="organizerName" class="form-label">Organizer Name</label>
                    <input type="text" class="form-control" id="organizerName" name="OrganizerName" placeholder="Enter organizer name">
                </div>
                <div class="mb-3">
                    <label for="eventDate" class="form-label">Event Date</label>
                    <input type="date" class="form-control" name="date" id="eventDate">
                </div>
                <div class="mb-3">
                    <label for="eventTime" class="form-label">Event Time</label>
                    <input type="time" class="form-control" name="time" id="eventTime">
                </div>
                <div class="mb-3">
                    <label for="eventCost" class="form-label">Event Cost</label>
                    <input type="text" class="form-control" id="eventCost" name="cost" placeholder="Enter event cost">
                </div>
                <div class="mb-3">
                    <label for="eventVenue" class="form-label">Event Venue</label>
                    <input type="text" class="form-control" id="eventVenue" name="veneu" placeholder="Enter event venue">
                </div>
                <div class="mb-3">
                    <label for="eventDescription" class="form-label">Event Description</label>
                    <textarea class="form-control" id="eventDescription" name="description" rows="3"
                              placeholder="Enter event description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="eventImage" class="form-label">Event Image</label>
                    <input class="form-control" type="file" name="eImage" id="eventImage">
                </div>
                <button type="submit" name="createEvent" class="btn btn-primary">Create Event</button>
            </form>
        </div>
    </div>
</div>
<!-- End Main Content -->

<script>
// JavaScript to set the minimum date to today
document.addEventListener("DOMContentLoaded", function() {
    var today = new Date().toISOString().split("T")[0];
    document.getElementById("eventDate").setAttribute("min", today);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

<script type="text/javascript">
$(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#eventTime').attr('min', maxDate);
});
</script>

</html>
