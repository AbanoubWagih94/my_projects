@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>

    <table class="table table-responsive">
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td> <img height="50px" src="{{ $post->photo? $post->photo->file: 'http://placehold.it/300*300'}}" alt=""> </td>
                    <td><a href="{{ route('posts.edit', $post->id) }}">{{ $post->user->name }}</a></td>
                    <td>{{ $post->category? $post->category->name : 'uncategorized' }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ str_limit($post->body, 20) }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        @endif
    </table>

    <ul class="pagination justify-content-center">
        <li class="page-item {{ $posts->currentPage() == $posts->firstItem()?'disabled':'' }}"><a class="page-link" href="{{ $posts->previousPageUrl() }}">Previous</a></li>
        <li class="page-item"><a class="page-link" href="">{{ $posts->currentPage() }}</a></li>
        <li class="page-item {{ $posts->currentPage() == $posts->lastPage()?'disabled':''}}"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a></li>
    </ul>
@endsection