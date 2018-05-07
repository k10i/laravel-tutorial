<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index() {
      $articles = Article::all();
      return view('article.index', ['articles' => $articles]);
    }


    public function create() {
      return view('article.create');
    }


    public function store(Request $request) {
      $request->validate([
          'title' => 'required|max:10',
          'body' => 'required',
      ],
      [
        'title.required' => 'タイトルを入力してください',
        'title.max' => 'タイトルは10文字以内で入力してください',
        'body.required' => '本文を入力してください',
      ]
    );

      $article = new Article;
      $article->title = $request->title;
      $article->body = $request->body;
      $article->save();

      $request->session()->flash('message', '登録しました');
      return redirect('/articles/' . $article->id);
    }

    public function edit(Request $request, $id) {
        $article = Article::find($id);
        return view('article.edit', ['article' => $article]);
    }

    public function update(Request $request) {
        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        return view('article.update');
    }

    public function show(Request $request, $id) {
        $article = Article::find($id);

        return view('article.show', ['article' => $article]);
    }

    public function delete(Request $request) {
        Article::destroy($request->id);
        return view('article.delete');
    }
}
