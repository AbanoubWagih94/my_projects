@extends('layouts.app')

@section('content')
    <h1>{{ title_case($post->title) }}</h1>
    <p class="lead">
        by
        <a href="#">{{ $post->user->name }}</a>
    </p>
    <hr>
    <p>Posted on {{ $post->created_at->diffForHumans() }}</p>
    <hr>
    <img style="height: 350px; width: 750px;" src="{{ $post->photo? $post->photo->file:'http://placehold.it/750x350' }}" alt=""  class="img-fluid rounded">
    <hr>
    <p class="lead"> {{ $post->body }} </p>
    <hr>
    @if(auth()->check())
        <div class="card my-4">
            <div class="card-header">
                <h5>Leave a Comment:</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('comments.store')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group">
                        <textarea name="body" class="form-control" rows="3" placeholder="Write a comment..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endif
    @if($post->comments->count() > 0)
        <h3>Comments :</h3>
        @foreach($post->comments->all() as $comment)
            <div class="media mb-4" id="comment">
                <img class="rounded-circle mr-3" height="50px" width="50px" src="{{ $comment->photo? $comment->photo->file : 'http://placehold.it/50x50' }}" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{$comment->author}}</h5>
                    <p>{{ $comment->body }}</p>
                    @if($comment->replies->count()>0)
                        @foreach($comment->replies->all() as $reply)
                            <div class="media">
                                <img class="rounded-circle mr-3" height="50px" width="50px" src="{{ $reply->photo? $reply->photo->file : 'http://placehold.it/50x50' }}" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">{{$reply->author}}</h5>
                                    <p>{{ $reply->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if(auth()->check())
                        <form method="post" action="{{route('replies.store')}}" id="{{$comment->id}}" hidden="true">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                <textarea name="body" class="form-control" rows="2" placeholder="Write a reply..."></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <a class="btn btn-primary text-white" onclick="showReplyForm({{ $comment->id }});"> Reply</a>
                    @endif
                </div>
            </div> <hr class="bg-secondary">
        @endforeach
    @endif

@endsection


<script>


    function showReplyForm(commentID) {
       var reply = document.getElementById(commentID);
       if(reply.hidden){
           reply.hidden = false;

       }
       else {
           reply.hidden = true;
       }
       /* $(document).ready(function(){
            $("#"+commentID).
                slideToggle();
        });*/
    }
</script>