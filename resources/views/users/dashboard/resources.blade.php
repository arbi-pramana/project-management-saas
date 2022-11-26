@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Resources Overview</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Hours Overview
                    </div>
                    <div class="card-body">
                        <canvas id="hours" class="chart-js" style="height:300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Tasks Overview
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>
    var labels = {!! json_encode($hours['label']) !!}
    var plan_hours = {!! json_encode($hours['plan_hours']) !!}
    var actual_hours = {!! json_encode($hours['actual_hours']) !!}
    var config = {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Plan Hours",
                    data:  plan_hours,
                    backgroundColor: '#2BC155'
                    
                },
                {
                    label: "Hours Spent",
                    data: actual_hours,
                    backgroundColor: 'rgba(254, 99, 78, 1)'
                }
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
                    point:{
                        radius: 0
                    }
            },
            // legend:false,
            legend: {
                position: 'bottom',
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: true
                    },
                    ticks: {
                        fontColor: "#999",
                        beginAtZero: true
                    },
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        stepSize: 5,
                        fontColor: "#999",
                        fontFamily: "Nunito, sans-serif"
                    }
                }]
            },
            tooltips: {
                enabled: true,
                mode: "index",
                intersect: false,
                titleFontColor: "#888",
                bodyFontColor: "#555",
                titleFontSize: 12,
                bodyFontSize: 15,
                backgroundColor: "rgba(256,256,256,0.95)",
                displayColors: true,
                xPadding: 10,
                yPadding: 7,
                // borderColor: "rgba(220, 220, 220, 0.9)",
                borderWidth: 0,
                caretSize: 6,
                caretPadding: 10
            }
        }
    };

    var ctx = document.getElementById("hours").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
@stop