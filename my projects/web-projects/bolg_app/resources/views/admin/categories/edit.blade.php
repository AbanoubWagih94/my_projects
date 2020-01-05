@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="{{route('categories.update', $category->id)}}">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label name="name" for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category? $category->name:'' }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary col-sm-6" style="float: left;">Update Category</button>
                </div>
            </form>

            <form method="post" action="{{route('categories.destroy', $category->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}

                <div class="form-group">
                    <button type="submit" class="btn btn-danger col-sm-6">Delete Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection