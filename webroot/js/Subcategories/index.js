var onloadCallback = function() {
    widgetId1 = grecaptcha.render('example1', {
        'sitekey': '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
        'theme': 'light'
    });
};

// angular js codes will be here
var app = angular.module('CakeJwtAngularjs', []);

app.controller('usersCtrl', function($scope, $http) {
    // more angular JS codes will be here

    // Login Process
    $scope.login = function() {
        //alert(grecaptcha.getResponse(widgetId1));
        if (grecaptcha.getResponse(widgetId1) == '') {
            $scope.captcha_status = 'Please verify captha.';
            return;
        }
        var req = {
            method: 'POST',
            url: 'api/users/token',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: {username: $scope.username, password: $scope.password}
        }
        // fields in key-value pairs
        $http(req)
                .success(function(jsonData, status, headers, config) {
                    // console.log(jsonData.data.token);
                    // tell the user was logged
                    Materialize.toast('User sucessfully logged in', 4000);
                    localStorage.setItem('token', jsonData.data.token);
                    localStorage.setItem('user_id', jsonData.data.id);
                    // Switch button for Logout
                    $('#login-btn').hide();
                    $('#logout-btn').show();
                })
                .error(function(data, status, headers, config) {
                    //console.log(data.response.result);
                    // tell the user was not logged
                    Materialize.toast(data.message, 4000);
                });
        // close modal
        $('#modal-login-form').modal('close');
    }
    // Login Process
    $scope.logout = function() {
        localStorage.setItem('token', "no token");
        $('#logout-btn').hide();
        $('#login-btn').show();
        $scope.captcha_status = '';
        // show modal
        $('#modal-logout-form').modal('close');
    }
    $scope.changePassword = function() {
        var req = {
            method: 'PUT',
            url: 'api/users/' + localStorage.getItem("user_id"),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            },
            data: {'password': $scope.newPassword}
        }
        $http(req)
                .success(function(response) {
                    // tell the user subcategory record was updated
                    Materialize.toast('Password successfully changed', 4000);
                    // close modal
                    $('#modal-logout-form').modal('close');
                })
                .error(function(response) {
                    // tell the user subcategory record was not updated
                    //console.log(response);
                    Materialize.toast('Could not update Password', 4000);

                });
    }
});

app.controller('subcategoriesCtrl', function($scope, $http) {

    // create new subcategory 
    $scope.createSubcategory = function() {
        var req = {
            method: 'POST',
            url: 'api/subcategories',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: {'name': $scope.newName, 'category_id': $scope.createCategory.id}
        }
        $http(req)
                .success(function(response) {
                    //console.log(data.response.result);
                    // tell the user new subcategory was created
                    Materialize.toast('Subcategory successfully created', 4000);

                    // close modal
                    $('#modal-createSubcategory-form').modal('close');

                    // refresh the list
                    $scope.getAll();
                })
                .error(function(response) {
                    //console.log(data.response.result);
                    // tell the user new subcategory was created
                    Materialize.toast('Could not create subcategory', 4000);
                });
    }
    // read subcategories
    $scope.getAll = function() {
        var req = {
            method: 'GET',
            url: 'api/subcategories',
            headers: {
                'Accept': 'application/json'
            }
        }
        $http(req)
                .success(function(response) {
                    $scope.names = response.data;
                })
                .error(function(response) {
                    // tell the user subcategories are not accessible
                    Materialize.toast('Could not retreive Subcategories', 4000);
                })
                ;
        // Retrieve Categories to fill the list on create or edit
        var req = {
            method: 'GET',
            url: 'api/categories/',
            headers: {
                'Accept': 'application/json'
            }
        }
        $http(req)
                .success(function(jsonData, status, headers, config) {
                    //console.log(jsonData.data);
                    // put the values in form
                    $scope.createCategories = jsonData.data;
                })
                .error(function(response) {
                    Materialize.toast('Unable to retrieve Categories.', 4000);
                });

    }
    // retrieve record to fill out the form
    $scope.readOne = function(id) {
        if (localStorage.getItem("token") === "no token") {
            Materialize.toast('Please login', 4000);
        } else {
            // Retrieve Subcategory to edit
            var req = {
                method: 'GET',
                url: 'api/subcategories/' + id,
                headers: {
                    'Accept': 'application/json'
                }
            }
            $http(req)
                    .success(function(jsonData, status, headers, config) {
                        //console.log(jsonData.data);
                        // put the values in form
                        $scope.id = jsonData.data.id;
                        $scope.actualName = jsonData.data.name;
                        $scope.selectedCategoryId = jsonData.data.category_id;
                    })
                    .error(function(response) {
                        Materialize.toast('Unable to retrieve record.', 4000);
                    });
            // Set the Actual Category
            var req = {
                method: 'GET',
                url: 'api/categories/',
                headers: {
                    'Accept': 'application/json'
                }
            }
            $http(req)
                    .success(function(jsonData, status, headers, config) {
                        //console.log(jsonData);
                        // put the values in form
                        $scope.editCategories = jsonData.data;
                        angular.forEach($scope.editCategories, function(category) {
                            if (category.id == $scope.selectedCategoryId) {
                                $scope.editCategory = category;
                            }
                        })
                        // show modal
                        $('#modal-editSubcategory-form').modal('open');
                    })
                    .error(function(response) {
                        Materialize.toast('Unable to retrieve Categories.', 4000);
                    })
        }
    }

    // update subcategory record / save changes
    $scope.updateSubcategory = function() {
        var req = {
            method: 'PUT',
            url: 'api/subcategories/' + $scope.id,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: {'name': $scope.actualName, 'category_id': $scope.editCategory.id}
        }
        $http(req)
                .success(function(response) {
                    // tell the user subcategory record was updated
                    Materialize.toast('Subcategory successfully updated', 4000);
                    // close modal
                    $('#modal-editSubcategory-form').modal('close');
                    // refresh the subcategory list
                    $scope.getAll();
                })
                .error(function(response) {
                    // tell the user subcategory record was not updated
                    //console.log(response);
                    Materialize.toast('Could not update Subcategory', 4000);

                });
    }
    // delete subcategory
    $scope.deleteSubcategory = function(id) {
        //console.log(localStorage.getItem("token"));
        if (localStorage.getItem("token") === "no token") {
            Materialize.toast('Please login', 4000);
        } else {
            // ask the user if he is sure to delete the record
            if (confirm("Are you sure?")) {
                // post the id of subcategory to be deleted
                var req = {
                    method: 'DELETE',
                    url: 'api/subcategories/' + id,
                    headers: {
                        'Accept': 'application/json',
                    }
                }
                $http(req)
                        .success(function(response) {

                            // tell the user subcategory was deleted
                            Materialize.toast('Subcategory successfully deleted', 4000);

                            // refresh the list
                            $scope.getAll();
                        })
                        .error(function(response) {
                            // tell the user subcategory was not deleted
                            Materialize.toast('Could not Subcategory', 4000);
                        })
                        ;
            }
        }
    }
});

// jquery codes will be here
$(document).ready(function() {
    // initialize modal
    $('.modal').modal();
    localStorage.setItem('token', "no token");
    $('#logout-btn').hide();
});



