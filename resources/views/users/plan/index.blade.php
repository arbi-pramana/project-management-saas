@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active"><a href="#">Plan</a></li>
            </ol>
        </div>
        <div class="row">
            @foreach($plans as $plan)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$plan->name}}</h4>
                        </div>
                        <div class="card-body">
                            <h2 class="text-center" style="color:#5e72e4;font-weight:bold">Rp. {{number_format($plan->price,0)}} </h2>
                            <br>
                            Duration : <b>  {{ucfirst($plan->duration)}} {{ucfirst($plan->unit)}} </b> <br>
                            Max Project : <b> @if($plan->max_projects == 0 )  Unlimited Project @else {{$plan->max_projects}} Project @endif </b> <br>
                            Max Client : <b> @if($plan->max_clients == 0 )  Unlimited Client @else {{$plan->max_clients}} Client @endif </b> <br>
                            Max Incomes : <b> @if($plan->max_incomes == 0 )  Unlimited Incomes @else {{$plan->max_incomes}} Incomes @endif </b> <br>
                            Max Expenses : <b> @if($plan->max_expenses == 0 )  Unlimited Expenses @else {{$plan->max_expenses}} Expenses @endif </b> <br>
                            Max Employee : <b> @if($plan->max_expenses == 0 )  Unlimited Employee @else {{$plan->max_expenses}} Employee @endif </b> <br>
                            @if($plan->is_support == 1) <b> <i class="fa fa-phone"></i> Customer Support </b> <br> @endif
                            <small>{!!$plan->description!!}</small>
                            @if($plan->id == Auth::guard('users')->user()->plan)
                                <div class="text-center mt-4">
                                    <a href="{{$plan->url}}" class="btn btn-secondary"><i class="fa fa-check"></i> Selected </a>
                                </div>
                            @else
                                <div class="text-center mt-4">
                                    <a href="{{$plan->url}}" class="btn btn-success"><i class="fa fa-tags"></i> Upgrade Plan</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dedicated System</h4>
                    </div>
                    <div class="card-body">
                        Dedicated system is to separate this system only for your business <br><br>
                        For Dedicated System you can contact us use link below :
                        <br><br>
                        <div class="text-center">
                            <a href="" class="btn btn-success"><i class="fa fa-phone"></i> Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Custom System</h4>
                    </div>
                    <div class="card-body">
                        Custom system is to add a new feature only for your business <br><br>
                        For Custom System you can contact us use link below :
                        <br><br>
                        <div class="text-center">
                            <a href="" class="btn btn-success"><i class="fa fa-phone"></i> Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop