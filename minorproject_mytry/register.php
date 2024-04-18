<?php

    if(isset($_REQUEST['register']))
    {
        require "eventClass.php";

        $obj = new db();

        $s_id = $_REQUEST['studentId'];
        $s_name = $_REQUEST['name'];
        $gender = $_REQUEST['gender'];
        $department = $_REQUEST['department'];
        $phonenumber = $_REQUEST['phoneNumber'];
        $email = $_REQUEST['email'];
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        

        $r = $obj->student_register($s_id,$s_name,$gender,$department,$phonenumber,$email,$username,$password);
        if($r > 0)
        {
            header('location:login.php');
        }
    }
?>