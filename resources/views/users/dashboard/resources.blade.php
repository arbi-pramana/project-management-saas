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
                        <canvas id="tasks" class="chart-js" style="height:300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="get">
                            <div class="form-inline">
                                <label>Select Employee : </label>
                                <select name="employee_id" class="form-control ml-4" style="width:300px;">
                                    <option value="">All</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}" @if(request('employee_id') == $employee->id) selected="selected" @endif >{{$employee->name}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-success ml-4">Filter</button>
                            </div>
                        </form>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center p-4">
                                        <h5>TASK ASSIGNED</h5>
                                        <h4>{{$task_assigned}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center p-4">
                                        <h5>TASK COMPLETED</h5>
                                        <h4>{{$task_completed}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center p-4">
                                        <h5>DUE THIS MONTH</h5>
                                        <h4>{{$due_this_month}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center p-4">
                                        <h5>DUE NEXT MONTH</h5>
                                        <h4>{{$due_next_month}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center p-4">
                                        <h5>DUE THIS YEAR</h5>
                                        <h4>{{$due_this_year}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center p-4">
                                        <h5>DUE NEXT YEAR</h5>
                                        <h4>{{$due_next_year}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        TASK PROGRESS
                    </div>
                    <div class="card-body">
                        <canvas id="task_progress" class="chart-js" style="height:300px;"></canvas>
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
<script>
    var xValues = {!! json_encode($tasks_label) !!};
    var yValues = {!! json_encode($tasks) !!};
    var barColors = "#2BC155";

    new Chart("tasks", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: false,
                text: "Task Overview"
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true, 
                    }, 
                }],
            }
        }
    });
</script>
<script>
    var labels = {!! json_encode($task_progress['label']) !!}
    var data = {!! json_encode($task_progress['value']) !!}
    var config = {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Status",
                    data: data,
                    backgroundColor: ['#3065D0','#ff9900','#2BC155','#FF6D4D','#FF4847']
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Pie Chart'
                }
            }
    },
    };

    var ctx = document.getElementById("task_progress").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
@stop