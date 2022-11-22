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
                        <a href="#" class="mr-2" style="float:right;"><i class="fa fa-times color-muted"></i> </a>
                        <a href="#" class="mr-2" style="float:right;"><i class="fa fa-pencil color-muted"></i> </a>
                        <h2 class="mt-2">{{$project->name}}</h2>
                        <label for="">Manager : {{$project->employee ? $project->employee->name : ''}}</label><br>
                        <label for="">Client  : {{$project->client ? $project->client->name." / ".$project->client->email." / ".$project->client->phone : ''}}</label><br>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Start Date : {{date("d M Y",strtotime($project->start_date))}}</label><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">End Date   : {{date("d M Y",strtotime($project->end_date))}}</label><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Status   : {{$project->status ? $project->status->name : ''}}</label><br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Complexity   : {{$project->complexity ? $project->complexity->name : ''}}</label><br>
                            </div>
                            <div class="col-md-6">
                                Priority   : <label for="" class="btn btn-xs btn-{{$project->priority ? $project->priority->color : ''}}">{{$project->priority ? $project->priority->name : ''}}</label><br>
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
    </div>
</div>
@stop