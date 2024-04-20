<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        $validated['user_id'] = auth()->user()->id;
        $validated['post_id'] = $post->id;
        $validated['parent_id'] = null;
        // return [$validated, auth()->user()->id];
        Comment::create($validated);

        return redirect()->back();
    }

    public function child(Request $request, User $user, Post $post, Comment $comment)
    {
        $validated = $request->validate([
            'contentChild' => 'required|string',
        ]);
        $validated['user_id'] = auth()->user()->id;
        $validated['post_id'] = $post->id;
        $validated['parent_id'] = $comment->id;

        // return [$validated, auth()->user()->id];
        Comment::create(array_merge(['content' => $validated['contentChild']], $validated));

        return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Post $post, Comment $comment, Request $request)
    {
        if (Gate::denies('update-comment', $comment)) {
            abort(403);
        }
        $validated = $request->validate([
            'contentChild' => 'required|string',
        ]);
        $comment->update(['content' => $validated['contentChild']]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Post $post, Comment $comment)
    {
        if (Gate::denies('delete-comment', $comment)) {
            abort(403);
        }
        $comment->delete();
    }
}
