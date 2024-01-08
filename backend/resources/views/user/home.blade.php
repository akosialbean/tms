@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Tasks') }}
                    | 
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    User1   
                    {{ Auth::user()->name }} {{ __('is logged in!') }}
                </div>

                <div class="card-body">
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#newTask">
                        New Task
                    </button>
                    <table class="table table-responsive table-sm table-bordered table-striped table-hover">
                        <thead>
                            <th>
                                <tr>
                                    <td>#</td>
                                    <td>Title</td>
                                    <td>Assigned to</td>
                                    <td>Actions</td>
                                </tr>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>New task 1</td>
                                <td>Test 3</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        open
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>New task 2</td>
                                <td>Test 2</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#task">
                                        open
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                <div class="row mb-3">
                    <label for="taskTitle" class="col-md-4 col-form-label text-md-end">{{ __('Title *') }}</label>

                    <div class="col-md-6">
                        <input id="taskTitle" type="text" class="form-control" name="t_title" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="taskDescription" class="col-md-4 col-form-label text-md-end">{{ __('Description *') }}</label>

                    <div class="col-md-6">
                        <textarea id="taskDescription" type="text" class="form-control" name="t_description" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Assign to (Optional)') }}</label>

                    <div class="col-md-6">
                        <select name="role" id="" class="form-select">
                            <option value="">--</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
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
<div class="modal fade" id="task">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Task</h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> --}}
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- TASK --}}
@endsection
