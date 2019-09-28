<div class="container" ng-controller="registerController">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center text-success">Register</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-success" ng-show="showSuccess" role="alert">
                    {{ successMessage }} Click <a href="<?php echo base_url();?>" class="alert-link">here</a> to login.
                </div>
                <form name="registrationForm" ng-submit="register(user) ">
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input ng-model="user.firstName" type="text" class="form-control" id="first-name">
                        <small class="is-invalid text-danger">{{ error.firstName }}</small>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input ng-model="user.lastName" type="text" class="form-control" id="last-name">
                        <small class="is-invalid text-danger">{{ error.lastName }}</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input ng-model="user.email" type="email" class="form-control" id="email">
                        <small class="is-invalid text-danger">{{ error.email }}</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input ng-model="user.password" type="password" class="form-control" id="password">
                        <small class="is-invalid text-danger">{{ error.password }}</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
