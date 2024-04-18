<?php
    $eventid = $_GET['key_id'];
    include "eventClass.php";
    $obj = new db();
    $r = $obj->fetch_event_info($eventid);

?>

<?php
session_start();
if(isset($_POST['createEvent'])){
    $eventName = $_POST['EventName'];
    $organizerName = $_POST['OrganizerName'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = $_POST['veneu']; 
    $Description = $_POST['description'];
    $cost = $_POST['cost'];
    $epid = $r['epId'];

    // Handling image upload
    

                // Call the event_register function with all the parameters
                $r = $obj->event_update($eventid,$eventName, $organizerName, $date, $time, $venue, $Description, $cost, $target_file, $epid);

                if($r > 0) {
                    header('location:adminEvent.php');
                    exit;
                } else {
                    $em = "Failed to register event";
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
        #sidebar {
            position: fixed;
            width: 250px;
            height: 100%;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            padding-top: 20px;
            transition: all 0.3s;
            overflow-y: auto; /* Enable vertical scrolling */
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
        @media (max-width: 768px) {
            #sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            #sidebar a {
                padding: 10px;
            }
            #content {
                margin-left: 0;
            }
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
<div class="bg-dark active" id="sidebar">
        <div class="text-center">
            <h2 class="text-white">EventHive</h2>
        </div>
        <hr class="bg-light">
        <ul class="list-unstyled">
            <li><a href="admin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="adminEvent.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Attendees</a></li>
            <li><a href="adminEventPlanner.php"><i class="fas fa-user-tie"></i> Event Planner</a></li>

        </ul>
    </div>
    <!-- /#sidebar -->

<!-- Main Content -->
<div class="container mt-4">
    <div class="form-container">
        <h2>Update Event </h2>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="eventName" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="eventName" name="EventName" value = "<?php echo $r['eventName']?>">
            </div>
            <div class="mb-3">
                <label for="organizerName" class="form-label">Organizer Name</label>
                <input type="text" class="form-control" id="organizerName" name="OrganizerName" value = "<?php echo $r['OrganizerName']?>">
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
                <input type="text" class="form-control" id="eventCost" name="cost" value = "<?php echo $r['cost']?>">
            </div>
            <div class="mb-3">
                <label for="eventVenue" class="form-label">Event Venue</label>
                <input type="text" class="form-control" id="eventVenue" name="veneu" value = "<?php echo $r['venue']?>">
            </div>
            <div class="mb-3">
                <label for="eventDescription" class="form-label">Event Description</label>
                <textarea class="form-control" id="eventDescription" name="description" rows="3"
                value = "<?php echo $r['Description']?>"></textarea>
            </div>
            <div class="mb-3">
                <label for="eventImage" class="form-label">Event Image</label>
                <input class="form-control" type="file" name="eImage" id="eventImage" value = "<?php echo $r['Image']?>" readonly>
            </div>
            <button type="submit" name="createEvent" class="btn btn-primary">Update Event</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>