<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Management System - Attendees</title>
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
        #content {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 250px; /* Adjust the width as needed */
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            padding: 15px;
            color: #000;
            overflow-y: auto; /* Enable vertical scrolling */
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
        .table-responsive {
            margin-bottom: 20px;
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
            <li><a href="adminEvent.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Attendees</a></li>
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
        $users = $obj->get_all_user();
        ?>

        <h2 align="center">Attendees</h2>

        <div class="container mt-4">
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search attendees by name or ID">
            </div>
            <h3>Attendees List</h3>
            <div class="table-responsive">
                <?php if($users){ ?>
                    <table id="attendeesTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo "<tr>";
                            echo "<td>" . $user['S_id'] . "</td>";
                            echo "<td>" . $user['studentName'] . "</td>";
                            echo "<td>" . $user['gender'] . "</td>";
                            echo "<td>" . $user['department'] . "</td>";
                            echo "<td>" . $user['email'] . "</td>";
                            echo "<td>" . $user['phonenumber'] . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-success mr-2'><a href=adminAttenUpdate.php?key_id=".$user['id']."><i class='fas fa-pencil-alt'></i></a></button>";
                            echo "<button class='btn btn-danger ml-2'><a href=adminAttenDelete.php?key_id=".$user['id']."><i class='fas fa-trash-alt'></i></a></button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        }else{
                            echo "<h4>No attendees found</h4>";
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
    // Filter function for searching attendees by ID or name
    function filterAttendees() {
        var input, filter, table, tr, tdId, tdName, i;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("attendeesTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            tdId = tr[i].getElementsByTagName("td")[0]; // First column for ID
            tdName = tr[i].getElementsByTagName("td")[1]; // Second column for name
            if (tdId || tdName) {
                var idText = tdId.textContent || tdId.innerText;
                var nameText = tdName.textContent || tdName.innerText;
                // Check if the ID or name contains the search input value
                if (idText.toUpperCase().indexOf(filter) > -1 || nameText.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Attach event listener to the search input
    document.getElementById("searchInput").addEventListener("keyup", filterAttendees);
</script>

</body>
</html>
