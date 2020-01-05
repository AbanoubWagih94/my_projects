@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title text-white">Registration</h4>
                </div>
                <div class="card-body">
                    @include('errors.errors')
                    <form method="post" action="{{ route('register') }}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">name:</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm Password:</label>
                            <input type="password" id="passwordConfirmation" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection