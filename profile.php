
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Registration - EventApp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <style>
       body {
            display:flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
        video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Place the video behind other content */
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.0); /* Transparent white */
            border-bottom: 0px solid #e9ecef;
            font-family: 'Roboto', sans-serif;
            font-weight: 200;
            color: white; /* Change navbar text color to white */
            position: relative; /* Set position to relative to stack on top of video */
            z-index: 1; /* Ensure navbar is above video */
        }
        .navbar-nav .nav-link {
            color: white !important; /* Change navbar link text color to white */
            font-weight: 400;
        }
        .navbar-brand {
        font-weight: 400; /* Set font weight to normal */
        color: white !important; /* Change navbar brand text color to white */
   
        }
        footer {
            color: #1E0342;
            background-color: rgba(255, 255, 255, 0.12); /* Transparent white */
            position: relative;
            bottom: 0;
            width: 100%;
            height: 50px; /* Adjust height as needed */
            text-align: center;
            padding: 5px 0;
}
        .container {
            flex: 1;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.5); /* Transparent white */
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
    
    .card {
        background-color: rgba(255, 255, 255, 0.8); /* Transparent white */
        border: none; /* Remove border */
    }
    
    .card-img-top {
        height: 200px; /* Set a fixed height for the card image */
        object-fit: cover; /* Ensure the image covers the entire area of the container */
    }

    </style>
</head>
<body>
<video autoplay muted loop>
        <source src="./image/soft_blur_bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#" style="color: white;">EventHive</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.html">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="eventPlannerLogin.php">Become an Event Planner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userProfileDisp.php">Profile</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container mt-4" ng-app="eventApp" ng-controller="MainController" ng-init="getEventId()">
        <div class="row">
            <div class="col-md-8 mb-4">
                <input type="text" class="form-control" ng-model="search" placeholder="Search Events">
            </div>
            <div class="col-md-2 mb-2">
                <select class="form-control" ng-model="sortBy" ng-change="sortEvents()">
                    <option value="" disabled>Sort by</option>
                    <option value="dateAsc">Date Ascending</option>
                    <option value="dateDesc">Date Descending</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" ng-repeat="x in events | filter: search | orderBy: sortKey:reverse">
                <div class="card h-100">
                    <img class="card-img-top" ng-src="{{x.Image}}" alt="Event image">
                    <div class="card-body">
                        <h5 class="card-title">{{x.eventName}}</h5>
                        <p class="card-text">{{x.Description}}</p>
                        <p class="card-text"><small class="text-muted">Date: {{x.date}}</small></p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-info bg-primary" value="submit" ng-click="registerForEvent(x.eventId)">Register for event</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>Created by Khanjan | Vishnu | Vaishvi</p>
    </footer>
    <script>
        angular.module('eventApp', [])
        .controller('MainController', function($scope,$http) {
            $scope.displayData = function(){
                $http.get('getAllEvents.php').then(function(response){
                    $scope.events = response.data;
                })
            }
            $scope.displayData();
            
            $scope.sortEvents = function() {
                if ($scope.sortBy === 'dateAsc') {
                    $scope.sortKey = 'date';
                    $scope.reverse = false;
                } else if ($scope.sortBy === 'dateDesc') {
                    $scope.sortKey = 'date';
                    $scope.reverse = true;
                }
            };

            $scope.getEventId = function() {
                $http.get('getEventId.php').then(function(response){
                    $scope.eventId = response.data;
                });
            };

            $scope.registerForEvent = function(eventId) {
                window.location.href = 'eventRegistration.php?eventId=' + eventId;
            };
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
