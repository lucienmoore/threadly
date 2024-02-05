<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;


class PostCommentController extends Controller
{
    public function store(Request $request, $community_slug, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content')
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:1',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $comment = Comment::findOrFail($id);
        $this->authorize('update', $comment);
        $comment->content = $request->input('content');
        $comment->save();
    
        return redirect()->back()->with('message', 'Комментарий обновлен успешно.');
    }
    

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
    
        $comment->delete();
    
        return back()->with('message', 'Комментарий успешно удален.');
    }
    
}
