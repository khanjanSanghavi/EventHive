<?php
      $connect = mysqli_connect("localhost","root","","projecteventdb");

      $output = array();
      $qry = "SELECT * FROM eventdetails";
      $result = mysqli_query($connect, $qry);
      if(mysqli_num_rows($result)>0){


        while($row = mysqli_fetch_array($result)){
            $output[] = $row;
        }
        echo json_encode($output);

      }


?>