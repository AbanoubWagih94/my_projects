@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="{{route('categories.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label name="name" for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
        </div>

        <div class="col-sm-6">
            <table class="table">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Created date</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at? $category->created_at->diffForHumans():"no date"}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection