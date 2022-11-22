@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active"><a href="#">Employee</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Employee List
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
                    <div style="overflow-x:scroll">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Emp Type</th>
                                <th>Department</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($employees as $i => $employee)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$employee->code}} </td>
                                        <td> {{$employee->name}} </td>
                                        <td> {{$employee->employee_type ? $employee->employee_type->name : ''}} </td>
                                        <td> {{$employee->department ? $employee->department->name : ''}} </td>
                                        <td>
                                            <span>
                                                <a href="#" class="mr-4" id="edit-{{$employee->id}}" 
                                                    data-code="{{$employee->code}}" 
                                                    data-name="{{$employee->name}}" 
                                                    data-employee_type_id="{{$employee->employee_type_id}}" 
                                                    data-employee_type_name="{{$employee->employee_type ? $employee->employee_type->name : ''}}" 
                                                    data-department_id="{{$employee->department_id}}" 
                                                    data-department_name="{{$employee->department ?$employee->department->name : ''}}" 
                                                    data-toggle="tooltip" 
                                                    data-placement="top" 
                                                    title="Edit" 
                                                    onclick="editData('{{$employee->id}}')"
                                                ><i class="fa fa-pencil color-muted"></i></a>
                                                <a href="#" 
                                                    data-placement="top" 
                                                    data-toggle="tooltip" 
                                                    title="Delete" 
                                                    onclick="deleteData('{{$employee->id}}')"
                                                ><i class="fa fa-close color-danger"></i></a></span>
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
    <form action="employee" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <label for="">Code</label>
                <input type="text" class="form-control" name="code" required>
                <br>
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" required>
                <br>
                <label for="">Emp Type</label>
                <select name="employee_type_id" class="form-control">
                    @foreach($emp_types as $emp_type)
                        <option value="{{$emp_type->id}}">{{$emp_type->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Department</label>
                <select name="department_id" class="form-control">
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
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
    <form action="employee" method="post">
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
                <label for="">Code</label>
                <input type="text" class="form-control" name="code" id="edit-code" required>
                <br>
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="edit-name" required>
                <br>
                <label for="">Emp Type</label>
                <select name="employee_type_id" id="edit-employee_type_id" class="form-control">
                    @foreach($emp_types as $emp_type)
                        <option value="{{$emp_type->id}}">{{$emp_type->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Department</label>
                <select name="department_id" id="edit-department_id" class="form-control">
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
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
    <form action="employee" method="post">
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
        $("#edit-code").val($("#edit-"+id).data('code'))
        $("#edit-name").val($("#edit-"+id).data('name'))
        $("#edit-employee_type_id").val($("#edit-"+id).data('employee_type_id'))
        $("#edit-department_id").val($("#edit-"+id).data('department_id'))
    }
    
    function deleteData(id){
        $('#deleteModal').modal('show')
        $("#delete-id").val(id)
    }
</script>
@stop