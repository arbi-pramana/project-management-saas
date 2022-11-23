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
@stop