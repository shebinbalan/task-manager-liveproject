<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }
                public function update(User $user, Comment $comment)
            {
                return $user->id === $comment->user_id; // Allow editing only if the user owns the comment
            }

            public function delete(User $user, Comment $comment)
            {
                return $user->id === $comment->user_id; // Allow deletion only if the user owns the comment
            }

}
