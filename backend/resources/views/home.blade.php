@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Tasks') }}
                    | 
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::check())
                        @if (Auth::user()->role === 1)
                            <strong>Admin</strong>
                        @else
                            <strong>User</strong>
                        @endif

                        {{ Auth::user()->name }} {{ __('is logged in!') }}
                    @endif

                </div>

                <div class="card-body">
                    @if(Auth::check())
                        @if(Auth::user()->role == 1)
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newTask">
                                New Task
                            </button>
                        @endif
                    @endif

                    <table class="table table-responsive table-lg table-striped table-hover mt-3">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Title</th>
                                @if(Auth::user()->role == 1)
                                    <th class="text-center">Assigned to</th>
                                @elseif(Auth::user()->role == 2)
                                    <th class="text-center">Assigned by</th>
                                @endif
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(Auth::check())
                                @foreach($tasks as $task)
                                <tr>
                                    <td class="text-center">{{$task->id}}</td>
                                    <td class="text-center">{{$task->t_title}}</td>
                                    @if(Auth::user()->role == 1)
                                        <td class="text-center">{{$task->t_assignedtoname}}</td>
                                    @elseif(Auth::user()->role == 2)
                                        <td class="text-center">{{$task->t_assignedbyname}}</td>
                                    @endif
                                    <td class="text-center">{{$task->created_at}}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#task{{$task->id}}">
                                            view
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if(Auth::check())
                        {{$tasks->onEachSide(0)->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- NEW TASK --}}
<div class="modal fade" id="newTask">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Task</h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> --}}
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/newtask" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="t_title" class="col-md-4 col-form-label text-md-end">{{ __('Title *') }}</label>

                        <div class="col-md-6">
                            <input id="t_title" type="text" class="form-control" name="t_title" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="t_description" class="col-md-4 col-form-label text-md-end">{{ __('Description *') }}</label>

                        <div class="col-md-6">
                            <textarea id="t_description" type="text" class="form-control" name="t_description" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="t_assignedto" class="col-md-4 col-form-label text-md-end">{{ __('Assign to (Optional)') }}</label>

                        <div class="col-md-6">
                            <select name="t_assignedto" id="t_assignedto" class="form-select">
                                <option value="">--</option>
                                @if(Auth::check())
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success float-end">Save</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- NEW TASK --}}

{{-- TASK --}}
@foreach($tasks as $task)
<div class="modal fade" id="task{{$task->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Task #{{$task->id}}</h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> --}}
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/updatetask" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="t_title" class="col-md-4 col-form-label text-md-end">{{ __('Title *') }}</label>

                        <div class="col-md-6">
                            <input id="t_title" type="text" class="form-control" name="t_title" value="{{$task->t_title}}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="t_description" class="col-md-4 col-form-label text-md-end">{{ __('Description *') }}</label>

                        <div class="col-md-6">
                            <textarea id="t_description" type="text" class="form-control" name="t_description" disabled>{{$task->t_description}}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="t_assignedby" class="col-md-4 col-form-label text-md-end">{{ __('Assign by') }}</label>

                        <div class="col-md-6">
                            @if(Auth::user()->role == 2)
                                <select name="t_assignedto" id="t_assignedto" class="form-select">
                                    <option value="">--</option>
                                    @if(Auth::check())
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @elseif(Auth::user()->role == 1)
                                <div class="col-md-12">
                                    <input id="t_title" type="text" class="form-control" name="t_title" value="{{$task->t_assignedbyname}}" disabled>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="t_remarks" class="col-md-4 col-form-label text-md-end">{{ __('Remarks *') }}</label>

                        <div class="col-md-6">
                            <textarea id="t_remarks" type="text" class="form-control" name="t_remarks">{{$task->t_description}}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="t_remarks" class="col-md-4 col-form-label text-md-end">{{ __('Mark as *') }}</label>

                        <div class="col-md-6">
                            <select name="t_assignedto" id="t_assignedto" class="form-select">
                                @if(Auth::check())
                                    <option value="{{$task->t_status}}">
                                        @if($task->t_status === 1)
                                            New
                                        @elseif($task->t_status == 2)
                                            Ongoing
                                        @else
                                            Done
                                        @endif
                                    </option>
                                @endif
                                <option value="2">Ongoing</option>
                                <option value="2">Done</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success float-end">Save</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endforeach
{{-- TASK --}}

@endsection
