@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title text-white">Login</h4>
                </div>
                <div class="card-body">
                    @include('errors.errors')
                    <form method="post" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection    