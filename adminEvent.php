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
            <h2 class="text-white">EventHive</h2>
        </div>
        <hr class="bg-light">
        <ul class="list-unstyled">
            <li><a href="admin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="adminAttendees.php"><i class="fas fa-users"></i> Attendees</a></li>
            <li><a href="adminEventPlanner.php"><i class="fas fa-user-tie"></i> Event Planner</a></li>

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
        $events = $obj->get_all_events();
        ?>

<div class="container mt-4">
    <h2 align="center">Events</h2>
    <div class="mb-3" style="width: 70%;">
        <input type="text" id="searchInput" class="form-control" placeholder="Search events">
    </div>
    <div class="table-responsive">
        <?php if($events){ ?>
            <table id="eventsTable" class="table table-bordered table-striped">
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
                    echo "<button class='btn btn-success mr-2'><a href=adminUpdate.php?key_id=".$event['eventId']."><i class='fas fa-edit'></i></a></button>";
                    echo "<button class='btn btn-danger ml-2'><a href=adminDelete.php?key_id=".$event['eventId']."><i class='fas fa-trash-alt'></i></a></button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        <?php }else{
            echo "<h4>Event Details will appear here once added</h4>";
        } ?>
    </div>
</div>


        </div>
    </div>
    <!-- /#content -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    // Filter function for searching events
    function filterEvents() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("eventsTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Index 0 for the event name column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Attach event listener to the search input
    document.getElementById("searchInput").addEventListener("keyup", filterEvents);
</script>
</body>
</html>
