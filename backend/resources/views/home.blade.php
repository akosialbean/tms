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

                    @if (Auth::user()->role === 1)
                        <strong>Admin</strong>
                    @else
                        <strong>User</strong>
                    @endif
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
                                    <button class="btn btn-sm btn-primary">
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

<div class="modal fade" id="newTask">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection
