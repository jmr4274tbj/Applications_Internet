var app = angular.module('linkedlists', []);
// The path to action from CakePHP is in urlToLinkedListRequest 
app.controller('categoriesController', function ($scope, $http) {


    $scope.selectedSubcategoryId = selectedSubcategoryId;
    $scope.selectedCategoryId = selectedCategoryId;
    var url = urlToLinkedListRequest;
    $http.get(url).then(function (response) {
        $scope.categories = response.data;
        angular.forEach($scope.categories, function (category) {
            if (category.id == selectedCategoryId) {
                $scope.category = category;
                angular.forEach($scope.category.subcategories, function (subcategory) {
                    if (subcategory.id == selectedSubcategoryId) {
                        $scope.category.subcategory = subcategory;
                    }
                })
            }
        })
    });

});

