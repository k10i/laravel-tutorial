<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function store(Request $request) {
    $request->validate([
        'comment' => 'required|max:10',
    ],
    [
      'comment.required' => 'コメントを入力してください',
      'comment.max' => 'コメントは10文字以内で入力してください',
    ]
  );

    $comment = new Comment();
    $comment->article_id = $request->article_id;
    $comment->comment = $request->comment;
    $comment->save();

    $request->session()->flash('message', 'コメントを登録しました');
    return redirect('/articles/' . $request->article_id);
  }
}
