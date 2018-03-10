<?php
session_start();
$_SESSION['register'] = true;
?>
    <div class="row content">

        <div class="col-md-6" >
            <form id="register-form"  method="POST" action="Controllers/registerController.php" class="col-md-8 col-md-offset-2">
                <?php
                if (isset($_SESSION['register-error']))
                    echo '<p class="error">' . $_SESSION['register-error'] . '</p>';

                if (isset($_SESSION['register-success']))
                    echo '<p class="success">' . $_SESSION['register-success'] . '</p>';
                ?>

                <h4 id="tittle" > Sign up as a professor</h4>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" id="name" required
                           placeholder="Enter your name..." autofocus>
                </div>
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input name="surname" type="text" class="form-control" id="surname" required
                           placeholder="Enter your surname...">
                </div>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input name="email" type="email" class="form-control" id="email" required
                           placeholder="Enter email...">
                </div>
                <div class="form-group">
                    <label for="pwd">Password: </label>
                    <input name="password" type="password" class="form-control" id="pwd" required
                           placeholder="Enter password...">
                </div>
                <div class="form-group">
                    <label for="pwd-confirm">Password repeat: </label>
                    <input name="confirm-password" type="password" class="form-control" id="pwd-confirm" required
                           placeholder="Repeat password...">
                </div>
                <button name="register" type="submit" class="btn btn-info">Register</button>

            </form>

        </div>

        <div class="col-md-6">
            <form id="register-form-student" method="POST" action="Controllers/registerController.php" class="col-md-8 col-md-offset-2">
                <?php
                if (isset($_SESSION['register-error-student']))
                    echo '<p class="error">' . $_SESSION['register-error-student'] . '</p>';

                if (isset($_SESSION['register-success-student']))
                    echo '<p class="success">' . $_SESSION['register-success-student'] . '</p>';
                ?>
                <div class="form-group">
                    <h4 id="tittle" align="center" >Sign up as a student</h4>
                    <label for="id-student">ID:</label>
                    <input name="id-student" type="text" class="form-control" id="id-student" required placeholder="Enter your ID..."
                           autofocus>
                </div>
                <div class="form-group">
                    <label for="email-student">Email address:</label>
                    <input name="email-student" type="email" class="form-control" id="email-student" required
                           placeholder="Enter email...">
                </div>
                <div class="form-group">
                    <label for="pwd-student">Password: </label>
                    <input name="password-student" type="password" class="form-control" id="pwd-student" required
                           placeholder="Enter password...">
                </div>
                <div class="form-group">
                    <label for="pwd-confirm-student">Password repeat: </label>
                    <input name="confirm-password-student" type="password" class="form-control" id="pwd-confirm-student"
                           required placeholder="Repeat password...">
                </div>
                <button name="register-student" type="submit" class="btn btn-info">Register</button>
            </form>
        </div>


    </div>
    <footer id="login-footer">
        &copy; <a href="">Student evaluation</a> 2018. All rights reserved.
    </footer>
<?php
if (isset($_SESSION['register-error']))
    unset($_SESSION['register-error']);



if (isset($_SESSION['register-success']))
    unset($_SESSION['register-success']);

// ________________________________________________________

if (isset($_SESSION['register-error-student']))
    unset($_SESSION['register-error-student']);

if (isset($_SESSION['register-success-student']))
    unset($_SESSION['register-success-student']);
?>