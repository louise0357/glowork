<?php
namespace App\Policies;

use App\Models\KanbanComment;
use App\Models\User;

class KanbanCommentPolicy
{
    public function update(User $user, KanbanComment $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, KanbanComment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
