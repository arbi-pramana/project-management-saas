@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active"><a href="#">Project</a></li>
            </ol>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Project List
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
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Manager</th>
                                <th>Client</th>
                                <th>Budget</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Complexity</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Plan Hours</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($projects as $i => $project)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> <a href="{{route('users.project.detail',['id'=>$project->id])}}"> {{$project->name}} </a></td>
                                        <td> {{$project->employee ? $project->employee->name : ''}}</td>
                                        <td> {{$project->client ? $project->client->name : ''}}</td>
                                        <td> Rp. {{number_format($project->budget,0)}}</td>
                                        <td> {{date("d M Y",strtotime($project->start_date))}}</td>
                                        <td> {{date("d M Y",strtotime($project->end_date))}}</td>
                                        <td> {{$project->complexity->name}}</td>
                                        <td> <label class="btn btn-sm btn-{{$project->priority->color}}"> {{$project->priority->name}} </label></td>
                                        <td> {{$project->status->name}}</td>
                                        <td> {{$project->plan_hours}}</td>
                                        <td>
                                            <span>
                                                <a href="#" class="mr-4" 
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
                                                ><i class="fa fa-pencil color-muted"></i></a>
                                                <a href="#" data-id="{{$project->id}}" data-name="{{$project->name}}" data-placement="top" data-toggle="tooltip" title="Delete" onclick="deleteData('{{$project->id}}')"><i class="fa fa-close color-danger"></i></a></span>
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
    <form action="project" method="post">
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
                <label for="">Manager</label>
                <select name="manager" class="form-control">
                    @foreach($managers as $manager)
                        <option value="{{$manager->id}}">{{$manager->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Client</label>
                <select name="client_id" class="form-control">
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Budget</label>
                <input type="int" class="form-control" name="budget" required>
                <br>
                <label for="">Start Date</label>
                <input type="date" class="form-control" name="start_date" required>
                <br>
                <label for="">End Date</label>
                <input type="date" class="form-control" name="end_date" required>
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
                <label for="">Status</label>
                <select name="status_id" class="form-control">
                    @foreach($statuss as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Plan Hours</label>
                <input type="int" class="form-control" name="plan_hours" required>
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
    <form action="project" method="post">
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
    <form action="project" method="post">
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