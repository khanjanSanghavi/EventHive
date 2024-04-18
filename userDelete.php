<?php



session_start();
require 'eventClass.php';
$id = $_SESSION['UserId'];
$obj = new db();

$r = $obj->DeleteAttendee($id);

if($r != 0)
{
    header("location:login.php");
}

?>