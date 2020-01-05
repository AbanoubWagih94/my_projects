@extends('layouts.app')

@section('content')
    @if($posts->count() >0)
        @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    <img class="card-img-top" height="350px" src="{{ $post->photo? $post->photo->file: 'http://placehold.it/750x350' }}" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h2 class="card-title">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->body }}</p>
                        <a href="{{route('post.show', $post->slug)}}" class="btn btn-primary">Read More &rarr;</a>
                    </h2>
                </div>
                <div class="card-footer">
                    Posted on {{ $post->created_at->diffForHumans() }} by
                    <a href="#">{{ $post->user->name }}</a>
                </div>
            </div>
        @endforeach

         <ul class="pagination justify-content-center mb-4">
            <li class="page-item {{ $posts->currentPage() == $posts->firstItem()?'disabled':'' }}"><a class="page-link" href="{{ $posts->previousPageUrl() }}" >Previous</a></li>
            <li class="page-item"><a class="page-link" href="">{{$posts->currentPage()}}</a></li>
            <li class="page-item {{ $posts->currentPage() == $posts->lastPage()?'disabled':''}}"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a></li>
        </ul>
    @endif
    
@endsection