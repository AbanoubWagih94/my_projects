@extends('layouts.admin')

@section('content')
    @if($comments->count()>0)
    <h1>Comments</h1>
    <table class="table table-responsive">
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>View Post</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ str_limit($comment->body, 20) }}</td>
                    <td><a href="{{route('post.show', $comment->post->slug)}}">View Post</a></td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                    <td>{{ $comment->updated_at->diffForHumans() }}</td>
                    <td>
                        <form method="post" action="{{ route('comments.destroy', $comment->id) }}">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
    @else
        <h1>No Comments</h1>
    @endif
@endsection