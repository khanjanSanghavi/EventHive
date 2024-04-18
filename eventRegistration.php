<?php
session_start();
$sid = $_SESSION['UserId'];

if(isset($sid)){
$eventId =  $_GET['eventId'];
include "eventClass.php";
$obj = new db();
 $r = $obj->ifRegistered($sid,$eventId);
if($r){
    header('location:bill.php?eventId='.$eventId);
}else{

$result = $obj->get_perticular_events($eventId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_51P5BWqSGjdbQxRsmdcygsGGfKRJywbueXNS1ZDeA3qx7JrC8Es9CjYR6JFdBNSVX3IPJDaNkVhJno101iIfk7k9900qAO1PTUI";
        data-amount="<?php echo $result['cost'] * 100; ?>"
        data-name="EventApp"
        data-description="Event Payment"
        data-currency="usd"
        data-locale="auto">
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Details - EventApp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <style>
        body {
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .navbar {
            background: linear-gradient(90deg, rgb(189, 222, 230) 0%, rgb(172, 197, 237) 83%);
        }

        .navbar a {
            color: #000;
        }

        .navbar a:hover {
            color: #000;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">EventApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.html">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.html">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Create Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div ng-app="eventApp" ng-controller="MainController">
            <div class="row justify-content-center">
                <div class="col-md-8" class="container mt-4">
                    <div class="card">
                        <img class="card-img-top" alt="Event image" src="<?php echo $result['Image'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><b>Title: </b> </Title><?php echo $result['eventName'] ?></h5>
                            <p class="card-text"><b>Organized by: </b><?php echo $result['OrganizerName'] ?></p>
                            <p class="card-text"><b>Description: </b><?php echo $result['Description'] ?></p>
                            <p class="card-text"><b>Date: </b><?php echo $result['date'] ?></p>
                            <p class="card-text"><b>Time: </b><?php echo $result['time'] ?></p>
                            <p class="card-text"><b>Venue: </b><?php echo $result['venue'] ?></p>
                            <p class="card-text"><b>Cost: </b><?php echo $result['cost'] ?></p>
                        </div>
                        <div class="card-footer text-center">
                        <form action="charge.php" method="POST">
                            <input type="hidden" name="eventId" value="<?php echo $eventId; ?>">
                            <input type="hidden" name="eventCost" value="<?php echo $result['cost'] ?>">
                            <button class="btn btn-primary">Pay  <?php echo $result['cost'] ?> Now </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       angular.module('eventApp', [])
.controller('MainController', function($scope, $http) {
    $scope.getEventDetails = function(eventId) {
        $http.get('getEventDetails.php?eventId=' + eventId).then(function(response){
            $scope.eventDetails = response.data;
        })
    }

            // Call function to fetch event details
            $scope.getEventDetails(eventId);
            
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

</body>
</html>

<?php
}
    }else{
        header('location:login.php');
    }
?>