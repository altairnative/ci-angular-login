app.controller("dashboardController", ['$scope', '$http', '$cookies', ($scope, $http, $cookies) => {
    $scope.getUsers = function() {
        $http({
            method: 'get',
            url: `${window.location.origin}/api/users`,
            headers: {
                'Authorization': `Bearer ${$cookies.get('APP_ACCESS_TOKEN')}`
            }
        })
        .then(({ data: { users } }) => {
            $scope.users = users;
        });
    };

    $scope.getUsers();
}]);
