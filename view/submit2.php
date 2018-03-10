<?php

include "Controllers/serverControllerGET.php";
include "modal.php";
//
require_once $siteRoot . "Repository/FilesRepository.php";
use Repository\FilesRepository as FilesRepository;

$filesRepos = new FilesRepository();
$file = $filesRepos->getFileByID($_SESSION['login_user-student']);
if($file!=null) {
    $_SESSION['file'] = $file->getName();
}
?>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="static/css/pattern.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="static/js/pattern.js"></script>
    <?php
    include "modal.php";
    ?>
</head>
<body>
<br> <br>


<div class="container col-md-6">
    <div id="login-box">

        <input type="hidden" id="id_of_student" value="<?php $_SESSION['login_user-student'] ?>">
        <form action="Controllers/uploadController.php" method="post" enctype="multipart/form-data">
            <?php
            if (isset($_SESSION['upload-error']))
                echo '<p class="error">' . $_SESSION['upload-error'] . '</p>';
            unset($_SESSION['upload-error']);

            if (isset($_SESSION['upload-success']))
                echo '<p class="success">' . $_SESSION['upload-success'] . '</p>';
            unset($_SESSION['upload-success']);
            ?>
            <p>If you want to upload your assignment, click on the button bellow: </p>

            <label class="btn btn-default btn-file">
                Browse <input type="file" name="my-file" style="display: none;">
            </label>

            <button type="submit" class="btn btn-default" name="btn-upload"> Upload zip file</button>
        </form>

        <?php
        if (isset($_SESSION['file'])) {
            ?>
            <p>
                <a download="<?php echo $_SESSION['file'] ?>"
                   href="uploads/<?php echo $_SESSION['file'] ?>"> <?php echo $_SESSION['file'] ?>  </a>
            </p>
        <?php } ?>
        <br>
        <p>If you want to convert your file to PDF , click on the button bellow: </p>

        <form action="https://v2.convertapi.com/docx/to/pdf?Secret=OWA28JBvbRvH3kve&download=attachment"
              method="post" enctype="multipart/form-data">

            <label class="btn btn-default btn-file">
                Browse <input id="file" type="file" name="File" style="display: none;">
            </label>
            <input id="submit" type="submit" class="btn btn-default" name="submit" value="Convert file"/>
        </form>


    </div><!-- /#login-box -->
</div><!-- /.container -->

<div class="container col-md-6">
    <div id="login-box">
        <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-book"></span> Student evaluation</a>
        <ul class="nav navbar-nav ">
            <p>
            <li><a href="#">  Submit your work          </a></li></p>
            <p>
            <li><a href="Controllers/addSucessfullController.php">Sucessfull students</a></li> </p>
            <li><a id="logout-href" href="Controllers/logoutController.php"><span
                            class="glyphicon glyphicon-log-out"></span>
                    Logout</a></li>
        </ul>

    </div>  <!-- /#login-box -->
    </nav>
</div><!-- /.container -->

<br> <br> <br> <br> <br> <br> <br>

<div class="col-md-3"></div>
<div class="container col-md-6">
    <div id="login-box">


        <h3>Student's details</h3>
        <?php
        $to_show = "  <form method='POST' action='Controllers/serverControllerUPDATE.php?id=$json_objekat->id'> 
           
                <p> ID: $json_objekat->id  </p>
                <p>Name: $json_objekat->name </p>
                <p>Surname:  $json_objekat->surname  </p>
                <p>Student_id:  $json_objekat->student_id</p>
                <p>Year:  $json_objekat->year </p>
                <p>Grade:  $json_objekat->grade </p>
                <div class='form-group'>Email: <input type='text' name='email' class='form-control' value='$json_objekat->email'></div>
               <button class='btn btn-default btn-block btn-success' name='change'>Change</button>
           
            </form>  ";

        echo $to_show; ?>


    </div><!-- /#login-box -->
</div><!-- /.container -->


<div id="particles-js"></div>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>-->
</body>