@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Project</a></li>
                <li class="breadcrumb-item"><a href="{{url('/users/project/'.$project->id.'/detail')}}">{{$project->name}}</a></li>
                <li class="breadcrumb-item active"><a href="#">Expense</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Expense List
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
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Reference No</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($expenses as $i => $expense)
                                <tr>
                                    <td> {{$i+1}} </td>
                                    <td> {{date("d M Y",strtotime($expense->date))}} </td>
                                    <td> {{$expense->description}} </td>
                                    <td> {{$expense->reference_number}} </td>
                                    <td> Rp. {{number_format($expense->amount,0)}} </td>
                                    <td> {{$expense->remarks}} </td>
                                    <td>
                                        <span>
                                            <a href="#" class="mr-4" 
                                                id="edit-{{$expense->id}}" 
                                                data-date="{{$expense->date}}" 
                                                data-description="{{$expense->description}}" 
                                                data-reference_number="{{$expense->reference_number}}" 
                                                data-amount="{{$expense->amount}}" 
                                                data-remarks="{{$expense->remarks}}" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Edit" 
                                                onclick="editData('{{$expense->id}}')"
                                            ><i class="fa fa-pencil color-muted"></i></a>
                                            <a href="#" data-id="{{$expense->id}}" data-name="{{$expense->name}}" data-placement="top" data-toggle="tooltip" title="Delete" onclick="deleteData('{{$expense->id}}')"><i class="fa fa-close color-danger"></i></a>
                                        </span>
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
<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="expense" method="post">
        @csrf
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <label for="">Date</label>
                <input type="date" class="form-control" name="date" required>
                <br>
                <label for="">Description</label>
                <input type="text" class="form-control" name="description" required>
                <br>
                <label for="">Reference No</label>
                <input type="text" class="form-control" name="reference_number" required>
                <br>
                <label for="">Amount</label>
                <input type="number" class="form-control" name="amount" required>
                <br>
                <label for="">Remarks</label>
                <input type="text" class="form-control" name="remarks" required>
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
    <form action="expense" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <input type="hidden" class="form-control" name="id" id="edit-id" required>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <label for="">Date</label>
                <input type="date" class="form-control" name="date" id="edit-date" required>
                <br>
                <label for="">Description</label>
                <input type="text" class="form-control" name="description" id="edit-description" required>
                <br>
                <label for="">Reference No</label>
                <input type="text" class="form-control" name="reference_number" id="edit-reference_number" required>
                <br>
                <label for="">Amount</label>
                <input type="number" class="form-control" name="amount" id="edit-amount" required>
                <br>
                <label for="">Remarks</label>
                <input type="text" class="form-control" name="remarks" id="edit-remarks" required>
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
    <form action="expense" method="post">
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
        $("#edit-date").val($("#edit-"+id).data('date'))
        $("#edit-description").val($("#edit-"+id).data('description'))
        $("#edit-reference_number").val($("#edit-"+id).data('reference_number'))
        $("#edit-amount").val($("#edit-"+id).data('amount'))
        $("#edit-remarks").val($("#edit-"+id).data('remarks'))
    }
    
    function deleteData(id){
        $('#deleteModal').modal('show')
        $("#delete-id").val(id)
    }
</script>
@stop