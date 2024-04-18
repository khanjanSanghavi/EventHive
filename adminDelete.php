<?php

$eventid = $_GET['key_id'];
echo $eventid;
include "eventClass.php";
$obj = new db();
$r = $obj->DeleteEvent($eventid);

if($r != 0)
{
    header("location:adminEvent.php");
}

?>