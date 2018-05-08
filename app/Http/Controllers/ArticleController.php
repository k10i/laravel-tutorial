<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Article;

class ArticleController extends Controller
{

  /**
   * ブログ　ホーム
   *
   * @return Response
   */
    public function index()
    {
        Log::info('Article Index');
        // $articles = Article::all();
        $articles = Article::paginate(5);
        return view('article.index', ['articles' => $articles]);
    }


    public function create()
    {
        return view('article.create');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:10',
                'body' => 'required',
                'attachment' => 'image',
            ],
            [
                'title.required' => 'タイトルを入力してください',
                'title.max' => 'タイトルは10文字以内で入力してください',
                'body.required' => '本文を入力してください',
                'attachment.image' => '画像ファイルを選択してください',
            ]
        );

        $article = new Article;


        $article->title = $request->title;
        $article->body = $request->body;

        if ($request->file('attachment')) {
            $article->attachment = basename($request->attachment->store('public/attachment'));
        }

        $article->save();

        $request->session()->flash('message', '登録しました');
        return redirect('/articles/' . $article->id);
    }

    public function edit(Request $request, $id)
    {
        $article = Article::find($id);
        return view('article.edit', ['article' => $article]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
              'title' => 'required|max:10',
              'body' => 'required',
              'attachment' => 'image',
            ],
            [
                'title.required' => 'タイトルを入力してください',
                'title.max' => 'タイトルは10文字以内で入力してください',
                'body.required' => '本文を入力してください',
                'attachment.image' => '画像ファイルを選択してください',
            ]
        );


        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->body = $request->body;

        if ($request->file('attachment')) {
            $article->attachment = basename($request->attachment->store('public/attachment'));
        }

        $article->save();

        $request->session()->flash('message', '更新しました');
        return redirect('/articles/' . $article->id);
    }

    public function show(Request $request, $id)
    {
        Log::info('Article Show:' . $id);

        $article = Article::find($id);

        return view('article.show', ['article' => $article]);
    }

    public function delete(Request $request)
    {
        Article::destroy($request->id);
        return view('article.delete');
    }
}
