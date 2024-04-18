<!DOCTYPE html>
<html>
<head>
    <title>Event Management App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body ng-app="eventApp" ng-controller="MainController">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">EventApp</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item" ng-show="!isLoggedIn">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item" ng-show="isLoggedIn">
                    <a class="nav-link" href="#">Profile</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <input type="text" class="form-control mb-4" placeholder="Search events" ng-model="searchQuery">
        <div class="row">
            <div class="col-md-4" ng-repeat="event in events | filter:searchQuery">
                <div class="card">
                    <img class="card-img-top" ng-src="{{event.image}}" alt="Event image">
                    <div class="card-body">
                        <h5 class="card-title">{{event.title}}</h5>
                        <p class="card-text">{{event.description}}</p>
                        <p class="card-text"><small class="text-muted">Date: {{event.date}}</small></p>
                        <button class="card-footer btn btn-info bg-primary" value="submit" href="/eventinfo.html">Register for event</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        angular.module('eventApp', [])
        .controller('MainController', function($scope) {
            $scope.isLoggedIn = false; // Simulate user login state
            $scope.events = [
                { id: 1, title: 'Event 1', description: 'This is the first event.', date: '2024-03-01', image: 'https://via.placeholder.com/150' },
                { id: 2, title: 'Event 2', description: 'This is the second event.', date: '2024-04-15', image: 'https://via.placeholder.com/150' },
                // Add more events here
            ];
        });
    </script>
</body>
</html>
