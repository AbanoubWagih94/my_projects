<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = ['comment_id', 'is_active', 'author', 'email', 'photo_id', 'body'];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function photo(){
        return $this->belongsTo(Photo::class);
    }
}
