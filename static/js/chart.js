// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);


// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

    var jsonData = $.ajax({
        url: "getData.php",
        dataType:"json",
        async: false
    }).responseText;

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);
    // Create the data table.
    // var data = new google.visualization.DataTable();
    // data.addColumn('string', 'Grades');
    // data.addColumn('number', 'numberOfStudents');
    // data.addRows([
    //     ['Five',2],
    //     ['Six', 3],
    //     ['Seven', 1],
    //     ['Eight', 1],
    //     ['Nine', 1],
    //     ['Ten', 2]
    // ]);

    // Set chart options
    var options = {'title':'Statistics of grades' ,
        'width':450,
        'height':300};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('pie_chart'));
    chart.draw(data, options);
}