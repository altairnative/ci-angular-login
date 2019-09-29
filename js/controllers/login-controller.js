app.controller("loginController", ['$scope', '$http', '$cookies', '$rootScope', ($scope, $http, $cookies, $rootScope) => {
    $scope.error = {
        email: null,
        password: null,
        message: null
    };

    $scope.email = null;
    $scope.password = null;

    $scope.setErrors = ((errors, message) => {
        if (errors) {
            $scope.error.email = errors.email;
            $scope.error.password = errors.password;
        }

        if (message) {
            $scope.error.message = message;
        }
    });

    $scope.login = ((email, password) => {
        $http({
            method: 'post',
            data: $.param({ email, password}),
            url: 'api/authenticate',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }
        })
        .then(({ data: { token }}) => {
            $cookies.put('APP_ACCESS_TOKEN', token);
            window.location.href = "/dashboard";
        })
        .catch(({ data: { errors, message } }) => {
            $scope.setErrors(errors, message);
        });
    });

    $scope.logout = (() => {
        $cookies.remove('APP_ACCESS_TOKEN')
        $rootScope.currentUser = null;
        window.location.href = `${window.location.origin}`;
    });
}]);
