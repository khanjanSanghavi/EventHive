<?php
$connect = mysqli_connect("localhost", "root", "", "projecteventdb");

$output = array();
// Check if eventId is set
    // Get eventId from the URL parameter
    $eventId = $_GET['eventId'];
    // Query with WHERE clause
    $qry = "SELECT * FROM eventdetails WHERE eventId=$eventId";
    $result = mysqli_query($connect, $qry);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
    
?>
