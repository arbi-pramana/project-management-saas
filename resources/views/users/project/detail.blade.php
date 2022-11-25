@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Project</a></li>
                <li class="breadcrumb-item active"><a href="#">Detail</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="mr-2" style="float:right;"
                            data-id="{{$project->id}}"
                            data-name="{{$project->name}}"
                            data-placement="top" 
                            data-toggle="tooltip" 
                            title="Delete" 
                            onclick="deleteData('{{$project->id}}')"
                        ><i class="fa fa-times color-muted"></i> </a>
                        <a href="#" class="mr-2" style="float:right;"
                            id="edit-{{$project->id}}" 
                            data-name="{{$project->name}}"
                            data-name="{{$project->name}}"
                            data-budget="{{$project->budget}}"
                            data-start_date="{{$project->start_date}}"
                            data-end_date="{{$project->end_date}}"
                            data-plan_hours="{{$project->plan_hours}}"
                            data-manager="{{$project->manager}}"
                            data-client_id="{{$project->client_id}}"
                            data-complexity_id="{{$project->complexity_id}}"
                            data-priority_id="{{$project->priority_id}}"
                            data-status_id="{{$project->status_id}}"
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Edit" 
                            onclick="editData('{{$project->id}}')"
                        ><i class="fa fa-pencil color-muted"></i> </a>
                        <h2 class="mt-2">{{$project->name}}</h2>
                        <label for=""><b> Manager </b> : {{$project->employee ? $project->employee->name : ''}}</label><br>
                        <label for=""><b> Client </b> : {{$project->client ? $project->client->name." / ".$project->client->email." / ".$project->client->phone : ''}}</label><br>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for=""><b> Start Date </b> {{date("d M Y",strtotime($project->start_date))}}</label><br>
                            </div>
                            <div class="col-md-6">
                                <label for=""><b> End Date </b> {{date("d M Y",strtotime($project->end_date))}}</label><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for=""> <b> Status </b> : {{$project->status ? $project->status->name : ''}}</label><br>
                            </div>
                            <div class="col-md-6">
                                <label for=""> <b> Complexity </b> : {{$project->complexity ? $project->complexity->name : ''}}</label><br>
                            </div>
                            <div class="col-md-6">
                                <b> Priority </b> : <label for="" class="btn btn-xs btn-{{$project->priority ? $project->priority->color : ''}}">{{$project->priority ? $project->priority->name : ''}}</label><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{route('users.milestone.index',['id'=>$project->id])}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="flaticon-381-flag-4" style="font-size:50px;"></i><br>
                            <label for="">Milestones</label>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('users.task.index',['id'=>$project->id])}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="flaticon-381-app" style="font-size:50px;"></i><br>
                            <label for="">Tasks</label>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('users.income.index',['id'=>$project->id])}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="flaticon-381-add-3" style="font-size:50px;"></i><br>
                            <label for="">Incomes</label>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('users.expense.index',['id'=>$project->id])}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="flaticon-381-file" style="font-size:50px;"></i><br>
                            <label for="">Expenses</label>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fs-14 mb-1">OVERALL PROGRESS</p>
                                <span class="fs-35 text-black font-w600">
                                    @if(count($tasks) >= 1)
                                        {{number_format(count($task_complete)/count($tasks)*100,0)}} %
                                    @else
                                        0 %
                                    @endif
                                </span>
                            </div>
                            <div class="d-inline-block ml-auto position-relative donut-chart-sale">
                                <span class="donut" data-peity='{ "fill": ["rgb(254, 99, 78)", "rgba(244, 244, 244, 1)"],   "innerRadius": 31, "radius": 20}'>{{count($task_complete)}}/{{count($tasks)}}</span>
                                <small class="text-secondary"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fs-14 mb-1">
                                    PROJECT TASKS <br>
                                    <h5>{{count($task_complete)}} OF {{count($tasks)}} TASKS COMPLETED</h5>
                                </p>
                            </div>
                            <div class="d-inline-block ml-auto position-relative donut-chart-sale">
                                <span class="donut" data-peity='{ "fill": ["rgb(254, 99, 78)", "rgba(244, 244, 244, 1)"],   "innerRadius": 31, "radius": 20}'>{{count($task_complete)}}/{{count($tasks)}}</span>
                                <small class="text-secondary">{{count($tasks)}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-end">
                            <div>
                                <p class="fs-14 mb-1">HOURS</p>
                                <label class="btn btn-xs btn-success"></label> Plan Hours <br>
                                <label class="btn btn-xs btn-primary"></label> Hours Spent
                            </div>
                            <canvas class="lineChart" id="hourSpent" height="85"></canvas>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        PROJECT BUDGET <br>
                        <h2>Rp. {{number_format($project->budget,2)}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        INCOMES <br>
                        <h2>Rp. {{number_format($project->incomes ? $project->incomes->sum('paid') : 0,2)}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        REMAINING <br>
                        @php
                            $budget = $project->budget;
                            $income = $project->incomes ? $project->incomes->sum('paid') : 0;
                            $remaining = $budget - $income;
                        @endphp
                        <h2>Rp. {{number_format($remaining,2)}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        EXPENSES <br>
                        <h2>Rp. {{number_format($project->expenses ? $project->expenses->sum('amount') : 0,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-4">PROJECT TIMELINE</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="gantt"></div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-4">INCOME VS EXPENSE</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="height:500px;padding-bottom:70px">
                        <canvas id="income_expense_chart" class="chart-js pt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-4">PLAN HOURS VS HOUR SPENT</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="height:500px;padding-bottom:70px">
                        <canvas id="hours_chart" class="chart-js pt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-4">TASKS | RESPONSIBLE</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="height:500px;padding-bottom:70px">
                        <canvas id="responsible_chart" class="chart-js pt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-4">PROJECT STATUS REPORT</h3>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        STATUS
                    </div>
                    <div class="card-body">
                        <canvas id="status_chart" class="chart-js" height="350px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        PRIORITY
                    </div>
                    <div class="card-body">
                        <canvas id="priority_chart" class="chart-js pt-4" height="350px"></canvas>
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        COMPLEXITY
                    </div>
                    <div class="card-body">
                        <canvas id="complexity_chart" class="chart-js pt-4" height="350px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('users.project.update')}}" method="post">
        @csrf
        @method('put')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" name="id" id="edit-id" required>
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="edit-name" required>
                <br>
                <label for="">Manager</label>
                <select name="manager" id="edit-manager" class="form-control">
                    @foreach($managers as $manager)
                        <option value="{{$manager->id}}">{{$manager->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Client</label>
                <select name="client_id" id="edit-client_id" class="form-control">
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Budget</label>
                <input type="int" class="form-control" name="budget" id="edit-budget" required>
                <br>
                <label for="">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="edit-start_date" required>
                <br>
                <label for="">End Date</label>
                <input type="date" class="form-control" name="end_date" id="edit-end_date" required>
                <br>
                <label for="">Complexity</label>
                <select name="complexity_id" id="edit-complexity_id" class="form-control">
                    @foreach($complexitys as $complexity)
                        <option value="{{$complexity->id}}">{{$complexity->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Priority</label>
                <select name="priority_id" id="edit-priority_id" class="form-control">
                    @foreach($prioritys as $priority)
                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Status</label>
                <select name="status_id" id="edit-status_id" class="form-control">
                    @foreach($statuss as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Plan Hours</label>
                <input type="int" class="form-control" name="plan_hours" id="edit-plan_hours" required>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"> Save </button>
            </div>
        </div>
    </form>
  </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('users.project.destroy')}}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" name="id" id="delete-id" value="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are you sure to delete this?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary"> Yes </button>
            </div>
        </div>
    </form>
  </div>
</div>
@stop
@section('scripts')
<script>
    var tasks = {!! json_encode($gantt_chart['tasks']) !!}
    var gantt = new Gantt("#gantt", tasks,{
        header_height: 50,
        column_width: 30,
        step: 24,
        view_modes: ['Quarter Day', 'Half Day', 'Day', 'Week', 'Month'],
        bar_height: 20,
        bar_corner_radius: 3,
        arrow_curve: 5,
        padding: 18,
        view_mode: 'Day',
        date_format: 'YYYY-MM-DD',
        custom_popup_html: null
    });
</script>
<script>
    function editData(id){
        $('#editModal').modal('show')
        $("#edit-id").val(id)
        $("#edit-name").val($("#edit-"+id).data('name'))
        $("#edit-budget").val($("#edit-"+id).data('budget'))
        $("#edit-start_date").val($("#edit-"+id).data('start_date'))
        $("#edit-end_date").val($("#edit-"+id).data('end_date'))
        $("#edit-plan_hours").val($("#edit-"+id).data('plan_hours'))
        $("#edit-manager").val($("#edit-"+id).data('manager'))
        $("#edit-client_id").val($("#edit-"+id).data('client_id'))
        $("#edit-complexity_id").val($("#edit-"+id).data('complexity_id'))
        $("#edit-priority_id").val($("#edit-"+id).data('priority_id'))
        $("#edit-status_id").val($("#edit-"+id).data('status_id'))
    }
    
    function deleteData(id){
        $('#deleteModal').modal('show')
        $("#delete-id").val(id)
    }
</script>
<script>
    const hourSpent = document.getElementById("hourSpent").getContext('2d');
    //generate gradient
    const hourSpentgradientStroke = hourSpent.createLinearGradient(250, 0, 0, 0);
    hourSpentgradientStroke.addColorStop(1, "#EA7A9A");
    hourSpentgradientStroke.addColorStop(0, "#FAC7B6");

    // hourSpent.attr('height', '100');
    new Chart(hourSpent, {
        type: 'bar',
        data: {
            defaultFontFamily: 'Poppins',
            labels: ["PLAN HOURS", "HOURS SPENT"],
            datasets: [
                {
                    data: ["{{$tasks->sum('plan_hours')}}","{{$tasks->sum('actual_hours')}}"],
                    borderColor: ['#2BC155','#FE634E'],
                    borderWidth: "0",
                    backgroundColor: ['#2BC155','#FE634E'], 
                    hoverBackgroundColor: ['#2BC155','#FE634E']
                }
            ]
        },
        options: {
            legend: false,
            responsive: true, 
            maintainAspectRatio: false,  
            scales: {
                yAxes: [{
                    display: false, 
                    ticks: {
                        beginAtZero: true, 
                        display: false, 
                        // max: 100, 
                        // min: 0, 
                        // stepSize: 10
                    }, 
                    gridLines: {
                        display: false, 
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display: false, 
                    barPercentage: 0.4, 
                    gridLines: {
                        display: false, 
                        drawBorder: false
                    }, 
                    ticks: {
                        display: false
                    }
                }]
            }
        }
    });
</script>
<script>
    var labels = {!! json_encode($income_expense_chart['label']) !!}
    var income_value = {!! json_encode($income_expense_chart['income_value']) !!}
    var expense_value = {!! json_encode($income_expense_chart['expense_value']) !!}
    var income_expense_chart = document.getElementById("income_expense_chart");
    var config = {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Income",
                    data:  income_value,
                    backgroundColor: '#2BC155'
                    
                },
                {
                    label: "Expense",
                    data: expense_value,
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

    var ctx = document.getElementById("income_expense_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var labels = {!! json_encode($hours_chart['label']) !!}
    var plan_hours = {!! json_encode($hours_chart['plan_hours']) !!}
    var actual_hours = {!! json_encode($hours_chart['actual_hours']) !!}
    var hours_chart = document.getElementById("hours_chart");
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
                    label: "Hour Spent",
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

    var ctx = document.getElementById("hours_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var labels = {!! json_encode($responsible_chart['label']) !!}
    var plan_task = {!! json_encode($responsible_chart['plan_task']) !!}
    var completed_task = {!! json_encode($responsible_chart['completed_task']) !!}
    var hours_chart = document.getElementById("hours_chart");
    var config = {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Plan Task",
                    data:  plan_task,
                    backgroundColor: '#2BC155'
                    
                },
                {
                    label: "Completed Task",
                    data: completed_task,
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

    var ctx = document.getElementById("responsible_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
</script>
<script>
    var labels = {!! json_encode($status_chart['label']) !!}
    var data = {!! json_encode($status_chart['value']) !!}
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

    var ctx = document.getElementById("status_chart").getContext("2d");
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
            plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Pie Chart'
                }
            },
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
@stop