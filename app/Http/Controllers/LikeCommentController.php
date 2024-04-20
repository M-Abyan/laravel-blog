<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeCommentController
{
    public function like(User $user, Post $post, Comment $comment)
    {
        $comment->likes()->toggle(auth()->id());
        return redirect()->back();
    }
}
