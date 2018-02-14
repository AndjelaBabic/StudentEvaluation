<?php session_start();

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<title>Student evaluation</title>
	<meta charset="utf8">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="static/css/main.css">



</head>
<body class="container-fluid">

<?php
	if(!isset($_SESSION['login_user']) && !isset($_COOKIE['remember_me'])
        && !isset($_SESSION['login_user-student']) && !isset($_COOKIE['remember_me-student'])) {
		 ?>
		 
		<nav class="navbar">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-book"></span> Student evaluation</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
			  <li><a id="signup-href"><span class="glyphicon glyphicon-user"></span> Sign Up </a></li>
			  <li><a id="login-href"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
			</ul>
		</nav>
		<!--  -->
		
	<!-- -->
		<div id="login-page"></div>
		<script type="text/javascript">
			var login = true; // prva stvar bude login
		</script>
		<?php if(isset($_SESSION['register-error']) || isset($_SESSION['register-success']) || isset($_SESSION['register'])) { ?>
		<script type="text/javascript">
			var login = false;
		</script>
	<?php }
    }
    // ulogovao se nekako
    else{
        if(isset($_SESSION['login_user-student'])) {

            if(isset($_SESSION['submit'])) {
                require_once "view/submit.php";
            }
            if(!isset($_SESSION['show-student']) && !isset($_SESSION['submit'])  && !isset($_SESSION['sucessfull'])) {
                //  require_once "Controllers/loginController.php";
                require_once "view/submit.php";
            }

        } else{
          if(isset($_SESSION['add-student'])) {
              require_once "view/home.php";
          }
          if(!isset($_SESSION['show-student']) && !isset($_SESSION['add-student']) && !isset($_SESSION['sucessfull'])) {
            //  require_once "Controllers/loginController.php";
             require_once "view/home.php";
          }
        }
        if(isset($_SESSION['show-student'])) {
            require_once "view/showStudents.php";
        }

        if(isset($_SESSION['sucessfull'])) {
            require_once "view/sucessfull.php";
        }
	} ?>



<!-- google chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="static/js/chart.js"></script>

<!-- Tabela -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<!--Data tables -->
<!--<script src="DataTables-1.10.4/media/js/jquery.js"></script>-->
<!--<script src="DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>-->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- My Scripts -->
<script type="text/javascript" src=static/js/main.js></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="static/download/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- Data tables -->
<link rel="stylesheet" type="text/css" href="DataTables-1.10.4/media/css/jquery.dataTables.min.css" />
<script src="DataTables-1.10.4/media/js/jquery.js"></script>
<script src="DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>



<script>
    $("document").ready(function() {
    $(".tabela").DataTable({
        "columns": [
            { "title": "Id" },
            { "title": "Name" },
            { "title": "Surname" },
            { "title": "Student id" },
            { "title": "Year" },
//            { "title": "Assignment status" },
            { "title": "Grade"}
        ],
        "ajax": "dataTable.php",
        "processing": true,
        "serverSide": true
    });
        });
</script>

</body>
</html>