<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Management System - Events</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
        }

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

        #content {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 250px; /* Adjust the width as needed */
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            padding: 15px;
            color: #000;
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
    </style>
</head>
<body>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark active" id="sidebar">
        <div class="text-center">
            <h2 class="text-white">EventMS</h2>
        </div>
        <hr class="bg-light">
        <ul class="list-unstyled">
        <li><a href="profile.php"><i class="fas fa-home"></i> Home</a></li>     
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="createEvent.php"><i class="fas fa-calendar-alt"></i> Create Events</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Manage Event</a></li>
            <li><a href="eventPlannerProfile.php"><i class="fas fa-users"></i> Profile</a></li>

        </ul>
    </div>
    <!-- /#sidebar -->

    <!-- Page Content -->
    <div id="content" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);">
            <!-- Button removed here -->
        </nav>

        <?php
    session_start();
    require 'eventClass.php';
    $obj = new db();
    $id = $_SESSION['epId'];
    $events = $obj->get_events_by_id($id);

?>

        <h2 align="center">Events</h2>

        <div class="container mt-4">
            <h3>Event List</h3>
            <div class="table-responsive">
            <?php if($events){ ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Organized By</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                
                                foreach ($events as $event) {
                                    echo "<tr>";
                                    echo "<td>" . $event['eventName'] . "</td>";
                                    echo "<td>" . $event['OrganizerName'] . "</td>";
                                    echo "<td>" . $event['date'] . "</td>";
                                    echo "<td>" . $event['time'] . "</td>";
                                    echo "<td>" . $event['venue'] . "</td>";
                                    echo "<td>" . $event['cost'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-success mr-2 '><a href=eventUpdate.php?key_id=".$event['eventId'].">Update</a></button>";
                                    echo "<button class='btn btn-danger ml-2'><a href=deleteEvent.php?key_id=".$event['eventId'].">Delete</a></button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<h4>Event Details will appear here once added</h4>";
                            }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /#content -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    // Toggle sidebar on button click
    document.getElementById('sidebarCollapse').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>
</body>
</html>
