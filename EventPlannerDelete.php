<?php
    session_start();

    $plannerId = $_SESSION["epId"];
    echo $plannerId;
    include "eventClass.php";
    $obj = new db();
    $r = $obj->DeleteEventPlanner($plannerId);

    if($r != 0)
    {
        header("location:eventPlannerProfile.php");
    }

?>