@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active"><a href="#">Profile</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <div class="basic-form">
                        <form action="#" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" value="{{$user->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{$user->phone}}" required>
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" value="">
                            </div>
                            @error('confirm_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="">
                            </div>
                            <button class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop