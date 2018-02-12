<?php
session_start();

if (isset($_SESSION['register']))
    unset($_SESSION['register']);


?>



<div class="row content">

    <div class="col-md-6">

    <form method="POST" action="Controllers/loginController.php" id="login-form" class="col-md-8 col-md-offset-2">
        <?php
        if (isset($_SESSION['login-error']))
            echo '<p class="error">' . $_SESSION['login-error'] . '</p>';
        unset($_SESSION['login-error']);
        ?>

        <div class="form-group">
            <h4 id="tittle" >Log in as a professor</h4>
            <label for="email">Email address:</label>
            <input name="email" type="email" class="form-control" id="email" required placeholder="Enter email..."
                   autofocus>
        </div>
        <div class="form-group">
            <label for="pwd">Password: </label>
            <input name="password" type="password" class="form-control" id="pwd" required
                   placeholder="Enter password...">
        </div>
        <div class="checkbox">
            <label><input name="remember_me" type="checkbox">Remember me</label>
        </div>
        <button name="login" type="submit" class="btn btn-info">Login</button>
    </form>
</div>
    <div class="col-md-6">


    <form method="POST" action="Controllers/loginController.php" id="login-form-student" class="col-md-8 col-md-offset-2">
        <?php
        if (isset($_SESSION['login-error-student']))
            echo '<p class="error">' . $_SESSION['login-error-student'] . '</p>';
        unset($_SESSION['login-error-student']);
        ?>
        <div class="form-group">
            <h4 id="tittle" >Log in as a student</h4>
            <label for="email-student">Email address:</label>
            <input name="email-student" type="email" class="form-control" id="email-student" required placeholder="Enter email..."
                   autofocus>
        </div>
        <div class="form-group">
            <label for="pwd-student">Password: </label>
            <input name="password-student" type="password" class="form-control" id="pwd-student" required
                   placeholder="Enter password...">
        </div>
        <div class="checkbox">
            <label><input name="remember_me-student" type="checkbox">Remember me</label>
        </div>
        <button name="login-student" type="submit" class="btn btn-info">Login</button>
    </form>
    </div>
</div>

<footer id="login-footer">
    &copy; <a href="">Student evaluation</a> 2017. All rights reserved.
</footer>