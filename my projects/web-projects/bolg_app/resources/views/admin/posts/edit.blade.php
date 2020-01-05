@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>

    <div class="row">
        <div class="col-sm-3">
            <img src="{{ $post->photo? $post->photo->file:'http://placehold.it/300*300' }}" alt="" class="img-thumbnail">
        </div>

        <div class="col-sm-9">
            @include('errors.errors')

            {!! Form::model($post, ['method'=>'patch', 'route'=>['posts.update', $post->id], 'files'=>true]) !!}

            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}

            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control-file']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Description:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6', 'style'=>'float: left;']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['method' => 'POST' , 'action' => ['AdminPostsController@destroy', $post->id]]) !!}
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="form-group">
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection