<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth; 

class PostCommentController extends Controller
{
    public function store($community_slug, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => Request::input('content')
        ]);

        return back();
    }

    public function destroy($community_slug, Post $post, $commentId)
    {
        $comment = $post->comments()->findOrFail($commentId);

        // Проверить, является ли текущий пользователь владельцем комментария или имеет другие права на удаление
        if (Auth::id() === $comment->user_id || Auth::user()->can('delete', $comment)) {
            $comment->delete();
            return back()->with('success', 'Комментарий удален.');
        }

        return back()->with('error', 'Недостаточно прав для удаления этого комментария.');
    }
}
