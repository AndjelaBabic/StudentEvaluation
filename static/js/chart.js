// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart2);

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

    // Set chart options
    var options = {'title':'Statistics of grades' ,
        'width':450,
        'height':300,
        'legend':'bottom'

        // animation.startup: true,
        // legend.position: 'bottom'

};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('pie_chart'));
    chart.draw(data, options);
}

function drawChart2() {

    var jsonData = $.ajax({
        url: "getData2.php",
        dataType:"json",
        async: false

}).responseText;

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);
    // Create the data table.

    // Set chart options
    var options = {'title':'Student success' ,
        'width':450,
        'height':300,
        is3D: true

    };

    // Instantiate and draw the chart for Anthony's pizza.
    var chart = new google.visualization.PieChart(document.getElementById('bar_chart'));
    chart.draw(data, options);
}