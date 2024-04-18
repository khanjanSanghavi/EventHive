<?php

$plannerId = $_GET['key_id'];
echo $plannerId;
include "eventClass.php";
$obj = new db();
$r = $obj->DeleteEventPlanner($plannerId);

if($r != 0)
{
    header("location:adminEventPlanner.php");
}

?>