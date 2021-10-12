@extends('layouts.app')

@section('content')
<div class="container">

    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Report</h1>      
    </div>
    <p class="lead">Totale delle ore che hai speso su ogni progetto</p>  

    <div class="mt-5"></div>     

    <table class="table">
        <thead class="" style="color: #ffffff; background-color: #0A3E52;">
            <tr>
                <th scope="col">Progetto</th>
                <th scope="col">Ore Totali </th>
            </tr>
        </thead>
        <tbody>
            @foreach($works as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->ore }}</td>            
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-5"></div> 

    <div class="pb-2 mt-4 mb-2 border-bottom"></div>
    <p class="lead">Attivià svolte sui progetti</p>  

   
    
    <div class="panel-body d-flex justify-content-center">
        <div id="pie_chart" style="width:750px; height:450px;"></div>
    </div>
</div>

<script type="text/javascript">

    var analytics = <?php echo $name; ?>
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics);
        var options = {
        
        //title : 'Percentage of Students Courses(BCA,BCOM,BSC)'
    };

    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

    chart.draw(data, options);
    }
</script>


@endsection