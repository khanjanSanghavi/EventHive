<?php

session_start();
require 'eventClass.php';
$id = $_SESSION['UserId'];
$obj = new db();
    $r = $obj->fetch_info($_SESSION['UserId']);

?>

<?php

$studentnameerror = "";
$studentPhoneerror = "";
$usernameerror = "";
$passworderror = "";
  
  if(isset($_REQUEST['update']))
  {
    
      $obj = new db();

     // $id=$_SESSION['USerId'];
      $s_id = $_REQUEST['studentId'];
      $s_name = $_REQUEST['name'];
      $gender = $_REQUEST['gender'];
      $department = $_REQUEST['department'];
      $phonenumber = $_REQUEST['phoneNumber']; 
      $email = $_REQUEST['email'];
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];


      $password = $_REQUEST['password'];
        $cpass = $_REQUEST['confirm_password'];
        if($password=== $cpass)
        {

            $s_id = $_REQUEST['studentId'];
            $s_name = $_REQUEST['name'];
            $gender = $_REQUEST['gender'];
            $department = $_REQUEST['department'];
            $phonenumber = $_REQUEST['phoneNumber']; 
            $email = $_REQUEST['email'];
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
           // $cpass = $_REQUEST['cpass'];
            $ans = $obj->validate_mail($email);


            if(is_numeric($s_name))
            {
                $studentnameerror = "Name Can't have numbers";
            }
            else{
            if(!is_numeric($phonenumber) or strlen($phonenumber)>10 or strlen($phonenumber)<10){
                $studentPhoneerror = "Enter valid phone number";
            }
            else
            {
                $r = $obj->updateStudentInfo($id,$s_id,$s_name,$gender,$department,$phonenumber,$email,$username,$password);
      
                if($r!= 0){
                    header('location:userProfileDisp.php');
                    exit;
                }
            }
            }
        }
        else {
            // Passwords do not match, display an error message
            $passworderror = "Passwords do not match. Please try again.";
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
            background-color: rgba(255, 255, 255, 0.0); /* Transparent white */
            border-bottom: 0px solid #e9ecef;
            font-family: 'Roboto', sans-serif;
            font-weight: 200;
            color: white; /* Change navbar text color to white */
            position: relative; /* Set position to relative to stack on top of video */
            z-index: 1; /* Ensure navbar is above video */
        }
        .navbar-nav .nav-link {
            color: white !important; /* Change navbar link text color to white */
            font-weight: 400;
        }
        .navbar-brand {
        font-weight: 400; /* Set font weight to normal */
        color: white !important; /* Change navbar brand text color to white */
   
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
        
        </style>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">

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
                    <input type="text" class="form-control" id="studentId" name="studentId" value= <?php echo $r['S_id']?> required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value= <?php echo $r['studentName']?> required>
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
                 
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value= <?php echo $r['email']?> required readonly>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value= <?php echo $r['username']?> required readonly>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value= <?php echo $r['password']?> required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" require>
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

