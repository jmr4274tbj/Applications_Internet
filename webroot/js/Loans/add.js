var app = angular.module('linkedlists', []);
// The path to action from CakePHP is in urlToLinkedListRequest 
app.controller('categoriesController', function ($scope, $http) {
    var url = urlToLinkedListRequest;

    $http.get(url).then(function (response) {
        $scope.categories = response.data;
    });
});


