<?php
    $id = $_GET['key_id'];
    
    include "eventClass.php";
    $obj = new db();
    $r = $obj->fetch_eventPlanner_info($id);
    
?>
<?php

$studentnameerror = "";
$studentPhoneerror = "";
$usernameerror = "";
$passworderror = "";
$flag = 0;
    if(isset($_REQUEST['update']))
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
            }
            else{
                if(!is_numeric($phonenumber) or strlen($phonenumber)>10 or strlen($phonenumber)<10)
                {
                     $studentPhoneerror = "Enter valid phone number";
                }
                else
                {
                    $r = $obj->updateEventPlannerInfo($id,$ep_id,$ep_name,$gender,$department,$phonenumber,$email,$username,$password);

                    if($r > 0){
                        header('location:adminEventPlanner.php'); 
                        exit;  
                    }
                }
            }
    }
    
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
</head>
<body>

<div class="container mt-5">
    <div class="card" style="width: 100%; max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-primary text-white text-center">
            <h2>Update</h2>
        </div>
        <div class="card-body">

            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student / Teacher ID</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" value= <?php echo $r['studentId']?> required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value= <?php echo $r['name']?> required>
                    <span style="color: red;"> <?php echo $studentnameerror; ?> </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="male" name="gender" value="M" required default>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="female" name="gender" value="F" required>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="other" name="gender" value="O" required>
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
               
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
        
    </div>

    <!-- Bootstrap JS and Popper.js (jQuery is no longer required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>

</body>
</html>
