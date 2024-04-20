<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'liked_comments')->withTimestamps();
    }


    protected $with = ['user'];

    // protected static function booted()
    // {
    //     static::retrieved(function ($comment) {
    //         $comment->can = [
    //             'update' => Gate::allows('update-comment', $comment),
    //             'delete' => Gate::allows('delete-comment', $comment),
    //         ];

    //         $comment->comments->each(function ($reply) {
    //             $reply->can = [
    //                 'update' => Gate::allows('update-comment', $reply),
    //                 'delete' => Gate::allows('delete-comment', $reply),
    //             ];
    //         });
    //     });
    // }
    //  protected $hidden = ['can'];

    public function setPermissions()
    {
        $this->can = [
            'update' => Gate::allows('update-comment', $this),
            'delete' => Gate::allows('delete-comment', $this),
        ];

        // Check if the comment has replies
        if ($this->comments->isNotEmpty()) {
            // Loop through each reply
            $this->comments->each(function ($reply) {
                // Set permissions for the reply
                $reply->setPermissions();
            });
        }
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->with(['comments' => function ($query) {
            $query->with('user')->withCount([
                'likes as liked' => function ($q) {
                    $q->where('user_id', auth()->id());
                },
                'likes as total_likes'
            ])->withCasts(['liked' => 'boolean']);
        }])->with('user');
    }
}
