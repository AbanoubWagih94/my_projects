@extends('front.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8" id="register">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Edit User</h2>
                    <hr>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                        </div>

                        <div class="form-group">
                            <label for="confirm">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm" name="password_confirmation" placeholder="Confirm password">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-info col-md-2"> Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection