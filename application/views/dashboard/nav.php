<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" ng-controller="loginController">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo base_url(); ?>dashboard">MyApp</a>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap text-white">
            Logged in as: {{ currentUser.firstName }} {{ currentUser.lastName }}
            <button class="btn btn-dark btn-sm mb-1" ng-click="logout()">Sign Out</button>
        </li>
    </ul>
</nav>
