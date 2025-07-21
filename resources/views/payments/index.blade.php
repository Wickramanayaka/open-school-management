@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-lg-12">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <div class="row">
                                        <div class="col-lg-6">
                                                Payments
                                        </div>
                                        <div class="col-lg-6">
                                                <ul class="nav navbar-nav navbar-right tool-bar">
                                                        <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-print"></i></a></li>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="panel-body">
                                <div id="bar-chart"></div>
                        </div>
                </div>
        </div>
</div>
<div class="row">
        <div class="col-lg-6">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <div class="row">
                                        <div class="col-lg-6">
                                                Term Fees
                                        </div>
                                        <div class="col-lg-6">
                                                <ul class="nav navbar-nav navbar-right tool-bar">
                                                        <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-print"></i></a></li>
                                                </ul>
                                        </div>
                                </div>
                            
                        </div>
                        <div class="panel-body">
                                <div id="pie-chart-1"></div>
                        </div>
                </div>
            
        </div>
        <div class="col-lg-6">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <div class="row">
                                        <div class="col-lg-6">
                                                Donations
                                        </div>
                                        <div class="col-lg-6">
                                                <ul class="nav navbar-nav navbar-right tool-bar">
                                                        <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-print"></i></a></li>
                                                </ul>
                                        </div>
                                </div>
                            
                        </div>
                        <div class="panel-body">
                                <div id="pie-chart-2"></div>
                        </div>
                </div>
        </div>
</div>
   
<div class="row">
        <div class="col-lg-6">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Class
                </div>
                <div class="panel-body">
                        <table class="table table-striped">
                                <tr><th>Class</th><th>Year</th><th>Total Amount</th><th>Type</th><th></th></tr>
                                <tr><td>5-A</td><td>2018</td><td>LKR 120,000.00</td><td>Donation</td><td><button class="btn btn-primary">View</button></td></tr>
                                <tr><td>5-B</td><td>2018</td><td>LKR 120,000.00</td><td>Term Fees</td><td><button class="btn btn-primary">View</button></td></tr>
                        </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

                <div class="panel panel-primary">
                        <div class="panel-heading">
                            Student
                        </div>
                        <div class="panel-body">
                                <table class="table table-striped">
                                        <tr><th>Student</th><th>Amount</th><td>Date</td></tr>
                                        <tr><td>Jone</td><td>LKR 120,000.00</td><td>2018-01-01</td></tr>
                                        <tr><td>Peter</td><td>LKR 120,000.00</td><td>2018-01-01</td></tr>
                                </table>
                        </div>
                </div>
        </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        var jsonData = $.ajax({
                url: "{{route('payment.getFeePaymentForClass')}}",
                dataType: "json",
                async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);
        // Set chart options
        var options = {'title':'Payemnt Collections',
                       'width':400,
                       'height':300};          

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart-1'));
        chart.draw(data, options);
}
</script>
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        var jsonData = $.ajax({
                url: "{{route('payment.getFeePaymentForClass')}}",
                dataType: "json",
                async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);
        // Set chart options
        var options = {'title':'Payemnt Collections',
                       'width':400,
                       'height':300};          

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart-2'));
        chart.draw(data, options);
}
</script>
<script>

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {

        var jsonData = $.ajax({
                url: "{{route('payment.getPaymentForYear')}}",
                dataType: "json",
                async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
        title: 'Payment Distrbutions',
        hAxis: {
          title: 'Days',
        },
        vAxis: {
          title: 'Amount (LKR)'
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('bar-chart'));
      chart.draw(data, options);
    }

</script>
    
@endsection