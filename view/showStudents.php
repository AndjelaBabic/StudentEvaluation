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
                <!-- u zavisnosti od toga ko je ovde razlicito -->
                <?php if(isset($_SESSION['login_user'])){ ?>
                <li><a href="Controllers/addStudentController.php"> Insert student </a></li>
                <?php } else {?>
                <li><a href="Controllers/addSubmitController.php"> Submit your work </a></li>
                <?php }?>
                <li><a href="Controllers/showStudentsController.php"> Show all students </a></li>
                <li><a href="Controllers/addSucessfullController.php">Sucessfull students</a></li>
                <li><a id="logout-href" href="Controllers/logoutController.php"><span class="glyphicon glyphicon-log-out"></span>
                        Logout</a></li>
            </ul>
        </div>
    </div>
</nav>



<div class="row">
    <div class="form-group col-md-6 col-md-offset-3">
        <br>
        <h3 id="search-student-title">Search student by name: </h3>
        <input id="search-student" class="form-control"
               placeholder="Enter empty field to get all students or search for specific..." autofocus>
    </div>
    <br>
</div>
<p id="callback-message"></p>

