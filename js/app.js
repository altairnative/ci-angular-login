const app = angular.module('myApp', []);

app.controller("registerController", ($scope, $http) => {
    $scope.error = {
        firstName: null,
        lastName: null,
        email: null,
        password: null
    };

    $scope.user = {
        firstName: null,
        lastName: null,
        email: null,
        password: null
    };

    $scope.clearAll = (() => {
        $scope.user.firstName = null;
        $scope.user.lastName = null;
        $scope.user.email = null;
        $scope.user.password = null;
        $scope.error.firstName = null;
        $scope.error.lastName = null;
        $scope.error.email = null;
        $scope.error.password = null;
    });

    $scope.setErrors = ((errors) => {
        $scope.error.firstName = errors.firstName
        $scope.error.lastName = errors.lastName
        $scope.error.email = errors.email
        $scope.error.password = errors.password
    });

    $scope.register = ((user) => {
        $http({
            method: 'post',
            data: $.param(user),
            url: 'api/register',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }
        })
        .then(({ data: { message } }) => {
            $scope.clearAll();
            $scope.registrationForm.$setPristine();
            $scope.showSuccess = true;
            $scope.successMessage = message;
        })
        .catch(({ data: { errors } }) => {
            $scope.setErrors(errors);
            $scope.showSuccess = false;
        });
    });
});
