$("document").ready(function() {

    
    // If user is not logged in, redirect user to login page
    try {
        if(login === true)
            $("#login-page").load("view/login.php");
        else
            $("#login-page").load("view/register.php");

    } catch(e) {}

    var showPage = $("#callback-message").text();

    if(showPage.length == 0) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("callback-message").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "Controllers/searchStudentController.php", true);
        xmlhttp.send();
    }

    var currentId = $("#id_of_student").val();
    var showInfo = $("#basic-info").text();

    if(showInfo.length == 0) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("basic-info").innerHTML = currentId;
                    //this.responseText;
            }
        }
        xmlhttp.open("GET", "Controllers/submitStudentController.php?idOfStudent="+currentId, true);
        xmlhttp.send();
    }

    $("#search-student").keyup(function() {
        var searchInput = $("#search-student").val();

        if (searchInput.length != 0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("callback-message").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "Controllers/searchStudentController.php?name=" + searchInput, true);
            xmlhttp.send();
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("callback-message").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "Controllers/searchStudentController.php", true);
            xmlhttp.send();
        }
    });


    $("#login-href").mouseenter(function() {
        $(".glyphicon-log-in").css("color", "#689F38");
    });

    $("#login-href").mouseleave(function() {
        $(".glyphicon-log-in").css("color", "snow");
    });

    $("#signup-href").mouseenter(function() {
        $(".glyphicon-user").css("color", "#689F38");
    });

    $("#signup-href").mouseleave(function() {
        $(".glyphicon-user").css("color", "snow");
    });

    $("#logout-href").mouseenter(function() {
        $(".glyphicon-log-out").css("color", "#689F38");
    });

    $("#logout-href").mouseleave(function() {
        $(".glyphicon-log-out").css("color", "snow");
    });

    // AJAX requests for login page
    $("#login-href").click(function() {
        $("#login-page").load("view/login.php");
    });

    $("#signup-href").click(function() {
        $("#login-page").load("view/register.php");
    });

});





function reply_click(clicked_id, id_in_table)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("mytable").deleteRow(parseInt(id_in_table));
        }
    };
    xmlhttp.open("GET", "Controllers/editStudentController.php?id="+clicked_id, true);
    xmlhttp.send();
};

function update_click(id_in_base,id_in_table)
{
    // alert(id_in_base)

    var grade = document.getElementById("insert_grade"+id_in_base).value;
    // alert(grade);
    var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById("insert_grade"+id_in_base).value = grade;
    //     }
    // };
    // xmlhttp.open("GET", "Controllers/editStudentController.php?id2="+id_in_base+"-"+grade+", true);
    xmlhttp.open("GET", "Controllers/editStudentController.php?id2="+id_in_base+"&grade="+grade, true);
    xmlhttp.send();
};


