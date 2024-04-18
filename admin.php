<?php
require "eventClass.php";

$obj = new db();
$r = $obj->totUsers();
$totevents = $obj->totEvents();
$totplanner = $obj->totPlanner();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
        }

        .btn-secondary {
            background-color: #3366ff;
            color: #fff;
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
            left: 250px;
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
        
        .card-icon {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .card-title {
            font-weight: bold;
            font-size: 24px; /* Increased font size */
        }
        
        .card-text {
            font-weight: bold;
            font-size: 36px; /* Increased font size */
        }
        
        .card {
            height: 250px;
        }
    </style>
</head>
<body>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark active" id="sidebar">
        <div class="text-center">
            <h2 class="text-white">EventHive</h2>
        </div>
        <hr class="bg-light">
        <ul class="list-unstyled">
            <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="adminEvent.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="adminAttendees.php"><i class="fas fa-users"></i> Attendees</a></li>
            <li><a href="adminEventPlanner.php"><i class="fas fa-user-tie"></i> Event Planner</a></li>
        </ul>
    </div>

    <div id="content" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);">
            <!-- Button removed here -->
        </nav>
        <!-- Page content goes here -->
        <h2 align="center">Welcome to Event Management System</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-body">
                        <i class="fas fa-users card-icon text-primary"></i>
                        <h5 class="card-title" style="font-size: 28px;">Total Students</h5>
                        <h1 class="card-text" style="font-size: 48px;"><?php echo "<strong>$r</strong>"; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-body">
                        <i class="fas fa-user-tie card-icon text-success"></i>
                        <h5 class="card-title" style="font-size: 28px;">Total Event Planners</h5>
                        <h1 class="card-text" style="font-size: 48px;"><?php echo "<strong>$totplanner</strong>"; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar-alt card-icon text-warning"></i>
                        <h5 class="card-title" style="font-size: 28px;">Total Events</h5>
                        <h1 class="card-text" style="font-size: 48px;"><?php echo "<strong>$totevents</strong>"; ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Additional content here -->
        </div>
        <div class="text-center mt-3">
            <a href="logout.php" class="btn btn-secondary btn-lg">Logout</a>
        </div>
    </div>
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
