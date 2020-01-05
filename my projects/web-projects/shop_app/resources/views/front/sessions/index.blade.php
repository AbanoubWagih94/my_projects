@extends('front.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8"  id="register">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Login</h4>
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

                    @if(session()->has('msg'))
                        <div class="alert alert-success">{{ session()->get('msg') }}</div>
                    @endif
                    <form action="{{ route('user.login') }}" method="post">
                        {{ @csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-info col-md-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection