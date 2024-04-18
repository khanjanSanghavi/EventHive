<?php
    $userid = $_GET['key_id'];
    echo $userid;
    include "eventClass.php";
$obj = new db();
$r = $obj->DeleteAttendee($userid);

if($r != 0)
{
    header("location:adminAttendees.php");
}
?>