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
                    <table class="table table-responsive table-sm">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
