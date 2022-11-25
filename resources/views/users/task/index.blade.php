@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Project</a></li>
                <li class="breadcrumb-item"><a href="{{url('/users/project/'.$project->id.'/detail')}}">{{$project->name}}</a></li>
                <li class="breadcrumb-item active"><a href="#">Task</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Task List
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
                    <table class="table table-responsive table-striped table-hover">
                        <thead>
                            <th>WBS Code</th>
                            <th>Milestone</th>
                            <th>Responsible</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Complexity</th>
                            <th>Priority</th>
                            <th>Plan Hours</th>
                            <th>Actual Hours</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($tasks as $i => $task)
                                <tr>
                                    <td> {{$task->wbs_code}} </td> 
                                    <td> {{$task->milestone ? $task->milestone->name : ''}} </td> 
                                    <td> {{$task->employee ? $task->employee->name : ''}} </td> 
                                    <td> {{$task->name}} </td> 
                                    <td> {{date("d M Y",strtotime($task->start_date))}} </td>
                                    <td> {{date("d M Y",strtotime($task->end_date))}} </td>
                                    <td> {{$task->status ? $task->status->name : ''}} </td> 
                                    <td> {{$task->complexity ? $task->complexity->name : ''}} </td> 
                                    <td> <label class="btn btn-xs btn-block btn-{{$task->priority ? $task->priority->color : ''}}"> {{$task->priority ? $task->priority->name : ''}} </label></td> 
                                    <td> {{$task->plan_hours}} </td> 
                                    <td> {{$task->actual_hours}} </td> 
                                    <td> {{$task->remarks}} </td> 
                                    <td>
                                        <span>
                                            <a href="#" class="mr-4" 
                                                id="edit-{{$task->id}}" 
                                                data-project_id="{{$task->project_id}}"
                                                data-milestone_id="{{$task->milestone_id}}"
                                                data-employee_id="{{$task->employee_id}}"
                                                data-wbs_code="{{$task->wbs_code}}"
                                                data-name="{{$task->name}}"
                                                data-start_date="{{$task->start_date}}"
                                                data-end_date="{{$task->end_date}}"
                                                data-status_id="{{$task->status_id}}"
                                                data-complexity_id="{{$task->complexity_id}}"
                                                data-priority_id="{{$task->priority_id}}"
                                                data-plan_hours="{{$task->plan_hours}}"
                                                data-actual_hours="{{$task->actual_hours}}"
                                                data-remarks="{{$task->remarks}}"
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Edit" 
                                                onclick="editData('{{$task->id}}')"
                                            ><i class="fa fa-pencil color-muted"></i></a>
                                            <a href="#" data-id="{{$task->id}}" data-placement="top" data-toggle="tooltip" title="Delete" onclick="deleteData('{{$task->id}}')"><i class="fa fa-close color-danger"></i></a>
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
    <form action="task" method="post">
        @csrf
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <label for="">WBS Code</label>
                <input type="text" class="form-control" name="wbs_code" required>
                <br>
                <label for="">Milestone</label>
                <select name="milestone_id" class="form-control" required>
                    @foreach($milestones as $milestone)
                        <option value="{{$milestone->id}}">{{$milestone->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Employee</label>
                <select name="employee_id" class="form-control" required>
                    @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" required>
                <br>
                <label for="">Start Date</label>
                <input type="date" class="form-control" name="start_date" required>
                <br>
                <label for="">End Date</label>
                <input type="date" class="form-control" name="end_date" required>
                <br>
                <label for="">Status</label>
                <select name="status_id" class="form-control" required>
                    @foreach($statuss as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Complexity</label>
                <select name="complexity_id" class="form-control">
                    @foreach($complexitys as $complexity)
                        <option value="{{$complexity->id}}">{{$complexity->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Priority</label>
                <select name="priority_id" class="form-control">
                    @foreach($prioritys as $priority)
                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Plan Hours</label>
                <input type="int" class="form-control" name="plan_hours" required>
                <br>
                <label for="">Actual Hours</label>
                <input type="int" class="form-control" name="actual_hours" required>
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
    <form action="task" method="post">
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
                <label for="">WBS Code</label>
                <input type="text" class="form-control" name="wbs_code" id="edit-wbs_code" required>
                <br>
                <label for="">Milestone</label>
                <select name="milestone_id" id="edit-milestone_id" class="form-control">
                    @foreach($milestones as $milestone)
                        <option value="{{$milestone->id}}">{{$milestone->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Employee</label>
                <select name="employee_id" id="edit-employee_id" class="form-control">
                    @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="edit-name" required>
                <br>
                <label for="">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="edit-start_date" required>
                <br>
                <label for="">End Date</label>
                <input type="date" class="form-control" name="end_date" id="edit-end_date" required>
                <br>
                <label for="">Status</label>
                <select name="status_id" id="edit-status_id" class="form-control">
                    @foreach($statuss as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
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
                <label for="">Plan Hours</label>
                <input type="int" class="form-control" name="plan_hours" id="edit-plan_hours" required>
                <br>
                <label for="">Actual Hours</label>
                <input type="int" class="form-control" name="actual_hours" id="edit-actual_hours" required>
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
    <form action="task" method="post">
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
        $("#edit-wbs_code").val($("#edit-"+id).data('wbs_code'))
        $("#edit-milestone_id").val($("#edit-"+id).data('milestone_id'))
        $("#edit-employee_id").val($("#edit-"+id).data('employee_id'))
        $("#edit-name").val($("#edit-"+id).data('name'))
        $("#edit-start_date").val($("#edit-"+id).data('start_date'))
        $("#edit-end_date").val($("#edit-"+id).data('end_date'))
        $("#edit-status_id").val($("#edit-"+id).data('status_id'))
        $("#edit-complexity_id").val($("#edit-"+id).data('complexity_id'))
        $("#edit-priority_id").val($("#edit-"+id).data('priority_id'))
        $("#edit-plan_hours").val($("#edit-"+id).data('plan_hours'))
        $("#edit-actual_hours").val($("#edit-"+id).data('actual_hours'))
        $("#edit-remarks").val($("#edit-"+id).data('remarks'))
    }
    
    function deleteData(id){
        $('#deleteModal').modal('show')
        $("#delete-id").val(id)
    }
</script>
@stop