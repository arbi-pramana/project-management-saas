@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active"><a href="#">Income</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Income List
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
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($incomes as $i => $income)
                                <tr>
                                    <td> {{$i+1}} </td>
                                    <td> {{$income->invoice_number}} </td>
                                    <td> {{date("d M Y",strtotime($income->date))}} </td>
                                    <td> Rp. {{number_format($income->amount,0)}} </td>
                                    <td> Rp. {{number_format($income->paid,0)}} </td>
                                    <td> Rp. {{number_format($income->amount-$income->paid,0)}} </td>
                                    <td> {{$income->remarks}} </td>
                                    <td>
                                        <span>
                                            <a href="#" class="mr-4" 
                                                id="edit-{{$income->id}}" 
                                                data-invoice_number="{{$income->invoice_number}}"
                                                data-date="{{$income->date}}"
                                                data-amount="{{$income->amount}}"
                                                data-paid="{{$income->paid}}"
                                                data-remarks="{{$income->remarks}}" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Edit" 
                                                onclick="editData('{{$income->id}}')"
                                            ><i class="fa fa-pencil color-muted"></i></a>
                                            <a href="#" data-id="{{$income->id}}" data-placement="top" data-toggle="tooltip" title="Delete" onclick="deleteData('{{$income->id}}')"><i class="fa fa-close color-danger"></i></a>
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
    <form action="income" method="post">
        @csrf
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
            <label for="">Invoice No</label>
                <input type="text" class="form-control" name="invoice_number" required>
                <br>
                <label for="">Date</label>
                <input type="date" class="form-control" name="date" required>
                <br>
                <label for="">Amount</label>
                <input type="number" class="form-control" name="amount" id="add-amount" required>
                <br>
                <label for="">Paid</label>
                <input type="number" class="form-control" name="paid" id="add-paid" required>
                <br>
                <label for="">Due</label>
                <input type="number" class="form-control" name="due" id="add-due" required>
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
    <form action="income" method="post">
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
            <input type="text" class="form-control" name="invoice_number" id="edit-invoice_number" required>
                <br>
                <label for="">Date</label>
                <input type="date" class="form-control" name="date" id="edit-date" required>
                <br>
                <label for="">Amount</label>
                <input type="number" class="form-control" name="amount" id="edit-amount" required>
                <br>
                <label for="">Paid</label>
                <input type="number" class="form-control" name="paid" id="edit-paid" required>
                <br>
                <label for="">Due</label>
                <input type="number" class="form-control" name="due" id="edit-due" required>
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
    <form action="income" method="post">
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
    $("#add-amount,#add-paid").keyup(function(){
        let due = $("#add-amount").val() - $("#add-paid").val()
        $("#add-due").val(due)
    })

    $("#edit-amount,#edit-paid").keyup(function(){
        let due = $("#edit-amount").val() - $("#edit-paid").val()
        $("#edit-due").val(due)
    })
</script>
<script>
    function editData(id){
        $('#editModal').modal('show')
        $("#edit-id").val(id)
        $("#edit-date").val($("#edit-"+id).data('date'))
        $("#edit-invoice_number").val($("#edit-"+id).data('invoice_number'))
        $("#edit-date").val($("#edit-"+id).data('date'))
        $("#edit-amount").val($("#edit-"+id).data('amount'))
        $("#edit-paid").val($("#edit-"+id).data('paid'))
        let due = $("#edit-"+id).data('amount')-$("#edit-"+id).data('paid')
        $("#edit-due").val(due)
        $("#edit-remarks").val($("#edit-"+id).data('remarks'))
    }
    
    function deleteData(id){
        $('#deleteModal').modal('show')
        $("#delete-id").val(id)
    }
</script>
@stop