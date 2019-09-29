<div class="container mt-5 pt-5" ng-controller="loginController">
    <form class="form-signin" ng-submit="login(email, password)">
        <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>

        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input ng-model="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <small ng-if="error.email" class="is-invalid text-danger">{{ error.email }}</small>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input ng-model="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <small ng-if="error.password" class="is-invalid text-danger">{{ error.password }}</small>
        </div>

        <div class="alert alert-danger text-center" ng-if="error.message" role="alert">{{ error.message }}</div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a class="btn btn-lg btn-warning text-white btn-block" href="<?php base_url(); ?>/register">Register</a>
    </form>
</div>
