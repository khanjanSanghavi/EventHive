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
            font-size: 18px;
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
            
            /* margin-left: 250px;
            padding: 15px;
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%); */
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
<div class="bg-dark" id="sidebar">
    <div class="text-center">
        <h2 class="text-white">EventMS</h2>
    </div>
    <hr class="bg-light">
    <ul class="list-unstyled">
         <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="#"><i class="fas fa-calendar-alt"></i> Events</a></li>
        <li><a href="#"><i class="fas fa-users"></i> Attendees</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        <!-- New "Manage Events" dropdown -->
        <li>
            <a href="#" class="dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#manageEventsDropdown">
                <i class="fas fa-tasks"></i> Manage Events
            </a>
            <ul class="collapse list-unstyled" id="manageEventsDropdown">
                <li><a href="#">Add Events</a></li>
                <li><a href="#">Update Events</a></li>
                <li><a href="#">Delete Events</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- /#sidebar -->


    <!-- Page Content -->
    

        <div id="content" class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);">
        <button type="button" id="sidebarCollapse" class="btn btn-dark">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
        <!-- Page content goes here -->
        <h2>Welcome to Event Management System</h2>
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
