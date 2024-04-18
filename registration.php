<?php

$studentnameerror = "";
$studentPhoneerror = "";
$usernameerror = "";
$passworderror = "";
$flag = 0;
    if(isset($_REQUEST['register']))
    {
        require "eventClass.php";

        $obj = new db();
        
        $password = $_REQUEST['password'];
        $cpass = $_REQUEST['cpass'];
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
            $cpass = $_REQUEST['cpass'];
            $ans = $obj->validate_mail($email);


            if(is_numeric($s_name))
            {
                $studentnameerror = "Name Can't have numbers";
            }
            else
            {
            if(!is_numeric($phonenumber) or strlen($phonenumber)>10 or strlen($phonenumber)<10){
                $studentPhoneerror = "Enter valid phone number";
            }
            else
            {
                $r = $obj->validate_username($username);
                if($r == 0 )
                {
                    $usernameerror = "User name already exist";
                }
                
                else{
                    if( $ans == 0)
                    {
                        $usernameerror = "Mail already exist";

                    }
                    else{
                        $r = $obj->student_register($s_id,$s_name,$gender,$department,$phonenumber,$email,$username,$password);
                        if($r > 0 )
                        {
                        
                            header('location:login.php');
                        }  }
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
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
    <style>
        video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Place the video behind other content */
        }
        .transparent-card {
    background-color: rgba(255, 255, 255, 0.7); /* Adjust the alpha value (fourth parameter) to change the transparency */
    border: none; /* Remove border if needed */
    border-radius: 15px; /* Optional: Add border radius */
    padding: 20px; /* Optional: Add padding */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Optional: Add shadow */
}


       
    </style>
</head>
<body>
<video autoplay muted loop>
        <source src="./image/soft_blur_bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center">Sign Up</h2>
        </div>
        <div class="card-body">

            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <label for="name" style='color: red;'>*</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <label for="name" style='color: red;'>*</label>
                    <input type="text" class="form-control" id="name" name="name" required>
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
                    <label for="name" style='color: red;'>*</label>
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
                    <label for="name" style='color: red;'>*</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                    <span style="color: red;"> <?php echo $studentPhoneerror; ?> </span>
                 
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <label for="name" style='color: red;'>*</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <label for="name" style='color: red;'>*</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <span style="color: red;"> <?php echo $usernameerror; ?> </span>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <label for="name" style='color: red;'>*</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password</label>
                    <label for="name" style='color: red;'>*</label>
                    <input type="password" class="form-control" id="cpass" name="cpass" required>
                    <span style="color: red;"> <?php echo $passworderror; ?> </span>
                    <br>
                    <label style='color: red;'>* are required fields</label>
                </div>
                
                <button type="submit" class="btn btn-primary" name="register">Register</button>
                <div class="card-footer text-muted text-center">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                    <p>Go back to <a href="profile.php">Profile</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (jQuery is no longer required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>

</body>
</html>
