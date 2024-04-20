<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user:id,name,username', 'tags:name'])
            ->withCount('likes')
            ->withCount([
                'likes as liked' => function ($q) {
                    $q->where('user_id', auth()->id());
                }
            ])
            ->withCasts(['liked' => 'boolean'])
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'slug' => $post->slug,
                    'liked' => $post->liked,
                    'total_likes' => $post->likes_count,
                    'user' => $post->user,
                    'tags' => $post->tags,
                    'can' => [
                        'update' => Gate::allows('update-post', $post),
                        'delete' => Gate::allows('delete-post', $post),
                    ],
                ];
            });
        return Inertia::render('Post/Index', ['posts' => $posts]);
    }

    public function show(User $user, Post $post)
    {
        $post = $post->load([
            'user:id,name,username',
            'comments' => function ($q) {
                $q->where('parent_id', null);
                $q->withCount([
                    'likes as liked' => function ($q) {
                        $q->where('user_id', auth()->id());
                    },
                    'likes as total_likes' // Count total likes for each comment
                ])->withCasts(['liked' => 'boolean']);

                $q->with(['comments' => function ($query) {
                    $query->with('user')->withCount([
                        'likes as liked' => function ($q) {
                            $q->where('user_id', auth()->id());
                        },
                        'likes as total_likes'
                    ])->withCasts(['liked' => 'boolean']);
                }]);
            }
        ]);
        $post->comments->each(function ($comment) {
            // Set permissions for the comment and its replies
            $comment->setPermissions();
        });
        // return $post;
        return Inertia::render('Post/Show', ['post' => $post]);
    }

    public function create(): Response
    {
        $tags = Tag::select(['id', 'name'])->get();

        return Inertia::render('Post/Create', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'excerpt' => '',
            'content' => 'required|string|min:20',
            'tags' => 'required'
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->user()->id;
        $post = Post::create($validated);
        $post->tags()->attach($validated['tags']);
        return redirect('/');
    }

    public function edit(User $user, Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }
        $post = [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'user' => [
                'username' => $user->username,
            ]
        ];
        return Inertia::render(
            'Post/Edit',
            [
                'post' => $post
            ]
        );
    }

    public function update(User $user, Post $post, Request $request)
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }
        $validated = $request->validate([
            'title' => 'required|string',
            'excerpt' => '',
            'content' => 'required|string',
        ]);
        $validated['user_id'] = auth()->user()->id;
        $validated['slug'] = Str::slug($validated['title']);
        $post->update($validated);
        return redirect('/');
    }

    public function destroy(User $user, Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }
        $post->delete();
    }
}
