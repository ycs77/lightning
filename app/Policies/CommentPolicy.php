<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment)
    {
        return in_array($user->id, [
            $comment->post->author_id,
            $comment->commenter_id,
        ]);
    }
}
