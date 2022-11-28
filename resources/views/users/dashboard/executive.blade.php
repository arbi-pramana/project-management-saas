@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Executive Overview</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="get">
                    <div class="form-inline" style="float:right;">
                        <select name="year" class="form-control" style="width:300px;">
                            <option value="">All</option>
                            @foreach($years as $year)
                                <option value="{{$year}}" @if(request('year') == $year) selected="selected" @endif>{{$year}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success ml-2">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="mr-3 bgl-primary text-primary">
                                <i class="flaticon-381-archive"></i>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">PROJECT</p>
                                <h4 class="mb-0">{{$count_projects}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="mr-3 bgl-primary text-primary">
                                <i class="la la-users"></i>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">CLIENT</p>
                                <h4 class="mb-0">{{$count_client}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="mr-3 bgl-primary text-primary">
                                <h4 class="text-primary">Rp.</h4>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">BUDGET</p>
                                <h4 class="mb-0">Rp. {{number_format($count_budget,0)}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="mr-3 bgl-primary text-primary">
                                <i class="flaticon-381-calendar-1"></i>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">{{$count_task}} TASK</p>
                                <p class="mb-1">{{$count_plan_hours}} PLAN HOURS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{$task_completed}} OF {{$count_task}} TASKS COMPLETED</div>
                    <div class="card-body">
                        <div id="task_apex_chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">ALL TASKS BY STATUS</div>
                    <div class="card-body">
                        <canvas id="tasks" class="chart-js" style="height:300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">ALL TASKS BY PRIORITY</div>
                    <div class="card-body">
                        <canvas id="priority_chart" class="chart-js pt-4" height="300px"></canvas>
                        <div class="row text-center mt-2">
                            <div class="col-md-4">
                                Low <br>
                                <b> {{$priority_chart['value'][0]}} </b>
                            </div>
                            <div class="col-md-4">
                                Medium <br>
                                <b> {{$priority_chart['value'][1]}} </b>
                            </div>
                            <div class="col-md-4">
                                High <br>
                                <b> {{$priority_chart['value'][2]}} </b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">ALL TASKS BY COMPLEXITY</div>
                    <div class="card-body">
                        <canvas id="complexity_chart" class="chart-js pt-4" height="300px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        PROJECT TIMELINE
                        <select name="timeline_view_mode" id="timeline_view_mode" class="form-control" style="width:100px;float:right">
                            <option value="Day">Day</option>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                    <div class="card-body" style="height:600px;overflow-x:scroll">
                        <div id="gantt"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        RESOURCE WORKLOAD
                    </div>
                    <div class="card-body">
                        <canvas id="resource_chart" class="chart-js pt-4" height="300px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        PROJECT BUDGET
                    </div>
                    <div class="card-body">
                        <canvas id="budget_chart" style="height:600px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        PROJECT EXPENSE
                    </div>
                    <div class="card-body">
                        <canvas id="expense_chart" style="height:600px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        PLANNED VS HOURS SPENT
                    </div>
                    <div class="card-body">
                        <canvas id="hours_chart" style="height:600px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
@php
    if($count_task == 0 ){
        $count_task = 1;
    }
    $series = number_format(($count_task_completed/$count_task)*100,0)
@endphp
<script>
    var series = {{$series}}
    var taskApexChart = {
        chart: {
            type: 'radialBar',
            height: 350,
            offsetY: 0,
            offsetX: 0,
            sparkline: {
                enabled: true,
            },
        },
        plotOptions: {
            radialBar: {
                size: undefined,
                inverseOrder: false,
                hollow: {
                    margin: 0,
                    size: '50%',
                    background: 'transparent',
                },
            
                track: {
                    show: true,
                    background: '#e1e5ff',
                    strokeWidth: '12%',
                    opacity: 1,
                    margin: 10, // margin is in pixels
                },
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    offsetY: 0,
                    offsetX: 0
                },	
                legend: {
                    position: 'bottom',
                    offsetX:0,
                    offsetY: 0
                }
            }
        }],	
    fill: {
        opacity: 1
    },
    stroke:{
        lineCap: 'round'
    },
    colors:['#FE634E'],
    series: [series],
    labels: ['Task Completed'],
        
        legend: {
            fontSize: '14px',  
            show: true,
            position: 'bottom'
            
        },		 
    }

    var task_apex_chart1 = new ApexCharts(document.querySelector('#task_apex_chart'), taskApexChart);
    task_apex_chart1.render();
</script>
<script>
    var labels = {!! json_encode($tasks['label']) !!}
    var data = {!! json_encode($tasks['value']) !!}
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
            legend: {
                position: 'bottom',
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Pie Chart'
                }
            }
        },
    };

    var ctx = document.getElementById("tasks").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var labels = {!! json_encode($priority_chart['label']) !!}
    var data = {!! json_encode($priority_chart['value']) !!}
    var config = {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Priority",
                    data:  data,
                    backgroundColor: ["#2BC155","#ff9900",'#FF4847']
                },
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Pie Chart'
                }
            }
    },
    };

    var ctx = document.getElementById("priority_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var labels = {!! json_encode($complexity_chart['label']) !!}
    var data = {!! json_encode($complexity_chart['value']) !!}
    var config = {
        type: 'horizontalBar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Complexity",
                    data:  data,
                    backgroundColor: ["#2BC155","#ff9900",'#FF4847']
                },
            ],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            legend:false,
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true, 
                    }, 
                }],
            }
        },
    };

    var ctx = document.getElementById("complexity_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var projects = {!! json_encode($gantt_chart['projects']) !!}
    var gantt = new Gantt("#gantt", projects,{
        custom_popup_html: function(project) {
            return `
                <div style="width:250px !important;padding:20px">
                    <h5 style="color:white">${project.name}</h5> 
                    <hr style="border: none;border-bottom: 1px solid gainsboro;">
                    Start Date : ${project.format_start} <br>
                    End Date : ${project.format_end} <br>
                    <br>
                    Status : ${project.status} <br>
                    Complexity : ${project.complexity} <br>
                    Priority : ${project.priority} <br>
                </div>
            `;
        }
    });
    $("#timeline_view_mode").change(function(){
        if($("#timeline_view_mode").val() == "Day"){
            gantt.change_view_mode("Day");
        }
        if($("#timeline_view_mode").val() == "Month"){
            gantt.change_view_mode("Month");
        }
        if($("#timeline_view_mode").val() == "Year"){
            gantt.change_view_mode("Year");
        }
    })
</script>
<script>
    var labels = {!! json_encode($resource_chart['label'] ?? []) !!}
    var data = {!! json_encode($resource_chart['value'] ?? []) !!}
    var config = {
        type: 'horizontalBar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Workload",
                    data:  data,
                    backgroundColor: "#2BC155"
                },
            ],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            legend:false,
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true, 
                    }, 
                }],
            }
        },
    };

    var ctx = document.getElementById("resource_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var labels = {!! json_encode($budget_chart['label'] ?? []) !!}
    var budget = {!! json_encode($budget_chart['budget'] ?? []) !!}
    var incomes = {!! json_encode($budget_chart['income'] ?? []) !!}
    var budget_remaining = {!! json_encode($budget_chart['budget_remaining'] ?? []) !!}
    var ctx = document.getElementById("budget_chart");
    var chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    type: "line",
                    backgroundColor: "#FF6D4D",
                    borderColor: "#FE634E",
                    label: "Budget Remaining",
                    data: budget_remaining,
                    lineTension: 0, 
                    fill: false 
                },
                {
                    type: "bar",
                    backgroundColor: "#5e72e4",
                    label: "Budget",
                    data: budget
                },
                {
                    type: "bar",
                    backgroundColor: "#2BC155",
                    label: "Incomes",
                    data: incomes
                },
            ]
        }
    });
</script>
<script>
    var labels = {!! json_encode($expense_chart['label'] ?? []) !!}
    var expense = {!! json_encode($expense_chart['expense'] ?? []) !!}
    var ctx = document.getElementById("expense_chart");
    var chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    type: "bar",
                    backgroundColor: "#FE634E",
                    label: "Expense",
                    data: expense
                },
            ]
        },
        options:{
            legend:false,
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
    var labels = {!! json_encode($hours_chart['label'] ?? []) !!}
    var plan_hours = {!! json_encode($hours_chart['plan_hours'] ?? []) !!}
    var actual_hours = {!! json_encode($hours_chart['actual_hours'] ?? []) !!}
    var ctx = document.getElementById("hours_chart");
    var chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    type: "bar",
                    backgroundColor: "#5e72e4",
                    label: "Plan Hours",
                    data: plan_hours
                },
                {
                    type: "bar",
                    backgroundColor: "#2BC155",
                    label: "Actual Hours",
                    data: actual_hours
                },
            ]
        }
    });
</script>
@stop