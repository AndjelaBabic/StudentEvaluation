<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-book"></span> Student evaluation</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> Submit your work </a></li>
                <li><a href="Controllers/showStudentsController.php"> Show all students </a></li>
                <li><a href="Controllers/addSucessfullController.php">Sucessfull students</a></li>
                <li><a id="logout-href" href="Controllers/logoutController.php"><span class="glyphicon glyphicon-log-out"></span>
                        Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row pic">

    <br> <br>
    <div class="col-md-2"></div>
    <div class="col-md-6 col-md-offset-3">
        <input type="hidden" id="id_of_student" value="<?php $_SESSION['login_user-student'] ?>">
        <p id="basic-info"></p>
    <form action="Controllers/uploadController.php" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_SESSION['upload-error']))
            echo '<p class="error">' . $_SESSION['upload-error'] . '</p>';
        unset($_SESSION['upload-error']);

        if (isset($_SESSION['upload-success']))
            echo '<p class="success">' . $_SESSION['upload-success'] . '</p>';
        unset($_SESSION['upload-success']);
        ?>

        <input type="file" name="my-file">
        <button type="submit" name="btn-upload"> Upload zip file </button>
    </form>

    <?php
    if(isset($_SESSION['file'])){
    ?>
    <p>
        <a download="<?php echo $_SESSION['file']?>" href="uploads/<?php echo $_SESSION['file'] ?>"> <?php echo $_SESSION['file'] ?>  </a>
    </p>
    <?php }  ?>


    </div>

</div>
