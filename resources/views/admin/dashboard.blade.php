@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Ukupno konsultacija</h5>
                    <p class="display-6">{{ $totalConsultations }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div id="consultations-chart" style="height: 400px;"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Status', 'Broj'],
        ['Zakazano', {{ $scheduled }}],
        ['Završeno', {{ $completed }}],
        ['Otkazano', {{ $canceled }}]
    ]);

    var options = {
        title: 'Stanje konsultacija',
        pieHole: 0.4,
        colors: ['#4e73df', '#1cc88a', '#e74a3b']
    };

    var chart = new google.visualization.PieChart(document.getElementById('consultations-chart'));
    chart.draw(data, options);
}
</script>
@endsection
