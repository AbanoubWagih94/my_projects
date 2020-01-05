@extends('layouts.admin')

@section('content')
    <h2>Admin</h2>
    <table class="table text-capitalize">

        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>

        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img src="{{ $user->photo ? $user->photo->file : '' }}" alt="No user photo" height="80px"></td>
                    <td><a href="{{ route('users.edit', $user->id) }}"> {{$user->name}} </a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role_id ==0 ? 'User has no role': $user->role->name}}</td>
                    <td>{{ $user->is_active == 1 ? "Active" : "Not Active"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection