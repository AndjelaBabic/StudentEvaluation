<?php
include "modal.php";
?>
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
                    <li><a href="Controllers/showStudentsController.php"> Show all students </a></li>
                <?php } else {?>
                    <li><a href="Controllers/addSubmitController.php"> Submit your work </a></li>
                <?php }?>
                <li><a href="Controllers/addSucessfullController.php">Sucessfull students</a></li>
                <li><a id="logout-href" href="Controllers/logoutController.php"><span class="glyphicon glyphicon-log-out"></span>
                        Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<br> <br>
<div class="col-md-2"></div>
<div class="col-md-8">
<table class="tabela display" width="100%">

    <tbody>
    </tbody>
</table>
    <br> <br>
    <?php if(isset($_SESSION['login_user-student'])){ ?>
    <div class="container col-md-6">
        <h4>Wikipedia search</h4>
        <p> Feeling stuck with your work? Here is little something that can help you to pass an exam! --> </p>
    </div>
    <div class="container col-md-4"> <br> <br>
        <input id="searchTerm" type="text" class="form-control" name="search" placeholder="Search..">
    </div>
    <div class="container col-md-2"> <br> <br>
        <button id='search' type="button" class ="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button>
        <!--    <div id="output"></div>-->
        <!--    <a href="https://www.freecodecamp.com/" class="text-center"><h1>FCC</h1></a>-->

    </div>
    <?php }?>
    <table class="columns">

        <tr>
            <td><div id="pie_chart" style="border: 1px solid #ccc"></div></td>
            <td><div id="bar_chart" style="border: 1px solid #ccc"></div></td>
        </tr>
    </table>

    <br> <br>


    <br> <br>
<!--    <div id="pie_chart"> </div>-->
<!--    <div id="bar_chart"> </div>-->
</div>