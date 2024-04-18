<?php
session_start();
require 'eventClass.php';
$id = $_SESSION['epId'];
$obj = new db();
    $r = $obj->fetch_epinfo($id);
    
?>

<?php

$studentnameerror = "";
$studentPhoneerror = "";
$usernameerror = "";
$passworderror = "";
$flag = 0;
  
  if(isset($_REQUEST['update']))
  {
      $obj = new db();

          $password = $_REQUEST['password'];
        $cpass = $_REQUEST['confirm_password'];
        if($password=== $cpass)
        {

            $ep_id = $_REQUEST['studentId'];
            $ep_name = $_REQUEST['name'];
            $gender = $_REQUEST['gender'];
            $department = $_REQUEST['department'];
            $phonenumber = $_REQUEST['phoneNumber']; 
            $email = $_REQUEST['email'];
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];


            if(is_numeric($ep_name)){
                $studentnameerror = "Name Can't have numbers";
            }else{
            if(!is_numeric($phonenumber) or strlen($phonenumber)>10 or strlen($phonenumber)<10){
                $studentPhoneerror = "Enter valid phone number";
            }else{
                $r = $obj->updateEventPlannerInfo($id,$ep_id,$ep_name,$gender,$department,$phonenumber,$email,$username,$password);
                if($r!= 0){
                    header('location:EventPlannerProfile.php');
                    exit;
                }
            }
            }
    }else{
        $passworderror = "Password Should match";
    }
 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update - Event Hive</title>
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
        </style>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">

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
                    <a class="nav-link" href="userProfileDisp.php"><i class="fas fa-user"></i> Back to User Profile</a>
                </li>
            </ul>
        </div>
    </nav>


<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center">Sign Up</h2>
        </div>
        <div class="card-body">

            <form  method="POST">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" required value= <?php echo $r['studentId']?> >
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value= <?php echo $r['name']?> >
                    <span style="color: red;"> <?php echo $studentnameerror; ?> </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="male" name="gender" value="male" required default>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="other" name="gender" value="other" required>
                        <label class="form-check-label" for="other">Other</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-select" id="department" name="department" required>
                        <option value="CMPICA">CMPICA</option>
                        <option value="PDPIAS">PDPIAS</option>
                        <option value="MTIN">MTIN</option>
                        <option value="CSPIT">CSPIT</option>
                        <option value="DEPSTAR">DEPSTAR</option>
                        <option value="ARIP">ARIP</option>
                        <option value="IIIM">IIIM</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value= <?php echo $r['phonenumber']?> required>
                    <span style="color: red;"> <?php echo $studentPhoneerror; ?> </span>
                 
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value= <?php echo $r['email']?> required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value= <?php echo $r['username']?> required readonly>
                    <span style="color: red;"> <?php echo $usernameerror; ?> </span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value= <?php echo $r['password']?> required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    <span style="color: red;"> <?php echo $passworderror; ?> </span>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (jQuery is no longer required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>

</body>
</html>

