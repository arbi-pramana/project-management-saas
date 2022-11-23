@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Client</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Client List
                    </h4>
                    <a href="" class="btn btn-success text-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    @if (\Session::has('danger'))
                        <div class="alert alert-danger">
                            {!! \Session::get('danger') !!}
                        </div>
                    @endif
                    <div style="overflow-x:scroll;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($clients as $i => $client)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$client->name}} </td>
                                        <td> {{$client->company}} </td>
                                        <td> {{$client->email}} </td>
                                        <td> {{$client->phone}} </td>
                                        <td>
                                            <span>
                                                <a href="#" class="mr-4" 
                                                    id="edit-{{$client->id}}" 
                                                    data-name="{{$client->name}}" 
                                                    data-company="{{$client->company}}" 
                                                    data-country="{{$client->country}}" 
                                                    data-address="{{$client->address}}" 
                                                    data-email="{{$client->email}}" 
                                                    data-phone="{{$client->phone}}" 
                                                    data-toggle="tooltip" 
                                                    data-placement="top" 
                                                    title="Edit" 
                                                    onclick="editData('{{$client->id}}')"
                                                ><i class="fa fa-pencil color-muted"></i></a>
                                                <a href="#" data-placement="top" data-toggle="tooltip" title="Delete" onclick="deleteData('{{$client->id}}')"><i class="fa fa-close color-danger"></i></a></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="client" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" required>
                <br>
                <label for="">Company</label>
                <input type="text" class="form-control" name="company" required>
                <br>
                <label for="">Country</label>
                <input type="text" class="form-control" name="country" required>
                <br>
                <label for="">Address</label>
                <textarea name="address" class="form-control" name="address" cols="30" rows="4"></textarea>
                <br>
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" required>
                <br>
                <label for="">Phone</label>
                <input type="text" class="form-control" name="phone" required>
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
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="client" method="post">
        @csrf
        @method('put')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <input type="hidden" name="id" id="edit-id" value="">
            <div class="modal-body">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="edit-name" required>
                <br>
                <label for="">Company</label>
                <input type="text" class="form-control" name="company" id="edit-company" required>
                <br>
                <label for="">Country</label>
                <input type="text" class="form-control" name="country" id="edit-country" required>
                <br>
                <label for="">Address</label>
                <textarea name="address" id="edit-address" class="form-control" cols="30" rows="4"></textarea>
                <br>
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" id="edit-email" required>
                <br>
                <label for="">Phone</label>
                <input type="text" class="form-control" name="phone" id="edit-phone" required>
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
    <form action="client" method="post">
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
    function editData(id){
        $('#editModal').modal('show')
        $("#edit-id").val(id)
        $("#edit-name").val($("#edit-"+id).data('name'))
        $("#edit-company").val($("#edit-"+id).data('company'))
        $("#edit-country").val($("#edit-"+id).data('country'))
        $("#edit-address").val($("#edit-"+id).data('address'))
        $("#edit-email").val($("#edit-"+id).data('email'))
        $("#edit-phone").val($("#edit-"+id).data('phone'))
    }
    
    function deleteData(id){
        $('#deleteModal').modal('show')
        $("#delete-id").val(id)
    }
</script>
@stop