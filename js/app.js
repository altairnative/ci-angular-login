const app = angular.module('myApp', ['ngCookies', 'ngRoute']);

window.routes = {
    "/": {
        templateUrl: '/',
        controller: 'loginController',
        authenticated: false
    },
    "/dashboard": {
        templateUrl: '/dashboard',
        controller: 'dashboardController',
        authenticated: true
    },
    "/dashboard/users": {
        templateUrl: '/dashboard/users',
        controller: 'dashboardController',
        authenticated: true
    },
    "/register": {
        templateUrl: '/register',
        controller: 'registerController',
        authenticated: false
    }
};

app.service('currentUser', ['$rootScope', '$http', '$cookies', function($rootScope, $http, $cookies) {
    return {
        init: (() => {
            $http({
                method: 'get',
                url: `${window.location.origin}/api/users/me`,
                headers: {
                    'Authorization': `Bearer ${$cookies.get('APP_ACCESS_TOKEN')}`
                }
            })
            .then(({ data: { currentUser } }) => {
                $rootScope.currentUser = currentUser;
            });
        }),

        isAuthenticated: (() => {
            if ($cookies.get('APP_ACCESS_TOKEN')) {
                return true;
            }

            return false;
        })
    }
}]);

app.config(['$routeProvider', '$locationProvider', ($routeProvider, $locationProvider) => {
    $locationProvider.html5Mode(false);
    $locationProvider.hashPrefix('');

    for(let path in window.routes) {
        $routeProvider.when(path, window.routes[path]);
    }
    $routeProvider.otherwise({redirectTo: '/'});
}]);

app.run(['$rootScope', 'currentUser', ($rootScope, currentUser) => {
    $rootScope.$on('$locationChangeStart', (event, next, current) => {
        if (currentUser.isAuthenticated()) {
            currentUser.init();
            if (window.location.pathname == '/' || window.location.pathname == '/register') {
                window.location.href = `${window.location.origin}/dashboard`;
            }
        }

        for(let i in window.routes) {
            if(next.indexOf(i) != -1) {
                if(window.routes[i].authenticated && !currentUser.isAuthenticated()) {
                    window.location.href="/";
                }
            }
        }
    });
}]);
