<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function store(Request $request) {
    $comment = new Comment();
    $comment->article_id = $request->article_id;
    $comment->comment = $request->comment;
    $comment->save();

    return redirect('/articles/' . $request->article_id);
  }
}
