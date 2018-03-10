<?php
include "Controllers/serverControllerGETStudent.php";
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
                <li><a href="Controllers/addStudentController.php"> Insert student </a></li>
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
    <form method="POST" action="Controllers/serverControllerPOST.php" class="col-md-6 col-md-offset-3">
        <?php
        if (isset($_SESSION['create-success'])) {
            echo '<p class="success">' . $_SESSION['create-success'] . '</p>';
            unset($_SESSION['create-success']);
        }

        if (isset($_SESSION['create-error'])) {
            echo '<p class="error">' . $_SESSION['create-error'] . '</p>';
            unset($_SESSION['create-error']);
        }
        ?>
        <div class="form-group">
            <label for="name">Student name*: </label>
            <input id="name" type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="surname">Students surname*:</label>
            <input id="surname" type="text" name="surname" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="student_id">Student_id*:</label>
            <input id="student_id" type="text" name="student_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="year">Current year of study*:</label>
            <input id="year" type="text" name="year" class="form-control" required>
        </div>

<!--        <div class="form-group">-->
<!--            <label for="assingment_status">Assignment status:*</label>-->
<!--            <div class="col-xs-5 selectContainer">-->
<!--                <select class="form-control" name="assignment_status" >-->
<!--                    <option value="">Choose a status</option>-->
<!--                    <option value="Submitted">Submitted</option>-->
<!--                    <option value="Unsubmitted">Unsubmitted</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="form-group">-->
<!--            <label for="assignment_status">Assignment status*:</label>-->
<!--            <input id="assignment_status" type="text" name="assignment_status" class="form-control"-->
<!--                   placeholder="(Un)submited..." required>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="grade">Grade:</label>-->
<!--            <input id="grade" type="text" name="grade" class="form-control">-->
<!--        </div>-->
        <button name="create-student" type="submit" class="btn btn-info btn-block">Insert student</button>
        <br>
    </form>
<!--    <div class="col-md-6"></div>-->
    <div class="form-group col-md-6 col-md-offset-5">

        <table id="listaProizvoda" class="table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Student_id</th>
                <th>Year</th>
                <th>Assignment status</th>
                <th>Grade</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="ajaxPodaci">
            <?php
            foreach($json_objekat1->student as $student) {
                echo "<tr>
                     <td> $student->id  </td>
                    <td>$student->name</td>
                    <td>$student->surname</td>
                    <td>$student->student_id</td>
                    <td>$student->year</td>
                    <td>$student->assignment_status</td>
                    <td>$student->grade</td>
                    <td><a href='Controllers/serverControllerDELETE.php?id=".  $student->id  ."'><button class='btn btn-default'>Delete</button></a></td>
                       </tr>";
            }
            ?>
            </tbody>
        </table>


    </div>
</div>

