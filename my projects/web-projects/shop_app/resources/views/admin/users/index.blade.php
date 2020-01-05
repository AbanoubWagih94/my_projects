@extends('admin.layouts.master')

@section('page')
    Users
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('msg'))
                <div class="alert alert-success">{{ session()->get('msg') }}</div>
            @endif
            <div class="card">
                <div class="header">
                    <h4 class="title">Users</h4>
                    <p class="category">List of all registered users</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->status)
                                        <span class="label label-warning">Blocked</span>
                                    @else
                                        <span class="label label-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->status)
                                        {{ link_to_route('user.changeStatus','',[$user->id, $user->status],['class'=>'btn btn-sm btn-success ti-check', 'title'=>'Active User']) }}
                                    @else
                                        {{ link_to_route('user.changeStatus','',[$user->id, $user->status],['class'=>'btn btn-sm btn-success ti-close', 'title'=>'Block User']) }}
                                    @endif

                                    {{ link_to_route('users.show','',$user,['class'=>'btn btn-sm btn-primary ti-view-list-alt', 'title'=>'Details']) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
