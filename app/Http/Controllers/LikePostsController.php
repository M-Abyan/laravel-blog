<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class LikePostsController
{
    public function like(User $user, Post $post)
    {   
        $post->likes()->toggle(auth()->id());
        return redirect()->back();
    }
}
