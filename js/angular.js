var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http)
	{
    $http.get("DAL.php")
    .then(function (response) {$scope.guestbook = response.data;});
});

